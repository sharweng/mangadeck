@extends('layouts.admin')

@section('title', $genre->name)

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Genre Details</h6>
        <div>
            <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-3">{{ $genre->name }}</h2>
                
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">Description</h5>
                    <p>{{ $genre->description ?? 'No description available.' }}</p>
                </div>
                
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">Statistics</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Total Manga</h6>
                                            <h2 class="mb-0">{{ $genre->items()->count() }}</h2>
                                        </div>
                                        <i class="fas fa-book fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Associated Manga -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manga in this Genre</h6>
    </div>
    <div class="card-body">
        @if($genre->items()->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($genre->items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>
                                    @if($item->stock)
                                        @if($item->stock->quantity > 10)
                                            <span class="badge bg-success">{{ $item->stock->quantity }}</span>
                                        @elseif($item->stock->quantity > 0)
                                            <span class="badge bg-warning">{{ $item->stock->quantity }}</span>
                                        @else
                                            <span class="badge bg-danger">Out of stock</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.items.show', $item) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No manga associated with this genre.</p>
        @endif
    </div>
</div>
@endsection