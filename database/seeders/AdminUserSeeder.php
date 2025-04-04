<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Find existing admin user or create a new one
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Change this to a secure password
                'role' => 'admin',
                'role_id' => 1,
                'status' => 'activated',
                'email_verified_at' => Carbon::now(),
            ]
        );
    }
}

