@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <!-- Background Manga Art -->
    <div class="login-bg-overlay"></div>
    <div class="login-bg-image" style="background-image: url('{{ asset('images/manga-login-bg.jpg') }}');"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="manga-login-card">
                    <!-- Card Header with Manga Style -->
                    <div class="login-card-header">
                        <div class="login-title">
                            <i class="fas fa-user-ninja login-icon"></i>
                            <h2>{{ __('Manga Deck Login') }}</h2>
                        </div>
                        <p class="login-subtitle">Enter your credentials to access your collection</p>
                    </div>

                    <div class="login-card-body">
                        <form method="POST" action="{{ route('login') }}">
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
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
    /* Main Container */
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        padding: 2rem 0;
    }

    /* Background Styles */
    .login-bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        z-index: -2;
        opacity: 0.7;
    }

    .login-bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.9) 0%, rgba(22, 33, 62, 0.9) 100%);
        z-index: -1;
    }

    /* Card Styles */
    .manga-login-card {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        transition: transform 0.3s ease;
    }

    .manga-login-card:hover {
        transform: translateY(-5px);
    }

    /* Card Header */
    .login-card-header {
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
        padding: 2rem;
        text-align: center;
        color: white;
        position: relative;
    }

    .login-card-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 20px;
        background: url('{{ asset('images/manga-edge.png') }}') repeat-x;
        background-size: contain;
    }

    .login-title {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
    }

    .login-title h2 {
        margin: 0;
        font-weight: 700;
        font-size: 1.8rem;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    .login-icon {
        font-size: 2rem;
        margin-right: 1rem;
        filter: drop-shadow(1px 1px 2px rgba(0, 0, 0, 0.3));
    }

    .login-subtitle {
        margin: 0;
        opacity: 0.9;
        font-size: 0.9rem;
    }

    /* Card Body */
    .login-card-body {
        padding: 2.5rem;
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
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i:first-child {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #d32f2f;
    }

    .input-with-icon .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        cursor: pointer;
    }

    .input-with-icon .form-control {
        padding-left: 45px;
        padding-right: 45px;
        height: 50px;
        border-radius: 8px;
        border: 2px solid #ddd;
        transition: all 0.3s;
    }

    .input-with-icon .form-control:focus {
        border-color: #d32f2f;
        box-shadow: 0 0 0 0.25rem rgba(211, 47, 47, 0.25);
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
        background-color: #d32f2f;
        border-color: #d32f2f;
    }

    .forgot-password {
        color: #d32f2f;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .forgot-password:hover {
        color: #b71c1c;
        text-decoration: underline;
    }

    /* Login Button */
    .btn-manga-login {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
        border: none;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s;
        margin-top: 1rem;
    }

    .btn-manga-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(211, 47, 47, 0.4);
    }

    /* Register Link */
    .register-link {
        text-align: center;
        margin-top: 2rem;
        color: #666;
    }

    .register-link a {
        color: #d32f2f;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }

    .register-link a:hover {
        color: #b71c1c;
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
</script>
@endsection