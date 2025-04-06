<footer class="bg-dark text-white py-3 mt-5 manga-footer">
    <div class="container">
        <div class="row g-4">
            <!-- Brand Column -->
            <div class="col-md-4">
                <div class="d-flex align-items-center mb-2">
                    <h5 class="mb-0 manga-footer-brand">{{ config('app.name', 'MangaDeck') }}</h5>
                    <span class="badge bg-danger ms-2">NEW</span>
                </div>
                <p class="small text-muted">Your ultimate destination for authentic Japanese manga collections.</p>
                <div class="social-icons mt-2">
                    <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-discord"></i></a>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div class="col-md-4">
                <h5 class="footer-heading mb-3">Quick Links</h5>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-white d-flex align-items-center">
                            <i class="fas fa-chevron-right me-2 small"></i> Home
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('items.index') }}" class="text-white d-flex align-items-center">
                            <i class="fas fa-chevron-right me-2 small"></i> Manga Collection
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('about') }}" class="text-white d-flex align-items-center">
                            <i class="fas fa-chevron-right me-2 small"></i> About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-white d-flex align-items-center">
                            <i class="fas fa-chevron-right me-2 small"></i> Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="col-md-4">
                <h5 class="footer-heading mb-3">Get In Touch</h5>
                <ul class="list-unstyled contact-info">
                    <li class="mb-2 d-flex align-items-start">
                        <i class="fas fa-map-marker-alt mt-1 me-2 text-danger"></i>
                        <span>123 Otaku Lane<br>Manga City, MC 10101</span>
                    </li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fas fa-phone me-2 text-danger"></i>
                        <span>(123) 456-7890</span>
                    </li>
                    <li class="d-flex align-items-center">
                        <i class="fas fa-envelope me-2 text-danger"></i>
                        <a href="mailto:info@mangadeck.com" class="text-white">info@mangadeck.com</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-4 pt-3 border-top border-secondary">
            <p class="small text-muted mb-0">
                &copy; {{ date('Y') }} {{ config('app.name', 'MangaDeck') }}. All rights reserved.
                <span class="d-block d-sm-inline-block mt-1 mt-sm-0">
                    <a href="#" class="text-muted ms-sm-3 small">Terms</a>
                    <a href="#" class="text-muted ms-3 small">Privacy</a>
                </span>
            </p>
        </div>
    </div>
</footer>

<style>
    .manga-footer {
        background: linear-gradient(135deg, #1a1a2e 0%, #0f0f1a 100%);
        border-top: 3px solid #d32f2f;
        font-size: 0.9rem;
    }
    
    .manga-footer-brand {
        font-family: 'Arial', sans-serif;
        font-weight: 700;
        letter-spacing: 1px;
        color: #fff;
        position: relative;
        display: inline-block;
    }
    
    .manga-footer-brand:after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: #d32f2f;
    }
    
    .footer-heading {
        font-size: 1.1rem;
        position: relative;
        padding-bottom: 8px;
        color: #fff;
    }
    
    .footer-heading:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30px;
        height: 2px;
        background-color: #d32f2f;
    }
    
    .footer-links a {
        transition: all 0.3s ease;
        color: #adb5bd !important;
    }
    
    .footer-links a:hover {
        color: #fff !important;
        transform: translateX(3px);
        text-decoration: none;
    }
    
    .footer-links i {
        transition: all 0.3s ease;
    }
    
    .footer-links a:hover i {
        color: #d32f2f !important;
    }
    
    .contact-info i {
        width: 20px;
        text-align: center;
    }
    
    .social-icons a {
        display: inline-block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        margin-right: 8px;
        transition: all 0.3s ease;
    }
    
    .social-icons a:hover {
        background: #d32f2f;
        transform: translateY(-3px);
    }
    
    .text-muted {
        color: #6c757d !important;
    }
</style>