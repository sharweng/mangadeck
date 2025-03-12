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
            <div class="col-md-4">
                <img src="{{ $item->img_path ? asset('storage/'.$item->img_path) : asset('images/no-image.jpg') }}" 
                     alt="{{ $item->title }}" class="img-fluid rounded">
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Stock Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5>Price</h5>
                                <p>${{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="col-6">
                                <h5>Stock</h5>
                                <p>
                                    @if($item->stock)
                                        @if($item->stock->quantity > 10)
                                            <span class="text-success">{{ $item->stock->quantity }} in stock</span>
                                        @elseif($item->stock->quantity > 0)
                                            <span class="text-warning">{{ $item->stock->quantity }} in stock (Low)</span>
                                        @else
                                            <span class="text-danger">Out of stock</span>
                                        @endif
                                    @else
                                        <span class="text-secondary">Not tracked</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5>ISBN</h5>
                                <p>{{ $item->isbn ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h2>{{ $item->title }}</h2>
                <p class="text-muted">{{ $item->genre->name }}</p>
                
                <div class="mb-3">
                    <h5>Description</h5>
                    <p>{{ $item->description }}</p>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Author</h5>
                        <p>{{ $item->author }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Publisher</h5>
                        <p>{{ $item->publisher ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Publication Date</h5>
                        <p>{{ $item->publication_date ? $item->publication_date->format('F d, Y') : 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Pages</h5>
                        <p>{{ $item->pages ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <h5>Created At</h5>
                    <p>{{ $item->created_at->format('F d, Y') }}</p>
                </div>
                
                <div class="mb-3">
                    <h5>Last Updated</h5>
                    <p>{{ $item->updated_at->format('F d, Y') }}</p>
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
                                <td>{{ $review->comment }}</td>
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

