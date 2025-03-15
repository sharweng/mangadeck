<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if roles already exist
        if (DB::table('roles')->count() > 0) {
            return;
        }

        DB::table('roles')->insert([
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full access to all system features',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff',
                'slug' => 'staff',
                'description' => 'Access to manage content and orders',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Customer',
                'slug' => 'customer',
                'description' => 'Regular customer access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}