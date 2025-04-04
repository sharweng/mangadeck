<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'item_id',
        'rating',
        'comment',
        'is_approved',
    ];

    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the item that owns the review.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Check if the review contains bad words.
     */
    public function containsBadWords()
    {
        $badWords = BadWord::pluck('word')->toArray();
        $comment = strtolower($this->comment);
        
        foreach ($badWords as $word) {
            if (str_contains($comment, strtolower($word))) {
                return true;
            }
        }
        
        return false;
    }
}