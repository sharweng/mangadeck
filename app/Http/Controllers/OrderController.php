<?php

namespace App\Http\Controllers;

use App\Models\OrderInfo;
use App\Models\OrderLine;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdate;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->isAdmin() || Auth::user()->isStaff()) {
            return view('admin.orders.index');
        } else {
            $customer = Auth::user()->customer;
            
            // If customer doesn't exist, show empty orders
            if (!$customer) {
                return view('orders.index', ['orders' => collect([])]);
            }
            
            $orders = OrderInfo::where('customer_id', $customer->id)
                ->with(['status', 'orderLines' => function($query) {
                    $query->with('item');
                }])
                ->orderBy('date_placed', 'desc')
                ->paginate(10);
            
            return view('orders.index', compact('orders'));
        }
    }

    /**
     * Get orders data for DataTables.
     */
    public function getData()
    {
        $orders = OrderInfo::with(['customer', 'status', 'orderLines']);
        
        return DataTables::of($orders)
            ->addColumn('customer_name', function($order) {
                return $order->customer ? $order->customer->fname . ' ' . $order->customer->lname : 'N/A';
            })
            ->addColumn('total', function($order) {
                $subtotal = $order->orderLines->sum(function($line) {
                    return $line->price * $line->quantity;
                });
                return $subtotal + $order->shipping;
            })
            ->addColumn('actions', function($order) {
                return view('admin.orders.actions', compact('order'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderInfo $order)
    {
        $order->load(['customer.user', 'status', 'orderLines.item']);
        
        if (Auth::user()->isAdmin() || Auth::user()->isStaff()) {
            $statuses = Status::all();
            return view('admin.orders.show', compact('order', 'statuses'));
        } else {
            // Check if the order belongs to the current user
            if (Auth::user()->customer && Auth::user()->customer->id === $order->customer_id) {
                return view('orders.show', compact('order'));
            } else {
                abort(403, 'Unauthorized action.');
            }
        }
    }

    /**
     * Update the status of the specified order.
     */
    public function updateStatus(Request $request, OrderInfo $order)
    {
        $this->authorize('update', $order);
        
        $validated = $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'date_shipped' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        
        // Get the previous status
        $previousStatus = $order->status->name;
        
        // Update the order
        $order->status_id = $validated['status_id'];
        
        if ($validated['date_shipped']) {
            $order->date_shipped = $validated['date_shipped'];
        }
        
        if (isset($validated['notes'])) {
            $order->notes = $validated['notes'];
        }
        
        $order->save();
        
        // Reload the order with relationships
        $order->load(['customer.user', 'status', 'orderLines.item']);
        
        // Send status update email
        Mail::to($order->customer->user->email)
            ->send(new OrderStatusUpdate($order, $previousStatus));
        
        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order status updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderInfo $order)
    {
        $this->authorize('update', $order);
        
        $order->load(['customer', 'status', 'orderLines.item']);
        $statuses = Status::all();
        
        return view('admin.orders.edit', compact('order', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderInfo $order)
    {
        $this->authorize('update', $order);
        
        $validated = $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'date_shipped' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        
        // Get the previous status
        $previousStatus = $order->status->name;
        
        // Update the order
        $order->status_id = $validated['status_id'];
        
        if ($validated['date_shipped']) {
            $order->date_shipped = $validated['date_shipped'];
        }
        
        if (isset($validated['notes'])) {
            $order->notes = $validated['notes'];
        }
        
        $order->save();
        
        // Reload the order with relationships
        $order->load(['customer.user', 'status', 'orderLines.item']);
        
        // Send status update email
        Mail::to($order->customer->user->email)
            ->send(new OrderStatusUpdate($order, $previousStatus));
        
        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderInfo $order)
    {
        $this->authorize('delete', $order);
        
        $order->delete();
        
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}

