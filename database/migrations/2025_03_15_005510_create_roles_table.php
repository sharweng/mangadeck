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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default roles
        DB::table('roles')->insert([
            ['name' => 'Administrator', 'slug' => 'admin', 'description' => 'Full access to all system features', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Staff', 'slug' => 'staff', 'description' => 'Access to manage content and orders', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Customer', 'slug' => 'customer', 'description' => 'Regular customer access', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Add role_id to users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('role')->constrained('roles');
        });

        // Migrate existing users to use role_id
        DB::statement("UPDATE users SET role_id = 
            CASE 
                WHEN role = 'admin' THEN 1 
                WHEN role = 'staff' THEN 2 
                WHEN role = 'customer' THEN 3 
            END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });

        Schema::dropIfExists('roles');
    }
};