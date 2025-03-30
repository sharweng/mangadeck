<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ItemsExport;
use App\Http\Controllers\Controller;
use App\Imports\ItemsImport;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Publisher;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        
        return view('admin.items.index', compact('genres', 'authors', 'publishers'));
    }

    /**
     * Process datatables ajax request.
     */
    public function getData(Request $request)
    {
        $query = Item::with(['genres', 'authors', 'publisher', 'stock'])
            ->select('items.*');
        
        // Apply filters if provided
        if ($request->has('genre_id') && $request->genre_id) {
            $query->whereHas('genres', function($q) use ($request) {
                $q->where('genres.id', $request->genre_id);
            });
        }
        
        // Handle multiple author names separated by semicolons
        if ($request->has('author_names') && $request->author_names) {
            $authorNames = array_map('trim', explode(';', $request->author_names));
            
            $query->whereHas('authors', function($q) use ($authorNames) {
                $q->where(function($subQuery) use ($authorNames) {
                    foreach ($authorNames as $index => $name) {
                        if ($index === 0) {
                            $subQuery->where('name', 'like', '%' . $name . '%');
                        } else {
                            $subQuery->orWhere('name', 'like', '%' . $name . '%');
                        }
                    }
                });
            });
        }
        
        if ($request->has('publisher_id') && $request->publisher_id) {
            $query->where('publisher_id', $request->publisher_id);
        }

        return DataTables::of($query)
            ->addColumn('genres_list', function ($item) {
                return $item->genres->pluck('name')->implode(', ');
            })
            ->addColumn('authors_list', function ($item) {
                return $item->authors->pluck('name')->implode(', ');
            })
            ->addColumn('publisher_name', function ($item) {
                return $item->publisher ? $item->publisher->name : 'N/A';
            })
            ->addColumn('stock_quantity', function ($item) {
                return $item->stock ? $item->stock->quantity : null;
            })
            ->addColumn('actions', function ($item) {
                return view('admin.items.actions', compact('item'));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        
        return view('admin.items.create', compact('genres', 'authors', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'exists:genres,id',
            'author_ids' => 'required|array',
            'author_ids.*' => 'exists:authors,id',
            'author_roles.*' => 'nullable|string|max:255',
            'publisher_id' => 'nullable|exists:publishers,id',
            'publication_date' => 'nullable|date',
            'images.*' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // Create the item
            $item = Item::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'publisher_id' => $request->publisher_id,
                'publication_date' => $request->publication_date,
            ]);

            // Create stock
            Stock::create([
                'item_id' => $item->id,
                'quantity' => $request->quantity,
            ]);

            // Attach genres
            $item->genres()->attach($request->genre_ids);

            // Attach authors with roles
            foreach ($request->author_ids as $key => $authorId) {
                if ($authorId) {
                    $role = isset($request->author_roles[$key]) ? $request->author_roles[$key] : null;
                    $item->authors()->attach($authorId, ['role' => $role]);
                }
            }

            // Handle images
            if ($request->hasFile('images')) {
                $isPrimary = true; // First image is primary
                $sortOrder = 0;
                
                foreach ($request->file('images') as $image) {
                    $path = $image->store('items', 'public');
                    
                    ItemImage::create([
                        'item_id' => $item->id,
                        'image_path' => $path,
                        'is_primary' => $isPrimary,
                        'sort_order' => $sortOrder,
                    ]);
                    
                    $isPrimary = false;
                    $sortOrder++;
                }
            }

            DB::commit();
            return redirect()->route('admin.items.index')->with('success', 'Manga added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating manga: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $item->load(['genres', 'authors', 'publisher', 'stock', 'images', 'reviews.user']);
        return view('admin.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $item->load(['genres', 'authors', 'publisher', 'stock', 'images']);
        $genres = Genre::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        
        return view('admin.items.edit', compact('item', 'genres', 'authors', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'exists:genres,id',
            'author_ids' => 'required|array',
            'author_ids.*' => 'exists:authors,id',
            'author_roles.*' => 'nullable|string|max:255',
            'publisher_id' => 'nullable|exists:publishers,id',
            'publication_date' => 'nullable|date',
            'new_images.*' => 'nullable|image|max:2048',
            'primary_image_id' => 'nullable|exists:item_images,id',
            'delete_image_ids' => 'nullable|array',
            'delete_image_ids.*' => 'exists:item_images,id',
        ]);

        DB::beginTransaction();
        try {
            // Update the item
            $item->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'publisher_id' => $request->publisher_id,
                'publication_date' => $request->publication_date,
            ]);

            // Update stock
            if ($item->stock) {
                $item->stock->update(['quantity' => $request->quantity]);
            } else {
                Stock::create([
                    'item_id' => $item->id,
                    'quantity' => $request->quantity,
                ]);
            }

            // Update genres
            $item->genres()->sync($request->genre_ids);

            // Update authors
            $item->authors()->detach();
            foreach ($request->author_ids as $key => $authorId) {
                if ($authorId) {
                    $role = isset($request->author_roles[$key]) ? $request->author_roles[$key] : null;
                    $item->authors()->attach($authorId, ['role' => $role]);
                }
            }

            // Handle image deletions
            if ($request->has('delete_image_ids')) {
                foreach ($request->delete_image_ids as $imageId) {
                    $image = ItemImage::find($imageId);
                    if ($image) {
                        Storage::disk('public')->delete($image->image_path);
                        $image->delete();
                    }
                }
            }

            // Update primary image
            if ($request->has('primary_image_id')) {
                ItemImage::where('item_id', $item->id)->update(['is_primary' => false]);
                ItemImage::where('id', $request->primary_image_id)->update(['is_primary' => true]);
            }

            // Handle new images
            if ($request->hasFile('new_images')) {
                $sortOrder = $item->images->max('sort_order') + 1;
                $isPrimary = $item->images->count() == 0; // Only set as primary if no other images
                
                foreach ($request->file('new_images') as $image) {
                    $path = $image->store('items', 'public');
                    
                    ItemImage::create([
                        'item_id' => $item->id,
                        'image_path' => $path,
                        'is_primary' => $isPrimary,
                        'sort_order' => $sortOrder,
                    ]);
                    
                    $isPrimary = false;
                    $sortOrder++;
                }
            }

            DB::commit();
            return redirect()->route('admin.items.index')->with('success', 'Manga updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating manga: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        try {
            $item->delete(); // Soft delete
            return redirect()->route('admin.items.index')->with('success', 'Manga deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting manga: ' . $e->getMessage());
        }
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trashed()
    {
        return view('admin.items.trashed');
    }

    /**
     * Process datatables ajax request for trashed items.
     */
    public function getTrashedData()
    {
        $query = Item::onlyTrashed()
            ->with(['genres', 'authors', 'publisher', 'stock'])
            ->select('items.*');

        return DataTables::of($query)
            ->addColumn('genres_list', function ($item) {
                return $item->genres->pluck('name')->implode(', ');
            })
            ->addColumn('authors_list', function ($item) {
                return $item->authors->pluck('name')->implode(', ');
            })
            ->addColumn('publisher_name', function ($item) {
                return $item->publisher ? $item->publisher->name : 'N/A';
            })
            ->addColumn('deleted_at_formatted', function ($item) {
                return $item->deleted_at->format('F d, Y');
            })
            ->addColumn('actions', function ($item) {
                return view('admin.items.trashed-actions', compact('item'));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Restore the specified resource.
     */
    public function restore($id)
    {
        try {
            $item = Item::onlyTrashed()->with('images')->findOrFail($id);
            
            // First restore the item
            $item->restore();
            
            // Then restore any related images that might have been soft-deleted
            ItemImage::onlyTrashed()->where('item_id', $id)->restore();
            
            return redirect()->route('admin.items.trashed')->with('success', 'Manga restored successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error restoring manga: ' . $e->getMessage());
        }
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete($id)
    {
        try {
            $item = Item::onlyTrashed()->findOrFail($id);
            
            // Delete all images from storage
            foreach ($item->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }
            
            $item->forceDelete();
            return redirect()->route('admin.items.trashed')->with('success', 'Manga permanently deleted!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error permanently deleting manga: ' . $e->getMessage());
        }
    }


    /**
     * Export items to Excel.
     */
    public function export(Request $request)
    {
        return Excel::download(new ItemsExport, 'manga-items.xlsx');
    }

    /**
     * Show import form.
     */
    public function importForm()
    {
        return view('admin.items.import');
    }

    /**
     * Import items from Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new ItemsImport, $request->file('file'));
            return redirect()->route('admin.items.index')->with('success', 'Items imported successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error importing items: ' . $e->getMessage());
        }
    }

    /**
     * Export a template for item import.
     */
    public function exportTemplate()
    {
        return Excel::download(new \App\Exports\ItemsTemplateExport(), 'manga-import-template.xlsx');
    }
}