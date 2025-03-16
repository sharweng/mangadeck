<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'biography',
        'birth_date',
        'country',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * The items that belong to the author.
     */
    public function items()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('role')
            ->withTimestamps();
    }
}

