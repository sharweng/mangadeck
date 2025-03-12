<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Genre;
use App\Models\Status;
use App\Models\BadWord;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'activated',
        ]);

        // Create genres
        $genres = [
            ['name' => 'Shonen', 'description' => 'Manga aimed at teenage boys'],
            ['name' => 'Shojo', 'description' => 'Manga aimed at teenage girls'],
            ['name' => 'Seinen', 'description' => 'Manga aimed at adult men'],
            ['name' => 'Josei', 'description' => 'Manga aimed at adult women'],
            ['name' => 'Isekai', 'description' => 'Stories about characters transported to another world'],
            ['name' => 'Mecha', 'description' => 'Stories featuring robots and mechanical technology'],
            ['name' => 'Fantasy', 'description' => 'Stories with magical or supernatural elements'],
            ['name' => 'Horror', 'description' => 'Stories designed to frighten or scare'],
            ['name' => 'Romance', 'description' => 'Stories focused on romantic relationships'],
            ['name' => 'Sports', 'description' => 'Stories centered around athletics and competition'],
        ];
        
        foreach ($genres as $genre) {
            Genre::create($genre);
        }

        // Create order statuses
        $statuses = [
            ['name' => 'Pending', 'description' => 'Order has been placed but not processed'],
            ['name' => 'Processing', 'description' => 'Order is being processed'],
            ['name' => 'Shipped', 'description' => 'Order has been shipped'],
            ['name' => 'Delivered', 'description' => 'Order has been delivered'],
            ['name' => 'Cancelled', 'description' => 'Order has been cancelled'],
        ];
        
        foreach ($statuses as $status) {
            Status::create($status);
        }

        // Create bad words list
        $badWords = [
            'badword1',
            'badword2',
            'badword3',
            // Add other inappropriate words here
        ];
        
        foreach ($badWords as $word) {
            BadWord::create(['word' => $word]);
        }
    }
}

