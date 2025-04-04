<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
use App\Models\OrderInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Check if the authenticated user has purchased and received the item.
     */
    private function userHasPurchased($itemId)
    {
        if (!Auth::check() || !Auth::user()->customer) {
            return false;
        }
        
        $customer = Auth::user()->customer;
        
        // Check if the customer has any delivered orders containing this item
        return OrderInfo::where('customer_id', $customer->id)
            ->whereHas('status', function($query) {
                $query->where('name', 'Delivered');
            })
            ->whereHas('orderlines', function($query) use ($itemId) {
                $query->where('item_id', $itemId);
            })
            ->exists();
    }
    
    /**
     * Check if the authenticated user has ordered but not yet received the item.
     */
    private function userHasOrderedButNotReceived($itemId)
    {
        if (!Auth::check() || !Auth::user()->customer) {
            return false;
        }
        
        $customer = Auth::user()->customer;
        
        // Check if the customer has any non-delivered orders containing this item
        return OrderInfo::where('customer_id', $customer->id)
            ->whereHas('status', function($query) {
                $query->where('name', '!=', 'Delivered');
            })
            ->whereHas('orderlines', function($query) use ($itemId) {
                $query->where('item_id', $itemId);
            })
            ->exists();
    }

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
        
        // Get paginated results
        $items = $query->orderBy('title')->paginate(12);
        
        // Get all genres for the filter dropdown
        $genres = Genre::orderBy('name')->get();
        
        return view('items.index', compact('items', 'genres', 'selectedGenre', 'search'));
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
        
        // Check if user has purchased and received this item
        $userHasPurchased = $this->userHasPurchased($item->id);
        
        // Check if user has ordered but not yet received this item
        $userHasOrderedButNotReceived = $this->userHasOrderedButNotReceived($item->id);
        
        return view('items.show', compact('item', 'relatedItems', 'userHasPurchased', 'userHasOrderedButNotReceived'));
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