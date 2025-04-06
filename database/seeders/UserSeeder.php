<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing users except the admin user
        User::where('email', '!=', 'admin@gmail.com')->delete();

        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'role_id' => 1,
                'status' => 'activated',
                'email_verified_at' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Staff users
        $staffUsers = [
            [
                'name' => 'Staff User',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'role_id' => 2,
                'status' => 'activated',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Staff Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'role_id' => 2,
                'status' => 'activated',
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($staffUsers as $staffUser ) {
            User::updateOrCreate(
                ['email' => $staffUser ['email']],
                $staffUser 
            );
        }

        // Customer users
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'john@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'role_id' => 3,
                'status' => 'activated',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'role_id' => 3,
                'status' => 'activated',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'role_id' => 3,
                'status' => 'activated',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Alice Brown',
                'email' => 'alice@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'role_id' => 3,
                'status' => 'activated',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Charlie Black',
                'email' => 'charlie@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'role_id' => 3,
                'status' => 'activated',
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($customers as $customer) {
            $customer['created_at'] = now();
            $customer['updated_at'] = now();
            User::updateOrCreate(
                ['email' => $customer['email']],
                $customer
            );
        }
    }
}