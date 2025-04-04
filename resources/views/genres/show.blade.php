@extends('layouts.app')

@section('title', $genre->name . ' - Manga Collection')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $genre->name }}</li>
        </ol>
    </nav>

    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ $genre->name }}</h1>
            @if($genre->description)
                <p class="lead">{{ $genre->description }}</p>
            @endif
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        @forelse($genre->items as $item)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($item->primaryImage)
                        <img src="/storage/{{ $item->primaryImage->image_path }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text text-muted">{{ $item->getAuthorNamesAttribute() }}</p>
                        <div class="mb-2">
                            @foreach($item->genres as $itemGenre)
                                <span class="badge bg-secondary">{{ $itemGenre->name }}</span>
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
                    No manga titles found in this genre.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection