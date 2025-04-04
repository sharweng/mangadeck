<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.genres.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', // Added validation for description
        ]);

        Genre::create([
            'name' => $request->name,
            'description' => $request->description, // Added description field
        ]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre created successfully.');
    }

       /**
     * Display the specified resource for public view.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        // Load the genre with its related items
        $genre->load(['items' => function($query) {
            $query->with(['primaryImage', 'stock', 'reviews']);
        }]);
        
        return view('genres.show', compact('genre'));
    }

    /**
     * Display the specified resource for admin view.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function adminShow(Genre $genre)
    {
        return view('admin.genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', // Added validation for description
        ]);

        $genre->update([
            'name' => $request->name,
            'description' => $request->description, // Added description field
        ]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', 'Genre deleted successfully.');
    }

    public function getData()
    {
        $genres = Genre::query();
        
        return DataTables::of($genres)
            ->addColumn('items_count', function($genre) {
                return $genre->items()->count();
            })
            ->addColumn('actions', function($genre) {
                return view('admin.genres.actions', compact('genre'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}