@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container-fluid px-0 contact-page">
    <!-- Hero Banner -->
    <div class="contact-hero position-relative overflow-hidden">
        <div class="banner-overlay"></div>
        <div class="container position-relative py-5" style="z-index: 2;">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold text-white mb-3">Contact <span class="text-danger">Manga</span>Deck</h1>
                    <p class="lead text-white mb-0">We'd love to hear from you! Reach out with questions, feedback, or just to say hello.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg manga-contact-card">
                    <div class="card-body p-4 p-md-5">
                        <!-- Contact Methods -->
                        <div class="row mb-5 g-4">
                            <div class="col-md-4">
                                <div class="card h-100 border-0 contact-method-card">
                                    <div class="card-body text-center p-4">
                                        <div class="contact-icon mb-3">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <h3 class="h5 mb-3">Email Us</h3>
                                        <p class="mb-1"><strong>Support:</strong> support@mangadeck.com</p>
                                        <p class="mb-0"><strong>Sales:</strong> sales@mangadeck.com</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card h-100 border-0 contact-method-card">
                                    <div class="card-body text-center p-4">
                                        <div class="contact-icon mb-3">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <h3 class="h5 mb-3">Call Us</h3>
                                        <p class="mb-1"><strong>Customer Service:</strong> (555) 123-4567</p>
                                        <p class="mb-0"><strong>Hours:</strong> 9AM - 5PM, Mon-Fri</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card h-100 border-0 contact-method-card">
                                    <div class="card-body text-center p-4">
                                        <div class="contact-icon mb-3">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <h3 class="h5 mb-3">Visit Us</h3>
                                        <p class="mb-1">123 Otaku Lane</p>
                                        <p class="mb-0">Tokyo, Japan 100-0001</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Form -->
                        <div class="contact-form-section">
                            <div class="text-center mb-5">
                                <h2 class="section-title">
                                    <span class="section-title-icon"><i class="fas fa-comment-dots text-danger"></i></span>
                                    <span class="section-title-text">Send Us a Message</span>
                                </h2>
                                <p class="text-muted">Have questions about our manga collection? Fill out the form below and we'll respond within 24 hours.</p>
                            </div>
                            
                            <form class="needs-validation" novalidate>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                                            <div class="invalid-feedback">
                                                Please provide your name.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid email address.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                            <input type="text" class="form-control" id="subject" placeholder="What's this about?" required>
                                            <div class="invalid-feedback">
                                                Please provide a subject.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text align-items-start pt-2"><i class="fas fa-pen"></i></span>
                                            <textarea class="form-control" id="message" rows="5" placeholder="Type your message here..." required></textarea>
                                            <div class="invalid-feedback">
                                                Please provide a message.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 text-center mt-3">
                                        <button class="btn btn-danger btn-lg px-4 py-2 fw-bold" type="submit">
                                            <i class="fas fa-paper-plane me-2"></i>Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Contact Page Hero */
    .contact-hero {
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.9) 0%, rgba(22, 33, 62, 0.9) 100%), 
                    url('{{ asset("images/contact-banner.jpg") }}');
        background-size: cover;
        background-position: center;
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
    
    /* Contact Card */
    .manga-contact-card {
        border-radius: 10px;
        overflow: hidden;
        margin-top: -50px;
        position: relative;
        z-index: 2;
        background-color: #fff;
        border: none;
    }
    
    /* Contact Method Cards */
    .contact-method-card {
        transition: all 0.3s ease;
        border-radius: 8px;
        background-color: #f8f9fa;
    }
    
    .contact-method-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .contact-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 20px;
        background-color: rgba(211, 47, 47, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d32f2f;
        font-size: 24px;
    }
    
    /* Section Title */
    .section-title {
        position: relative;
        padding-bottom: 10px;
        color: #333;
        display: inline-block;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: #d32f2f;
    }
    
    .section-title-icon {
        color: #d32f2f;
        margin-right: 10px;
    }
    
    /* Form Styles */
    .contact-form-section {
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
    }
    
    .form-label {
        font-weight: 600;
        color: #333;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        color: #d32f2f;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .contact-hero {
            padding: 4rem 0;
        }
        
        .manga-contact-card {
            margin-top: -30px;
        }
        
        .contact-method-card {
            margin-bottom: 20px;
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
        
        document.querySelectorAll('.contact-method-card').forEach(card => {
            observer.observe(card);
        });
    });
</script>
@endsection