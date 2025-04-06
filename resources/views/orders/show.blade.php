@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Order Header with Manga-style Title -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="position-relative">
                <h1 class="display-5 fw-bold text-dark mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
                    Order <span class="text-muted">#{{ $order->id }}</span>
                </h1>
                <div class="position-absolute bottom-0 start-0 w-100 border-bottom border-dark border-2" style="z-index: -1;"></div>
            </div>
            <p class="text-muted">Placed on {{ $order->date_placed->format('F d, Y') }}</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-dark btn-lg px-4">
                <i class="fas fa-arrow-left me-2"></i> Back to Orders
            </a>
        </div>
    </div>

    <!-- Order Content with Manga-style Panels -->
    <div class="row mb-4 g-4">
        <!-- Order Information Panel -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-receipt me-2"></i> Order Information</h5>
                </div>
                <div class="card-body bg-light">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge rounded-pill bg-{{ $order->status->name === 'Pending' ? 'secondary' : ($order->status->name === 'Processing' ? 'dark' : ($order->status->name === 'Shipped' ? 'dark' : ($order->status->name === 'Delivered' ? 'dark' : 'danger'))) }} me-2" style="width: 10px; height: 10px;"></span>
                        <div>
                            <h6 class="mb-0 fw-bold">Status</h6>
                            <span class="text-muted">{{ $order->status->name }}</span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="text-muted">Order Date</span>
                        <span class="fw-bold">{{ $order->date_placed->format('F d, Y') }}</span>
                    </div>
                    
                    @if($order->date_shipped)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="text-muted">Shipped Date</span>
                        <span class="fw-bold">{{ $order->date_shipped->format('F d, Y') }}</span>
                    </div>
                    @endif
                    
                    <div class="d-flex justify-content-between pt-2">
                        <span class="text-muted">Shipping Cost</span>
                        <span class="fw-bold">${{ number_format($order->shipping, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping Information Panel -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-truck me-2"></i> Shipping Information</h5>
                </div>
                <div class="card-body bg-light">
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">Name</h6>
                        <p class="text-muted mb-0">{{ $order->customer->title ?? '' }} {{ $order->customer->fname }} {{ $order->customer->lname }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">Address</h6>
                        <p class="text-muted mb-0">{{ $order->customer->addressline }}</p>
                    </div>
                    
                    <div>
                        <h6 class="fw-bold mb-1">Phone</h6>
                        <p class="text-muted mb-0">{{ $order->customer->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items Panel -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="mb-0 fw-bold"><i class="fas fa-box-open me-2"></i> Order Items</h5>
        </div>
        <div class="card-body bg-light p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-secondary bg-opacity-10">
                        <tr>
                            <th class="border-0 ps-4">Item</th>
                            <th class="border-0">Price</th>
                            <th class="border-0">Quantity</th>
                            <th class="border-0 text-end pe-4">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach($order->orderlines as $line)
                            @php $subtotal += $line->price * $line->quantity; @endphp
                            <tr class="border-top border-bottom">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="position-relative me-3" style="width: 60px; height: 80px;">
                                            <img src="{{ $line->item->img_path ? asset('storage/'.$line->item->img_path) : asset('images/no-image.jpg') }}" 
                                                 alt="{{ $line->item->title }}" 
                                                 class="img-fluid h-100 w-100 object-fit-cover rounded-1 shadow-sm">
                                            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.3) 100%);"></div>
                                        </div>
                                        <div>
                                            <a href="{{ route('items.show', $line->item) }}" class="fw-bold text-dark text-decoration-none">{{ $line->item->title }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>${{ number_format($line->price, 2) }}</td>
                                <td>{{ $line->quantity }}</td>
                                <td class="text-end pe-4 fw-bold">${{ number_format($line->price * $line->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Order Summary -->
            <div class="bg-white p-4 border-top">
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal:</span>
                            <span class="fw-bold">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping:</span>
                            <span class="fw-bold">${{ number_format($order->shipping, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-2">
                            <span class="text-dark fw-bold">Total:</span>
                            <span class="text-dark fw-bold">${{ number_format($subtotal + $order->shipping, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($order->notes)
    <!-- Order Notes Panel -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="mb-0 fw-bold"><i class="fas fa-sticky-note me-2"></i> Order Notes</h5>
        </div>
        <div class="card-body bg-light">
            <div class="p-3 bg-white rounded-2 border">
                <p class="mb-0">{{ $order->notes }}</p>
            </div>
        </div>
    </div>
    @endif
</div>

@section('styles')
<style>
    /* Manga-inspired Styles */
    body {
        background-color: #f5f5f5;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }
    
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    
    .badge {
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    
    /* Manga-style borders */
    .border-dark {
        border-color: #333 !important;
    }
    
    /* Gradient overlay for images */
    .img-gradient-overlay {
        position: relative;
    }
    
    .img-gradient-overlay::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.3) 100%);
    }
    
    /* Custom shadows */
    .shadow-sm {
        box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
    }
    
    /* Status indicators */
    .status-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }
        
        .table-responsive {
            border: 0;
        }
        
        .table thead {
            display: none;
        }
        
        .table tr {
            display: block;
            margin-bottom: 1rem;
            border-bottom: 2px solid #eee;
        }
        
        .table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            border-bottom: 1px dotted #ddd;
        }
        
        .table td::before {
            content: attr(data-label);
            font-weight: bold;
            margin-right: 1rem;
        }
    }
</style>
@endsection