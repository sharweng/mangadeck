@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="bg-dark text-white p-5 mb-4 rounded">
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

    <!-- Search Bar (Moved below banner) -->
    <div class="card mb-5">
        <div class="card-body">
            <h4 class="mb-3">Search Our Manga Collection</h4>
            <form id="searchForm" action="{{ route('home') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="searchInput" 
                        name="search" 
                        placeholder="Search for manga titles, authors, or descriptions..." 
                        value="{{ $search ?? '' }}"
                        autocomplete="off"
                    >
                    <button class="btn btn-primary d-none" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Results (if search query exists) -->
    @if(isset($search) && isset($searchResults))
        <div class="mb-5">
            <h2>Search Results for "{{ $search }}"</h2>
            <p>Found {{ $searchResults->total() }} results</p>
            
            <div class="row">
                @forelse($searchResults as $item)
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
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No manga found matching your search. Please try different keywords.
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination for search results -->
            <div class="d-flex justify-content-center mt-4">
                {{ $searchResults->appends(['search' => $search])->links() }}
            </div>
        </div>
    @endif

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
    @if(isset($genres) && !isset($search))
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
    @endif

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
    });
</script>
@endsection