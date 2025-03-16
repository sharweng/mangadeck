<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            GenreSeeder::class,
            StatusSeeder::class,
            CustomerSeeder::class,
            ItemSeeder::class,
            ItemImageSeeder::class,
            StockSeeder::class,

            PublisherSeeder::class,
            AuthorSeeder::class,

            UpdateItemsSeeder::class,
            AuthorItemSeeder::class,
        ]);
    }
}