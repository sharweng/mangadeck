@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <h1 class="display-5 mb-4">About MangaDeck</h1>
                    
                    <div class="mb-5">
                        <h2 class="h4 text-primary">Our Story</h2>
                        <p>MangaDeck was founded in 2023 by a group of passionate manga enthusiasts who wanted to create a dedicated platform for manga lovers around the world. What started as a small collection has now grown into one of the most comprehensive manga stores online.</p>
                    </div>
                    
                    <div class="mb-5">
                        <h2 class="h4 text-primary">Our Mission</h2>
                        <p>At MangaDeck, our mission is to connect manga fans with their favorite titles and introduce them to new stories they'll love. We believe in the power of manga to inspire, entertain, and bring people together through shared experiences.</p>
                    </div>
                    
                    <div class="mb-5">
                        <h2 class="h4 text-primary">Quality & Authenticity</h2>
                        <p>We take pride in offering only authentic, high-quality manga publications. All our products are sourced directly from publishers or authorized distributors, ensuring you receive genuine items that meet the highest standards.</p>
                    </div>
                    
                    <div class="mb-5">
                        <h2 class="h4 text-primary">Customer Experience</h2>
                        <p>We're committed to providing an exceptional shopping experience. From our user-friendly website to our responsive customer service team, we strive to make your journey with us as enjoyable as reading your favorite manga.</p>
                    </div>
                    
                    <div class="text-center mt-5">
                        <a href="{{ route('items.index') }}" class="btn btn-primary btn-lg">Explore Our Collection</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

