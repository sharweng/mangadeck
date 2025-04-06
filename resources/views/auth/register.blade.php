@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="register-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="manga-register-card">
                    <div class="manga-register-header">
                        <h2><i class="fas fa-user-ninja me-2"></i> Join MangaDeck</h2>
                        <p>Become part of our anime community</p>
                    </div>

                    <div class="manga-register-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="manga-form-group">
                                <div class="manga-input-group">
                                    <label for="name" class="manga-input-label">
                                        <i class="fas fa-user-circle"></i> Username
                                    </label>
                                    <input id="name" type="text" class="manga-form-control @error('name') is-invalid @enderror" 
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                           placeholder="Enter your username">
                                    @error('name')
                                        <span class="manga-invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="manga-form-group">
                                <div class="manga-input-group">
                                    <label for="email" class="manga-input-label">
                                        <i class="fas fa-envelope"></i> Email Address
                                    </label>
                                    <input id="email" type="email" class="manga-form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email"
                                           placeholder="Enter your email">
                                    @error('email')
                                        <span class="manga-invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="manga-form-group">
                                <div class="manga-input-group">
                                    <label for="password" class="manga-input-label">
                                        <i class="fas fa-lock"></i> Password
                                    </label>
                                    <input id="password" type="password" class="manga-form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="new-password"
                                           placeholder="Create a password">
                                    @error('password')
                                        <span class="manga-invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="manga-form-group">
                                <div class="manga-input-group">
                                    <label for="password-confirm" class="manga-input-label">
                                        <i class="fas fa-lock"></i> Confirm Password
                                    </label>
                                    <input id="password-confirm" type="password" class="manga-form-control" 
                                           name="password_confirmation" required autocomplete="new-password"
                                           placeholder="Confirm your password">
                                </div>
                            </div>

                            <div class="manga-form-group">
                                <div class="manga-input-group">
                                    <label for="photo" class="manga-input-label">
                                        <i class="fas fa-camera"></i> Profile Avatar
                                    </label>
                                    <div class="manga-file-upload">
                                        <input id="photo" type="file" class="manga-form-control @error('photo') is-invalid @enderror" 
                                               name="photo" required>
                                        <div class="file-upload-preview">
                                            <div class="upload-icon">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <div class="upload-text">Choose an avatar image</div>
                                        </div>
                                    </div>
                                    <small class="manga-form-text">Recommended: 200x200px square image</small>
                                    @error('photo')
                                        <span class="manga-invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="manga-form-group mb-0">
                                <button type="submit" class="manga-register-btn">
                                    <i class="fas fa-user-plus me-2"></i> Create Account
                                </button>
                            </div>

                            <div class="manga-register-footer">
                                Already have an account? 
                                <a href="{{ route('login') }}" class="manga-login-link">
                                    <i class="fas fa-sign-in-alt"></i> Sign In
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    /* Main Container */
    .register-container {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('{{ asset("images/manga-register-bg.jpg") }}');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    /* Registration Card */
    .manga-register-card {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border-top: 5px solid #d32f2f;
    }

    /* Header Section */
    .manga-register-header {
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .manga-register-header h2 {
        font-weight: 700;
        margin-bottom: 0.5rem;
        font-size: 2rem;
    }

    .manga-register-header p {
        margin-bottom: 0;
        opacity: 0.9;
    }

    /* Body Section */
    .manga-register-body {
        padding: 2rem;
    }

    /* Form Elements */
    .manga-form-group {
        margin-bottom: 1.5rem;
    }

    .manga-input-group {
        position: relative;
    }

    .manga-input-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #333;
    }

    .manga-input-label i {
        margin-right: 8px;
        color: #d32f2f;
    }

    .manga-form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .manga-form-control:focus {
        border-color: #d32f2f;
        box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.2);
        background-color: white;
    }

    /* File Upload Styling */
    .manga-file-upload {
        position: relative;
    }

    .manga-file-upload input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .file-upload-preview {
        border: 2px dashed #ddd;
        border-radius: 6px;
        padding: 2rem;
        text-align: center;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    .manga-file-upload:hover .file-upload-preview {
        border-color: #d32f2f;
        background-color: rgba(211, 47, 47, 0.05);
    }

    .upload-icon {
        font-size: 2rem;
        color: #d32f2f;
        margin-bottom: 0.5rem;
    }

    .upload-text {
        color: #666;
    }

    /* Form Text */
    .manga-form-text {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.85rem;
        color: #666;
    }

    /* Invalid Feedback */
    .manga-invalid-feedback {
        display: block;
        margin-top: 0.5rem;
        color: #dc3545;
        font-size: 0.85rem;
    }

    .manga-invalid-feedback i {
        margin-right: 5px;
    }

    /* Register Button */
    .manga-register-btn {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
        border: none;
        border-radius: 6px;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .manga-register-btn:hover {
        background: linear-gradient(135deg, #b71c1c 0%, #8c0e0e 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    /* Footer Link */
    .manga-register-footer {
        text-align: center;
        margin-top: 1.5rem;
        color: #666;
    }

    .manga-login-link {
        color: #d32f2f;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .manga-login-link:hover {
        color: #b71c1c;
        text-decoration: underline;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .manga-register-card {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        
        .manga-register-header {
            padding: 1.5rem;
        }
        
        .manga-register-body {
            padding: 1.5rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File upload preview functionality
        const fileInput = document.getElementById('photo');
        const filePreview = document.querySelector('.file-upload-preview');
        
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    filePreview.innerHTML = `
                        <img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                        <div class="mt-2">${fileInput.files[0].name}</div>
                    `;
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Add animation to form elements
        const formGroups = document.querySelectorAll('.manga-form-group');
        formGroups.forEach((group, index) => {
            group.style.opacity = '0';
            group.style.transform = 'translateY(20px)';
            group.style.transition = 'all 0.5s ease ' + (index * 0.1) + 's';
            
            setTimeout(() => {
                group.style.opacity = '1';
                group.style.transform = 'translateY(0)';
            }, 100);
        });
    });
</script>
@endsection 