@extends('layouts.app')

@section('title', 'Manga Collection')

@section('content')
<div class="container">
    <h1 class="mb-4">Manga Collection</h1>

    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('items.index') }}" method="GET" class="row g-3">
                <div class="col-md-6">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ $search ?? '' }}" placeholder="Search by title, author, or description">
                </div>
                <div class="col-md-4">
                    <label for="genre" class="form-label">Genre</label>
                    <select class="form-select" id="genre" name="genre">
                        <option value="">All Genres</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $selectedGenre == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Items Display -->
    <div class="row">
        @forelse($items as $item)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $item->img_path ? asset('storage/'.$item->img_path) : asset('images/no-image.jpg') }}" class="card-img-top" alt="{{ $item->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text text-muted">{{ $item->genre->name }}</p>
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
                    No manga found matching your criteria. Please try a different search or filter.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $items->appends(['search' => $search, 'genre' => $selectedGenre])->links() }}
    </div>
</div>
@endsection

