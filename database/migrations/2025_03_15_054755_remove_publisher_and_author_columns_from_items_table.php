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
        Schema::table('items', function (Blueprint $table) {
            // Remove the original publisher and author columns
            $table->dropColumn(['publisher', 'author']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // Add back the columns if we need to roll back
            $table->string('publisher')->nullable()->after('publisher_id');
            $table->string('author')->nullable()->after('publisher');
        });
    }
};

