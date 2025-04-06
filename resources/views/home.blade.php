@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section with Manga-style Banner -->
    <div class="hero-banner position-relative overflow-hidden mb-5">
        <div class="banner-overlay"></div>
        <div class="container position-relative py-5" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-3 fw-bold text-white mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Welcome to <span class="text-danger">Manga</span>Deck</h1>
                    <p class="lead text-white mb-4" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Discover the best manga titles from Japan and around the world.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('items.index') }}" class="btn btn-danger btn-lg px-4 py-2 fw-bold">Explore Collection</a>
                        <a href="#trending" class="btn btn-outline-light btn-lg px-4 py-2 fw-bold">Trending Now</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="manga-character-illustration">
                        <img src="{{ asset('images/manga-hero-character.png') }}" alt="Manga Character" class="img-fluid floating">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Search Bar with Manga-style Design -->
        <div class="card mb-5 border-0 shadow-lg manga-search-card">
            <div class="card-body p-4">
                <h4 class="mb-3 text-center fw-bold" style="color: #d32f2f;">
                    <i class="fas fa-search me-2"></i>Search Our Manga Collection
                </h4>
                <form id="searchForm" action="{{ route('home') }}" method="GET">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input 
                            type="text" 
                            class="form-control border-start-0 border-end-0 py-3" 
                            id="searchInput" 
                            name="search" 
                            placeholder="Search for manga titles, authors, or genres..." 
                            value="{{ $search ?? '' }}"
                            autocomplete="off"
                        >
                        <button class="btn btn-danger fw-bold" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Results -->
        @if(isset($search) && isset($searchResults))
            <div class="mb-5">
                <h2 class="mb-4 pb-2 border-bottom border-danger">
                    <i class="fas fa-search me-2 text-danger"></i>Search Results for "<span class="text-danger">{{ $search }}</span>"
                    <small class="text-muted fs-5 ms-2">{{ $searchResults->total() }} results found</small>
                </h2>
                
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
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
                                        <span class="badge bg-danger">${{ number_format($item->price, 2) }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title manga-title">{{ $item->title }}</h5>
                                    <div class="mb-2">
                                        @foreach($item->genres as $genre)
                                            <span class="badge bg-dark me-1 mb-1">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                    @if($item->average_rating > 0)
                                        <div class="manga-rating mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= round($item->average_rating))
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                            <small class="text-muted ms-1">({{ $item->reviews->count() }})</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-top-0">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-dark">Details</a>
                                        <form action="{{ route('cart.add', $item) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-sm btn-danger" {{ $item->isInStock() ? '' : 'disabled' }}>
                                                {{ $item->isInStock() ? 'Add to Cart' : 'Out of Stock' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                No manga found matching your search. Please try different keywords.
                            </div>
                        </div>
                    @endforelse
                </div>
                
                @if($searchResults->hasPages())
                    <div class="d-flex justify-content-center mt-5">
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title">
                    <span class="section-title-icon"><i class="fas fa-bolt text-danger"></i></span>
                    <span class="section-title-text">Latest Releases</span>
                </h2>
                <a href="{{ route('items.index') }}" class="btn btn-outline-danger">
                    View All <i class="fas fa-chevron-right ms-1"></i>
                </a>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
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
                                    <span class="badge bg-danger">NEW</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title manga-title">{{ $item->title }}</h5>
                                <div class="mb-2">
                                    @foreach($item->genres as $genre)
                                        <span class="badge bg-dark me-1 mb-1">{{ $genre->name }}</span>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-danger">${{ number_format($item->price, 2) }}</span>
                                    @if($item->average_rating > 0)
                                        <div class="manga-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= round($item->average_rating))
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-dark">Details</a>
                                    <form action="{{ route('cart.add', $item) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm btn-danger" {{ $item->isInStock() ? '' : 'disabled' }}>
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
            <h2 class="section-title mb-4">
                <span class="section-title-icon"><i class="fas fa-tags text-danger"></i></span>
                <span class="section-title-text">Browse by Genre</span>
            </h2>
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3">
                @foreach($genres as $genre)
                    <div class="col">
                        <a href="{{ route('genres.show', $genre) }}" class="text-decoration-none genre-card">
                            <div class="card h-100 genre-card-inner">
                                <div class="card-body text-center p-3">
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
        <div class="row mb-5 g-4">
            <div class="col-md-4">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h3 class="h4">Fast Shipping</h3>
                        <p class="mb-0">Get your manga delivered in 2-3 business days with our premium shipping</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="h4">Authentic Manga</h3>
                        <p class="mb-0">100% official licensed manga directly from Japanese publishers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="h4">Otaku Support</h3>
                        <p class="mb-0">Our team of manga enthusiasts is here to help you find your next read</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly Special Offer -->
        <div class="mb-5">
            <div class="card bg-dark text-white special-offer-card overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body p-4 p-lg-5">
                            <h2 class="card-title display-5 fw-bold mb-3">Weekly Special Offer</h2>
                            <p class="card-text lead mb-4">Get 15% off on all Shonen Jump titles this week only!</p>
                            <a href="#" class="btn btn-outline-light btn-lg px-4 fw-bold">Shop Now</a>
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
    /* Hero Banner Styles */
    .hero-banner {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%), 
                    url('{{ asset("images/manga-banner-bg.jpg") }}');
        background-size: cover;
        background-position: center;
        background-blend-mode: overlay;
        padding: 5rem 0;
        border-bottom: 4px solid #d32f2f;
    }
    
    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }
    
    .manga-character-illustration img {
        max-height: 400px;
        filter: drop-shadow(0 0 10px rgba(0,0,0,0.5));
    }
    
    .floating {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    
    /* Manga Card Styles */
    .manga-card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .manga-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .manga-card-image {
        position: relative;
        overflow: hidden;
    }
    
    .manga-card-image img {
        transition: transform 0.5s ease;
        height: 300px;
        object-fit: cover;
        width: 100%;
    }
    
    .manga-card:hover .manga-card-image img {
        transform: scale(1.05);
    }
    
    .manga-card-badge {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    
    .manga-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 3em;
    }
    
    /* Genre Card Styles */
    .genre-card-inner {
        border: none;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }
    
    .genre-card:hover .genre-card-inner {
        background-color: #d32f2f;
        transform: translateY(-3px);
    }
    
    .genre-card:hover .genre-title,
    .genre-card:hover .genre-icon i {
        color: white !important;
    }
    
    .genre-icon {
        color: #d32f2f;
        transition: all 0.3s ease;
    }
    
    .genre-title {
        color: #333;
        transition: all 0.3s ease;
    }
    
    /* Section Title Styles */
    .section-title {
        position: relative;
        padding-bottom: 10px;
        color: #333;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: #d32f2f;
    }
    
    .section-title-icon {
        color: #d32f2f;
        margin-right: 10px;
    }
    
    /* Feature Card Styles */
    .feature-card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .feature-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 20px;
        background-color: rgba(211, 47, 47, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d32f2f;
        font-size: 24px;
    }
    
    /* Special Offer Card */
    .special-offer-card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
    }
    
    /* Search Card */
    .manga-search-card {
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-banner {
            padding: 3rem 0;
            text-align: center;
        }
        
        .manga-title {
            font-size: 1rem;
        }
        
        .manga-card-image img {
            height: 250px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let typingTimer;
        const doneTypingInterval = 500; // Wait 500ms after user stops typing

        // Function to submit the form
        function submitSearch() {
            const searchTerm = searchInput.value.trim();
            
            // Only submit if there's something to search for
            if (searchTerm.length > 2) {
                searchForm.submit();
            } else if (searchTerm.length === 0 && window.location.search.includes('search=')) {
                // If search is empty and we're on a search results page, go back to home
                window.location.href = '{{ route('home') }}';
            }
        }

        // On keyup, start the countdown
        searchInput.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            
            // Don't trigger search on navigation keys
            if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'Escape', 'Tab'].includes(e.key)) {
                return;
            }
            
            const searchTerm = searchInput.value.trim();
            
            if (searchTerm.length > 2) {
                // If 3+ characters, wait briefly then search
                typingTimer = setTimeout(submitSearch, doneTypingInterval);
            } else if (searchTerm.length === 0 && window.location.search.includes('search=')) {
                // If search is cleared and we're on a search results page, wait briefly then go to home
                typingTimer = setTimeout(submitSearch, doneTypingInterval);
            }
        });

        // On keydown, clear the countdown
        searchInput.addEventListener('keydown', function() {
            clearTimeout(typingTimer);
        });
        
        // Handle form submission to prevent empty searches
        searchForm.addEventListener('submit', function(e) {
            if (searchInput.value.trim().length === 0) {
                e.preventDefault();
                window.location.href = '{{ route('home') }}';
            }
        });
        
        // Focus the search input when the page loads if there's a search term
        if (searchInput.value.trim().length > 0) {
            searchInput.focus();
            // Place cursor at the end of the text
            const length = searchInput.value.length;
            searchInput.setSelectionRange(length, length);
        }
        
        // Add animation class to cards when they come into view
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