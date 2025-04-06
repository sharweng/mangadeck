@extends('layouts.app')

@section('title', $item->title)

@section('content')
<div class="container">
    <!-- Breadcrumb with dark background -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-dark rounded-3 px-3 py-2">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('items.index') }}" class="text-white-50">Manga</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($item->title, 30) }}</li>
        </ol>
    </nav>

    <!-- Main Product Card with Gradient Background -->
    <div class="card mb-4 border-0 overflow-hidden">
        <div class="card-body p-0">
            <div class="row g-0">
                <!-- Manga Image Gallery - Left Side -->
                <div class="col-md-5 position-relative">
                    <div class="manga-detail-gradient-overlay"></div>
                    <div class="p-4">
                        <div class="manga-image-container mb-3 d-flex justify-content-center">
                            @if($item->primaryImage)
                                <img id="product-main-image" src="/storage/{{ $item->primaryImage->image_path }}" 
                                     alt="{{ $item->title }}" class="img-fluid rounded shadow manga-cover">
                            @else
                                <img id="product-main-image" src="{{ asset('images/no-image.jpg') }}" 
                                     alt="{{ $item->title }}" class="img-fluid rounded shadow manga-cover">
                            @endif
                        </div>
                        
                        <!-- Thumbnails Gallery -->
                        @if($item->images->count() > 1)
                            <div class="thumbnails-scroll-container">
                                <div class="manga-thumbnails d-flex">
                                    @foreach($item->images as $image)
                                        <div class="thumbnail-item {{ $image->is_primary ? 'active' : '' }}">
                                            <img src="/storage/{{ $image->image_path }}" 
                                                 class="thumbnail-image"
                                                 data-path="/storage/{{ $image->image_path }}"
                                                 alt="Image {{ $loop->iteration }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Manga Details - Right Side -->
                <div class="col-md-7 bg-light">
                    <div class="p-4 h-100 d-flex flex-column">
                        <h1 class="mb-3 fw-bold">{{ $item->title }}</h1>
                        
                        <div class="mb-3">
                            @foreach($item->genres as $genre)
                                <a href="{{ route('genres.show', $genre) }}" class="badge bg-dark text-white text-decoration-none me-1">{{ $genre->name }}</a>
                            @endforeach
                        </div>
                        
                        <!-- Rating with manga-style stars -->
                        <div class="mb-3">
                            @if($item->average_rating > 0)
                                <div class="text-dark d-inline-block me-2">
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
                                <span class="text-muted"><i class="far fa-star"></i> No reviews yet</span>
                            @endif
                        </div>
                        
                        <!-- Price with manga-style emphasis -->
                        <div class="mb-4">
                            <span class="display-5 fw-bold text-dark">₱{{ number_format($item->price, 2) }}</span>
                            <span class="badge {{ $item->isInStock() ? 'bg-success' : 'bg-danger' }} ms-2 align-middle">
                                {{ $item->isInStock() ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>
                        
                        <!-- Description with manga-style panel -->
                        <div class="mb-4 bg-white p-3 rounded border">
                            <h5 class="border-bottom pb-2 mb-3">Description</h5>
                            <p class="mb-0">{{ $item->description }}</p>
                        </div>
                        
                        <!-- Details in manga-info style -->
                        <div class="row mb-4 g-3">
                            <div class="col-md-6">
                                <div class="bg-white p-3 rounded border h-100">
                                    <h5 class="border-bottom pb-2 mb-3">Details</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><strong class="text-dark">Author:</strong> {{ $item->getAuthorNamesAttribute() }}</li>
                                        <li class="mb-2"><strong class="text-dark">Publisher:</strong> {{ $item->publisher ? $item->publisher->name : 'Unknown' }}</li>
                                        <li><strong class="text-dark">Published:</strong> {{ $item->publication_date ? $item->publication_date->format('M d, Y') : 'Unknown' }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white p-3 rounded border h-100">
                                    <h5 class="border-bottom pb-2 mb-3">Specs</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><strong class="text-dark">Stock:</strong> {{ $item->stock ? $item->stock->quantity : 0 }} copies</li>
                                        <li class="mb-2"><strong class="text-dark">Pages:</strong> {{ $item->pages ?? 'Unknown' }}</li>
                                        <li><strong class="text-dark">Language:</strong> English</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Add to cart with manga-style button -->
                        <form action="{{ route('cart.add', $item) }}" method="POST" class="mt-auto">
                            @csrf
                            <div class="d-flex align-items-center">
                                <div class="input-group me-3" style="max-width: 150px;">
                                    <label class="input-group-text bg-dark text-white border-dark" for="quantity">Qty</label>
                                    <input type="number" class="form-control border-dark" id="quantity" name="quantity" value="1" min="1" max="{{ $item->stock ? $item->stock->quantity : 0 }}" {{ $item->isInStock() ? '' : 'disabled' }}>
                                </div>
                                <button type="submit" class="btn btn-dark btn-lg flex-grow-1" {{ $item->isInStock() ? '' : 'disabled' }}>
                                    <i class="fas fa-shopping-cart me-2"></i>{{ $item->isInStock() ? 'Add to Cart' : 'Out of Stock' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section with manga panel style -->
    <div class="card mb-4 border-0">
        <div class="card-header bg-dark text-white rounded-top">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-comment-alt me-2"></i>Customer Reviews</h5>
                <span class="badge bg-light text-dark">{{ $item->reviews->count() }} {{ Str::plural('review', $item->reviews->count()) }}</span>
            </div>
        </div>
        <div class="card-body bg-light rounded-bottom">
            @if($item->reviews->where('is_approved', true)->count() > 0)
                <div class="reviews-list">
                    @foreach($item->reviews->where('is_approved', true) as $review)
                        <div class="review-item bg-white p-3 rounded mb-3 border">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <span class="fw-bold text-dark">{{ $review->user->name }}</span>
                                    <span class="text-muted ms-2">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>
                                @auth
                                    @if($review->user_id === Auth::id())
                                        <a href="{{ route('reviews.edit', [$item, $review]) }}" class="btn btn-sm btn-outline-dark">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            <div class="text-dark mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="mb-0">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-secondary">
                    <i class="fas fa-exclamation-circle me-2"></i>No reviews yet. Be the first to review this manga!
                </div>
            @endif
        </div>
    </div>

    <!-- Review Form Section -->
    @auth
        @php
            $userReview = $item->reviews->where('user_id', Auth::id())->first();
        @endphp
        
        @if(!$userReview)
            @if(isset($userHasPurchased) && $userHasPurchased)
                <div class="card border-0 mb-4">
                    <div class="card-header bg-dark text-white rounded-top">
                        <h5><i class="fas fa-pen me-2"></i>Write a Review</h5>
                    </div>
                    <div class="card-body bg-light rounded-bottom">
                        <form action="{{ route('reviews.store', $item) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label text-dark">Rating</label>
                                <select class="form-select border-dark @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                                    <option value="">Select your rating</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="3">3 - Good</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label text-dark">Your Review</label>
                                <textarea class="form-control border-dark @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3" required minlength="5" maxlength="1000"></textarea>
                                <div class="form-text text-muted">Your honest review helps other manga fans. Minimum 5 characters.</div>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-dark">Submit Review</button>
                        </form>
                    </div>
                </div>
            @elseif(isset($userHasOrderedButNotReceived) && $userHasOrderedButNotReceived)
                <div class="alert alert-secondary">
                    <i class="fas fa-clock me-2"></i>
                    <p class="mb-1">You've ordered this manga, but you can only review it after delivery.</p>
                    <p class="mb-0">Check back when your order status changes to "Delivered".</p>
                </div>
            @else
                <div class="alert alert-secondary">
                    <i class="fas fa-info-circle me-2"></i>
                    <p class="mb-2">You need to purchase and receive this manga before reviewing.</p>
                    <form action="{{ route('cart.add', $item) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-sm btn-dark" {{ $item->isInStock() ? '' : 'disabled' }}>
                            {{ $item->isInStock() ? 'Add to Cart' : 'Out of Stock' }}
                        </button>
                    </form>
                </div>
            @endif
        @else
            <div class="alert alert-secondary">
                <i class="fas fa-check-circle me-2"></i>
                You've already reviewed this manga. <a href="{{ route('reviews.edit', [$item, $userReview]) }}" class="text-dark fw-bold">Edit your review</a>
            </div>
        @endif
    @else
        <div class="alert alert-secondary">
            <i class="fas fa-sign-in-alt me-2"></i>
            Please <a href="{{ route('login') }}" class="text-dark fw-bold">login</a> to write a review.
        </div>
    @endauth

    <!-- Related Manga - Manga-style shelf -->
    @if($relatedItems->count() > 0)
        <div class="card border-0 mb-4">
            <div class="card-header bg-dark text-white rounded-top">
                <h3 class="mb-0"><i class="fas fa-book-open me-2"></i>Related Manga</h3>
            </div>
            <div class="card-body bg-light rounded-bottom">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($relatedItems as $relatedItem)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm manga-card">
                                @if($relatedItem->primaryImage)
                                    <img src="/storage/{{ $relatedItem->primaryImage->image_path }}" class="card-img-top" alt="{{ $relatedItem->title }}">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="{{ $relatedItem->title }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title manga-title">{{ $relatedItem->title }}</h5>
                                    <div class="mb-2">
                                        @foreach($relatedItem->genres->take(2) as $genre)
                                            <span class="badge bg-secondary me-1 mb-1">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                    <div class="text-dark mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($relatedItem->average_rating))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="fw-bold text-dark">₱{{ number_format($relatedItem->price, 2) }}</div>
                                </div>
                                <div class="card-footer bg-white border-0">
                                    <a href="{{ route('items.show', $relatedItem) }}" class="btn btn-outline-dark w-100">View Details</a>
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

@section('styles')
<style>
    /* Base manga-inspired styles */
    body {
        background-color: #f5f5f5;
    }
    
    /* Gradient overlay for manga details */
    .manga-detail-gradient-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            to bottom,
            rgba(0,0,0,0.8) 0%,
            rgba(0,0,0,0.6) 50%,
            rgba(0,0,0,0.4) 100%
        );
        z-index: 1;
    }
    
    /* Manga cover styling */
    .manga-cover {
        height: auto;
        max-height: 400px;
        object-fit: contain;
        border: 1px solid rgba(0,0,0,0.1);
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
        position: relative;
        z-index: 2;
        background-color: white;
    }
    
    .manga-cover:hover {
        transform: scale(1.02) rotate(1deg);
    }
    
    /* Thumbnail gallery styling */
    .thumbnails-scroll-container {
        width: 100%;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    
    .manga-thumbnails {
        display: flex;
        flex-wrap: nowrap;
        gap: 8px;
        min-width: min-content;
    }
    
    .thumbnail-item {
        position: relative;
        flex: 0 0 auto;
        width: 70px;
        height: 70px;
        border-radius: 4px;
        overflow: hidden;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
        background-color: white;
    }
    
    .thumbnail-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }
    
    .thumbnail-item.active {
        border-color: #333;
    }
    
    .thumbnail-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Custom scrollbar */
    .thumbnails-scroll-container::-webkit-scrollbar {
        height: 6px;
    }
    
    .thumbnails-scroll-container::-webkit-scrollbar-track {
        background: #e1e1e1;
        border-radius: 10px;
    }
    
    .thumbnails-scroll-container::-webkit-scrollbar-thumb {
        background: #333;
        border-radius: 10px;
    }
    
    /* Manga card styling for related items */
    .manga-card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .manga-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .manga-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #333;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.8em;
    }
    
    /* Review items styling */
    .review-item {
        transition: all 0.3s ease;
    }
    
    .review-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .manga-cover {
            max-height: 300px;
        }
        
        .manga-title {
            font-size: 0.85rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Image gallery functionality
    document.addEventListener('DOMContentLoaded', function() {
        const thumbnails = document.querySelectorAll('.thumbnail-image');
        const mainImage = document.getElementById('product-main-image');
        
        if (thumbnails.length > 0 && mainImage) {
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    // Update main image
                    mainImage.src = this.getAttribute('data-path');
                    
                    // Update active thumbnail
                    document.querySelectorAll('.thumbnail-item').forEach(item => {
                        item.classList.remove('active');
                    });
                    this.parentElement.classList.add('active');
                });
            });
        }
        
        // Add subtle animation to cards
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * index);
        });
    });
</script>
@endsection