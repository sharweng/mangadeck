<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\OrderInfo;
use App\Models\Customer;
use App\Models\Review;
use App\Models\Status;
use App\Models\Genre;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $this->authorize('accessAdmin');
        
        // Count data for dashboard
        $totalCustomers = Customer::count();
        $totalOrders = OrderInfo::count();
        $totalItems = Item::count();
        $totalRevenue = OrderInfo::sum(DB::raw('
            (SELECT SUM(orderlines.price * orderlines.quantity) 
             FROM orderlines 
             WHERE orderlines.orderinfo_id = orderinfos.id) + shipping
        '));
        
        // Recent orders
        $recentOrders = OrderInfo::with(['customer', 'status'])
            ->orderBy('date_placed', 'desc')
            ->take(5)
            ->get();
        
        // Low stock items
        $lowStockItems = Item::whereHas('stock', function($query) {
            $query->where('quantity', '<', 5);
        })->with(['stock', 'genre'])->take(5)->get();
        
        // Recent reviews
        $recentReviews = Review::with(['user', 'item'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Monthly sales data for chart
        $monthlySales = OrderInfo::select(
                DB::raw('MONTH(date_placed) as month'),
                DB::raw('YEAR(date_placed) as year'),
                DB::raw('SUM((SELECT SUM(orderlines.price * orderlines.quantity) FROM orderlines WHERE orderlines.orderinfo_id = orderinfos.id) + shipping) as total')
            )
            ->whereYear('date_placed', Carbon::now()->year)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = 0;
        }
        
        foreach ($monthlySales as $sale) {
            $monthlyData[$sale->month] = $sale->total;
        }
        
        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalOrders',
            'totalItems',
            'totalRevenue',
            'recentOrders',
            'lowStockItems',
            'recentReviews',
            'monthlyData'
        ));
    }

    /**
     * Display the user management page.
     */
    public function users()
    {
        $this->authorize('manageUsers');
        
        $users = User::paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUser()
    {
        $this->authorize('manageUsers');
        
        return view('admin.users.create');
    }

    /**
     * Store a newly created user.
     */
    public function storeUser(Request $request)
    {
        $this->authorize('manageUsers');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,staff,customer',
        ]);
        
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'status' => 'activated',
        ]);
        
        return redirect()->route('admin.users')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing a user.
     */
    public function editUser(User $user)
    {
        $this->authorize('manageUsers');
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function updateUser(Request $request, User $user)
    {
        $this->authorize('manageUsers');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,staff,customer',
            'status' => 'required|in:activated,deactivated',
        ]);
        
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'],
        ];
        
        if ($validated['password']) {
            $updateData['password'] = bcrypt($validated['password']);
        }
        
        $user->update($updateData);
        
        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user.
     */
    public function destroyUser(User $user)
    {
        $this->authorize('manageUsers');
        
        $user->delete();
        
        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }
}

