@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section with Gradient and Rounded Edges -->
<div class="hero-banner position-relative overflow-hidden mb-4 rounded-3 mx-3">
    <div class="banner-overlay"></div>
    <div class="container-fluid px-4 position-relative py-1" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-8 col-xl-6">
                <h1 class="display-5 fw-bold text-white mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Welcome to <span class="text-white-50">Manga</span>Deck</h1>
                <p class="text-white mb-3" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Discover the best manga titles from Japan and around the world.</p>
                <div class="d-flex gap-2">
                    <a href="{{ route('items.index') }}" class="btn btn-dark btn-md px-3 py-1 fw-bold">Explore Collection</a>
                    <a href="#trending" class="btn btn-outline-light btn-md px-3 py-1 fw-bold">Trending Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <!-- Compact Search Bar -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body p-3">
                <form id="searchForm" action="{{ route('home') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-dark"></i></span>
                        <input 
                            type="text" 
                            class="form-control border-start-0 border-end-0 py-2" 
                            id="searchInput" 
                            name="search" 
                            placeholder="Search for manga titles, authors, or genres..." 
                            value="{{ $search ?? '' }}"
                            autocomplete="off"
                        >
                        <button class="btn btn-dark fw-bold" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Results -->
        @if(isset($search) && isset($searchResults))
            <div class="mb-5">
                <h2 class="mb-4 pb-2 border-bottom border-dark">
                    <i class="fas fa-search me-2"></i>Search Results for "<span class="fw-bold">{{ $search }}</span>"
                    <small class="text-muted ms-2">{{ $searchResults->total() }} results found</small>
                </h2>
                
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">
                    @forelse($searchResults as $item)
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
    <div class="mb-2">
        <div class="d-flex flex-wrap">
            @foreach($item->genres->take(3) as $genre)
                <span class="badge bg-secondary me-1 mb-1">{{ $genre->name }}</span>
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
                        @foreach($item->genres->slice(3) as $genre)
                            <li><span class="dropdown-item-text small">{{ $genre->name }}</span></li>
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
                                No manga found matching your search. Please try different keywords.
                            </div>
                        </div>
                    @endforelse
                </div>
                
                @if($searchResults->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Search results pagination">
                            <ul class="pagination">
                                {{ $searchResults->appends(['search' => $search])->links() }}
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        @endif

        <!-- Latest Manga -->
        <div class="mb-5" id="trending">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="section-title">
                    <span class="section-title-icon"><i class="fas fa-bolt"></i></span>
                    <span class="section-title-text">Latest Releases</span>
                </h2>
                <a href="{{ route('items.index') }}" class="btn btn-outline-dark">
                    View All <i class="fas fa-chevron-right ms-1"></i>
                </a>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">
                @foreach($latestItems as $item)
                    <div class="col">
                    <div class="card h-100 manga-card">
    <div class="manga-card-image">
        @if($item->primaryImage)
            <img src="/storage/{{ $item->primaryImage->image_path }}" class="card-img-top" alt="{{ $item->title }}">
        @else
            <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="{{ $item->title }}">
        @endif
        <div class="manga-card-badge">
            <span class="badge bg-dark">
                @if(isset($searchResults))
                    ₱{{ number_format($item->price, 2) }}
                @else
                    NEW
                @endif
            </span>
        </div>
    </div>
    <div class="card-body p-3">
        <h5 class="card-title manga-title mb-2">{{ $item->title }}</h5>
        
    <div class="mb-2">
        <div class="d-flex flex-wrap">
            @foreach($item->genres->take(3) as $genre)
                <span class="badge bg-secondary me-1 mb-1">{{ $genre->name }}</span>
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
                        @foreach($item->genres->slice(3) as $genre)
                            <li><span class="dropdown-item-text small">{{ $genre->name }}</span></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="fw-bold">₱{{ number_format($item->price, 2) }}</span>
        @if($item->average_rating > 0)
            <div class="manga-rating">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= round($item->average_rating))
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
            </div>
        @endif
    </div>
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
                @endforeach
            </div>
        </div>

        <!-- Genre Browsing -->
        @if(isset($genres) && !isset($search))
        <div class="mb-5">
            <h2 class="section-title mb-3">
                <span class="section-title-icon"><i class="fas fa-tags"></i></span>
                <span class="section-title-text">Browse by Genre</span>
            </h2>
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3">
                @foreach($genres as $genre)
                    <div class="col">
                        <a href="{{ route('genres.show', $genre) }}" class="text-decoration-none genre-card">
                            <div class="card h-100 genre-card-inner">
                                <div class="card-body text-center p-2">
                                    <div class="genre-icon mb-2">
                                        <i class="fas fa-{{ $genre->icon ?? 'book' }} fa-2x"></i>
                                    </div>
                                    <h5 class="card-title genre-title mb-0">{{ $genre->name }}</h5>
                                    <small class="text-muted">{{ $genre->items_count }} titles</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Features -->
        <div class="row mb-5 g-3">
            <div class="col-md-4">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center p-3">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h3 class="h5">Fast Shipping</h3>
                        <p class="mb-0 small">Get your manga delivered in 2-3 business days</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center p-3">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="h5">Authentic Manga</h3>
                        <p class="mb-0 small">100% official licensed manga</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center p-3">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="h5">Otaku Support</h3>
                        <p class="mb-0 small">Manga enthusiasts ready to help</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly Special Offer -->
        <div class="mb-5">
            <div class="card bg-dark text-white special-offer-card overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body p-4">
                            <h2 class="card-title h4 fw-bold mb-2">Weekly Special Offer</h2>
                            <p class="card-text mb-3">15% off on all Shonen Jump titles this week!</p>
                            <a href="#" class="btn btn-outline-light btn-sm px-3 fw-bold">Shop Now</a>
                        </div>
                    </div>
                    <div class="col-md-4 d-none d-md-block">
                        <img src="{{ asset('images/special-offer.jpg') }}" class="img-fluid h-100" alt="Special Offer" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Base Styles */
    body {
        background-color: #f8f9fa;
    }
    
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

