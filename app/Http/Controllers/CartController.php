<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\OrderInfo;
use App\Models\OrderLine;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = [];
        $total = 0;
        
        if (!empty($cart)) {
            $itemIds = array_keys($cart);
            $items = Item::whereIn('id', $itemIds)->get();
            
            foreach ($items as $item) {
                $item->cart_quantity = $cart[$item->id];
                $item->subtotal = $item->price * $cart[$item->id];
                $total += $item->subtotal;
            }
        }
        
        return view('cart.index', compact('items', 'total'));
    }

    /**
     * Add an item to the cart.
     */
    public function add(Request $request, Item $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        $quantity = $request->input('quantity');
        $cart = session()->get('cart', []);
        
        if (isset($cart[$item->id])) {
            $cart[$item->id] += $quantity;
        } else {
            $cart[$item->id] = $quantity;
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()
            ->with('success', "Added {$quantity} copies of \"{$item->title}\" to your cart.");
    }

    /**
     * Update cart item quantities.
     */
    public function update(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);
        
        $cart = session()->get('cart', []);
        $quantities = $request->input('quantities');
        
        foreach ($quantities as $id => $quantity) {
            if (isset($cart[$id])) {
                $cart[$id] = $quantity;
            }
        }
        
        session()->put('cart', $cart);
        
        return redirect()->route('cart.index')
            ->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Item $item)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$item->id])) {
            unset($cart[$item->id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')
            ->with('success', "Removed \"{$item->title}\" from your cart.");
    }

    /**
     * Clear the cart.
     */
    public function clear()
    {
        session()->forget('cart');
        
        return redirect()->route('cart.index')
            ->with('success', 'Cart cleared successfully.');
    }

    /**
     * Show the checkout form.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }
        
        $itemIds = array_keys($cart);
        $items = Item::whereIn('id', $itemIds)->get();
        $subtotal = 0;
        
        foreach ($items as $item) {
            $item->cart_quantity = $cart[$item->id];
            $item->subtotal = $item->price * $cart[$item->id];
            $subtotal += $item->subtotal;
        }
        
        $shipping = 10.00; // Default shipping cost
        $total = $subtotal + $shipping;
        
        $user = Auth::user();
        $customer = $user ? $user->customer : null;
        
        return view('cart.checkout', compact('items', 'subtotal', 'shipping', 'total', 'customer'));
    }

    /**
     * Process the checkout and create an order.
     */
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }
        
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Please login to complete your purchase.');
        }
        
        $customer = $user->customer;
        
        if (!$customer) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please complete your profile before checking out.');
        }
        
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'shipping_method' => 'required|in:standard,express',
        ]);
        
        $shippingCost = $validated['shipping_method'] === 'standard' ? 10.00 : 20.00;
        
        // Get pending status
        $pendingStatus = Status::where('name', 'Pending')->first();
        
        // Create order
        $order = OrderInfo::create([
            'customer_id' => $customer->id,
            'date_placed' => Carbon::now(),
            'shipping' => $shippingCost,
            'status_id' => $pendingStatus->id,
            'notes' => "Shipping Address: {$validated['shipping_address']}\nShipping Method: {$validated['shipping_method']}",
        ]);
        
        // Create order lines and update stock
        $itemIds = array_keys($cart);
        $items = Item::whereIn('id', $itemIds)->with('stock')->get();
        
        foreach ($items as $item) {
            $quantity = $cart[$item->id];
            
            OrderLine::create([
                'orderinfo_id' => $order->id,
                'item_id' => $item->id,
                'quantity' => $quantity,
                'price' => $item->price,
            ]);
            
            // Update stock
            if ($item->stock) {
                $item->stock->update([
                    'quantity' => max(0, $item->stock->quantity - $quantity),
                ]);
            }
        }
        
        // Clear cart after successful order
        session()->forget('cart');
        
        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully! Your order number is #' . $order->id);
    }
}

