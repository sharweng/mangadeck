<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'item_id'];
    
    // Set the primary key to item_id instead of id
    protected $primaryKey = 'item_id';
    
    // Specify that the primary key is not auto-incrementing
    public $incrementing = false;

    /**
     * Get the item that owns the stock.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
    /**
     * Check if the item is in stock.
     */
    public function isInStock()
    {
        return $this->quantity > 0;
    }
}

