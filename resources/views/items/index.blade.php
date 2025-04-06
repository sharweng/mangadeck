@extends('layouts.app')

@section('title', 'Manga Collection')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section for Collection Page -->
    <div class="collection-hero-banner bg-dark text-white py-5 mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">Manga <span class="text-danger">Collection</span></h1>
                    <p class="lead mb-4">Browse our extensive catalog of manga titles from all genres</p>
                    <div class="d-flex gap-3">
                        <a href="#collection" class="btn btn-danger btn-lg px-4 py-2 fw-bold">View Collection</a>
                        <a href="#search" class="btn btn-outline-light btn-lg px-4 py-2 fw-bold">Search & Filter</a>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block">
                    <img src="{{ asset('images/manga-stack.png') }}" alt="Manga Collection" class="img-fluid floating">
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="collection">
        <!-- Search and Filter Section -->
        <div class="card mb-5 border-0 shadow-lg manga-search-card" id="search">
            <div class="card-body p-4">
                <h2 class="mb-4 text-center fw-bold" style="color: #d32f2f;">
                    <i class="fas fa-filter me-2"></i>Search & Filter
                </h2>
                <form action="{{ route('items.index') }}" method="GET" class="row g-3">
                    <div class="col-md-6">
                        <label for="search" class="form-label fw-bold">Search Manga</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="{{ $search ?? '' }}" 
                                   placeholder="Search by title, author, or description">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="genre" class="form-label fw-bold">Filter by Genre</label>
                        <select class="form-select" id="genre" name="genre">
                            <option value="">All Genres</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ $selectedGenre == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }} ({{ $genre->items_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-danger w-100 fw-bold py-2">
                            <i class="fas fa-filter me-1"></i> Apply
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Collection Stats -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="section-title mb-0">
                        <span class="section-title-icon"><i class="fas fa-book-open text-danger"></i></span>
                        <span class="section-title-text">Our Collection</span>
                    </h2>
                    <div class="text-muted">
                        Showing {{ $items->firstItem() }} - {{ $items->lastItem() }} of {{ $items->total() }} titles
                    </div>
                </div>
                <hr class="mt-2 mb-4">
            </div>
        </div>

        <!-- Items Display -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse($items as $item)
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
                                @if($item->created_at->diffInDays(now()) < 30)
                                    <span class="badge bg-success ms-1">NEW</span>
                                @endif
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
                                <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-dark">
                                    <i class="fas fa-info-circle me-1"></i> Details
                                </a>
                                <form action="{{ route('cart.add', $item) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-danger" {{ $item->isInStock() ? '' : 'disabled' }}>
                                        <i class="fas fa-cart-plus me-1"></i>
                                        {{ $item->isInStock() ? 'Add to Cart' : 'Out of Stock' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center py-4">
                        <i class="fas fa-book-dead fa-3x mb-3 text-muted"></i>
                        <h3 class="h4">No Manga Found</h3>
                        <p class="mb-0">We couldn't find any manga matching your criteria. Try adjusting your search or filters.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($items->hasPages())
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Manga collection pagination">
                    <ul class="pagination">
                        {{ $items->appends(['search' => $search, 'genre' => $selectedGenre])->links() }}
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Collection Hero Banner */
    .collection-hero-banner {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%), 
                    url('{{ asset("images/manga-collection-bg.jpg") }}');
        background-size: cover;
        background-position: center;
        background-blend-mode: overlay;
        border-bottom: 4px solid #d32f2f;
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
    
    /* Search Card */
    .manga-search-card {
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    
    /* Floating Animation */
    .floating {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    
    /* Pagination Styles */
    .pagination .page-item.active .page-link {
        background-color: #d32f2f;
        border-color: #d32f2f;
    }
    
    .pagination .page-link {
        color: #d32f2f;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .collection-hero-banner {
            text-align: center;
            padding: 3rem 0;
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
        // Add animation to cards when they come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.manga-card').forEach(card => {
            observer.observe(card);
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>
@endsection