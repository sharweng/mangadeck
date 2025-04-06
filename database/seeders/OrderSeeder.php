<?php

namespace Database\Seeders;

use App\Models\OrderInfo;
use App\Models\OrderLine;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming we have 5 customers and 2 items for each
        $customers = Customer::all();
        $items = [1, 2, 3, 4, 5]; // Assuming these are the item IDs available

        foreach ($customers as $customer) {
            // Create two orders for each customer
            for ($i = 0; $i < 2; $i++) {
                $datePlaced = Carbon::now()->subDays(rand(0,30));
                // Create an order for each customer
                $order = OrderInfo::create([
                    'customer_id' => $customer->id,
                    'date_placed' => $datePlaced,
                    'shipping' => 5.00, // Example shipping cost
                    'status_id' => $i == 0 ? 1 : rand(1, 5), // Randomize status for second order
                    'notes' => 'Order placed by ' . $customer->name,
                    'created_at' => $datePlaced,
                    'updated_at' => $datePlaced,
                ]);

                // Each customer orders 2 items
                foreach (array_rand(array_flip($items), 2) as $itemId) {
                    OrderLine::create([
                        'orderinfo_id' => $order->id,
                        'item_id' => $itemId,
                        'quantity' => 1, // Assuming each order is for 1 item
                        'price' => DB::table('items')->where('id', $itemId)->value('price'), // Get the price of the item
                        'created_at' => $datePlaced,
                        'updated_at' => $datePlaced,
                    ]);
                }
            }
        }

        // Update most orders to 'Delivered' status
        $orders = OrderInfo::all();
        foreach ($orders as $order) {
            if (rand(0, 1) == 0) {
                $order->status_id = 3; // 'Delivered' status
                $order->save();
            }
        }
    }
}