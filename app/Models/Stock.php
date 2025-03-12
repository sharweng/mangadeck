<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'item_id',
        'quantity',
    ];

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

