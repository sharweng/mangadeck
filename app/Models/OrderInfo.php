<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orderinfos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'date_placed',
        'date_shipped',
        'shipping',
        'status_id',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_placed' => 'date',
        'date_shipped' => 'date',
        'shipping' => 'decimal:2',
    ];

    /**
     * Get the customer that owns the order.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the status of the order.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the order lines for the order.
     */
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class, 'orderinfo_id');
    }

    /**
     * Get the total for the order.
     */
    public function getTotalAttribute()
    {
        $subtotal = $this->orderLines->sum(function ($line) {
            return $line->price * $line->quantity;
        });
        
        return $subtotal + $this->shipping;
    }
}

