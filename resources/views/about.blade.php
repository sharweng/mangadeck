@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Banner -->
    <div class="about-hero-banner position-relative overflow-hidden">
        <div class="banner-overlay"></div>
        <div class="container position-relative py-5" style="z-index: 2;">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-3 fw-bold text-white mb-4">About <span class="text-danger">Manga</span>Deck</h1>
                    <p class="lead text-white mb-0">Our story, passion, and commitment to manga lovers worldwide</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Story Section -->
                <div class="card mb-5 border-0 shadow-sm manga-about-card">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-4 manga-about-image">
                            <img src="{{ asset('images/about-story.jpg') }}" class="img-fluid rounded-start" alt="Our Story">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4 p-lg-5">
                                <h2 class="h3 mb-4 manga-section-title">
                                    <span class="title-icon"><i class="fas fa-book-open text-danger"></i></span>
                                    <span>Our Story</span>
                                </h2>
                                <p class="card-text">MangaDeck was founded in 2023 by a group of passionate manga enthusiasts who wanted to create a dedicated platform for manga lovers around the world. What started as a small collection has now grown into one of the most comprehensive manga stores online.</p>
                                <p class="card-text">Our founders, all lifelong manga fans, saw a need for a specialized store that truly understood the manga community's needs and preferences.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mission Section -->
                <div class="card mb-5 border-0 shadow-sm manga-about-card">
                    <div class="row g-0 flex-md-row-reverse">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-4 manga-about-image">
                            <img src="{{ asset('images/about-mission.jpg') }}" class="img-fluid rounded-start" alt="Our Mission">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4 p-lg-5">
                                <h2 class="h3 mb-4 manga-section-title">
                                    <span class="title-icon"><i class="fas fa-bullseye text-danger"></i></span>
                                    <span>Our Mission</span>
                                </h2>
                                <p class="card-text">At MangaDeck, our mission is to connect manga fans with their favorite titles and introduce them to new stories they'll love. We believe in the power of manga to inspire, entertain, and bring people together through shared experiences.</p>
                                <p class="card-text">We're more than just a store - we're a community hub for manga enthusiasts to discover, discuss, and celebrate their passion.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quality Section -->
                <div class="card mb-5 border-0 shadow-sm manga-about-card">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-4 manga-about-image">
                            <img src="{{ asset('images/about-quality.jpg') }}" class="img-fluid rounded-start" alt="Quality & Authenticity">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4 p-lg-5">
                                <h2 class="h3 mb-4 manga-section-title">
                                    <span class="title-icon"><i class="fas fa-certificate text-danger"></i></span>
                                    <span>Quality & Authenticity</span>
                                </h2>
                                <p class="card-text">We take pride in offering only authentic, high-quality manga publications. All our products are sourced directly from publishers or authorized distributors, ensuring you receive genuine items that meet the highest standards.</p>
                                <p class="card-text">Each manga in our collection is carefully selected and inspected to guarantee perfect condition when it reaches your hands.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Experience Section -->
                <div class="card mb-5 border-0 shadow-sm manga-about-card">
                    <div class="row g-0 flex-md-row-reverse">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-4 manga-about-image">
                            <img src="{{ asset('images/about-customer.jpg') }}" class="img-fluid rounded-start" alt="Customer Experience">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4 p-lg-5">
                                <h2 class="h3 mb-4 manga-section-title">
                                    <span class="title-icon"><i class="fas fa-heart text-danger"></i></span>
                                    <span>Customer Experience</span>
                                </h2>
                                <p class="card-text">We're committed to providing an exceptional shopping experience. From our user-friendly website to our responsive customer service team, we strive to make your journey with us as enjoyable as reading your favorite manga.</p>
                                <p class="card-text">Our team consists of fellow manga fans who understand exactly what you're looking for and are always happy to help.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Section -->
                <div class="text-center mb-5">
                    <h2 class="h3 mb-4 manga-section-title-center">
                        <span class="title-icon"><i class="fas fa-users text-danger"></i></span>
                        <span>Meet The Developers</span>
                    </h2>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                        <div class="col">
                            <div class="team-member-card">
                                <img src="{{ asset('images/team-1.jpg') }}" class="rounded-circle mb-3" alt="Team Member" width="120" height="120">
                                <h5 class="mb-1"></h5>
                                <p class="text-muted small">    </p>
                                <div class="team-social">
                                    <a href="#" class="text-muted mx-1"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-muted mx-1"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="team-member-card">
                                <img src="{{ asset('images/team-2.jpg') }}" class="rounded-circle mb-3" alt="Team Member" width="120" height="120">
                                <h5 class="mb-1">Sharwin John Marbella</h5>
                                <p class="text-muted small">Developer</p>
                                <div class="team-social">
                                    <a href="#" class="text-muted mx-1"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-muted mx-1"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="team-member-card">
                                <img src="{{ asset('images/team-3.jpg') }}" class="rounded-circle mb-3" alt="Team Member" width="120" height="120">
                                <h5 class="mb-1">Krsmur Chelvin Lacorte</h5>
                                <p class="text-muted small">Developer</p>
                                <div class="team-social">
                                    <a href="#" class="text-muted mx-1"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-muted mx-1"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="team-member-card">
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

                <!-- Call to Action -->
                <div class="text-center mt-5">
                    <h3 class="mb-4">Ready to Explore Our Manga Collection?</h3>
                    <a href="{{ route('items.index') }}" class="btn btn-danger btn-lg px-5 py-3 fw-bold">
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
    .about-hero-banner {
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.9) 0%, rgba(22, 33, 62, 0.9) 100%), 
                    url('{{ asset("images/about-banner.jpg") }}');
        background-size: cover;
        background-position: center;
        background-blend-mode: overlay;
        padding: 6rem 0;
        border-bottom: 4px solid #d32f2f;
    }
    
    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1;
    }
    
    /* About Card Styles */
    .manga-about-card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease;
        background-color: #ffffff;
    }
    
    .manga-about-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
    }
    
    .manga-about-image {
        background-color: #f8f9fa;
    }
    
    .manga-about-image img {
        max-height: 250px;
        object-fit: cover;
        width: 100%;
    }
    
    /* Section Title Styles */
    .manga-section-title {
        position: relative;
        padding-bottom: 10px;
        color: #333;
    }
    
    .manga-section-title:after {
        content: '';
        position: absolute;
        left: 40px;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: #d32f2f;
    }
    
    .manga-section-title .title-icon {
        color: #d32f2f;
        margin-right: 10px;
    }
    
    .manga-section-title-center {
        position: relative;
        padding-bottom: 15px;
        color: #333;
        text-align: center;
    }
    
    .manga-section-title-center:after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: #d32f2f;
        transform: translateX(-50%);
    }
    
    .manga-section-title-center .title-icon {
        color: #d32f2f;
        margin-right: 10px;
    }
    
    /* Team Member Styles */
    .team-member-card {
        padding: 20px;
        transition: all 0.3s ease;
    }
    
    .team-member-card:hover {
        transform: translateY(-5px);
    }
    
    .team-member-card img {
        border: 3px solid #d32f2f;
        object-fit: cover;
    }
    
    .team-social {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .team-member-card:hover .team-social {
        opacity: 1;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .about-hero-banner {
            padding: 4rem 0;
        }
        
        .manga-about-card .col-md-4 {
            padding: 2rem !important;
        }
        
        .manga-about-image img {
            max-height: 200px;
        }
    }
</style>
@endsection