<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing users except the admin user
        DB::table('users')->where('email', '!=', 'admin@example.com')->delete();

        // Admin user (if it doesn't exist)
        if (DB::table('users')->where('email', 'admin@example.com')->count() === 0) {
            DB::table('users')->insert([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'role_id' => 1,
                'status' => 'activated',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            // Update existing admin user with role_id if needed
            DB::table('users')
                ->where('email', 'admin@example.com')
                ->update(['role_id' => 1]);
        }

        // Staff users
        DB::table('users')->insert([
            [
                'name' => 'Staff User',
                'email' => 'staff@example.com',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'role_id' => 2,
                'status' => 'activated',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff Manager',
                'email' => 'manager@example.com',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'role_id' => 2,
                'status' => 'activated',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Customer users
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'role_id' => 3,
                'status' => 'activated',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'role_id' => 3,
                'status' => 'activated',
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'role_id' => 3,
                'status' => 'activated',
            ],
            [
                'name' => 'Alice Brown',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'role_id' => 3,
                'status' => 'activated',
            ],
            [
                'name' => 'Inactive User',
                'email' => 'inactive@example.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'role_id' => 3,
                'status' => 'deactivated',
            ],
        ];

        foreach ($customers as $customer) {
            $customer['created_at'] = now();
            $customer['updated_at'] = now();
            DB::table('users')->insert($customer);
        }
    }
}