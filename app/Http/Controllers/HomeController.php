<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Get latest items for the carousel/featured section
        $latestItems = Item::with(['genres', 'stock', 'reviews'])
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $genres = Genre::all();

        // If search query is provided, use Laravel Scout
        if ($search && strlen(trim($search)) > 0) {
            try {
                // Use Laravel Scout for searching
                $searchResults = Item::search($search)->paginate(15);
                
                // Load relationships after getting results
                if ($searchResults->isNotEmpty()) {
                    $itemIds = $searchResults->pluck('id')->toArray();
                    $fullItems = Item::with(['genres', 'stock', 'reviews', 'primaryImage'])
                        ->whereIn('id', $itemIds)
                        ->get()
                        ->keyBy('id');
                    
                    // Replace the basic models with fully loaded ones
                    foreach ($searchResults as $key => $result) {
                        if (isset($fullItems[$result->id])) {
                            $searchResults[$key] = $fullItems[$result->id];
                        }
                    }
                }
                
                return view('home', compact('latestItems', 'genres', 'searchResults', 'search'));
            } catch (\Exception $e) {
                // Fallback to database search if Scout fails
                $searchResults = Item::with(['genres', 'stock', 'reviews', 'primaryImage'])
                    ->where(function($query) use ($search) {
                        $query->where('title', 'like', "%{$search}%")
                              ->orWhere('description', 'like', "%{$search}%");
                    })
                    ->orWhereHas('authors', function($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('genres', function($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->paginate(15);
                    
                return view('home', compact('latestItems', 'genres', 'searchResults', 'search'));
            }
        }

        return view('home', compact('latestItems', 'genres'));
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show the contact page.
     */
    public function contact()
    {
        return view('contact');
    }
}