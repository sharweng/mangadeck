@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Total Customers Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Customers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCustomers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Items Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalItems }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Revenue (Delivered)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₱{{ number_format($totalRevenueDelivered, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-peso-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Sales Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Overview</h6>
                    <div class="dropdown no-arrow">
                        <div class="input-group">
                            <input type="text" class="form-control" id="salesDateRange" placeholder="Date Range">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="refreshSalesChart">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Sales Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Product Sales Distribution</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="productSalesChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small" id="productSalesLegend">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Orders -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Orders</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td><a href="{{ route('admin.orders.show', $order) }}">#{{ $order->id }}</a></td>
                                    <td>{{ $order->customer->fname }} {{ $order->customer->lname }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->date_placed)->format('M d, Y') }}</td>
                                    <td>₱{{ number_format((DB::table('orderlines')
                                        ->where('orderinfo_id', $order->id)
                                        ->sum(DB::raw('price * quantity'))) + $order->shipping, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status->name === 'Pending' ? 'warning' : ($order->status->name === 'Processing' ? 'info' : ($order->status->name === 'Shipped' ? 'primary' : ($order->status->name === 'Delivered' ? 'success' : 'danger'))) }}">
                                            {{ $order->status->name }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Items -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Low Stock Items</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Genre</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStockItems as $item)
                                <tr>
                                    <td><a href="{{ route('admin.items.show', $item) }}">{{ $item->title }}</a></td>
                                    <td>
                                        @if($item->genres && $item->genres->count() > 0)
                                            {{ $item->genres->first()->name }}
                                            @if($item->genres->count() > 1)
                                                <span class="text-muted">+{{ $item->genres->count() - 1 }} more</span>
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $item->stock->quantity <= 5 ? 'danger' : ($item->stock->quantity <= 10 ? 'warning' : 'success') }}">
                                            {{ $item->stock->quantity }}
                                        </span>
                                    </td>
                                    <td>₱{{ number_format($item->price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .chart-area {
        height: 300px;
    }
    .chart-pie {
        height: 250px;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize date range picker
        $('#salesDateRange').daterangepicker({
            startDate: moment().subtract(30, 'days'),
            endDate: moment(),
            locale: {
                format: 'MM/DD/YYYY'
            },
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });

        // Function to show loading state
        function showLoading(element) {
            element.innerHTML = `
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;
        }

        // Function to show error message
        function showError(element, message) {
            element.innerHTML = `
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-danger">${message}</div>
                </div>
            `;
        }

        // Function to show no data message
        function showNoData(element, message) {
            element.innerHTML = `
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-muted">${message}</div>
                </div>
            `;
        }

        // Function to fetch sales data
        function fetchSalesData() {
            const dateRange = $('#salesDateRange').val();
            const [startDate, endDate] = dateRange.split(' - ');
            
            // Show loading indicator
            const salesChartContainer = document.querySelector('.chart-area');
            showLoading(salesChartContainer);
            
            console.log('Fetching sales data for date range:', startDate, 'to', endDate);
            
            // Modified to include status filter for delivered orders only
            fetch(`/admin/api/sales-data?start_date=${startDate}&end_date=${endDate}&status=delivered`)
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Rest of the code remains the same
                    console.log('Received sales data:', data);
                    
                    // Check if we have data
                    if (!data.salesData.labels || data.salesData.labels.length === 0) {
                        console.log('No sales data available');
                        showNoData(salesChartContainer, 'No sales data available for the selected date range.');
                        return;
                    }
                    
                    // Restore the canvas
                    salesChartContainer.innerHTML = '<canvas id="salesChart"></canvas>';
                    const newSalesChartCtx = document.getElementById('salesChart').getContext('2d');
                    
                    // Create new chart with the data
                    new Chart(newSalesChartCtx, {
                        type: 'bar',
                        data: {
                            labels: data.salesData.labels,
                            datasets: [{
                                label: 'Sales (₱)',
                                backgroundColor: 'rgba(78, 115, 223, 0.5)',
                                borderColor: 'rgba(78, 115, 223, 1)',
                                borderWidth: 1,
                                data: data.salesData.values
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return '₱' + value;
                                        }
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return '₱' + context.parsed.y.toFixed(2);
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching sales data:', error);
                    showError(salesChartContainer, 'Error loading sales data. Please try again.');
                });
        }

        // Function to fetch product sales data
        function fetchProductSalesData() {
            // Show loading indicator
            const productChartContainer = document.querySelector('.chart-pie');
            showLoading(productChartContainer);
            
            console.log('Fetching product sales data');
            
            // Modified to include status filter for delivered orders only
            fetch('/admin/api/product-sales-data?status=delivered')
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Rest of the code remains the same
                    console.log('Received product sales data:', data);
                    
                    // Check if we have data
                    if (!data.productSalesData.labels || data.productSalesData.labels.length === 0) {
                        console.log('No product sales data available');
                        showNoData(productChartContainer, 'No product sales data available.');
                        document.getElementById('productSalesLegend').innerHTML = '';
                        return;
                    }
                    
                    // Restore the canvas
                    productChartContainer.innerHTML = '<canvas id="productSalesChart"></canvas>';
                    const newProductSalesChartCtx = document.getElementById('productSalesChart').getContext('2d');
                    
                    // Create new chart with the data
                    new Chart(newProductSalesChartCtx, {
                        type: 'pie',
                        data: {
                            labels: data.productSalesData.labels,
                            datasets: [{
                                data: data.productSalesData.values,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(75, 192, 192, 0.7)',
                                    'rgba(153, 102, 255, 0.7)',
                                    'rgba(255, 159, 64, 0.7)',
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(75, 192, 192, 0.7)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const percentage = context.dataset.data[context.dataIndex] + '%';
                                            return label + ': ' + percentage;
                                        }
                                    }
                                }
                            }
                        }
                    });
                    
                    // Update legend
                    updateProductSalesLegend(data.productSalesData.labels, data.productSalesData.values);
                })
                .catch(error => {
                    console.error('Error fetching product sales data:', error);
                    showError(productChartContainer, 'Error loading product data. Please try again.');
                    document.getElementById('productSalesLegend').innerHTML = '';
                });
        }

        // Function to update product sales legend
        function updateProductSalesLegend(labels, values) {
            const legendContainer = document.getElementById('productSalesLegend');
            legendContainer.innerHTML = '';
            
            const colors = [
                'primary', 'success', 'info', 'warning', 'danger',
                'primary', 'success', 'info', 'warning', 'danger'
            ];
            
            labels.forEach((label, index) => {
                if (index < 10) { // Limit to top 10 products
                    const legendItem = document.createElement('span');
                    legendItem.className = `mr-2 ${index > 0 ? 'ml-2' : ''}`;
                    legendItem.innerHTML = `
                        <i class="fas fa-circle text-${colors[index]}"></i> ${label.length > 15 ? label.substring(0, 15) + '...' : label} (${values[index]}%)
                    `;
                    legendContainer.appendChild(legendItem);
                }
            });
        }

        // Initial data fetch
        fetchSalesData();
        fetchProductSalesData();

        // Refresh sales chart when button is clicked
        $('#refreshSalesChart').on('click', function() {
            fetchSalesData();
        });

        // Refresh sales chart when date range changes
        $('#salesDateRange').on('apply.daterangepicker', function(ev, picker) {
            fetchSalesData();
        });
    });
</script>
@endsection