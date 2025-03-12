@extends('layouts.app')

@section('content')
<div class="container py-4">
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
                    <img src="{{ $item->img_path ? asset('storage/'.$item->img_path) : asset('images/no-image.jpg') }}" 
                         class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text text-muted">{{ $item->author }}</p>
                        <p class="card-text">${{ number_format($item->price, 2) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="{{ route('items.show', $item) }}" class="btn btn-primary w-100">View Details</a>
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

