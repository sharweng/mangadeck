@extends('layouts.app')

@section('title', 'Edit Review')

@section('content')
<div class="container py-4">
    <!-- Manga-style Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb manga-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('items.index') }}" class="text-decoration-none">Manga</a></li>
            <li class="breadcrumb-item"><a href="{{ route('items.show', $item) }}" class="text-decoration-none">{{ Str::limit($item->title, 20) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Review</li>
        </ol>
    </nav>

    <!-- Manga Panel-inspired Card -->
    <div class="card border-0 shadow-lg manga-panel-card">
        <div class="card-header bg-dark text-white py-3">
            <div class="d-flex align-items-center">
                <i class="fas fa-pen-fancy me-2"></i>
                <h1 class="card-title mb-0 h4">Edit Your Review for <span class="text-white-50">{{ $item->title }}</span></h1>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('reviews.update', [$item, $review]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Rating Select - Manga Style -->
                <div class="mb-4">
                    <label for="rating" class="form-label fw-bold">Rating</label>
                    <div class="manga-rating-select">
                        <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                            <option value="">Select your rating</option>
                            <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>
                                ★★★★★ - Excellent
                            </option>
                            <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>
                                ★★★★☆ - Very Good
                            </option>
                            <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>
                                ★★★☆☆ - Good
                            </option>
                            <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>
                                ★★☆☆☆ - Fair
                            </option>
                            <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>
                                ★☆☆☆☆ - Poor
                            </option>
                        </select>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Comment Box - Manga Speech Bubble Style -->
                <div class="mb-4">
                    <label for="comment" class="form-label fw-bold">Your Review</label>
                    <div class="manga-comment-box">
                        <textarea class="form-control @error('comment') is-invalid @enderror" 
                                  id="comment" 
                                  name="comment" 
                                  rows="6" 
                                  required 
                                  minlength="5" 
                                  maxlength="1000"
                                  placeholder="Share your thoughts about this manga...">{{ old('comment', $review->comment) }}</textarea>
                        <div class="manga-comment-footer">
                            <small class="text-muted">Minimum 5 characters. Keep it manga-appropriate!</small>
                            <span class="text-muted float-end">{{ strlen(old('comment', $review->comment)) }}/1000</span>
                        </div>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Action Buttons - Manga Panel Style -->
                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-dark btn-lg flex-grow-1 manga-action-btn">
                        <i class="fas fa-save me-2"></i> Update Review
                    </button>
                    <a href="{{ route('items.show', $item) }}" class="btn btn-outline-dark btn-lg flex-grow-1 manga-action-btn">
                        <i class="fas fa-times me-2"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Manga-inspired Neutral Color Scheme */
    :root {
        --manga-black: #111;
        --manga-dark: #333;
        --manga-gray: #666;
        --manga-light: #ddd;
        --manga-white: #f8f9fa;
        --manga-panel: #fff;
    }
    
    body {
        background-color: var(--manga-white);
        background-image: linear-gradient(
            to bottom,
            var(--manga-white) 0%,
            var(--manga-light) 100%
        );
    }
    
    /* Manga Breadcrumb */
    .manga-breadcrumb {
        background-color: var(--manga-panel);
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .manga-breadcrumb .breadcrumb-item {
        font-size: 0.85rem;
    }
    
    .manga-breadcrumb .breadcrumb-item::before {
        color: var(--manga-gray);
    }
    
    .manga-breadcrumb .breadcrumb-item a {
        color: var(--manga-dark);
        transition: color 0.2s;
    }
    
    .manga-breadcrumb .breadcrumb-item a:hover {
        color: var(--manga-black);
        text-decoration: underline;
    }
    
    .manga-breadcrumb .breadcrumb-item.active {
        color: var(--manga-gray);
        font-weight: 500;
    }
    
    /* Manga Panel Card */
    .manga-panel-card {
        border-radius: 0.75rem;
        overflow: hidden;
        background-color: var(--manga-panel);
        border: 1px solid var(--manga-light);
    }
    
    .manga-panel-card .card-header {
        border-bottom: 2px solid var(--manga-black);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Manga Rating Select */
    .manga-rating-select .form-select {
        border: 2px solid var(--manga-dark);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        background-color: var(--manga-white);
        transition: all 0.3s ease;
    }
    
    .manga-rating-select .form-select:focus {
        border-color: var(--manga-black);
        box-shadow: 0 0 0 0.25rem rgba(0,0,0,0.1);
    }
    
    /* Manga Comment Box */
    .manga-comment-box {
        position: relative;
        border-radius: 0.5rem;
        background-color: var(--manga-white);
    }
    
    .manga-comment-box textarea {
        border: 2px solid var(--manga-dark);
        border-radius: 0.5rem 0.5rem 0 0;
        padding: 1rem;
        font-size: 1rem;
        background-color: var(--manga-white);
        resize: vertical;
        min-height: 150px;
    }
    
    .manga-comment-box textarea:focus {
        border-color: var(--manga-black);
        box-shadow: 0 0 0 0.25rem rgba(0,0,0,0.1);
        outline: none;
    }
    
    .manga-comment-footer {
        background-color: var(--manga-light);
        padding: 0.5rem 1rem;
        border-radius: 0 0 0.5rem 0.5rem;
        border: 2px solid var(--manga-dark);
        border-top: none;
    }
    
    /* Manga Action Buttons */
    .manga-action-btn {
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border-width: 2px;
    }
    
    .manga-action-btn.btn-dark {
        background-color: var(--manga-black);
        border-color: var(--manga-black);
    }
    
    .manga-action-btn.btn-dark:hover {
        background-color: var(--manga-dark);
        border-color: var(--manga-dark);
        transform: translateY(-2px);
    }
    
    .manga-action-btn.btn-outline-dark {
        color: var(--manga-black);
        border-color: var(--manga-dark);
    }
    
    .manga-action-btn.btn-outline-dark:hover {
        background-color: var(--manga-light);
        border-color: var(--manga-black);
        transform: translateY(-2px);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .manga-action-btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .manga-comment-box textarea {
            min-height: 120px;
        }
    }
    
    /* Manga-style form elements */
    .form-label {
        font-weight: 600;
        color: var(--manga-dark);
        margin-bottom: 0.5rem;
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }
    
    .is-invalid {
        border-color: #dc3545 !important;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter for comment textarea
        const commentTextarea = document.getElementById('comment');
        const charCounter = document.querySelector('.manga-comment-footer span');
        
        if (commentTextarea && charCounter) {
            commentTextarea.addEventListener('input', function() {
                const currentLength = this.value.length;
                charCounter.textContent = `${currentLength}/1000`;
                
                // Visual feedback when approaching limit
                if (currentLength > 900) {
                    charCounter.style.color = '#dc3545';
                    charCounter.style.fontWeight = 'bold';
                } else {
                    charCounter.style.color = '#666';
                    charCounter.style.fontWeight = 'normal';
                }
            });
            
            // Trigger initial count
            const event = new Event('input');
            commentTextarea.dispatchEvent(event);
        }
    });
</script>
@endsection