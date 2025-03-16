<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'price',
        'publisher_id',
        'publication_date',
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
     * Get the publisher of the item.
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    /**
     * The authors that belong to the item.
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class)
            ->withPivot('role')
            ->withTimestamps();
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

    /**
     * Get all images for this item.
     */
    public function images()
    {
        return $this->hasMany(ItemImage::class)->orderBy('sort_order');
    }

    /**
     * Get the primary image for this item.
     */
    public function primaryImage()
    {
        return $this->hasOne(ItemImage::class)->where('is_primary', true);
    }

    /**
     * Get the primary image path or a default image if none exists.
     */
    public function getImagePathAttribute()
    {
        $primaryImage = $this->primaryImage;
        return $primaryImage ? $primaryImage->image_path : 'default_manga.jpg';
    }

    /**
     * Get the order lines for the item.
     */
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

    /**
     * Get the main author of the item.
     */
    public function getMainAuthorAttribute()
    {
        return $this->authors()->where('role', 'Author')->first();
    }

    /**
     * Get a comma-separated list of author names.
     */
    public function getAuthorNamesAttribute()
    {
        return $this->authors->pluck('name')->implode(', ');
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        // When an item is deleted (even soft deleted), delete its images
        static::deleting(function($item) {
            // Get all images for this item
            $images = $item->images;
            
            foreach ($images as $image) {
                // Delete the image file from storage
                if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
                
                // Delete the image record
                $image->delete();
            }
        });
    }
}

