<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-lg manga-navbar">
    <div class="container">
        <!-- Brand Logo with Manga Style -->
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <span class="manga-logo">
                <span class="manga-logo-text">Manga</span>
                <span class="manga-logo-accent">Deck</span>
            </span>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Navigation -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>{{ __('Home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}" href="{{ route('items.index') }}">
                        <i class="fas fa-book-open me-1"></i>{{ __('Manga Collection') }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('genres.*') ? 'active' : '' }}" 
                       href="#" id="navbarGenresDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-tags me-1"></i>{{ __('Genres') }}
                    </a>
                    <ul class="dropdown-menu manga-dropdown" aria-labelledby="navbarGenresDropdown">
                        @foreach($genres ?? [] as $genre)
                            <li>
                                <a class="dropdown-item" href="{{ route('genres.show', $genre) }}">
                                    <i class="fas fa-{{ $genre->icon ?? 'book' }} me-2"></i>{{ $genre->name }}
                                </a>
                            </li>
                            @if($loop->iteration % 5 == 0 && !$loop->last)
                                <li><hr class="dropdown-divider"></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <i class="fas fa-info-circle me-1"></i>{{ __('About') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <i class="fas fa-envelope me-1"></i>{{ __('Contact') }}
                    </a>
                </li>
            </ul>

            <!-- Right Side Navigation -->
            <ul class="navbar-nav ms-auto">
                <!-- Search Button (Triggers Modal) -->
                <li class="nav-item d-flex align-items-center me-2">
                    <button class="btn btn-outline-light btn-sm manga-search-btn" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search"></i>
                    </button>
                </li>
                
                <!-- Cart Link -->
                <li class="nav-item">
                    <a class="nav-link position-relative manga-cart-link" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="ms-1 d-none d-md-inline">Cart</span>
                        @php
                            $cartCount = session()->has('cart') ? count(session('cart')) : 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount }}
                                <span class="visually-hidden">items in cart</span>
                            </span>
                        @endif
                    </a>
                </li>

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link manga-auth-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>{{ __('Login') }}
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link manga-auth-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>{{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle manga-user-menu" href="#" role="button" 
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end manga-dropdown" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->isAdmin() || Auth::user()->isStaff())
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>{{ __('Admin Dashboard') }}
                                </a>
                                <div class="dropdown-divider"></div>
                            @endif
                            
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-cog me-2"></i>{{ __('Profile') }}
                            </a>
                            
                            <a class="dropdown-item" href="{{ route('orders.index') }}">
                                <i class="fas fa-receipt me-2"></i>{{ __('My Orders') }}
                            </a>
                            
                            <div class="dropdown-divider"></div>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content manga-search-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="searchModalLabel">
                    <i class="fas fa-search me-2"></i>Search Manga
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('items.index') }}" method="GET">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control manga-search-input" name="search" 
                               placeholder="Search titles, authors, or genres..." autocomplete="off">
                        <button class="btn btn-danger" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    /* Navbar Container */
    .manga-navbar {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%) !important;
        border-bottom: 3px solid #d32f2f !important;
    }
    
    /* Brand Logo */
    .manga-logo {
        font-size: 1.5rem;
        letter-spacing: 1px;
        position: relative;
    }
    
    .manga-logo-text {
        color: white;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    
    .manga-logo-accent {
        color: #d32f2f;
        font-weight: 800;
    }
    
    /* Nav Links */
    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.85);
        font-weight: 500;
        padding: 0.5rem 1rem;
        margin: 0 0.1rem;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: white;
        background-color: rgba(211, 47, 47, 0.2);
    }
    
    .navbar-nav .nav-link.active {
        font-weight: 600;
        border-bottom: 2px solid #d32f2f;
    }
    
    /* Dropdown Menu */
    .manga-dropdown {
        background-color: #1a1a2e;
        border: 1px solid #d32f2f;
    }
    
    .manga-dropdown .dropdown-item {
        color: rgba(255, 255, 255, 0.85);
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }
    
    .manga-dropdown .dropdown-item:hover {
        background-color: #d32f2f;
        color: white;
    }
    
    .dropdown-divider {
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    /* Cart Link */
    .manga-cart-link {
        position: relative;
        padding-right: 1.5rem !important;
    }
    
    /* Search Button */
    .manga-search-btn {
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .manga-search-btn:hover {
        background-color: #d32f2f;
        transform: scale(1.1);
    }
    
    /* User Menu */
    .manga-user-menu {
        display: flex;
        align-items: center;
    }
    
    /* Search Modal */
    .manga-search-modal {
        background-color: #1a1a2e;
        color: white;
        border: 1px solid #d32f2f;
    }
    
    .manga-search-input {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
    }
    
    .manga-search-input:focus {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border-color: #d32f2f;
        box-shadow: 0 0 0 0.25rem rgba(211, 47, 47, 0.25);
    }
    
    /* Mobile Menu Toggle */
    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.85%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .navbar-nav {
            padding-top: 1rem;
        }
        
        .nav-item {
            margin-bottom: 0.5rem;
        }
        
        .manga-dropdown {
            background-color: transparent;
            border: none;
        }
        
        .manga-dropdown .dropdown-item {
            padding-left: 2rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Auto-focus search input when modal opens
        const searchModal = document.getElementById('searchModal');
        if (searchModal) {
            searchModal.addEventListener('shown.bs.modal', function () {
                const searchInput = this.querySelector('.manga-search-input');
                if (searchInput) {
                    searchInput.focus();
                }
            });
        }
    });
</script>
@endsection