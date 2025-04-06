@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Banner with Gradient -->
    <div class="hero-banner position-relative overflow-hidden mb-4 rounded-3 mx-3">
        <div class="banner-overlay"></div>
        <div class="container-fluid px-4 position-relative py-1" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-xl-6">
                    <h1 class="display-5 fw-bold text-white mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">About <span class="text-white-50">Manga</span>Deck</h1>
                    <p class="text-white mb-3" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Our story, passion, and commitment to manga lovers worldwide</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Story Section -->
                <div class="card mb-4 border-0 shadow-sm manga-card">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-4">
                            <img src="{{ asset('images/about-story.jpg') }}" class="img-fluid rounded-start" alt="Our Story">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h2 class="h4 mb-3 section-title">
                                    <span class="section-title-icon"><i class="fas fa-book-open"></i></span>
                                    <span class="section-title-text">Our Story</span>
                                </h2>
                                <p class="card-text text-muted">MangaDeck was founded in 2023 by a group of passionate manga enthusiasts who wanted to create a dedicated platform for manga lovers around the world. What started as a small collection has now grown into one of the most comprehensive manga stores online.</p>
                                <p class="card-text text-muted">Our founders, all lifelong manga fans, saw a need for a specialized store that truly understood the manga community's needs and preferences.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mission Section -->
                <div class="card mb-4 border-0 shadow-sm manga-card">
                    <div class="row g-0 flex-md-row-reverse">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-4">
                            <img src="{{ asset('images/about-mission.jpg') }}" class="img-fluid rounded-start" alt="Our Mission">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h2 class="h4 mb-3 section-title">
                                    <span class="section-title-icon"><i class="fas fa-bullseye"></i></span>
                                    <span class="section-title-text">Our Mission</span>
                                </h2>
                                <p class="card-text text-muted">At MangaDeck, our mission is to connect manga fans with their favorite titles and introduce them to new stories they'll love. We believe in the power of manga to inspire, entertain, and bring people together through shared experiences.</p>
                                <p class="card-text text-muted">We're more than just a store - we're a community hub for manga enthusiasts to discover, discuss, and celebrate their passion.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quality Section -->
                <div class="card mb-4 border-0 shadow-sm manga-card">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-4">
                            <img src="{{ asset('images/about-quality.jpg') }}" class="img-fluid rounded-start" alt="Quality & Authenticity">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h2 class="h4 mb-3 section-title">
                                    <span class="section-title-icon"><i class="fas fa-certificate"></i></span>
                                    <span class="section-title-text">Quality & Authenticity</span>
                                </h2>
                                <p class="card-text text-muted">We take pride in offering only authentic, high-quality manga publications. All our products are sourced directly from publishers or authorized distributors, ensuring you receive genuine items that meet the highest standards.</p>
                                <p class="card-text text-muted">Each manga in our collection is carefully selected and inspected to guarantee perfect condition when it reaches your hands.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Experience Section -->
                <div class="card mb-4 border-0 shadow-sm manga-card">
                    <div class="row g-0 flex-md-row-reverse">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-4">
                            <img src="{{ asset('images/about-customer.jpg') }}" class="img-fluid rounded-start" alt="Customer Experience">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h2 class="h4 mb-3 section-title">
                                    <span class="section-title-icon"><i class="fas fa-heart"></i></span>
                                    <span class="section-title-text">Customer Experience</span>
                                </h2>
                                <p class="card-text text-muted">We're committed to providing an exceptional shopping experience. From our user-friendly website to our responsive customer service team, we strive to make your journey with us as enjoyable as reading your favorite manga.</p>
                                <p class="card-text text-muted">Our team consists of fellow manga fans who understand exactly what you're looking for and are always happy to help.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Section -->
                <div class="text-center mb-5">
                    <h2 class="h4 mb-4 section-title">
                        <span class="section-title-icon"><i class="fas fa-users"></i></span>
                        <span class="section-title-text">Meet The Developers</span>
                    </h2>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <img src="{{ asset('images/team-1.jpg') }}" class="rounded-circle mb-3" alt="Team Member" width="120" height="120">
                                    <h5 class="mb-1"></h5>
                                    <p class="text-muted small"></p>
                                    <div class="team-social">
                                        <a href="#" class="text-muted mx-1"><i class="fab fa-twitter"></i></a>
                                        <a href="#" class="text-muted mx-1"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <img src="{{ asset('images/team-2.jpg') }}" class="rounded-circle mb-3" alt="Team Member" width="120" height="120">
                                    <h5 class="mb-1">Sharwin John Marbella</h5>
                                    <p class="text-muted small">Developer</p>
                                    <div class="team-social">
                                        <a href="#" class="text-muted mx-1"><i class="fab fa-twitter"></i></a>
                                        <a href="#" class="text-muted mx-1"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <img src="{{ asset('images/team-3.jpg') }}" class="rounded-circle mb-3" alt="Team Member" width="120" height="120">
                                    <h5 class="mb-1">Krsmur Chelvin Lacorte</h5>
                                    <p class="text-muted small">Developer</p>
                                    <div class="team-social">
                                        <a href="#" class="text-muted mx-1"><i class="fab fa-twitter"></i></a>
                                        <a href="#" class="text-muted mx-1"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <img src="{{ asset('images/team-4.jpg') }}" class="rounded-circle mb-3" alt="Team Member" width="120" height="120">
                                    <h5 class="mb-1"></h5>
                                    <p class="text-muted small"></p>
                                    <div class="team-social">
                                        <a href="#" class="text-muted mx-1"><i class="fab fa-twitter"></i></a>
                                        <a href="#" class="text-muted mx-1"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="text-center mt-4">
                    <h3 class="mb-4">Ready to Explore Our Manga Collection?</h3>
                    <a href="{{ route('items.index') }}" class="btn btn-dark btn-lg px-5 py-3 fw-bold">
                        <i class="fas fa-book-open me-2"></i> Browse All Manga
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Hero Banner Styles */
    .hero-banner {
        background: linear-gradient(135deg, 
                    rgba(0,0,0,1) 0%, 
                    rgba(30,30,30,1) 50%, 
                    rgba(60,60,60,1) 100%), 
                    url('{{ asset("images/about-banner.jpg") }}');
        background-size: cover;
        background-position: center;
        background-blend-mode: overlay;
        padding: 2rem 0;
        border-bottom: 1px solid #444;
    }

    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            to right,
            rgba(0,0,0,0.7) 0%,
            rgba(255,255,255,0.1) 50%,
            rgba(0,0,0,0.7) 100%
        );
        z-index: 1;
        border-radius: inherit;
    }

    /* Manga Card Styles */
    .manga-card {
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff;
    }

    .manga-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15) !important;
    }

    /* Section Titles */
    .section-title {
        position: relative;
        padding-bottom: 8px;
        color: #333;
    }

    .section-title:after {
        content: '';
        position: absolute;
        left: 30px;
        bottom: 0;
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, #333 0%, #ddd 100%);
        border-radius: 2px;
    }

    .section-title-icon {
        color: #333;
        margin-right: 8px;
    }

    /* Team Member Styles */
    .team-social {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card:hover .team-social {
        opacity: 1;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-banner {
            padding: 1.5rem 0;
            text-align: center;
        }

        .manga-card .col-md-4 {
            padding: 1.5rem !important;
        }

        .manga-card img {
            max-height: 200px;
        }
    }
</style>
@endsection
