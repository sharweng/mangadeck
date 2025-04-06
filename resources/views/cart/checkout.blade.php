@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section for Checkout -->
    <div class="hero-banner position-relative overflow-hidden mb-4 rounded-3 mx-3">
        <div class="banner-overlay"></div>
        <div class="container-fluid px-4 position-relative py-1" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-xl-6">
                    <h1 class="display-5 fw-bold text-white mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Finalize Your <span class="text-white-50">Manga</span> Order</h1>
                    <p class="text-white mb-3" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Complete your purchase and get ready for an amazing reading experience.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4 border-0 shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><i class="fas fa-truck me-2"></i>Shipping Information</h4>
                    </div>
                    <div class="card-body bg-light">
                        <form action="{{ route('cart.process') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="shipping_address" class="form-label fw-bold">Shipping Address</label>
                                <textarea class="form-control bg-white border-dark" id="shipping_address" name="shipping_address" rows="3" required>{{ $customer ? $customer->addressline : '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="shipping_method" class="form-label fw-bold">Shipping Method</label>
                                <select class="form-select bg-white border-dark" id="shipping_method" name="shipping_method" required>
                                    <option value="standard">Standard Shipping - $10.00 (5-7 business days)</option>
                                    <option value="express">Express Shipping - $20.00 (2-3 business days)</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Payment Method</label>
                                <div class="card bg-white border-dark p-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payment_method_cod" value="cod" checked>
                                        <label class="form-check-label fw-bold" for="payment_method_cod">
                                            <i class="fas fa-money-bill-wave me-2"></i>Cash on Delivery
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark btn-lg w-100 fw-bold py-2">
                                <i class="fas fa-check-circle me-2"></i>Place Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4 border-0 shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><i class="fas fa-receipt me-2"></i>Order Summary</h4>
                    </div>
                    <div class="card-body bg-light">
                        <div class="mb-3">
                            @foreach($items as $item)
                                <div class="d-flex justify-content-between mb-2 border-bottom pb-2">
                                    <span class="fw-bold">{{ $item->title }}</span>
                                    <span class="badge bg-dark rounded-pill">x{{ $item->cart_quantity }}</span>
                                    <span>${{ number_format($item->subtotal, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <hr class="border-dark">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold">Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold">Shipping</span>
                            <span>${{ number_format($shipping, 2) }}</span>
                        </div>
                        <hr class="border-dark">
                        <div class="d-flex justify-content-between fw-bold bg-dark text-white p-2 rounded">
                            <span class="h5">Total</span>
                            <span class="h5">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>Customer Information</h5>
                    </div>
                    <div class="card-body bg-light">
                        @if($customer)
                            <div class="mb-2">
                                <p class="mb-1"><strong class="fw-bold">Name:</strong> {{ $customer->full_name }}</p>
                                <p class="mb-1"><strong class="fw-bold">Email:</strong> {{ Auth::user()->email }}</p>
                                <p class="mb-1"><strong class="fw-bold">Phone:</strong> {{ $customer->phone }}</p>
                                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-dark mt-2">
                                    <i class="fas fa-edit me-1"></i>Edit profile
                                </a>
                            </div>
                        @else
                            <div class="alert alert-dark">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Please complete your profile information before checkout.
                                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-dark mt-2 w-100">
                                    <i class="fas fa-user-edit me-1"></i>Update Profile
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Consistent with home.blade.php styles */
    .hero-banner {
        background: linear-gradient(135deg, 
                    rgba(0,0,0,1) 0%, 
                    rgba(30,30,30,1) 50%, 
                    rgba(60,60,60,1) 100%), 
                    url('{{ asset("images/manga-banner-bg.jpg") }}');
        background-size: cover;
        background-position: center;
        background-blend-mode: overlay;
        padding: 2rem 0;
        border-bottom: 1px solid #444;
        margin-left: calc(-1 * var(--bs-gutter-x) + 1rem);
        margin-right: calc(-1 * var(--bs-gutter-x) + 1rem);
        width: calc(100% + 2 * var(--bs-gutter-x) - 2rem);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            to right,
            rgba(0,0,0,0.7) 0%,
            rgba(255,255,255,0.1) 50%,
            rgba(0,0,0,0.7) 100%
        );
        z-index: 1;
        border-radius: inherit;
    }

    /* Checkout specific styles */
    .card {
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.15) !important;
    }

    .card-header {
        border-bottom: 2px solid rgba(255,255,255,0.1);
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .border-dark {
        border-color: #333 !important;
    }

    .form-control, .form-select {
        border-width: 2px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #333;
        box-shadow: 0 0 0 0.25rem rgba(51,51,51,0.25);
    }

    .btn-dark {
        background-color: #333;
        border-color: #333;
        transition: all 0.3s ease;
    }

    .btn-dark:hover {
        background-color: #222;
        border-color: #222;
        transform: translateY(-2px);
    }

    .btn-outline-dark {
        border-width: 2px;
    }

    .alert-dark {
        background-color: #333;
        color: white;
        border-color: #444;
    }

    hr {
        opacity: 1;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-banner {
            padding: 1.5rem 0;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
            width: calc(100% - 1rem);
        }
        
        .hero-banner h1 {
            font-size: 2rem;
        }
    }
</style>
@endsection