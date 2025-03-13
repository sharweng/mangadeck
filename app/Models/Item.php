<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'author',
        'pages',
        'publisher',
        'publication_date',
        'isbn',
        'img_path',
    ];

    protected $casts = [
        'publication_date' => 'date',
        'price' => 'decimal:2',
    ];

    /**
     * The genres that belong to the item.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_item');
    }

    /**
     * Get the primary genre of the item.
     * Since genre_id column is removed, we'll use the first genre from the many-to-many relationship.
     */
    public function genre()
    {
        return $this->belongsToMany(Genre::class, 'genre_item')->limit(1);
    }

    /**
     * Get the stock associated with the item.
     */
    public function stock()
    {
        return $this->hasOne(Stock::class);
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
}

