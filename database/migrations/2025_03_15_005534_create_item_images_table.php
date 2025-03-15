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
        Schema::create('item_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->boolean('is_primary')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // If img_path exists in items table, migrate existing images
        if (Schema::hasColumn('items', 'img_path')) {
            DB::statement("
                INSERT INTO item_images (item_id, image_path, is_primary, sort_order, created_at, updated_at)
                SELECT id, img_path, 1, 1, created_at, updated_at
                FROM items
                WHERE img_path IS NOT NULL AND img_path != ''
            ");
            
            // Remove img_path column from items table
            Schema::table('items', function (Blueprint $table) {
                $table->dropColumn('img_path');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add img_path column back to items table if it doesn't exist
        if (!Schema::hasColumn('items', 'img_path')) {
            Schema::table('items', function (Blueprint $table) {
                $table->string('img_path')->nullable()->after('price');
            });
            
            // Migrate primary images back to img_path
            DB::statement("
                UPDATE items i
                JOIN item_images ii ON i.id = ii.item_id AND ii.is_primary = 1
                SET i.img_path = ii.image_path
            ");
        }
        
        Schema::dropIfExists('item_images');
    }
};