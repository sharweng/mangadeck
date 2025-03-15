<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get customer users
        $customerUsers = DB::table('users')
            ->where('role', 'customer')
            ->get();

        $titles = ['Mr', 'Mrs', 'Ms', 'Dr', 'Prof'];

        foreach ($customerUsers as $user) {
            // Skip if customer already exists for this user
            if (DB::table('customers')->where('user_id', $user->id)->exists()) {
                continue;
            }

            $nameParts = explode(' ', $user->name);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : 'Doe';

            DB::table('customers')->insert([
                'title' => $titles[array_rand($titles)],
                'fname' => $firstName,
                'lname' => $lastName,
                'addressline' => fake()->streetAddress() . ', ' . fake()->city() . ', ' . fake()->stateAbbr() . ' ' . fake()->postcode(),
                'phone' => fake()->phoneNumber(),
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}