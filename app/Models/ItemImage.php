<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ItemImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Get the item that owns the image.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the full storage path for the image.
     */
    public function getFullPathAttribute()
    {
        return storage_path('app/public/' . $this->image_path);
    }

    // /**
    //  * Get the URL for the image.
    //  */
    // public function getUrlAttribute()
    // {
    //     return asset('storage/' . $this->image_path);
    // }

    // /**
    //  * Check if the image file exists in storage.
    //  */
    // public function fileExists()
    // {
    //     return Storage::disk('public')->exists($this->image_path);
    // }

   /**
     * Check if the image file exists in storage.
     */
    public function fileExists()
    {
        $exists = Storage::disk('public')->exists($this->image_path);
        
        if ($exists) {
            // Check if the file is readable
            $fullPath = storage_path('app/public/' . $this->image_path);
            $isReadable = is_readable($fullPath);
            
            if (!$isReadable) {
                \Log::warning("Image file exists but is not readable: {$this->image_path}");
            }
            
            return $isReadable;
        }
        
        \Log::warning("Image file not found: {$this->image_path} for image ID: {$this->id}");
        return false;
    }

    /**
     * Get file size of the image.
     */
    public function getFileSizeAttribute()
    {
        if ($this->fileExists()) {
            $fullPath = storage_path('app/public/' . $this->image_path);
            return filesize($fullPath);
        }
        return 0;
    }

    /**
     * Get the URL for the image.
     */
    public function getUrlAttribute()
    {
        if ($this->fileExists()) {
            return asset('storage/' . $this->image_path);
        }
        return asset('images/no-image.jpg');
    }
}

