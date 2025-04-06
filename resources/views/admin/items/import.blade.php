@extends('layouts.admin')

@section('title', 'Import Manga')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Import Manga from Excel</h6>
        <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Manga List
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Upload Excel File</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.items.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="file" class="form-label">Excel File</label>
                                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" required>
                                <small class="form-text text-muted">Accepted formats: .xlsx, .xls, .csv</small>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload and Import
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Instructions</h6>
                    </div>
                    <div class="card-body">
                        <p>Please follow these guidelines for importing manga data:</p>
                        <ol>
                            <li>Use the template format.</li>
                            <li>Ensure all required fields are filled in</li>
                            <li>Maximum file size is 2MB</li>
                        </ol>
                        <div class="mt-3">
                            <a href="{{ route('admin.items.export.template') }}" class="btn btn-outline-primary">
                                <i class="fas fa-download"></i> Download Template
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection