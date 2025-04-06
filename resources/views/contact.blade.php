@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container-fluid px-0 contact-page">
    <!-- Hero Banner with Gradient -->
    <div class="hero-banner position-relative overflow-hidden mb-4 rounded-3 mx-3">
        <div class="banner-overlay"></div>
        <div class="container-fluid px-4 position-relative py-1" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-xl-6">
                    <h1 class="display-5 fw-bold text-white mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Contact <span class="text-white-50">Manga</span>Deck</h1>
                    <p class="text-white mb-3" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">We'd love to hear from you! Reach out with questions or feedback.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Contact Methods -->
        <div class="row mb-5 g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="h5 mb-3">Email Us</h3>
                        <p class="mb-1 small"><strong>Support:</strong> support@mangadeck.com</p>
                        <p class="mb-0 small"><strong>Sales:</strong> sales@mangadeck.com</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3 class="h5 mb-3">Call Us</h3>
                        <p class="mb-1 small"><strong>Customer Service:</strong> (555) 123-4567</p>
                        <p class="mb-0 small"><strong>Hours:</strong> 9AM - 5PM, Mon-Fri</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="h5 mb-3">Visit Us</h3>
                        <p class="mb-1 small">123 Otaku Lane</p>
                        <p class="mb-0 small">Tokyo, Japan 100-0001</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Form Section -->
        <div class="card mb-5 border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-5">
                    <h2 class="section-title">
                        <span class="section-title-icon"><i class="fas fa-comment-dots"></i></span>
                        <span class="section-title-text">Send Us a Message</span>
                    </h2>
                    <p class="text-muted">Have questions about our manga collection? Fill out the form below.</p>
                </div>
                
                <form class="needs-validation" novalidate>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Your Name <span class="text-muted">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-dark"></i></span>
                                <input type="text" class="form-control border-start-0" id="name" placeholder="Enter your name" required>
                                <div class="invalid-feedback">
                                    Please provide your name.
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address <span class="text-muted">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-envelope text-dark"></i></span>
                                <input type="email" class="form-control border-start-0" id="email" placeholder="Enter your email" required>
                                <div class="invalid-feedback">
                                    Please provide a valid email address.
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label for="subject" class="form-label">Subject <span class="text-muted">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-tag text-dark"></i></span>
                                <input type="text" class="form-control border-start-0" id="subject" placeholder="What's this about?" required>
                                <div class="invalid-feedback">
                                    Please provide a subject.
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label for="message" class="form-label">Message <span class="text-muted">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 align-items-start pt-2"><i class="fas fa-pen text-dark"></i></span>
                                <textarea class="form-control border-start-0" id="message" rows="5" placeholder="Type your message here..." required></textarea>
                                <div class="invalid-feedback">
                                    Please provide a message.
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 text-center mt-3">
                            <button class="btn btn-dark btn-lg px-4 py-2 fw-bold" type="submit">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Contact Page Hero */
    .hero-banner {
        background: linear-gradient(135deg, 
                    rgba(0,0,0,1) 0%, 
                    rgba(30,30,30,1) 50%, 
                    rgba(60,60,60,1) 100%), 
                    url('{{ asset("images/contact-banner.jpg") }}');
        background-size: cover;
        background-position: center;
        background-blend-mode: overlay;
        padding: 2rem 0;
        border-bottom: 1px solid #444;
        margin-left: calc(-1 * var(--bs-gutter-x) + 1rem);
        margin-right: calc(-1 * var(--bs-gutter-x) + 1rem);
        width: calc(100% + 2 * var(--bs-gutter-x) - 2rem);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
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

    /* Feature Cards (Contact Methods) */
    .feature-card {
        border-radius: 8px;
        transition: all 0.3s ease;
        background-color: #fff;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }
    
    .feature-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 15px;
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        font-size: 20px;
    }
    
    /* Section Titles */
    .section-title {
        position: relative;
        padding-bottom: 8px;
        color: #333;
        font-size: 1.5rem;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        left: 0;
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
    
    /* Form Styles */
    .form-label {
        font-weight: 600;
        color: #333;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-banner {
            padding: 1.5rem 0;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
            width: calc(100% - 1rem);
            text-align: center;
        }
        
        .hero-banner h1 {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Form validation script
    (function () {
        'use strict'
        
        // Fetch all forms we want to apply validation to
        var forms = document.querySelectorAll('.needs-validation')
        
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    
    // Add animation to contact method cards
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });
    });
</script>
@endsection