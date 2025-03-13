@extends('layouts.app')

@section('title', $item->title)

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Manga</a></li>
            @if($item->genres->isNotEmpty())
                <li class="breadcrumb-item"><a href="{{ route('genres.show', $item->genres->first()) }}">{{ $item->genres->first()->name }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $item->title }}</li>
        </ol>
    </nav>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <!-- Manga Image -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <img src="{{ $item->img_path ? asset('storage/'.$item->img_path) : asset('images/no-image.jpg') }}" class="img-fluid rounded" alt="{{ $item->title }}">
                </div>
                
                <!-- Manga Details -->
                <div class="col-md-8">
                    <h1 class="mb-3">{{ $item->title }}</h1>
                    
                    <div class="mb-2">
                        @foreach($item->genres as $genre)
                            <a href="{{ route('genres.show', $genre) }}" class="badge bg-primary text-decoration-none">{{ $genre->name }}</a>
                        @endforeach
                    </div>
                    
                    <div class="mb-3">
                        @if($item->average_rating > 0)
                            <div class="text-warning d-inline-block me-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($item->average_rating))
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-muted">({{ $item->reviews->count() }} reviews)</span>
                        @else
                            <span class="text-muted">No reviews yet</span>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <span class="fs-3 fw-bold text-primary">${{ number_format($item->price, 2) }}</span>
                        <span class="badge {{ $item->isInStock() ? 'bg-success' : 'bg-danger' }} ms-2">
                            {{ $item->isInStock() ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Description</h5>
                        <p>{{ $item->description }}</p>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Details</h5>
                            <ul class="list-unstyled">
                                <li><strong>Author:</strong> {{ $item->author ?? 'Unknown' }}</li>
                                <li><strong>Publisher:</strong> {{ $item->publisher ?? 'Unknown' }}</li>
                                <li><strong>Publication Date:</strong> {{ $item->publication_date ? $item->publication_date->format('M d, Y') : 'Unknown' }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Specifications</h5>
                            <ul class="list-unstyled">
                                <li><strong>Stock:</strong> {{ $item->stock ? $item->stock->quantity : 0 }} copies</li>
                            </ul>
                        </div>
                    </div>
                    
                    <form action="{{ route('cart.add', $item) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <div class="input-group me-3" style="max-width: 150px;">
                            <label class="input-group-text" for="quantity">Qty</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="{{ $item->stock ? $item->stock->quantity : 0 }}" {{ $item->isInStock() ? '' : 'disabled' }}>
                        </div>
                        <button type="submit" class="btn btn-primary" {{ $item->isInStock() ? '' : 'disabled' }}>
                            <i class="fas fa-shopping-cart me-2"></i>{{ $item->isInStock() ? 'Add to Cart' : 'Out of Stock' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Customer Reviews</h3>
        </div>
        <div class="card-body">
            @if($item->reviews->count() > 0)
                <div class="mb-4">
                    <h4>{{ number_format($item->average_rating, 1) }} out of 5</h4>
                    <div class="text-warning mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($item->average_rating))
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <p>Based on {{ $item->reviews->count() }} reviews</p>
                </div>
                
                <div class="mb-4">
                    @foreach($item->reviews as $review)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <strong>{{ $review->user->name }}</strong>
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                            </div>
                            <p class="mb-0">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No reviews yet. Be the first to review this manga!</p>
            @endif
            
            <!-- Review Form -->
            @auth
                <div class="card">
                    <div class="card-header">
                        <h5>Write a Review</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('reviews.store', $item) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <select class="form-select" id="rating" name="rating" required>
                                    <option value="">Select rating</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="3">3 - Good</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" required minlength="5" maxlength="1000"></textarea>
                                <div class="form-text">Your review must be at least 5 characters long. Please note that reviews containing inappropriate language will require approval before being published.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    Please <a href="{{ route('login') }}">login</a> to write a review.
                </div>
            @endauth
        </div>
    </div>

    <!-- Related Manga -->
    @if($relatedItems->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3>Related Manga</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($relatedItems as $relatedItem)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100">
                                <img src="{{ $relatedItem->img_path ? asset('storage/'.$relatedItem->img_path) : asset('images/no-image.jpg') }}" class="card-img-top" alt="{{ $relatedItem->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $relatedItem->title }}</h5>
                                    <div class="mb-2">
                                        @foreach($relatedItem->genres as $genre)
                                            <span class="badge bg-secondary">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                    <div class="text-warning mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($relatedItem->average_rating))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="fw-bold mt-2">${{ number_format($relatedItem->price, 2) }}</div>
                                </div>
                                <div class="card-footer bg-white">
                                    <a href="{{ route('items.show', $relatedItem) }}" class="btn btn-outline-primary w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection