<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the items.
     */
    public function index(Request $request)
    {
        $query = Item::with(['genres', 'authors', 'publisher', 'stock', 'primaryImage']);
        
        // Apply search if provided
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
        
        // Apply genre filter if provided
        if ($request->has('genre') && $request->genre) {
            $query->whereHas('genres', function($q) use ($request) {
                $q->where('genres.id', $request->genre);
            });
        }
        
        // Apply author filter if provided
        if ($request->has('author') && $request->author) {
            $query->whereHas('authors', function($q) use ($request) {
                $q->where('authors.id', $request->author);
            });
        }
        
        // Apply publisher filter if provided
        if ($request->has('publisher') && $request->publisher) {
            $query->where('publisher_id', $request->publisher);
        }
        
        // Apply sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);
        
        $items = $query->paginate(12);
        $genres = Genre::orderBy('name')->get();
        
        return view('items.index', compact('items', 'genres'));
    }

    /**
     * Display the specified item.
     */
    public function show(Item $item)
    {
        $item->load(['genres', 'authors', 'publisher', 'stock', 'images', 'reviews' => function($query) {
            $query->where('is_approved', true)->latest();
        }]);
        
        // Get related items based on genres
        $relatedItems = Item::whereHas('genres', function($query) use ($item) {
            $query->whereIn('genres.id', $item->genres->pluck('id'));
        })
        ->where('id', '!=', $item->id)
        ->with('primaryImage')
        ->take(4)
        ->get();
        
        return view('items.show', compact('item', 'relatedItems'));
    }
}