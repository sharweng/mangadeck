@extends('layouts.app')

@section('title', $genre->name . ' - Manga Collection')

@section('content')
<div class="container-fluid px-0">
    <!-- Genre Hero Section -->
    <div class="hero-banner position-relative overflow-hidden mb-4 rounded-3 mx-3">
        <div class="banner-overlay"></div>
        <div class="container-fluid px-4 position-relative py-5" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-xl-6">
                    <h1 class="display-5 fw-bold text-white mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">{{ $genre->name }}</h1>
                    @if($genre->description)
                        <p class="text-white mb-3" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">{{ $genre->description }}</p>
                    @endif
                    <div class="d-flex gap-2">
                        <a href="{{ url()->previous() }}" class="btn btn-dark btn-md px-3 py-1 fw-bold">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title">
                <span class="section-title-icon"><i class="fas fa-tags"></i></span>
                <span class="section-title-text">{{ $genre->name }} Collection</span>
                <small class="text-muted ms-2">{{ $genre->items->count() }} titles</small>
            </h2>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse($genre->items as $item)
                <div class="col">
                    <div class="card h-100 manga-card">
                        <div class="manga-card-image">
                            @if($item->primaryImage)
                                <img src="/storage/{{ $item->primaryImage->image_path }}" class="card-img-top" alt="{{ $item->title }}">
                            @else
                                <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="{{ $item->title }}">
                            @endif
                            <div class="manga-card-badge">
                                <span class="badge bg-dark">${{ number_format($item->price, 2) }}</span>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <h5 class="card-title manga-title mb-1">{{ $item->title }}</h5>
                            <p class="card-text text-muted small mb-2">{{ $item->getAuthorNamesAttribute() }}</p>
                            <div class="mb-2">
                                <div class="d-flex flex-wrap">
                                    @foreach($item->genres->take(3) as $itemGenre)
                                        <span class="badge bg-secondary me-1 mb-1">{{ $itemGenre->name }}</span>
                                    @endforeach
                                    
                                    @if($item->genres->count() > 3)
                                        <div class="dropdown d-inline-block">
                                            <button class="btn badge bg-secondary dropdown-toggle py-1 px-2" 
                                                    type="button" 
                                                    data-bs-toggle="dropdown" 
                                                    aria-expanded="false">
                                                +{{ $item->genres->count() - 3 }}
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach($item->genres->slice(3) as $itemGenre)
                                                    <li><span class="dropdown-item-text small">{{ $itemGenre->name }}</span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if($item->average_rating > 0)
                                <div class="manga-rating mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($item->average_rating))
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    <small class="text-muted ms-1">({{ $item->reviews->count() }})</small>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer bg-white border-top-0 p-2">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-dark">Details</a>
                                <form action="{{ route('cart.add', $item) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-dark" {{ $item->isInStock() ? '' : 'disabled' }}>
                                        {{ $item->isInStock() ? 'Add to Cart' : 'Out of Stock' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-secondary">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        No manga titles found in this genre.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Hero Banner Styles */
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
    top: 20%;  /* Reduced from top */
    left: 0;
    width: 100%;
    height: 50%;  /* Reduced height */
    background: linear-gradient(
        to right,
        rgba(0,0,0,0.5) 0%,        /* More transparent black */
        rgba(255,255,255,0.05) 50%, /* More subtle white */
        rgba(0,0,0,0.5) 100%        /* More transparent black */
    );
    z-index: 1;
    border-radius: inherit;
    }

    /* Manga Card - Tall and Skinny */
    .manga-card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .manga-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }
    
    .manga-card-image {
        position: relative;
        overflow: hidden;
        flex-grow: 1;
    }
    
    .manga-card-image img {
        transition: transform 0.5s ease;
        height: 350px;
        width: 100%;
        object-fit: cover;
        object-position: top;
    }
    
    .manga-card:hover .manga-card-image img {
        transform: scale(1.03);
    }
    
    .manga-card-badge {
        position: absolute;
        top: 1px;
        right: 1px;
    }
    
    .manga-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.8em;
        margin-bottom: 0.5rem;
    }

    /* Section Titles */
    .section-title {
        position: relative;
        padding-bottom: 8px;
        color: #333;
        font-size: 1.5rem;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, #333 0%, #ddd 100%);
        border-radius: 2px;
    }
    
    .section-title-icon {
        color: #333;
        margin-right: 8px;
    }

    /* Badges */
    .badge {
        border-radius: 4px;
        font-weight: 500;
        padding: 4px 8px;
    }
    
    /* Buttons */
    .btn {
        border-radius: 6px;
    }
    
    .btn-dark {
        background-color: #333;
        border-color: #333;
    }
    
    .btn-dark:hover {
        background-color: #222;
        border-color: #222;
    }

    /* Manga Rating */
    .manga-rating {
        color: #333;
    }

    .manga-rating .fa-star {
        font-size: 0.8rem;
    }

    /* Responsive Adjustments */
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
        
        .hero-banner .btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .manga-card-image img {
            height: 300px;
        }
    }

    @media (max-width: 576px) {
        .manga-card-image img {
            height: 250px;
        }
    }
</style>
@endsection