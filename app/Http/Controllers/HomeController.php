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
    public function index()
    {
        $latestItems = Item::with(['genres', 'stock', 'reviews'])
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $genres = Genre::all();

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

