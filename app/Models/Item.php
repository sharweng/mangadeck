<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'img_path',
        'genre_id',
        'author',
        'pages',
        'publisher',
        'publication_date',
        'isbn',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_date' => 'date',
        'price' => 'decimal:2',
    ];

    /**
     * Get the genre that owns the item.
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * Get the stock for the item.
     */
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    /**
     * Get the order lines for the item.
     */
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

    /**
     * Get the reviews for the item.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Check if the item is in stock.
     */
    public function isInStock()
    {
        return $this->stock && $this->stock->quantity > 0;
    }

    /**
     * Get the average rating for the item.
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->where('is_approved', true)->avg('rating') ?? 0;
    }
}

