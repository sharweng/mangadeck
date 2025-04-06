@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="manga-register-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Manga Panel with Black/White/Gray Theme -->
                <div class="manga-panel">
                    <!-- Panel Header with Manga Styling -->
                    <div class="manga-panel-header">
                        <div class="manga-title-container">
                            <div class="manga-title-line"></div>
                            <h2 class="manga-panel-title">
                                <span class="manga-title-text">JOIN MANGA DECK</span>
                                <span class="manga-title-shadow">JOIN MANGA DECK</span>
                            </h2>
                            <div class="manga-title-line"></div>
                        </div>
                        <p class="manga-panel-subtitle">Begin your manga journey</p>
                    </div>

                    <!-- Panel Body with Manga-style Form -->
                    <div class="manga-panel-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Username Input - Manga Style -->
                            <div class="manga-input-group">
                                <div class="manga-input-decoration"></div>
                                <div class="manga-input-content">
                                    <label for="name" class="manga-input-label">
                                        <i class="fas fa-user manga-input-icon"></i> Username
                                    </label>
                                    <input id="name" type="text" class="manga-form-control @error('name') is-invalid @enderror" 
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                           placeholder="Enter your username">
                                    @error('name')
                                        <span class="manga-error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Input - Manga Style -->
                            <div class="manga-input-group">
                                <div class="manga-input-decoration"></div>
                                <div class="manga-input-content">
                                    <label for="email" class="manga-input-label">
                                        <i class="fas fa-envelope manga-input-icon"></i> Email
                                    </label>
                                    <input id="email" type="email" class="manga-form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email"
                                           placeholder="Enter your email">
                                    @error('email')
                                        <span class="manga-error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Input - Manga Style -->
                            <div class="manga-input-group">
                                <div class="manga-input-decoration"></div>
                                <div class="manga-input-content">
                                    <label for="password" class="manga-input-label">
                                        <i class="fas fa-lock manga-input-icon"></i> Password
                                    </label>
                                    <input id="password" type="password" class="manga-form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="new-password"
                                           placeholder="Create a password">
                                    @error('password')
                                        <span class="manga-error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password - Manga Style -->
                            <div class="manga-input-group">
                                <div class="manga-input-decoration"></div>
                                <div class="manga-input-content">
                                    <label for="password-confirm" class="manga-input-label">
                                        <i class="fas fa-lock manga-input-icon"></i> Confirm Password
                                    </label>
                                    <input id="password-confirm" type="password" class="manga-form-control" 
                                           name="password_confirmation" required autocomplete="new-password"
                                           placeholder="Confirm your password">
                                </div>
                            </div>

                            <!-- Avatar Upload - Manga Style -->
                            <div class="manga-input-group">
                                <div class="manga-input-decoration"></div>
                                <div class="manga-input-content">
                                    <label for="photo" class="manga-input-label">
                                        <i class="fas fa-camera manga-input-icon"></i> Profile Avatar
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
                                        <span class="manga-error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button - Manga Style -->
                            <div class="manga-action-panel">
                                <button type="submit" class="manga-action-button">
                                    <span class="manga-button-text">CREATE ACCOUNT</span>
                                    <span class="manga-button-highlight"></span>
                                </button>
                            </div>

                            <!-- Login Link - Manga Style -->
                            <div class="manga-login-prompt">
                                Already part of Manga Deck? 
                                <a href="{{ route('login') }}" class="manga-login-link">
                                    <span class="manga-link-text">SIGN IN</span>
                                    <span class="manga-link-underline"></span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Base Manga-inspired Styles */
    body {
        background-color: #f8f9fa;
        color: #333;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Main Container with Manga Texture */
    .manga-register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        padding: 2rem 0;
        background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%);
    }

    /* Manga Panel Registration Card */
    .manga-panel {
        background: linear-gradient(145deg, #ffffff 0%, #f5f5f5 100%);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 
            0 4px 30px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(0, 0, 0, 0.05),
            0 0 0 3px #fff,
            0 0 0 4px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
        border: 1px solid #ddd;
    }

    /* Manga Panel Header */
    .manga-panel-header {
        padding: 2rem 2rem 1.5rem;
        text-align: center;
        background: linear-gradient(to bottom, #fff 0%, #f0f0f0 100%);
        border-bottom: 1px solid #e0e0e0;
        position: relative;
    }

    .manga-panel-header::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 10px;
        background: linear-gradient(to bottom, rgba(0,0,0,0.03) 0%, transparent 100%);
    }

    .manga-title-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .manga-title-line {
        flex: 1;
        height: 2px;
        background: linear-gradient(to right, transparent 0%, #999 50%, transparent 100%);
        margin: 0 1rem;
    }

    .manga-panel-title {
        position: relative;
        margin: 0;
        font-weight: 900;
        font-size: 1.8rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #333;
    }

    .manga-title-text {
        position: relative;
        z-index: 2;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .manga-title-shadow {
        position: absolute;
        top: 2px;
        left: 2px;
        color: rgba(0,0,0,0.1);
        z-index: 1;
    }

    .manga-panel-subtitle {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    /* Manga Panel Body */
    .manga-panel-body {
        padding: 2rem;
        background: linear-gradient(to bottom, #fafafa 0%, #f0f0f0 100%);
    }

    /* Manga Input Groups */
    .manga-input-group {
        display: flex;
        margin-bottom: 1.5rem;
        position: relative;
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
    }

    .manga-input-decoration {
        width: 8px;
        background: linear-gradient(to bottom, #999 0%, #666 100%);
        border-radius: 4px 0 0 4px;
        margin-right: 0;
    }

    .manga-input-content {
        flex: 1;
        padding: 1rem;
    }

    .manga-input-label {
        display: block;
        margin-bottom: 0.5rem;
        color: #444;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .manga-input-icon {
        margin-right: 8px;
        color: #777;
    }

    .manga-form-control {
        width: 100%;
        padding: 12px 15px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        color: #333;
        font-size: 1rem;
        transition: all 0.3s;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }

    .manga-form-control:focus {
        background-color: #fff;
        border-color: #999;
        box-shadow: 
            inset 0 1px 3px rgba(0,0,0,0.1),
            0 0 0 2px rgba(0,0,0,0.05);
        outline: none;
    }

    .manga-error-message {
        display: block;
        margin-top: 0.5rem;
        color: #d9534f;
        font-size: 0.85rem;
    }

    .manga-error-message i {
        margin-right: 5px;
    }

    /* Manga File Upload */
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
        border-radius: 4px;
        padding: 1.5rem;
        text-align: center;
        background-color: #fff;
        transition: all 0.3s;
    }

    .manga-file-upload:hover .file-upload-preview {
        border-color: #999;
        background-color: #f9f9f9;
    }

    .upload-icon {
        font-size: 2rem;
        color: #999;
        margin-bottom: 0.5rem;
    }

    .upload-text {
        color: #777;
    }

    .manga-form-text {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.85rem;
        color: #999;
    }

    /* Manga Action Button */
    .manga-action-panel {
        margin: 2rem 0 1.5rem;
        text-align: center;
    }

    .manga-action-button {
        position: relative;
        padding: 12px 30px;
        background: linear-gradient(to bottom, #333 0%, #111 100%);
        border: none;
        border-radius: 4px;
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.3s;
        box-shadow: 
            0 2px 5px rgba(0,0,0,0.2),
            inset 0 1px 1px rgba(255,255,255,0.1);
    }

    .manga-action-button:hover {
        background: linear-gradient(to bottom, #444 0%, #222 100%);
        transform: translateY(-2px);
        box-shadow: 
            0 4px 8px rgba(0,0,0,0.3),
            inset 0 1px 1px rgba(255,255,255,0.1);
    }

    .manga-action-button:active {
        transform: translateY(0);
    }

    .manga-button-text {
        position: relative;
        z-index: 2;
    }

    .manga-button-highlight {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.2) 50%, transparent 100%);
        transition: left 0.6s;
    }

    .manga-action-button:hover .manga-button-highlight {
        left: 100%;
    }

    /* Manga Login Prompt */
    .manga-login-prompt {
        text-align: center;
        color: #777;
        font-size: 0.9rem;
        margin-top: 1.5rem;
    }

    .manga-login-link {
        position: relative;
        color: #333;
        font-weight: 600;
        text-decoration: none;
        margin-left: 5px;
        text-transform: uppercase;
    }

    .manga-link-text {
        position: relative;
        z-index: 2;
    }

    .manga-link-underline {
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 1px;
        background-color: #333;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s;
    }

    .manga-login-link:hover .manga-link-underline {
        transform: scaleX(1);
    }

    .manga-login-link:hover .manga-link-text {
        color: #000;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .manga-panel-header {
            padding: 1.5rem 1.5rem 1rem;
        }
        
        .manga-panel-body {
            padding: 1.5rem;
        }
        
        .manga-panel-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .manga-title-container {
            flex-direction: column;
        }
        
        .manga-title-line {
            width: 50px;
            height: 1px;
            margin: 0.5rem 0;
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
                        <div class="mt-2" style="color: #777;">${fileInput.files[0].name}</div>
                    `;
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Add animation to form elements
        const formGroups = document.querySelectorAll('.manga-input-group');
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