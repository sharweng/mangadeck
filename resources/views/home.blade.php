@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="bg-dark text-white p-5 mb-5 rounded">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4">Welcome to MangaDeck</h1>
                <p class="lead">Discover the best manga titles from Japan and around the world.</p>
                <a href="{{ route('items.index') }}" class="btn btn-primary btn-lg">Explore Our Collection</a>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('images/manga-hero.jpg') }}" alt="Manga Collection" class="img-fluid rounded">
            </div>
        </div>
    </div>

    <!-- Latest Manga -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Latest Manga</h2>
            <a href="{{ route('items.index') }}" class="btn btn-outline-primary">View All</a>
        </div>
        <div class="row">
            @foreach($latestItems as $item)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if($item->primaryImage)
                            <img src="/storage/{{ $item->primaryImage->image_path }}" class="card-img-top" alt="{{ $item->title }}">
                        @else
                            <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="{{ $item->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <div class="mb-2">
                                @foreach($item->genres as $genre)
                                    <span class="badge bg-secondary">{{ $genre->name }}</span>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">${{ number_format($item->price, 2) }}</span>
                                <div>
                                    @if($item->average_rating > 0)
                                        <div class="text-warning mb-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= round($item->average_rating))
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span class="text-muted">({{ $item->reviews->count() }})</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between">
                            <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-secondary">Details</a>
                            <form action="{{ route('cart.add', $item) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-sm btn-primary" {{ $item->isInStock() ? '' : 'disabled' }}>
                                    {{ $item->isInStock() ? 'Add to Cart' : 'Out of Stock' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Genre Browsing -->
    <div class="mb-5">
        <h2 class="mb-4">Browse by Genre</h2>
        <div class="row">
            @foreach($genres as $genre)
                <div class="col-md-2 mb-3">
                    <a href="{{ route('genres.show', $genre) }}" class="text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-3x mb-3"></i>
                                <h5 class="card-title">{{ $genre->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Features -->
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-shipping-fast fa-4x mb-3 text-primary"></i>
                    <h3>Fast Shipping</h3>
                    <p>Get your manga delivered to your doorstep quickly</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-hand-holding-usd fa-4x mb-3 text-success"></i>
                    <h3>Best Prices</h3>
                    <p>We offer competitive prices on our entire collection</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-book-reader fa-4x mb-3 text-danger"></i>
                    <h3>Huge Selection</h3>
                    <p>Browse thousands of titles across all manga genres</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection