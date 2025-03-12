<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'lname',
        'fname',
        'addressline',
        'phone',
        'user_id',
    ];

    /**
     * Get the user that owns the customer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the orders for the customer.
     */
    public function orders()
    {
        return $this->hasMany(OrderInfo::class);
    }

    /**
     * Get the full name of the customer.
     */
    public function getFullNameAttribute()
    {
        return $this->title ? "{$this->title} {$this->fname} {$this->lname}" : "{$this->fname} {$this->lname}";
    }
}

