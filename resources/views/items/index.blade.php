@extends('layouts.app')

@section('title', 'Manga Collection')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section for Collection Page -->
    <div class="hero-banner position-relative overflow-hidden mb-4 rounded-3 mx-3">
        <div class="banner-overlay"></div>
        <div class="container-fluid px-4 position-relative py-1" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-xl-6">
                    <h1 class="display-5 fw-bold text-white mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Manga <span class="text-white-50">Collection</span></h1>
                    <p class="text-white mb-3" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Browse our extensive catalog of manga titles from all genres.</p>
                    <div class="d-flex gap-2">
                        <a href="#collection" class="btn btn-dark btn-md px-3 py-1 fw-bold">View Collection</a>
                        <a href="#search" class="btn btn-outline-light btn-md px-3 py-1 fw-bold">Search & Filter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="collection">
        <!-- Search and Filter Section -->
        <div class="card mb-4 border-0 shadow-sm" id="search">
            <div class="card-body p-3">
                <h2 class="mb-3 text-center fw-bold">
                    <i class="fas fa-filter me-2"></i>Search & Filter
                </h2>
                <form action="{{ route('items.index') }}" method="GET" class="row g-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-dark"></i></span>
                            <input type="text" class="form-control border-start-0 border-end-0 py-2" id="search" name="search" 
                                   value="{{ $search ?? '' }}" 
                                   placeholder="Search by title, author, or description">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="genre" name="genre">
                            <option value="">All Genres</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ $selectedGenre == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }} ({{ $genre->items_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark w-100 fw-bold py-2">
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
                        <span class="section-title-icon"><i class="fas fa-book-open"></i></span>
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
                                <span class="badge bg-dark">₱{{ number_format($item->price, 2) }}</span>
                                @if($item->created_at->diffInDays(now()) < 30)
                                    <span class="badge bg-secondary ms-1">NEW</span>
                                @endif
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
                    <div class="alert alert-secondary text-center py-4">
                        <i class="fas fa-book-dead fa-3x mb-3 text-muted"></i>
                        <h3 class="h4">No Manga Found</h3>
                        <p class="mb-0">We couldn't find any manga matching your criteria. Try adjusting your search or filters.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
@if($items->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} results
        </div>
        
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                <li class="page-item {{ $items->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $items->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>

                {{-- Pagination Elements --}}
                @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                    @if($page == $items->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                <li class="page-item {{ !$items->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $items->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif
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
        line-clamp: 2;
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

    /* Pagination Styles */
.pagination {
    --bs-pagination-color: #333;
    --bs-pagination-bg: #fff;
    --bs-pagination-border-color: #dee2e6;
    --bs-pagination-hover-color: #fff;
    --bs-pagination-hover-bg: #333;
    --bs-pagination-hover-border-color: #333;
    --bs-pagination-focus-color: #fff;
    --bs-pagination-focus-bg: #333;
    --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(51, 51, 51, 0.25);
    --bs-pagination-active-color: #fff;
    --bs-pagination-active-bg: #333;
    --bs-pagination-active-border-color: #333;
    --bs-pagination-disabled-color: #6c757d;
    --bs-pagination-disabled-bg: #fff;
    --bs-pagination-disabled-border-color: #dee2e6;
}

.page-link {
    padding: 0.5rem 0.75rem;
    font-weight: 500;
    border-radius: 4px;
    margin: 0 2px;
    min-width: 40px;
    text-align: center;
    transition: all 0.2s ease;
}

.page-item.active .page-link {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.page-item:not(.active):not(.disabled) .page-link:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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