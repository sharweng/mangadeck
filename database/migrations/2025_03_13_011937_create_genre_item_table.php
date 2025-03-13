<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('genre_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Add a unique constraint to prevent duplicate entries
            $table->unique(['genre_id', 'item_id']);
        });
        
        // Copy existing genre relationships to the pivot table
        if (Schema::hasColumn('items', 'genre_id')) {
            DB::table('items')->get()->each(function ($item) {
                if ($item->genre_id) {
                    DB::table('genre_item')->insert([
                        'genre_id' => $item->genre_id,
                        'item_id' => $item->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            });
            
            // Remove the genre_id column from items table
            Schema::table('items', function (Blueprint $table) {
                $table->dropForeign(['genre_id']);
                $table->dropColumn('genre_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the genre_id column to items table
        Schema::table('items', function (Blueprint $table) {
            $table->foreignId('genre_id')->nullable()->constrained();
        });
        
        // Copy the first genre from each item back to the genre_id column
        DB::table('genre_item')
            ->select('item_id', 'genre_id')
            ->groupBy('item_id')
            ->get()
            ->each(function ($relation) {
                DB::table('items')
                    ->where('id', $relation->item_id)
                    ->update(['genre_id' => $relation->genre_id]);
            });
            
        Schema::dropIfExists('genre_item');
    }
};