<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Publisher;
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

    public function index(Request $request)
    {
        $query = Item::query()->with(['genres', 'primaryImage', 'reviews', 'authors', 'publisher']);
        
        // Search filter
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhereHas('authors', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });
        }
        
        // Genre filter - require ALL selected genres
        if ($request->has('genres') && is_array($request->input('genres'))) {
            $selectedGenres = array_filter($request->input('genres'));
            if (!empty($selectedGenres)) {
                foreach ($selectedGenres as $genreId) {
                    $query->whereHas('genres', function($q) use ($genreId) {
                        $q->where('genres.id', $genreId);
                    });
                }
            }
        }
        
        // Price range filter - min/max
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }
        
        // Author filter - text input
        if ($request->filled('author')) {
            $authorNames = array_filter(array_map('trim', explode(';', $request->input('author'))));
            $query->whereHas('authors', function($q) use ($authorNames) {
                $q->where(function($subQuery) use ($authorNames) {
                    foreach ($authorNames as $name) {
                        $subQuery->orWhere('name', 'like', "%{$name}%");
                    }
                });
            });
        }
        
        // Publisher filter
        if ($request->has('publisher') && $request->input('publisher')) {
            $query->where('publisher_id', $request->input('publisher'));
        }
        
        // Sorting
        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'top_rated':
                    $query->withAvg('reviews', 'rating')
                        ->orderBy('reviews_avg_rating', 'desc');
                    break;
                default:
                    $query->orderBy('title');
                    break;
            }
        } else {
            $query->orderBy('title');
        }
        
        // Get all filters for the view
        $genres = Genre::withCount('items')->get();
        $publishers = Publisher::has('items')->orderBy('name')->get();
        
        $items = $query->paginate(15)->withQueryString();
        
        return view('items.index', [
            'items' => $items,
            'genres' => $genres,
            'publishers' => $publishers,
            'search' => $request->search,
            'selectedGenres' => $request->genres ?? [], // Pass selected genres as array
            'minPrice' => $request->min_price,
            'maxPrice' => $request->max_price,
            'author' => $request->author,
            'selectedPublisher' => $request->publisher,
            'selectedSort' => $request->sort
        ]);
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
            ->take(5)
            ->get();
            
        // Calculate average rating for related items
        foreach ($relatedItems as $relatedItem) {
            $relatedItem->average_rating = $relatedItem->reviews->avg('rating') ?: 0;
        }
        
        // Check if user has purchased and received this item
        $userHasPurchased = $this->userHasPurchased($item->id);
        
        // Check if user has ordered but not yet received this item
        $userHasOrderedButNotReceived = $this->userHasOrderedButNotReceived($item->id);
        
        return view('items.show', compact(
            'item', 
            'relatedItems', 
            'userHasPurchased', 
            'userHasOrderedButNotReceived'
        ));
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