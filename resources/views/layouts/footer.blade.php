<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>{{ config('app.name', 'Manga Shop') }}</h5>
                <p>Your one-stop shop for all your manga needs. We offer a wide selection of manga titles across various genres.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li><a class="text-white" href="{{ route('items.index') }}">Manga</a></li>
                    <li><a class="text-white" href="{{ route('about') }}">About Us</a></li>
                    <li><a class="text-white" href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact Information</h5>
                <address>
                    123 Manga Street<br>
                    Anime City, AC 12345<br>
                    <i class="fas fa-phone"></i> (123) 456-7890<br>
                    <i class="fas fa-envelope"></i> <a class="text-white" href="mailto:info@mangashop.com">info@mangashop.com</a>
                </address>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Manga Shop') }}. All rights reserved.</p>
        </div>
    </div>
</footer>

