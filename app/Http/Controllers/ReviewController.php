<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Item;
use App\Models\BadWord;
use App\Models\OrderInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    /**
     * Check if user has purchased and received the item.
     */
    private function hasPurchasedItem($userId, $itemId)
    {
        // Get the customer ID for the user
        $customer = Auth::user()->customer;
        
        if (!$customer) {
            return false;
        }
        
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
     * Check if text contains bad words and return filtered text
     */
    private function filterBadWords($text)
    {
        $badWords = BadWord::all()->pluck('word')->toArray();
        
        if (empty($badWords)) {
            // Use default bad words if none exist in the database
            $badWords = BadWord::getDefaultBadWords();
        }
        
        $hasBadWords = false;
        $filteredText = $text;
        
        foreach ($badWords as $word) {
            // Create a regex pattern that matches the word with word boundaries
            $pattern = '/\b' . preg_quote($word, '/') . '\b/i';
            
            // Check if the word exists in the text
            if (preg_match($pattern, $text)) {
                $hasBadWords = true;
                
                // Replace the word with asterisks of the same length
                $replacement = str_repeat('*', strlen($word));
                $filteredText = preg_replace($pattern, $replacement, $filteredText);
            }
        }
        
        return [
            'hasBadWords' => $hasBadWords,
            'filteredText' => $filteredText
        ];
    }

    /**
     * Store a newly created review.
     */
    public function store(Request $request, Item $item)
    {
        $this->authorize('create', Review::class);
        
        // Check if user has purchased and received this item
        if (!$this->hasPurchasedItem(Auth::id(), $item->id)) {
            return redirect()->back()
                ->with('error', 'You can only review products you have purchased and received.');
        }
        
        // Check if user has already reviewed this item
        $existingReview = Review::where('user_id', Auth::id())
            ->where('item_id', $item->id)
            ->first();
            
        if ($existingReview) {
            return redirect()->back()
                ->with('error', 'You have already reviewed this product. You can edit your existing review.');
        }
        
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ]);
        
        // Filter bad words
        $filteredResult = $this->filterBadWords($validated['comment']);
        
        $review = new Review([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'rating' => $validated['rating'],
            'comment' => $filteredResult['filteredText'],
            'is_approved' => !$filteredResult['hasBadWords'],
        ]);
        
        $review->save();
        
        if ($filteredResult['hasBadWords']) {
            return redirect()->back()
                ->with('warning', 'Your review has been submitted but requires approval due to potentially inappropriate content.');
        } else {
            return redirect()->back()
                ->with('success', 'Your review has been submitted successfully.');
        }
    }

    /**
     * Show the form for editing a review.
     */
    public function edit(Item $item, Review $review)
    {
        $this->authorize('update', $review);
        
        // Check if user has purchased and received this item
        if (!$this->hasPurchasedItem(Auth::id(), $item->id)) {
            return redirect()->route('items.show', $item)
                ->with('error', 'You can only review products you have purchased and received.');
        }
        
        return view('reviews.edit', compact('item', 'review'));
    }

    /**
     * Update the specified review.
     */
    public function update(Request $request, Item $item, Review $review)
    {
        $this->authorize('update', $review);
        
        // Check if user has purchased and received this item
        if (!$this->hasPurchasedItem(Auth::id(), $item->id)) {
            return redirect()->route('items.show', $item)
                ->with('error', 'You can only review products you have purchased and received.');
        }
        
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ]);
        
        // Filter bad words
        $filteredResult = $this->filterBadWords($validated['comment']);
        
        $review->update([
            'rating' => $validated['rating'],
            'comment' => $filteredResult['filteredText'],
            'is_approved' => !$filteredResult['hasBadWords'],
        ]);
        
        if ($filteredResult['hasBadWords']) {
            return redirect()->route('items.show', $item)
                ->with('warning', 'Your review has been updated but requires approval due to potentially inappropriate content.');
        } else {
            return redirect()->route('items.show', $item)
                ->with('success', 'Your review has been updated successfully.');
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
            ->addColumn('user', function($review) {
                return $review->user->name;
            })
            ->addColumn('item', function($review) {
                return $review->item->title;
            })
            ->addColumn('status', function($review) {
                return $review->is_approved ? 
                    '<span class="badge bg-success">Approved</span>' : 
                    '<span class="badge bg-warning">Pending</span>';
            })
            ->addColumn('actions', function($review) {
                return view('admin.reviews.actions', compact('review'))->render();
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}