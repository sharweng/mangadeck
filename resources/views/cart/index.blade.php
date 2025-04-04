@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Your Shopping Cart</h1>
    
    @if(session('cart') && count(session('cart')))
        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
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
                                <tr data-id="{{ $id }}">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $details['image'] ?? asset('images/no-image.jpg') }}" alt="{{ $details['title'] }}" class="img-thumbnail me-3" style="width: 60px; height: 80px; object-fit: cover;">
                                            <div>
                                                <h5 class="mb-1">{{ $details['title'] }}</h5>
                                                @if(isset($details['genres']))
                                                    <div class="small text-muted">
                                                        @foreach($details['genres'] as $genre)
                                                            <span class="badge bg-secondary me-1">{{ $genre }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($details['price'], 2) }}</td>
                                    <td>
                                        <div class="input-group input-group-sm" style="width: 120px;">
                                            <button class="btn btn-outline-secondary update-cart decrease" data-id="{{ $id }}">-</button>
                                            <input type="number" class="form-control text-center quantity" value="{{ $details['quantity'] }}" min="1" max="{{ $details['max_qty'] ?? 99 }}">
                                            <button class="btn btn-outline-secondary update-cart increase" data-id="{{ $id }}">+</button>
                                        </div>
                                    </td>
                                    <td>${{ number_format($subtotal, 2) }}</td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-danger remove-from-cart" data-id="{{ $id }}">
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
        
        <div class="row">
            <div class="col-md-6">

                
                <div class="d-flex gap-2">
                    <a href="{{ route('items.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to empty your cart?')">
                            <i class="fas fa-trash-alt me-2"></i>Empty Cart
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>$5.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax (10%)</span>
                            <span>${{ number_format($total * 0.1, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total</strong>
                            <strong>${{ number_format($total + 5 + ($total * 0.1), 2) }}</strong>
                        </div>
                        <a href="{{ route('cart.checkout') }}" class="btn btn-primary w-100">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-shopping-cart fa-4x mb-3 text-muted"></i>
                <h3>Your cart is empty</h3>
                <p class="mb-4">Looks like you haven't added any manga to your cart yet.</p>
                <a href="{{ route('items.index') }}" class="btn btn-primary">
                    Start Shopping
                </a>
            </div>
        </div>
    @endif
</div>
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

