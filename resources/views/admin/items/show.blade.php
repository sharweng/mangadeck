@extends('layouts.admin')

@section('title', $item->title)

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Manga Details</h6>
        <div>
            <a href="{{ route('admin.items.edit', $item) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="manga-image-container mb-3 d-flex justify-content-center">
                    @if($item->primaryImage)
                        <img id="main-image" src="/storage/{{ $item->primaryImage->image_path }}" 
                             alt="{{ $item->title }}" class="img-fluid rounded shadow manga-cover">
                    @else
                        <img id="main-image" src="{{ asset('images/no-image.jpg') }}" 
                             alt="{{ $item->title }}" class="img-fluid rounded shadow manga-cover">
                    @endif
                </div>
                
                <!-- Display all images as scrollable thumbnails -->
                @if($item->images->count() > 0)
                    <div class="mt-3">
                        <div class="thumbnails-scroll-container">
                            <div class="manga-thumbnails d-flex">
                                @foreach($item->images as $image)
                                    <div class="thumbnail-item {{ $image->is_primary ? 'primary-thumbnail' : '' }}">
                                        <img src="/storage/{{ $image->image_path }}" 
                                             class="img-thumbnail thumbnail-image" 
                                             data-path="/storage/{{ $image->image_path }}"
                                             alt="Image {{ $loop->iteration }}">
                                        @if($image->is_primary)
                                            <span class="badge bg-primary position-absolute">Primary</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="card mt-3">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold">Stock Information</h6>
                    </div>
                    <div class="card-body py-2">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mb-1">Price</h5>
                                <p class="fs-4 text-primary mb-1">₱{{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="col-6">
                                <h5 class="mb-1">Stock</h5>
                                <p class="mb-1">
                                    @if($item->stock)
                                        @if($item->stock->quantity > 10)
                                            <span class="text-success fs-5"><i class="fas fa-check-circle me-1"></i>{{ $item->stock->quantity }} in stock</span>
                                        @elseif($item->stock->quantity > 0)
                                            <span class="text-warning fs-5"><i class="fas fa-exclamation-circle me-1"></i>{{ $item->stock->quantity }} in stock (Low)</span>
                                        @else
                                            <span class="text-danger fs-5"><i class="fas fa-times-circle me-1"></i>Out of stock</span>
                                        @endif
                                    @else
                                        <span class="text-secondary fs-5"><i class="fas fa-question-circle me-1"></i>Not tracked</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card h-100">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold">Manga Information</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-2">{{ $item->title }}</h4>
                        <div class="mb-2">
                            @foreach($item->genres as $genre)
                                <span class="badge bg-primary fs-6 me-1 mb-1">{{ $genre->name }}</span>
                            @endforeach
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="border-bottom pb-1">Description</h6>
                                <p>{{ Str::limit($item->description, 150) }}</p>
                                <button class="btn btn-sm btn-link p-0" type="button" data-bs-toggle="collapse" data-bs-target="#fullDescription">
                                    Read more
                                </button>
                                <div class="collapse" id="fullDescription">
                                    <p>{{ $item->description }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="border-bottom pb-1">Authors</h6>
                                <ul class="list-unstyled mb-2">
                                    @forelse($item->authors as $author)
                                        <li>
                                            <strong>{{ $author->name }}</strong>
                                            @if($author->pivot && $author->pivot->role)
                                                <span class="text-muted">({{ $author->pivot->role }})</span>
                                            @endif
                                        </li>
                                    @empty
                                        <li>No authors listed</li>
                                    @endforelse
                                </ul>
                                
                                <h6 class="border-bottom pb-1 mt-3">Publisher</h6>
                                <p class="mb-2">{{ $item->publisher ? $item->publisher->name : 'N/A' }}</p>
                                
                                <h6 class="border-bottom pb-1">Publication Date</h6>
                                <p class="mb-2">{{ $item->publication_date ? $item->publication_date->format('F d, Y') : 'N/A' }}</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="border-bottom pb-1">Created At</h6>
                                <p class="mb-2">{{ $item->created_at->format('F d, Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="border-bottom pb-1">Last Updated</h6>
                                <p class="mb-2">{{ $item->updated_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reviews Section -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Reviews</h6>
    </div>
    <div class="card-body">
        @if($item->reviews->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item->reviews as $review)
                            <tr>
                                <td>{{ $review->user->name }}</td>
                                <td>
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                        @endfor
                                    </div>
                                </td>
                                <td>{{ Str::limit($review->comment, 100) }}</td>
                                <td>{{ $review->created_at->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $review->is_approved ? 'success' : 'warning' }}">
                                        {{ $review->is_approved ? 'Approved' : 'Pending' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if(!$review->is_approved)
                                            <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this review?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No reviews yet.</p>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .manga-cover {
        height: auto;
        max-height: 300px;
        object-fit: contain;
        border: 1px solid #ddd;
        transition: transform 0.3s ease;
    }
    
    .manga-cover:hover {
        transform: scale(1.02);
    }
    
    /* Scrollable thumbnails container */
    .thumbnails-scroll-container {
        width: 100%;
        overflow-x: auto;
        padding-bottom: 10px; /* Add padding to show scrollbar */
    }
    
    .manga-thumbnails {
        display: flex;
        flex-wrap: nowrap;
        gap: 8px;
        min-width: min-content;
    }
    
    .thumbnail-item {
        position: relative;
        flex: 0 0 auto;
        width: 70px;
        height: 70px;
        border-radius: 0.25rem;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .thumbnail-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .thumbnail-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0.25rem;
    }
    
    .primary-thumbnail {
        border: 2px solid #4e73df;
    }
    
    .primary-thumbnail .badge {
        position: absolute;
        top: 2px;
        right: 2px;
        font-size: 0.6rem;
    }
    
    /* Custom scrollbar for thumbnails */
    .thumbnails-scroll-container::-webkit-scrollbar {
        height: 6px;
    }
    
    .thumbnails-scroll-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .thumbnails-scroll-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    
    .thumbnails-scroll-container::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
    }
</style>
@endsection

@section('scripts')
<script>
    // Image thumbnail click functionality
    document.addEventListener('DOMContentLoaded', function() {
        const thumbnails = document.querySelectorAll('.thumbnail-image');
        const mainImage = document.getElementById('main-image');
        
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // Update main image
                mainImage.src = this.getAttribute('data-path');
                
                // Update active thumbnail
                document.querySelectorAll('.thumbnail-item').forEach(item => {
                    item.classList.remove('primary-thumbnail');
                });
                this.parentElement.classList.add('primary-thumbnail');
            });
        });
    });
</script>
@endsection