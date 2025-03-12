<?php

namespace App\Http\Controllers;

use App\Models\OrderInfo;
use App\Models\OrderLine;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    // Rest of the controller methods...
}