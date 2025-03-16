@extends('layouts.admin')

@section('title', 'Edit Genre')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Edit Genre: {{ $genre->name }}</h6>
        <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <!-- Debug information -->
        {{-- <div class="alert alert-info mb-3">
            <p><strong>Debug Info:</strong></p>
            <ul>
                <li>Genre ID: {{ $genre->id }}</li>
                <li>Genre Name: {{ $genre->name }}</li>
                <li>Description exists: {{ isset($genre->description) ? 'Yes' : 'No' }}</li>
                <li>Description value: "{{ $genre->description ?? 'NULL' }}"</li>
                <li>Genre attributes: {{ json_encode($genre->getAttributes()) }}</li>
            </ul>
        </div> --}}
        
        <form action="{{ route('admin.genres.update', $genre) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $genre->name) }}" 
                       class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="3" 
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $genre->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Genre</button>
            </div>
        </form>
    </div>
</div>
@endsection