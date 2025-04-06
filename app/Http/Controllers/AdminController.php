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
use Illuminate\Support\Facades\Storage;
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
        
        // Debug order info
        \Log::info('Dashboard loaded with:', [
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'totalItems' => $totalItems
        ]);
        
        // Check if there are any orders
        if ($totalOrders > 0) {
            \Log::info('Orders exist in the database');
            
            // Get a sample order to debug
            $sampleOrder = OrderInfo::first();
            \Log::info('Sample order:', $sampleOrder->toArray());
            
            // Check if the order has order lines
            $orderLines = DB::table('orderlines')->where('orderinfo_id', $sampleOrder->id)->get();
            \Log::info('Order lines for sample order:', $orderLines->toArray());
        } else {
            \Log::warning('No orders found in the database');
        }
        
        // Total revenue from all orders
        $totalRevenue = OrderInfo::sum(DB::raw('
            COALESCE((SELECT SUM(orderlines.price * orderlines.quantity) 
             FROM orderlines 
             WHERE orderlines.orderinfo_id = orderinfos.id), 0) + shipping
        '));
        
        // Total revenue from delivered orders only
        $totalRevenueDelivered = OrderInfo::where('status_id', 3) // Status 3 is "Delivered"
            ->sum(DB::raw('
                COALESCE((SELECT SUM(orderlines.price * orderlines.quantity) 
                FROM orderlines 
                WHERE orderlines.orderinfo_id = orderinfos.id), 0) + shipping
            '));
        
        \Log::info('Total revenue calculated: ' . $totalRevenue);
        \Log::info('Total revenue from delivered orders: ' . $totalRevenueDelivered);
        
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
                DB::raw('SUM(COALESCE((SELECT SUM(orderlines.price * orderlines.quantity) FROM orderlines WHERE orderlines.orderinfo_id = orderinfos.id), 0) + shipping) as total')
            )
            ->whereYear('date_placed', Carbon::now()->year)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        \Log::info('Monthly sales data:', $monthlySales->toArray());
        
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
            'totalRevenueDelivered', // Added new variable for delivered orders revenue
            'recentOrders',
            'lowStockItems',
            'recentReviews',
            'monthlyData'
        ));
    }

    /**
     * Get sales data for chart.
     */
    public function getSalesData(Request $request)
    {
        $this->authorize('accessAdmin');
        
        // Set timezone to Asia/Manila
        date_default_timezone_set('Asia/Manila');
        
        try {
            // Debug the request parameters
            \Log::info('Date range request:', [
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'status' => $request->input('status')
            ]);
            
            $startDate = $request->input('start_date') 
                ? Carbon::createFromFormat('m/d/Y', $request->input('start_date'))->startOfDay() 
                : Carbon::now()->subDays(30)->startOfDay();
                
            $endDate = $request->input('end_date') 
                ? Carbon::createFromFormat('m/d/Y', $request->input('end_date'))->endOfDay() 
                : Carbon::now()->endOfDay();
            
            // Debug the parsed dates
            \Log::info('Parsed date range:', [
                'startDate' => $startDate->toDateTimeString(),
                'endDate' => $endDate->toDateTimeString()
            ]);
            
            // Base query with date range filter
            $query = OrderInfo::whereBetween('date_placed', [$startDate, $endDate]);
            
            // Filter by status if provided
            if ($request->input('status') === 'delivered') {
                $query->where('status_id', 3); // Status 3 is "Delivered"
                \Log::info('Filtering sales data by delivered status');
            }
            
            // Check if there are any orders in this filtered query
            $orderCount = $query->count();
            \Log::info('Order count in filtered query: ' . $orderCount);
            
            // If no orders in this filtered query, return empty data
            if ($orderCount === 0) {
                \Log::info('No orders found in the filtered query');
                return response()->json([
                    'salesData' => [
                        'labels' => [],
                        'values' => []
                    ]
                ]);
            }
            
            // Determine the grouping based on date range
            $diffInDays = $startDate->diffInDays($endDate);
            \Log::info('Difference in days: ' . $diffInDays);
            
            if ($diffInDays <= 31) {
                // Group by day for ranges up to 31 days
                $baseQuery = $query->select(
                    DB::raw('DATE(date_placed) as date'),
                    DB::raw('SUM(COALESCE((SELECT SUM(orderlines.price * orderlines.quantity) FROM orderlines WHERE orderlines.orderinfo_id = orderinfos.id), 0) + shipping) as total_sales')
                )
                ->groupBy('date')
                ->orderBy('date');
                
                $salesData = $baseQuery->get();
                
                // Debug the query results
                \Log::info('Daily sales data:', $salesData->toArray());
                
                $labels = [];
                $values = [];
                
                // Create a period of days to ensure all days are included
                $period = new \DatePeriod(
                    $startDate,
                    new \DateInterval('P1D'),
                    $endDate->addDay() // Add a day to include the end date
                );
                
                // Initialize with zeros
                foreach ($period as $date) {
                    $dateString = $date->format('Y-m-d');
                    $labels[] = $date->format('M d');
                    $values[] = 0;
                }
                
                // Fill in actual values
                foreach ($salesData as $data) {
                    $date = Carbon::parse($data->date);
                    $index = $date->diffInDays($startDate);
                    if ($index >= 0 && $index < count($values)) {
                        $values[$index] = (float) $data->total_sales;
                    }
                }
            } else if ($diffInDays <= 92) {
                // Group by week for ranges up to 3 months
                $baseQuery = $query->select(
                    DB::raw('YEARWEEK(date_placed) as yearweek'),
                    DB::raw('MIN(DATE(date_placed)) as week_start'),
                    DB::raw('SUM(COALESCE((SELECT SUM(orderlines.price * orderlines.quantity) FROM orderlines WHERE orderlines.orderinfo_id = orderinfos.id), 0) + shipping) as total_sales')
                )
                ->groupBy('yearweek')
                ->orderBy('yearweek');
                
                $salesData = $baseQuery->get();
                
                // Debug the query results
                \Log::info('Weekly sales data:', $salesData->toArray());
                
                $labels = $salesData->map(function ($item) {
                    $weekStart = Carbon::parse($item->week_start);
                    return $weekStart->format('M d') . ' - ' . $weekStart->addDays(6)->format('M d');
                });
                
                $values = $salesData->pluck('total_sales')->map(function ($value) {
                    return (float) $value;
                });
            } else {
                // Group by month for longer ranges
                $baseQuery = $query->select(
                    DB::raw('YEAR(date_placed) as year'),
                    DB::raw('MONTH(date_placed) as month'),
                    DB::raw('SUM(COALESCE((SELECT SUM(orderlines.price * orderlines.quantity) FROM orderlines WHERE orderlines.orderinfo_id = orderinfos.id), 0) + shipping) as total_sales')
                )
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month');
                
                $salesData = $baseQuery->get();
                
                // Debug the query results
                \Log::info('Monthly sales data:', $salesData->toArray());
                
                $labels = $salesData->map(function ($item) {
                    return Carbon::createFromDate($item->year, $item->month, 1)->format('M Y');
                });
                
                $values = $salesData->pluck('total_sales')->map(function ($value) {
                    return (float) $value;
                });
            }
            
            // Debug the final data being sent to the chart
            \Log::info('Final chart data:', [
                'labels' => $labels,
                'values' => $values
            ]);
            
            return response()->json([
                'salesData' => [
                    'labels' => $labels,
                    'values' => $values
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getSalesData: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return response()->json([
                'error' => $e->getMessage(),
                'salesData' => [
                    'labels' => [],
                    'values' => []
                ]
            ], 500);
        }
    }
    
    /**
     * Get product sales data for chart.
     */
    public function getProductSalesData(Request $request)
    {
        $this->authorize('accessAdmin');
        
        try {
            // Check if status filter is provided
            $statusFilter = $request->input('status') === 'delivered';
            \Log::info('Product sales data status filter: ' . ($statusFilter ? 'delivered' : 'all'));
            
            // Base query for orderlines
            $orderlineQuery = DB::table('orderlines');
            
            // Apply status filter if requested
            if ($statusFilter) {
                $orderlineQuery->join('orderinfos', 'orderlines.orderinfo_id', '=', 'orderinfos.id')
                              ->where('orderinfos.status_id', 3); // Status 3 is "Delivered"
            }
            
            // Get total sales amount with filter applied
            $totalSales = $orderlineQuery->sum(DB::raw('orderlines.price * orderlines.quantity'));
            
            // Debug total sales
            \Log::info('Total sales amount with filter: ' . $totalSales);
            
            if ($totalSales == 0) {
                \Log::info('No sales data found, returning empty chart');
                return response()->json([
                    'productSalesData' => [
                        'labels' => [],
                        'values' => []
                    ]
                ]);
            }
            
            // Get product sales data with filter applied
            $productQuery = DB::table('items')
                ->join('orderlines', 'items.id', '=', 'orderlines.item_id');
            
            // Apply status filter if requested
            if ($statusFilter) {
                $productQuery->join('orderinfos', 'orderlines.orderinfo_id', '=', 'orderinfos.id')
                            ->where('orderinfos.status_id', 3); // Status 3 is "Delivered"
            }
            
            $productSalesData = $productQuery
                ->select(
                    'items.title',
                    DB::raw('SUM(orderlines.price * orderlines.quantity) as revenue')
                )
                ->groupBy('items.id', 'items.title')
                ->orderBy('revenue', 'desc')
                ->take(10) // Limit to top 10 products
                ->get();
            
            // Debug product sales data
            \Log::info('Product sales data:', $productSalesData->toArray());
            
            // Calculate percentages
            $labels = $productSalesData->pluck('title');
            $values = $productSalesData->pluck('revenue')->map(function ($value) use ($totalSales) {
                return round(($value / $totalSales) * 100, 1);
            });
            
            // Add "Others" category if there are more than 10 products
            $otherProductsQuery = DB::table('orderlines')
                ->join('items', 'orderlines.item_id', '=', 'items.id')
                ->whereNotIn('items.title', $labels);
            
            // Apply status filter if requested
            if ($statusFilter) {
                $otherProductsQuery->join('orderinfos', 'orderlines.orderinfo_id', '=', 'orderinfos.id')
                                  ->where('orderinfos.status_id', 3); // Status 3 is "Delivered"
            }
            
            $otherProductsRevenue = $otherProductsQuery->sum(DB::raw('orderlines.price * orderlines.quantity'));
            
            if ($otherProductsRevenue > 0) {
                $labels->push('Others');
                $values->push(round(($otherProductsRevenue / $totalSales) * 100, 1));
            }
            
            // Debug final chart data
            \Log::info('Final product chart data:', [
                'labels' => $labels->toArray(),
                'values' => $values->toArray()
            ]);
            
            return response()->json([
                'productSalesData' => [
                    'labels' => $labels,
                    'values' => $values
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getProductSalesData: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return response()->json([
                'error' => $e->getMessage(),
                'productSalesData' => [
                    'labels' => [],
                    'values' => []
                ]
            ], 500);
        }
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'status' => 'activated',
        ];
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            $userData['photo'] = $request->file('photo')->store('user-photos', 'public');
        }
        
        User::create($userData);
        
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            
            $updateData['photo'] = $request->file('photo')->store('user-photos', 'public');
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
        
        // Delete user's photo if exists
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }
        
        $user->delete();
        
        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }
}