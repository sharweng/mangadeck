@extends('layouts.app')

@section('title', 'Edit Review')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Manga</a></li>
            <li class="breadcrumb-item"><a href="{{ route('items.show', $item) }}">{{ $item->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Review</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Edit Your Review for {{ $item->title }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('reviews.update', [$item, $review]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                        <option value="">Select rating</option>
                        <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5 - Excellent</option>
                        <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4 - Very Good</option>
                        <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3 - Good</option>
                        <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2 - Fair</option>
                        <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1 - Poor</option>
                    </select>
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="5" required minlength="5" maxlength="1000">{{ old('comment', $review->comment) }}</textarea>
                    <div class="form-text">Your review must be at least 5 characters long. Please note that reviews containing inappropriate language will require approval before being published.</div>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Review</button>
                    <a href="{{ route('items.show', $item) }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection