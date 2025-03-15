<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if statuses already exist
        if (DB::table('statuses')->count() > 0) {
            return;
        }

        $statuses = [
            [
                'name' => 'Pending',
                'description' => 'Order has been placed but not processed yet',
            ],
            [
                'name' => 'Processing',
                'description' => 'Order is being processed',
            ],
            [
                'name' => 'Shipped',
                'description' => 'Order has been shipped to the customer',
            ],
            [
                'name' => 'Delivered',
                'description' => 'Order has been delivered to the customer',
            ],
            [
                'name' => 'Cancelled',
                'description' => 'Order has been cancelled',
            ],
            [
                'name' => 'Returned',
                'description' => 'Order has been returned by the customer',
            ],
        ];

        foreach ($statuses as $status) {
            $status['created_at'] = now();
            $status['updated_at'] = now();
            DB::table('statuses')->insert($status);
        }
    }
}