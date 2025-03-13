<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
use App\Models\Review;
use App\Models\Stock;
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
        
        $query = Item::with(['genres', 'stock', 'reviews']);
        
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
            'image' => 'nullable|image|max:2048',
            'quantity' => 'required|integer|min:0',
        ]);
        
        // Start a database transaction
        \DB::beginTransaction();
        
        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('items', 'public');
            }
            
            $item = Item::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'img_path' => $imagePath,
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
        $item->load(['genres', 'stock', 'reviews' => function($query) {
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
        $item->load(['genres', 'stock']);
        
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
            'image' => 'nullable|image|max:2048',
            'quantity' => 'required|integer|min:0',
        ]);
        
        // Start a database transaction
        \DB::beginTransaction();
        
        try {
            $imagePath = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Delete old image if it exists
                if ($item->img_path) {
                    Storage::disk('public')->delete($item->img_path);
                }
                $imagePath = $request->file('image')->store('items', 'public');
            }
            
            $item->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'img_path' => $imagePath ?? $item->img_path,
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
        
        if ($item->img_path) {
            Storage::disk('public')->delete($item->img_path);
        }
        
        $item->delete();
        
        return redirect()->route('admin.items.index')
            ->with('success', 'Manga deleted successfully.');
    }

    /**
     * Get items data for DataTables.
     */
    public function getData()
    {
        $items = Item::with(['genres', 'stock']);
        
        return DataTables::of($items)
            ->addColumn('stock_quantity', function($item) {
                return $item->stock ? $item->stock->quantity : 0;
            })
            ->addColumn('genres_list', function($item) {
                return $item->genres->pluck('name')->implode(', ');
            })
            ->addColumn('actions', function($item) {
                return view('admin.items.actions', compact('item'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}

