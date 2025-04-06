@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <!-- Card Header with Gradient Background -->
                <div class="card-header bg-gradient-dark text-white py-3">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-user-edit me-2"></i>{{ __('My Profile') }}
                    </h2>
                </div>

                <div class="card-body p-0">
                    @if (session('success'))
                        <div class="alert alert-success border-0 rounded-0 mb-0" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <!-- Profile Photo Section -->
                    <div class="text-center py-4" style="background: linear-gradient(to bottom, #f8f9fa, #ffffff);">
                        @if(Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}" 
                                class="img-thumbnail rounded-circle border-3 border-white shadow" 
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-gradient-dark text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow" 
                                style="width: 150px; height: 150px; font-size: 3rem;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <!-- Form Section -->
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-4">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information Section -->
                        <div class="mb-4">
                            <h5 class="mb-3 pb-2 border-bottom border-dark">
                                <i class="fas fa-id-card me-2"></i>Personal Information
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="title" class="form-label">{{ __('Title') }}</label>
                                    <select id="title" name="title" class="form-select @error('title') is-invalid @enderror">
                                        <option value="">-- Select --</option>
                                        <option value="Mr" {{ old('title', $customer->title ?? '') == 'Mr' ? 'selected' : '' }}>Mr</option>
                                        <option value="Mrs" {{ old('title', $customer->title ?? '') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                        <option value="Ms" {{ old('title', $customer->title ?? '') == 'Ms' ? 'selected' : '' }}>Ms</option>
                                        <option value="Dr" {{ old('title', $customer->title ?? '') == 'Dr' ? 'selected' : '' }}>Dr</option>
                                        <option value="Prof" {{ old('title', $customer->title ?? '') == 'Prof' ? 'selected' : '' }}>Prof</option>
                                    </select>
                                    @error('title')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-5">
                                    <label for="fname" class="form-label">{{ __('First Name') }}</label>
                                    <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" 
                                        name="fname" value="{{ old('fname', $customer->fname ?? '') }}" required>
                                    @error('fname')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="lname" class="form-label">{{ __('Last Name') }}</label>
                                    <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" 
                                        name="lname" value="{{ old('lname', $customer->lname ?? '') }}" required>
                                    @error('lname')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="addressline" class="form-label">{{ __('Address') }}</label>
                                    <input id="addressline" type="text" class="form-control @error('addressline') is-invalid @enderror" 
                                        name="addressline" value="{{ old('addressline', $customer->addressline ?? '') }}" required>
                                    @error('addressline')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                                        name="phone" value="{{ old('phone', $customer->phone ?? '') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Account Information Section -->
                        <div class="mb-4">
                            <h5 class="mb-3 pb-2 border-bottom border-dark">
                                <i class="fas fa-user-cog me-2"></i>Account Information
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">{{ __('Display Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                        name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                        name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="photo" class="form-label">{{ __('Profile Photo') }}</label>
                                    <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                                    <small class="form-text text-muted">Upload a profile photo (optional, max 2MB)</small>
                                    @error('photo')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Password Change Section -->
                        <div class="mb-4">
                            <h5 class="mb-3 pb-2 border-bottom border-dark">
                                <i class="fas fa-key me-2"></i>Change Password
                                <small class="text-muted ms-2">(optional)</small>
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                                    <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                        name="current_password" placeholder="••••••••">
                                    @error('current_password')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="password" class="form-label">{{ __('New Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                        name="password" placeholder="••••••••">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="password-confirm" class="form-label">{{ __('Confirm New Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" 
                                        name="password_confirmation" placeholder="••••••••">
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-dark">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-save me-1"></i> {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Base Styles */
    body {
        background-color: #f8f9fa;
        background-image: linear-gradient(to bottom, #ffffff, #f0f0f0);
    }

    /* Gradient Background */
    .bg-gradient-dark {
        background: linear-gradient(135deg, #222222, #444444);
    }

    /* Card Styles */
    .card {
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Form Styles */
    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #555;
        box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 0.5rem;
    }

    /* Button Styles */
    .btn-dark {
        background-color: #333;
        border-color: #333;
        transition: all 0.3s ease;
    }

    .btn-dark:hover {
        background-color: #222;
        border-color: #222;
        transform: translateY(-1px);
    }

    .btn-outline-dark {
        border-color: #333;
        color: #333;
        transition: all 0.3s ease;
    }

    .btn-outline-dark:hover {
        background-color: #333;
        color: white;
    }

    /* Alert Styles */
    .alert {
        border-radius: 0;
    }

    /* Profile Image Styles */
    .img-thumbnail {
        transition: all 0.3s ease;
    }

    .img-thumbnail:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Section Header Styles */
    h5 {
        position: relative;
        padding-bottom: 8px;
    }

    h5 i {
        color: #333;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .form-label {
            font-size: 0.9rem;
        }
    }
</style>
@endsection