.rounded-3 {
    border-radius: 0.75rem !important;
}

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
    
    /* Genre Cards */
    .genre-card-inner {
        border: none;
        transition: all 0.3s ease;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    
    .genre-card:hover .genre-card-inner {
        background-color: #333;
        transform: translateY(-3px);
    }
    
    .genre-card:hover .genre-title,
    .genre-card:hover .genre-icon i {
        color: white !important;
    }
    
    .genre-icon {
        color: #333;
        transition: all 0.3s ease;
    }
    
    .genre-title {
        color: #333;
        transition: all 0.3s ease;
        font-size: 0.9rem;
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
    
    /* Feature Cards */
    .feature-card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        background-color: #fff;
    }
    
    .feature-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }
    
    .feature-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 15px;
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        font-size: 20px;
    }
    
    /* Special Offer Card */
    .special-offer-card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        background: linear-gradient(135deg, #222 0%, #444 100%);
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
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-banner {
            padding: 2rem 0;
            text-align: center;
        }
        
        .manga-card-image img {
            height: 300px;
        }
        
        .manga-title {
            font-size: 0.85rem;
        }
    }
    
    /* Genre Badges and Dropdown Styles */
.badge-genre {
    font-size: 0.7rem;
    padding: 0.25rem 0.4rem;
    margin-right: 0.3rem;
    margin-bottom: 0.3rem;
    border-radius: 4px;
}

.dropdown-toggle.badge {
    padding-right: 1.5rem;
    position: relative;
}

.dropdown-toggle.badge::after {
    position: absolute;
    right: 0.5rem;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    content: "\f078";
    font-size: 0.6rem;
}

.dropdown-menu {
    min-width: 8rem;
    padding: 0.3rem;
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.dropdown-item-text {
    padding: 0.25rem 0.5rem;
    color: #333;
}
    @media (max-width: 576px) {
        .manga-card-image img {
            height: 250px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Existing search functionality remains unchanged
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let typingTimer;
        const doneTypingInterval = 500;

        function submitSearch() {
            const searchTerm = searchInput.value.trim();
            
            if (searchTerm.length > 2) {
                searchForm.submit();
            } else if (searchTerm.length === 0 && window.location.search.includes('search=')) {
                window.location.href = '{{ route('home') }}';
            }
        }

        searchInput.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            
            if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'Escape', 'Tab'].includes(e.key)) {
                return;
            }
            
            const searchTerm = searchInput.value.trim();
            
            if (searchTerm.length > 2) {
                typingTimer = setTimeout(submitSearch, doneTypingInterval);
            } else if (searchTerm.length === 0 && window.location.search.includes('search=')) {
                typingTimer = setTimeout(submitSearch, doneTypingInterval);
            }
        });

        searchInput.addEventListener('keydown', function() {
            clearTimeout(typingTimer);
        });
        
        searchForm.addEventListener('submit', function(e) {
            if (searchInput.value.trim().length === 0) {
                e.preventDefault();
                window.location.href = '{{ route('home') }}';
            }
        });
        
        if (searchInput.value.trim().length > 0) {
            searchInput.focus();
            const length = searchInput.value.length;
            searchInput.setSelectionRange(length, length);
        }
        
        // Add intersection observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.manga-card, .genre-card-inner, .feature-card').forEach(card => {
            observer.observe(card);
        });
    });
</script>
@endsection