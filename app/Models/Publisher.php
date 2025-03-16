<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'country',
        'website',
    ];

    /**
     * Get the items published by this publisher.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}

