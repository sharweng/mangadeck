@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <h1 class="display-5 mb-4">Contact Us</h1>
                    
                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="card h-100 border-0 bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-envelope fa-3x mb-3 text-primary"></i>
                                    <h3 class="h5">Email Us</h3>
                                    <p class="mb-0">support@mangadeck.com</p>
                                    <p>sales@mangadeck.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-phone fa-3x mb-3 text-primary"></i>
                                    <h3 class="h5">Call Us</h3>
                                    <p class="mb-0">Customer Service: (555) 123-4567</p>
                                    <p>Business Hours: 9AM - 5PM, Mon-Fri</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <form class="needs-validation" novalidate>
                        <div class="mb-4">
                            <h2 class="h4">Send Us a Message</h2>
                            <p class="text-muted">We'll get back to you as soon as possible.</p>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" required>
                                <div class="invalid-feedback">
                                    Please provide your name.
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" required>
                                <div class="invalid-feedback">
                                    Please provide a valid email address.
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" required>
                                <div class="invalid-feedback">
                                    Please provide a subject.
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="5" required></textarea>
                                <div class="invalid-feedback">
                                    Please provide a message.
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
</script>
@endsection

