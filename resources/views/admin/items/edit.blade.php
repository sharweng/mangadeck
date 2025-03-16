@extends('layouts.admin')

@section('title', 'Edit Manga')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Edit Manga: {{ $item->title }}</h6>
        <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.items.update', $item) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $item->title) }}" 
                               class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="genres" class="form-label">Genres</label>
                        <select name="genre_ids[]" id="genres" class="form-control @error('genre_ids') is-invalid @enderror" multiple required>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" 
                                    {{ in_array($genre->id, old('genre_ids', $item->genres->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Hold Ctrl (or Cmd on Mac) to select multiple genres</small>
                        @error('genre_ids')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="5" 
                                  class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $item->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" name="price" id="price" value="{{ old('price', $item->price) }}" 
                                       class="form-control @error('price') is-invalid @enderror" step="0.01" min="0" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Stock</label>
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $item->stock ? $item->stock->quantity : 0) }}" 
                                       class="form-control @error('quantity') is-invalid @enderror" min="0" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Authors Section -->
                    <div class="mb-3">
                        <label class="form-label">Authors</label>
                        <div id="authors-container">
                            @forelse($item->authors as $index => $author)
                                <div class="row mb-2 author-row">
                                    <div class="col-md-8">
                                        <select name="author_ids[]" class="form-control @error('author_ids.*') is-invalid @enderror" required>
                                            <option value="">Select Author</option>
                                            @foreach($authors as $authorOption)
                                                <option value="{{ $authorOption->id }}" {{ $author->id == $authorOption->id ? 'selected' : '' }}>
                                                    {{ $authorOption->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="author_roles[]" class="form-control" 
                                               placeholder="Role (e.g., Author, Illustrator)" 
                                               value="{{ $author->pivot->role }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-author" {{ $index == 0 ? 'style=display:none;' : '' }}>
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="row mb-2 author-row">
                                    <div class="col-md-8">
                                        <select name="author_ids[]" class="form-control @error('author_ids.*') is-invalid @enderror" required>
                                            <option value="">Select Author</option>
                                            @foreach($authors as $author)
                                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="author_roles[]" class="form-control" placeholder="Role (e.g., Author, Illustrator)">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-author" style="display: none;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <button type="button" id="add-author" class="btn btn-sm btn-secondary mt-2">
                            <i class="fas fa-plus"></i> Add Another Author
                        </button>
                        @error('author_ids')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="publisher_id" class="form-label">Publisher</label>
                        <select name="publisher_id" id="publisher_id" class="form-control @error('publisher_id') is-invalid @enderror">
                            <option value="">Select Publisher</option>
                            @foreach($publishers as $publisher)
                                <option value="{{ $publisher->id }}" 
                                    {{ old('publisher_id', $item->publisher_id) == $publisher->id ? 'selected' : '' }}>
                                    {{ $publisher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('publisher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="publication_date" class="form-label">Publication Date</label>
                        <input type="date" name="publication_date" id="publication_date" 
                               value="{{ old('publication_date', $item->publication_date ? $item->publication_date->format('Y-m-d') : '') }}" 
                               class="form-control @error('publication_date') is-invalid @enderror">
                        @error('publication_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Current Images</h6>
                        </div>
                        <div class="card-body">
                            <div class="row current-images">
                                @forelse($item->images as $image)
                                    <div class="col-6 mb-3">
                                        <div class="image-card {{ $image->is_primary ? 'primary-image' : '' }}">
                                            <img src="{{ asset('storage/'.$image->image_path) }}" 
                                                 alt="Image {{ $loop->iteration }}" 
                                                 class="img-thumbnail">
                                            
                                            @if($image->is_primary)
                                                <span class="badge bg-primary">Primary</span>
                                            @endif
                                            
                                            <div class="image-controls mt-2">
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input" type="radio" name="primary_image_id" 
                                                           value="{{ $image->id }}" 
                                                           id="primary_image_{{ $image->id }}" 
                                                           {{ $image->is_primary ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="primary_image_{{ $image->id }}">
                                                        Set as primary
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="delete_image_ids[]" 
                                                           value="{{ $image->id }}" 
                                                           id="delete_image_{{ $image->id }}">
                                                    <label class="form-check-label" for="delete_image_{{ $image->id }}">
                                                        Delete
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted">No images uploaded yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Add New Images</h6>
                        </div>
                        <div class="card-body">
                            <div class="image-upload-container mb-3">
                                <label for="new_images" class="image-upload-label">
                                    <div class="upload-icon">
                                        <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                        <p>Click to select images or drag and drop</p>
                                    </div>
                                </label>
                                <input type="file" name="new_images[]" id="new_images" multiple
                                       class="form-control image-upload-input @error('new_images') is-invalid @enderror" accept="image/*">
                            </div>
                            <small class="form-text text-muted mb-3 d-block">You can select multiple images.</small>
                            @error('new_images')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div id="image-preview-container" class="mt-3 row">
                                <!-- Image previews will be inserted here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update Manga
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    .image-upload-container {
        border: 2px dashed #ccc;
        border-radius: 5px;
        text-align: center;
        padding: 20px;
        background-color: #f8f9fc;
        transition: all 0.3s ease;
    }
    
    .image-upload-container:hover {
        border-color: #4e73df;
        background-color: #eef1ff;
    }
    
    .image-upload-label {
        display: block;
        cursor: pointer;
        width: 100%;
        margin-bottom: 0;
    }
    
    .upload-icon {
        color: #6c757d;
    }
    
    .upload-icon p {
        margin-top: 10px;
        font-size: 14px;
    }
    
    .image-upload-input {
        display: none;
    }
    
    .current-images .image-card {
        position: relative;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .current-images .image-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .current-images .image-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 5px 5px 0 0;
        border: none;
    }
    
    .current-images .image-card .badge {
        position: absolute;
        top: 5px;
        right: 5px;
    }
    
    .current-images .image-controls {
        padding: 8px;
        background-color: #f8f9fc;
        border-top: 1px solid #e3e6f0;
    }
    
    .primary-image {
        border: 2px solid #4e73df;
    }
    
    #image-preview-container .col-6 {
        position: relative;
        margin-bottom: 15px;
    }
    
    #image-preview-container img {
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    #image-preview-container img:hover {
        transform: scale(1.05);
    }
</style>
@endsection

@section('scripts')
<script>
    // Image preview with drag and drop
    const imageInput = document.getElementById('new_images');
    const previewContainer = document.getElementById('image-preview-container');
    const uploadContainer = document.querySelector('.image-upload-container');
    
    // Show file input when clicking on the label
    document.querySelector('.image-upload-label').addEventListener('click', function(e) {
        imageInput.click();
    });
    
    // Handle file selection
    imageInput.addEventListener('change', function(e) {
        showPreviews(e.target.files);
    });
    
    // Drag and drop functionality
    uploadContainer.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadContainer.style.borderColor = '#4e73df';
        uploadContainer.style.backgroundColor = '#eef1ff';
    });
    
    uploadContainer.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadContainer.style.borderColor = '#ccc';
        uploadContainer.style.backgroundColor = '#f8f9fc';
    });
    
    uploadContainer.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadContainer.style.borderColor = '#ccc';
        uploadContainer.style.backgroundColor = '#f8f9fc';
        
        if (e.dataTransfer.files.length) {
            imageInput.files = e.dataTransfer.files;
            showPreviews(e.dataTransfer.files);
        }
    });
    
    function showPreviews(files) {
        previewContainer.innerHTML = '';
        
        Array.from(files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const col = document.createElement('div');
                col.className = 'col-6 mb-2';
                
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = 'img-thumbnail';
                img.style.height = '150px';
                img.style.width = '100%';
                img.style.objectFit = 'cover';
                
                col.appendChild(img);
                previewContainer.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    }
    
    // Authors management
    document.getElementById('add-author').addEventListener('click', function() {
        const container = document.getElementById('authors-container');
        const authorRow = document.querySelector('.author-row').cloneNode(true);
        
        // Reset values
        authorRow.querySelector('select').value = '';
        authorRow.querySelector('input').value = '';
        
        // Show remove button
        authorRow.querySelector('.remove-author').style.display = 'block';
        
        container.appendChild(authorRow);
        
        // Add event listener to the new remove button
        authorRow.querySelector('.remove-author').addEventListener('click', function() {
            container.removeChild(authorRow);
        });
    });
    
    // Show remove button for additional rows
    document.querySelectorAll('.author-row').forEach((row, index) => {
        if (index > 0) {
            row.querySelector('.remove-author').style.display = 'block';
            row.querySelector('.remove-author').addEventListener('click', function() {
                row.parentNode.removeChild(row);
            });
        }
    });
</script>
@endsection