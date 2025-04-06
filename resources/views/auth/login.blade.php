@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <!-- Manga-style background with ink wash effect -->
    <div class="manga-bg-overlay"></div>
    <div class="manga-bg-texture"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="manga-login-card">
                    <!-- Card Header with manga panel style -->
                    <div class="login-card-header">
                        <div class="manga-panel-effect"></div>
                        <div class="login-title">
                            <i class="fas fa-user-ninja login-icon"></i>
                            <h2>{{ __('Manga Deck Login') }}</h2>
                        </div>
                        <p class="login-subtitle">Enter your credentials to access your collection</p>
                    </div>

                    <div class="login-card-body">
                        <!-- Status Messages -->
                        @if (session('status'))
                            <div class="manga-alert manga-alert-success">
                                <i class="fas fa-check-circle"></i> {{ session('status') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="manga-alert manga-alert-danger">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            </div>
                        @endif

                        @if (session('info'))
                            <div class="manga-alert manga-alert-info">
                                <i class="fas fa-info-circle"></i> {{ session('info') }}
                            </div>
                        @endif

                        <!-- Verification Error Alert -->
                        @error('email')
                            @if(str_contains($message, 'verify your email'))
                                <div class="manga-verification-alert">
                                    <div class="verification-message">
                                        <i class="fas fa-envelope"></i>
                                        <p>{{ $message }}</p>
                                    </div>
                                    <div class="verification-action">
                                        <form method="POST" action="{{ route('verification.resend.guest') }}" id="resendVerificationForm">
                                            @csrf
                                            <input type="hidden" name="email" id="verification_email" value="{{ old('email') }}">
                                            <button type="submit" class="btn-manga-verify">
                                                <i class="fas fa-paper-plane"></i> Send Verification Link
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @endif
                        @enderror

                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <!-- Email Input -->
                            <div class="manga-form-group">
                                <label for="email">{{ __('Email Address') }}</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-envelope"></i>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                           placeholder="your@email.com">
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="manga-form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-lock"></i>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="current-password"
                                           placeholder="••••••••">
                                    <i class="fas fa-eye password-toggle" onclick="togglePasswordVisibility()"></i>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="login-options">
                                <div class="form-check remember-me">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                
                                @if (Route::has('password.request'))
                                    <a class="forgot-password" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="login-button-group">
                                <button type="submit" class="btn btn-manga-login">
                                    <i class="fas fa-sign-in-alt me-2"></i>{{ __('Login') }}
                                </button>
                            </div>

                            <!-- Register Link -->
                            <div class="register-link">
                                Don't have an account? 
                                <a href="{{ route('register') }}">Join Manga Deck</a>
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
    /* Main Container with manga-style background */
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        padding: 2rem 0;
        background-color: #f0f0f0;
    }

    /* Manga-style background elements */
    .manga-bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0,0,0,0.9) 0%, rgba(50,50,50,0.7) 100%);
        z-index: -1;
    }

    .manga-bg-texture {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none" stroke="black" stroke-width="0.5" stroke-dasharray="2,2" opacity="0.1"/></svg>');
        background-size: 100px 100px;
        z-index: -2;
        opacity: 0.3;
    }

    /* Manga panel style card */
    .manga-login-card {
        background: linear-gradient(to bottom, #ffffff 0%, #f5f5f5 100%);
        border-radius: 4px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        position: relative;
    }

    .manga-login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    }

    /* Card Header with manga panel effect */
    .login-card-header {
        background: linear-gradient(135deg, #222 0%, #444 100%);
        padding: 2rem;
        text-align: center;
        color: white;
        position: relative;
        border-bottom: 3px solid #000;
    }

    .manga-panel-effect {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
        z-index: 0;
    }

    .login-title {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .login-title h2 {
        margin: 0;
        font-weight: 700;
        font-size: 1.8rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        letter-spacing: 1px;
    }

    .login-icon {
        font-size: 2rem;
        margin-right: 1rem;
        filter: drop-shadow(2px 2px 3px rgba(0, 0, 0, 0.5));
    }

    .login-subtitle {
        margin: 0;
        opacity: 0.8;
        font-size: 0.9rem;
        position: relative;
        z-index: 1;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    /* Card Body */
    .login-card-body {
        padding: 2.5rem;
        background-color: #fff;
    }

    /* Manga Alert */
    .manga-alert {
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
        display: flex;
        align-items: flex-start;
    }

    .manga-alert i {
        margin-right: 0.75rem;
        font-size: 1.1rem;
        margin-top: 0.1rem;
    }

    .manga-alert-success {
        background-color: #e8f5e9;
        color: #2e7d32;
        border-left: 4px solid #4caf50;
    }

    .manga-alert-danger {
        background-color: #ffebee;
        color: #c62828;
        border-left: 4px solid #f44336;
    }

    .manga-alert-info {
        background-color: #e3f2fd;
        color: #1565c0;
        border-left: 4px solid #2196f3;
    }

    /* Verification Alert */
    .manga-verification-alert {
        background-color: #fff8e1;
        border-left: 4px solid #ffc107;
        border-radius: 4px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .verification-message {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .verification-message i {
        color: #ff9800;
        font-size: 1.2rem;
        margin-right: 0.75rem;
        margin-top: 0.2rem;
    }

    .verification-message p {
        margin: 0;
        color: #5d4037;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .verification-action {
        text-align: center;
    }

    .btn-manga-verify {
        background: linear-gradient(to bottom, #ff9800 0%, #f57c00 100%);
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-manga-verify:hover {
        background: linear-gradient(to bottom, #f57c00 0%, #ef6c00 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .btn-manga-verify i {
        margin-right: 0.5rem;
    }

    /* Form Styles */
    .manga-form-group {
        margin-bottom: 1.5rem;
    }

    .manga-form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #333;
        letter-spacing: 0.5px;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i:first-child {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #444;
    }

    .input-with-icon .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        cursor: pointer;
        transition: color 0.3s;
    }

    .input-with-icon .password-toggle:hover {
        color: #000;
    }

    .input-with-icon .form-control {
        padding-left: 45px;
        padding-right: 45px;
        height: 50px;
        border-radius: 4px;
        border: 2px solid #ddd;
        transition: all 0.3s;
        background-color: #f9f9f9;
    }

    .input-with-icon .form-control:focus {
        border-color: #666;
        box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    /* Login Options */
    .login-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1.5rem 0;
    }

    .remember-me {
        display: flex;
        align-items: center;
    }

    .remember-me .form-check-input {
        margin-right: 0.5rem;
        border: 2px solid #666;
    }

    .remember-me .form-check-input:checked {
        background-color: #333;
        border-color: #333;
    }

    .forgot-password {
        color: #444;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .forgot-password:hover {
        color: #000;
        text-decoration: underline;
    }

    /* Login Button */
    .btn-manga-login {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #333 0%, #000 100%);
        border: none;
        border-radius: 4px;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s;
        margin-top: 1rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-manga-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #000 0%, #333 100%);
    }

    /* Register Link */
    .register-link {
        text-align: center;
        margin-top: 2rem;
        color: #666;
    }

    .register-link a {
        color: #333;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }

    .register-link a:hover {
        color: #000;
        text-decoration: underline;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .login-card-header {
            padding: 1.5rem;
        }
        
        .login-card-body {
            padding: 1.5rem;
        }
        
        .login-title h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .login-container {
            padding: 1rem;
        }
        
        .login-card-header {
            padding: 1.2rem;
        }
        
        .login-card-body {
            padding: 1.2rem;
        }
        
        .login-title {
            flex-direction: column;
        }
        
        .login-icon {
            margin-right: 0;
            margin-bottom: 0.5rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.password-toggle');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Update the hidden email field for verification when the email input changes
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email');
        const verificationEmail = document.getElementById('verification_email');
        
        if (emailInput && verificationEmail) {
            emailInput.addEventListener('input', function() {
                verificationEmail.value = this.value;
            });
        }
    });
</script>
@endsection

