@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container-fluid py-4">
    <!-- Hero-like Cart Header -->
    <div class="hero-banner position-relative overflow-hidden mb-4 rounded-3 mx-3">
        <div class="banner-overlay"></div>
        <div class="container-fluid px-4 position-relative py-1" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-xl-6">
                    <h1 class="display-5 fw-bold text-white mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Your <span class="text-white-50">Manga</span> Cart</h1>
                    <p class="text-white mb-3" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Review your selected manga before checkout.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if(session('cart') && count(session('cart')))
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach(session('cart') as $id => $details)
                                    @php 
                                        $subtotal = $details['price'] * $details['quantity'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr data-id="{{ $id }}" class="manga-cart-item">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="manga-card-image position-relative" style="width: 60px; height: 80px;">
                                                    <img src="{{ $details['image'] ?? asset('images/no-image.jpg') }}" alt="{{ $details['title'] }}" class="img-fluid h-100" style="object-fit: cover; border-radius: 4px;">
                                                    <div class="manga-card-badge">
                                                        <span class="badge bg-dark">₱{{ number_format($details['price'], 2) }}</span>
                                                    </div>
                                                </div>
                                                <div class="ms-3">
                                                    <h5 class="mb-1">{{ $details['title'] }}</h5>
                                                    @if(isset($details['genres']))
                                                        <div class="d-flex flex-wrap">
                                                            @foreach($details['genres'] as $genre)
                                                                <span class="badge bg-secondary me-1 mb-1">{{ $genre }}</span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">₱{{ number_format($details['price'], 2) }}</td>
                                        <td class="align-middle">
                                            <div class="input-group input-group-sm" style="width: 120px;">
                                                <button class="btn btn-outline-dark update-cart decrease" data-id="{{ $id }}">-</button>
                                                <input type="number" class="form-control text-center quantity bg-white" value="{{ $details['quantity'] }}" min="1" max="{{ $details['max_qty'] ?? 99 }}">
                                                <button class="btn btn-outline-dark update-cart increase" data-id="{{ $id }}">+</button>
                                            </div>
                                        </td>
                                        <td class="align-middle">₱{{ number_format($subtotal, 2) }}</td>
                                        <td class="text-end pe-4 align-middle">
                                            <button class="btn btn-sm btn-dark remove-from-cart" data-id="{{ $id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="d-flex gap-2">
                        <a href="{{ route('items.index') }}" class="btn btn-outline-dark">
                            <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                        </a>
                        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-dark" onclick="return confirm('Are you sure you want to empty your cart?')">
                                <i class="fas fa-trash-alt me-2"></i>Empty Cart
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body bg-dark text-white rounded-3">
                            <h5 class="card-title text-white mb-3">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>₱{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                <span>₱5.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax (10%)</span>
                                <span>₱{{ number_format($total * 0.1, 2) }}</span>
                            </div>
                            <hr class="bg-white">
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total</strong>
                                <strong>₱{{ number_format($total + 5 + ($total * 0.1), 2) }}</strong>
                            </div>
                            <a href="{{ route('cart.checkout') }}" class="btn btn-light w-100 fw-bold">
                                Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5 bg-light rounded-3">
                    <div class="empty-cart-icon mb-4">
                        <i class="fas fa-shopping-cart fa-4x text-dark"></i>
                        <div class="empty-cart-overlay"></div>
                    </div>
                    <h3 class="text-dark mb-3">Your cart is empty</h3>
                    <p class="text-muted mb-4">Looks like you haven't added any manga to your cart yet.</p>
                    <a href="{{ route('items.index') }}" class="btn btn-dark">
                        <i class="fas fa-book-open me-2"></i>Browse Manga
                    </a>
                </div>
            </div>
        @endif
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

    /* Cart-specific styles */
    .manga-cart-item:hover {
        background-color: rgba(0,0,0,0.03);
        transform: translateX(2px);
        transition: all 0.2s ease;
    }

    .table-dark {
        background-color: #333;
        color: white;
    }

    .table-dark th {
        border-bottom: 2px solid #555;
    }

    .empty-cart-icon {
        position: relative;
        display: inline-block;
    }

    .empty-cart-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
    }

    .card {
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }

    .btn-outline-dark {
        border-color: #333;
        color: #333;
    }

    .btn-outline-dark:hover {
        background-color: #333;
        color: white;
    }

    .btn-dark {
        background-color: #333;
        border-color: #333;
    }

    .btn-dark:hover {
        background-color: #222;
        border-color: #222;
    }

    .badge {
        font-weight: 500;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .bg-secondary {
        background-color: #666 !important;
    }

    @media (max-width: 768px) {
        .hero-banner {
            padding: 1.5rem 0;
            text-align: center;
        }
        
        .manga-cart-item td {
            padding: 0.75rem 0.5rem;
        }
        
        .input-group {
            width: 100% !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Update cart quantity
        $('.update-cart').click(function(e) {
            e.preventDefault();
            
            var ele = $(this);
            var quantityInput = ele.closest('td').find('.quantity');
            var currentQty = parseInt(quantityInput.val());
            var maxQty = parseInt(quantityInput.attr('max'));
            
            if (ele.hasClass('increase')) {
                if (currentQty < maxQty) {
                    quantityInput.val(currentQty + 1);
                }
            } else if (ele.hasClass('decrease')) {
                if (currentQty > 1) {
                    quantityInput.val(currentQty - 1);
                }
            }
            
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "PUT",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id"),
                    quantity: quantityInput.val()
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });
        
        // Manual input change
        $('.quantity').change(function(e) {
            var ele = $(this);
            var maxQty = parseInt(ele.attr('max'));
            var currentQty = parseInt(ele.val());
            
            if (currentQty < 1) {
                ele.val(1);
            } else if (currentQty > maxQty) {
                ele.val(maxQty);
            }
            
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "PUT",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.closest('tr').attr("data-id"),
                    quantity: ele.val()
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });
        
        // Remove from cart
        $('.remove-from-cart').click(function (e) {
            e.preventDefault();
            
            var ele = $(this);
            
            if(confirm("Are you sure you want to remove this item?")) {
                $.ajax({
                    url: '{{ url('cart/remove') }}/' + ele.attr("data-id"),
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    });
</script>
@endsection