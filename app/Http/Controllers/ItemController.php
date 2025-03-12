<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
use App\Models\Review;
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
        
        $query = Item::with(['genre', 'stock', 'reviews']);
        
        if ($selectedGenre) {
            $query->where('genre_id', $selectedGenre);
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }
        
        $items = $query->paginate(12);
        
        return view('items.index', compact('items', 'genres', 'selectedGenre', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Item::class);
        
        $genres = Genre::all();
        
        return view('items.create', compact('genres'));
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
            'genre_id' => 'required|exists:genres,id',
            'author' => 'nullable|string|max:255',
            'pages' => 'nullable|integer|min:1',
            'publisher' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'isbn' => 'nullable|string|max:20',
            'image' => 'nullable|image|max:2048',
            'quantity' => 'required|integer|min:0',
        ]);
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
            $validated['img_path'] = $imagePath;
        }
        
        $item = Item::create($validated);
        
        $item->stock()->create([
            'quantity' => $validated['quantity'],
        ]);
        
        return redirect()->route('admin.items.index')
            ->with('success', 'Manga created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $item->load(['genre', 'stock', 'reviews' => function($query) {
            $query->where('is_approved', true)->with('user');
        }]);
        
        $relatedItems = Item::where('genre_id', $item->genre_id)
            ->where('id', '!=', $item->id)
            ->take(4)
            ->get();
        
        return view('items.show', compact('item', 'relatedItems'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        
        $genres = Genre::all();
        $item->load('stock');
        
        return view('items.edit', compact('item', 'genres'));
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
            'genre_id' => 'required|exists:genres,id',
            'author' => 'nullable|string|max:255',
            'pages' => 'nullable|integer|min:1',
            'publisher' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'isbn' => 'nullable|string|max:20',
            'image' => 'nullable|image|max:2048',
            'quantity' => 'required|integer|min:0',
        ]);
        
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($item->img_path) {
                Storage::disk('public')->delete($item->img_path);
            }
            $imagePath = $request->file('image')->store('items', 'public');
            $validated['img_path'] = $imagePath;
        }
        
        $item->update($validated);
        
        $item->stock()->update([
            'quantity' => $validated['quantity'],
        ]);
        
        return redirect()->route('admin.items.index')
            ->with('success', 'Manga updated successfully.');
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
        $items = Item::with(['genre', 'stock']);
        
        return DataTables::of($items)
            ->addColumn('stock', function($item) {
                return $item->stock ? $item->stock->quantity : 0;
            })
            ->addColumn('genre', function($item) {
                return $item->genre->name;
            })
            ->addColumn('actions', function($item) {
                return view('admin.items.actions', compact('item'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}

