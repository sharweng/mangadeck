<footer class="bg-dark text-white-90 py-2 mt-4 manga-footer">
    <div class="container">
        <div class="row g-3">
            <!-- Brand Column -->
            <div class="col-md-4">
                <div class="d-flex align-items-center mb-1">
                    <h5 class="mb-0 manga-footer-brand fs-6">{{ config('app.name', 'MangaDeck') }}</h5>
                    <span class="badge bg-white-700 ms-2 fs-3">MANGADECK</span>
                </div>
                <p  class="text-white">Your ultimate destination for authentic Japanese manga collections.</p>
                <div class="social-icons mt-2">
                    <a href="#" class="text-white me-1"><i class="fab fa-twitter fa-sm"></i></a>
                    <a href="#" class="text-white me-1"><i class="fab fa-facebook fa-sm"></i></a>
                    <a href="#" class="text-white me-1"><i class="fab fa-instagram fa-sm"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-discord fa-sm"></i></a>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div class="col-md-4">
                <h5 class="footer-heading mb-1 fs-6">Quick Links</h5>
                <ul class="list-unstyled footer-links mb-0">
                    <li>
                        <a href="{{ route('home') }}" class="text-white d-flex align-items-center py-1">
                            <i class="fas fa-chevron-right me-1 small"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('items.index') }}" class="text-white d-flex align-items-center py-1">
                            <i class="fas fa-chevron-right me-1 small"></i> Manga Collection
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-white d-flex align-items-center py-1">
                            <i class="fas fa-chevron-right me-1 small"></i> About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-white d-flex align-items-center py-1">
                            <i class="fas fa-chevron-right me-1 small"></i> Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="col-md-4">
                <h5 class="footer-heading mb-1 fs-6">Get In Touch</h5>
                <ul class="list-unstyled contact-info mb-0">
                    <li class="d-flex align-items-start py-1">
                        <i class="fas fa-map-marker-alt mt-1 me-1 text-white-300"></i>
                        <span class="text-white">123 Otaku Lane<br>Manga City, MC 10101</span>
                    </li>
                    <li class="d-flex align-items-center py-1">
                        <i class="fas fa-phone me-1 text-white-300"></i>
                        <span class="text-white">(123) 456-7890</span>
                    </li>
                    <li class="d-flex align-items-center py-1">
                        <i class="fas fa-envelope me-1 text-white-300"></i>
                        <a href="mailto:info@mangadeck.com" class="text-white">info@mangadeck.com</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-3 pt-2 border-top border-gray-700">
            <p class="text-white">
                &copy; {{ date(format: 'Y') }} {{ config('app.name', 'MangaDeck' ) }}. All rights reserved.
                <a href="#" class="text-white">Terms</a>
                <a href="#" class="text-white">Privacy</a>
            </p>
        </div>
    </div>
</footer>

<style>
    .manga-footer {
        background: linear-gradient(135deg, #000000 0%, #222222 100%);
        border-top: 1px solid #444;
        font-size: 0.7rem;
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
        bottom: -3px;
        left: 0;
        width: 30px;
        height: 1px;
        background: linear-gradient(90deg, #fff 0%, #aaa 100%);
    }
    
    .footer-heading {
        position: relative;
        padding-bottom: 5px;
        color: #fff;
    }
    
    .footer-heading:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 25px;
        height: 1px;
        background: linear-gradient(90deg, #fff 0%, #aaa 100%);
    }
    
    .footer-links a {
        transition: all 0.2s ease;
        color: #aaa !important;
    }
    
    .footer-links a:hover {
        color: #fff !important;
        transform: translateX(2px);
    }
    
    .footer-links i {
        transition: all 0.2s ease;
        color: #777;
    }
    
    .social-icons a {
        display: inline-block;
        width: 26px;
        height: 26px;
        line-height: 26px;
        text-align: center;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
        margin-right: 6px;
        transition: all 0.2s ease;
    }
    
    .social-icons a:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-2px);
    }
    
    .fs-6 {
        font-size: 0.8rem !important;
    }
    
    .py-1 {
        padding-top: 0.25rem !important;
        padding-bottom: 0.25rem !important;
    }
</style>