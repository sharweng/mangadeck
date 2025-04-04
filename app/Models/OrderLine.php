<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orderlines'; // Specify the actual table name in your database

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'orderinfo_id',
        'item_id',
        'quantity',
        'price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get the order that owns the order line.
     */
    public function order()
    {
        return $this->belongsTo(OrderInfo::class, 'orderinfo_id');
    }

    /**
     * Get the item that owns the order line.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the subtotal for the order line.
     */
    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}