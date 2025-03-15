<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all items
        $items = DB::table('items')->get();

        foreach ($items as $item) {
            // Check if stock already exists for this item
            if (DB::table('stocks')->where('item_id', $item->id)->exists()) {
                continue;
            }
            
            DB::table('stocks')->insert([
                'item_id' => $item->id,
                'quantity' => rand(0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}