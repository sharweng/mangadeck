<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Item;
use App\Models\BadWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    /**
     * Store a newly created review.
     */
    public function store(Request $request, Item $item)
    {
        $this->authorize('create', Review::class);
        
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ]);
        
        // Check for bad words
        $badWords = BadWord::pluck('word')->toArray();
        $comment = strtolower($validated['comment']);
        $hasBadWords = false;
        
        foreach ($badWords as $word) {
            if (str_contains($comment, strtolower($word))) {
                $hasBadWords = true;
                break;
            }
        }
        
        $review = new Review([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => !$hasBadWords,
        ]);
        
        $review->save();
        
        if ($hasBadWords) {
            return redirect()->back()
                ->with('warning', 'Your review has been submitted but requires approval due to potentially inappropriate content.');
        } else {
            return redirect()->back()
                ->with('success', 'Your review has been submitted successfully.');
        }
    }

    /**
     * Display a listing of reviews for admin.
     */
    public function index()
    {
        $this->authorize('viewAny', Review::class);
        
        return view('admin.reviews.index');
    }

    /**
     * Update the specified review approval status.
     */
    public function approve(Review $review)
    {
        $this->authorize('update', $review);
        
        $review->update(['is_approved' => true]);
        
        return redirect()->back()
            ->with('success', 'Review approved successfully.');
    }

    /**
     * Remove the specified review.
     */
    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        
        $review->delete();
        
        return redirect()->back()
            ->with('success', 'Review deleted successfully.');
    }

    /**
     * Get reviews data for DataTables.
     */
    public function getData()
    {
        $reviews = Review::with(['user', 'item']);
        
        return DataTables::of($reviews)
            ->addColumn('username', function($review) {
                return $review->user->name;
            })
            ->addColumn('item_title', function($review) {
                return $review->item->title;
            })
            ->addColumn('status', function($review) {
                return $review->is_approved ? 'Approved' : 'Pending';
            })
            ->addColumn('actions', function($review) {
                return view('admin.reviews.actions', compact('review'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}

