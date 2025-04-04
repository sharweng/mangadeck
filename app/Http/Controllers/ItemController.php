<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search ?? '';
        $selectedGenre = $request->genre ?? null;
        
        $query = Item::with(['genres', 'stock', 'reviews', 'primaryImage']);
        
        // Apply genre filter if selected
        if ($selectedGenre) {
            $query->whereHas('genres', function($q) use ($selectedGenre) {
                $q->where('genres.id', $selectedGenre);
            });
        }
        
        // Apply search filter if provided
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Get paginated results - this is the key change
        $items = $query->orderBy('title')->paginate(12);
        
        // Get all genres for the filter dropdown
        $genres = Genre::orderBy('name')->get();
        
        return view('items.index', compact('items', 'genres', 'selectedGenre', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // Load relationships
        $item->load(['genres', 'stock', 'reviews', 'images', 'authors', 'publisher']);
        
        // Calculate average rating
        $item->average_rating = $item->reviews->avg('rating') ?: 0;
        
        // Get related items based on genres
        $genreIds = $item->genres->pluck('id');
        
        $relatedItems = Item::with(['genres', 'stock', 'reviews', 'primaryImage'])
            ->whereHas('genres', function($query) use ($genreIds) {
                $query->whereIn('genres.id', $genreIds);
            })
            ->where('id', '!=', $item->id)
            ->take(4)
            ->get();
            
        // Calculate average rating for related items
        foreach ($relatedItems as $relatedItem) {
            $relatedItem->average_rating = $relatedItem->reviews->avg('rating') ?: 0;
        }
        
        return view('items.show', compact('item', 'relatedItems'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}