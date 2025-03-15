<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
use App\Models\Review;
use App\Models\Stock;
use App\Models\ItemImage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $genres = Genre::all();
        $selectedGenre = $request->input('genre');
        $search = $request->input('search');
        
        $query = Item::with(['genres', 'stock', 'reviews', 'images']);
        
        if ($selectedGenre) {
            $query->whereHas('genres', function($q) use ($selectedGenre) {
                $q->where('genres.id', $selectedGenre);
            });
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
            });
        }
        
        $items = $query->paginate(12);
        
        // More explicit route name checking
        $routeName = $request->route()->getName();
        if ($routeName === 'admin.items.index') {
            return view('admin.items.index', compact('items', 'genres', 'selectedGenre', 'search'));
        } else {
            return view('items.index', compact('items', 'genres', 'selectedGenre', 'search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Item::class);
        
        $genres = Genre::all();
        
        return view('admin.items.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Item::class);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'exists:genres,id',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'quantity' => 'required|integer|min:0',
        ]);
        
        // Start a database transaction
        \DB::beginTransaction();
        
        try {
            $item = Item::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'author' => $validated['author'],
                'publisher' => $validated['publisher'],
                'publication_date' => $validated['publication_date'],
            ]);
            
            // Attach genres
            $item->genres()->attach($validated['genre_ids']);
            
            // Create stock
            $item->stock()->create([
                'quantity' => $validated['quantity'],
            ]);
            
            // Handle multiple images
            if ($request->hasFile('images')) {
                $isPrimary = true; // First image is primary
                $sortOrder = 1;
                
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('items', 'public');
                    
                    $item->images()->create([
                        'image_path' => $imagePath,
                        'is_primary' => $isPrimary,
                        'sort_order' => $sortOrder,
                    ]);
                    
                    $isPrimary = false; // Only first image is primary
                    $sortOrder++;
                }
            }
            
            \DB::commit();
            
            return redirect()->route('admin.items.index')
                ->with('success', 'Manga created successfully.');
        } catch (\Exception $e) {
            \DB::rollBack();
            
            // Log the error
            \Log::error('Error creating manga: ' . $e->getMessage());
            
            return back()->withInput()->withErrors([
                'error' => 'There was a problem creating the manga. Please try again. Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Item $item)
    {
        $item->load(['genres', 'stock', 'images', 'reviews' => function($query) {
            $query->where('is_approved', true)->with('user');
        }]);
        
        // Get related items that share at least one genre with this item
        $relatedItems = Item::whereHas('genres', function($query) use ($item) {
            $query->whereIn('genres.id', $item->genres->pluck('id'));
        })
        ->where('id', '!=', $item->id)
        ->take(4)
        ->get();
        
        $routeName = $request->route()->getName();
        if ($routeName === 'admin.items.show') {
            return view('admin.items.show', compact('item'));
        } else {
            return view('items.show', compact('item', 'relatedItems'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        
        $genres = Genre::all();
        $item->load(['genres', 'stock', 'images']);
        
        return view('admin.items.edit', compact('item', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'exists:genres,id',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'new_images' => 'nullable|array',
            'new_images.*' => 'image|max:2048',
            'delete_image_ids' => 'nullable|array',
            'delete_image_ids.*' => 'exists:item_images,id',
            'primary_image_id' => 'nullable|exists:item_images,id',
            'quantity' => 'required|integer|min:0',
        ]);
        
        // Start a database transaction
        \DB::beginTransaction();
        
        try {
            $item->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'author' => $validated['author'],
                'publisher' => $validated['publisher'],
                'publication_date' => $validated['publication_date'],
            ]);
            
            // Sync genres
            $item->genres()->sync($validated['genre_ids']);
            
            // Update stock - using direct DB operations to avoid model issues
            $stock = Stock::where('item_id', $item->id)->first();
            if ($stock) {
                // Update existing stock
                $stock->quantity = $validated['quantity'];
                $stock->save();
            } else {
                // Create new stock
                Stock::create([
                    'item_id' => $item->id,
                    'quantity' => $validated['quantity']
                ]);
            }
            
            // Handle image deletions
            if (!empty($validated['delete_image_ids'])) {
                $imagesToDelete = ItemImage::whereIn('id', $validated['delete_image_ids'])
                    ->where('item_id', $item->id)
                    ->get();
                
                foreach ($imagesToDelete as $image) {
                    // Delete the file from storage
                    if ($image->image_path) {
                        Storage::disk('public')->delete($image->image_path);
                    }
                    $image->delete();
                }
            }
            
            // Set primary image
            if (!empty($validated['primary_image_id'])) {
                // First, set all images as non-primary
                ItemImage::where('item_id', $item->id)
                    ->update(['is_primary' => false]);
                
                // Then set the selected image as primary
                ItemImage::where('id', $validated['primary_image_id'])
                    ->where('item_id', $item->id)
                    ->update(['is_primary' => true]);
            }
            
            // Handle new images
            if ($request->hasFile('new_images')) {
                // Get the highest sort order
                $maxSortOrder = ItemImage::where('item_id', $item->id)
                    ->max('sort_order') ?? 0;
                
                $sortOrder = $maxSortOrder + 1;
                
                // If no images exist and no primary image is set, make the first new image primary
                $makeFirstPrimary = ItemImage::where('item_id', $item->id)
                    ->where('is_primary', true)
                    ->count() === 0;
                
                foreach ($request->file('new_images') as $index => $image) {
                    $imagePath = $image->store('items', 'public');
                    
                    $item->images()->create([
                        'image_path' => $imagePath,
                        'is_primary' => ($index === 0 && $makeFirstPrimary),
                        'sort_order' => $sortOrder,
                    ]);
                    
                    $sortOrder++;
                }
            }
            
            \DB::commit();
            
            return redirect()->route('admin.items.index')
                ->with('success', 'Manga updated successfully.');
        } catch (\Exception $e) {
            \DB::rollBack();
            
            // Log the error
            \Log::error('Error updating manga: ' . $e->getMessage());
            
            return back()->withInput()->withErrors([
                'error' => 'There was a problem updating the manga. Please try again. Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        
        // Delete all associated images from storage
        foreach ($item->images as $image) {
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }
        }
        
        $item->delete();
        
        return redirect()->route('admin.items.index')
            ->with('success', 'Manga deleted successfully.');
    }

    /**
     * Restore a soft-deleted item.
     */
    public function restore($id)
    {
        $this->authorize('restore', Item::class);
        
        $item = Item::withTrashed()->findOrFail($id);
        $item->restore();
        
        return redirect()->route('admin.items.index')
            ->with('success', 'Manga restored successfully.');
    }

    /**
     * Display a listing of trashed items.
     */
    public function trashed()
    {
        $this->authorize('viewTrashed', Item::class);
        
        $trashedItems = Item::onlyTrashed()->with(['genres', 'stock'])->paginate(12);
        
        return view('admin.items.trashed', compact('trashedItems'));
    }

    /**
     * Get items data for DataTables.
     */
    public function getData()
    {
        $items = Item::with(['genres', 'stock', 'images']);
        
        return DataTables::of($items)
            ->addColumn('stock_quantity', function($item) {
                return $item->stock ? $item->stock->quantity : 0;
            })
            ->addColumn('genres_list', function($item) {
                return $item->genres->pluck('name')->implode(', ');
            })
            ->addColumn('image', function($item) {
                $primaryImage = $item->primaryImage;
                if ($primaryImage) {
                    return '<img src="' . Storage::url($primaryImage->image_path) . '" alt="' . $item->title . '" class="img-thumbnail" width="50">';
                }
                return '<span class="text-muted">No image</span>';
            })
            ->addColumn('actions', function($item) {
                return view('admin.items.actions', compact('item'))->render();
            })
            ->rawColumns(['actions', 'image'])
            ->make(true);
    }

    /**
     * Upload multiple images for an item.
     */
    public function uploadImages(Request $request, Item $item)
    {
        $this->authorize('update', $item);
        
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|max:2048',
        ]);
        
        $maxSortOrder = ItemImage::where('item_id', $item->id)
            ->max('sort_order') ?? 0;
        
        $sortOrder = $maxSortOrder + 1;
        $uploadedCount = 0;
        
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('items', 'public');
            
            $item->images()->create([
                'image_path' => $imagePath,
                'is_primary' => false, // Don't change primary image when bulk uploading
                'sort_order' => $sortOrder,
            ]);
            
            $sortOrder++;
            $uploadedCount++;
        }
        
        return response()->json([
            'success' => true,
            'message' => $uploadedCount . ' images uploaded successfully',
        ]);
    }

    /**
     * Update image order and primary status.
     */
    public function updateImages(Request $request, Item $item)
    {
        $this->authorize('update', $item);
        
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:item_images,id',
            'images.*.sort_order' => 'required|integer|min:1',
            'images.*.is_primary' => 'required|boolean',
        ]);
        
        \DB::beginTransaction();
        
        try {
            foreach ($request->images as $imageData) {
                ItemImage::where('id', $imageData['id'])
                    ->where('item_id', $item->id)
                    ->update([
                        'sort_order' => $imageData['sort_order'],
                        'is_primary' => $imageData['is_primary'],
                    ]);
            }
            
            \DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Images updated successfully',
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating images: ' . $e->getMessage(),
            ], 500);
        }
    }
}