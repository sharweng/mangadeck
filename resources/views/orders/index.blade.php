@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section for Orders -->
    <div class="hero-banner position-relative overflow-hidden mb-4 rounded-3 mx-3">
        <div class="banner-overlay"></div>
        <div class="container-fluid px-4 position-relative py-1" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-xl-6">
                    <h1 class="display-5 fw-bold text-white mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">My <span class="text-white-50">Manga</span> Orders</h1>
                    <p class="text-white mb-3" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Track your manga purchases.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-dark alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        
        @if(count($orders) > 0)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-scroll me-2"></i>Order History
                    </h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0">Order #</th>
                                    <th class="border-0">Date</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Total</th>
                                    <th class="border-0 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="order-row">
                                        <td class="fw-bold">#{{ $order->id }}</td>
                                        <td>{{ $order->date_placed->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge rounded-pill bg-{{ $order->status->name === 'Pending' ? 'warning text-dark' : ($order->status->name === 'Processing' ? 'info text-dark' : ($order->status->name === 'Shipped' ? 'primary' : ($order->status->name === 'Delivered' ? 'success' : 'secondary'))) }}">
                                                <i class="fas fa-{{ $order->status->name === 'Pending' ? 'clock' : ($order->status->name === 'Processing' ? 'cog' : ($order->status->name === 'Shipped' ? 'truck' : ($order->status->name === 'Delivered' ? 'check-circle' : 'times-circle'))) }} me-1"></i>
                                                {{ $order->status->name }}
                                            </span>
                                        </td>
                                        <td>
                                            ${{ number_format($order->orderlines->sum(function($line) {
                                                return $line->price * $line->quantity;
                                            }) + $order->shipping, 2) }}
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-dark">
                                                <i class="fas fa-eye me-1"></i> Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-3">
                    <div class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body py-5">
                    <div class="empty-state-icon">
                        <i class="fas fa-scroll fa-4x text-muted mb-4"></i>
                    </div>
                    <h3 class="h4 mb-3">No Orders Yet</h3>
                    <p class="text-muted mb-4">Your manga collection is waiting to begin. Start exploring our titles!</p>
                    <a href="{{ route('items.index') }}" class="btn btn-dark px-4">
                        <i class="fas fa-book-open me-2"></i> Browse Manga
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Hero Banner Styles - Matching home.blade.php */
    .hero-banner {
        background: linear-gradient(135deg, 
                    rgba(0,0,0,1) 0%, 
                    rgba(30,30,30,1) 50%, 
                    rgba(60,60,60,1) 100%), 
                    url('{{ asset("images/manga-banner-bg.jpg") }}');
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

    /* Order Table Styles */
    .order-row:hover {
        background-color: rgba(0,0,0,0.02);
        transform: translateX(2px);
        transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    /* Card Styles */
    .card {
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
    }

    /* Badge Styles */
    .badge {
        font-weight: 500;
        letter-spacing: 0.5px;
        padding: 0.35em 0.65em;
    }

    /* Button Styles */
    .btn-dark {
        background-color: #333;
        border-color: #333;
    }

    .btn-dark:hover {
        background-color: #222;
        border-color: #222;
    }

    .btn-outline-dark:hover {
        background-color: #333;
        color: white;
    }

    /* Empty State */
    .empty-state-icon {
        opacity: 0.7;
    }

    /* Pagination Styles */
    .pagination .page-item.active .page-link {
        background-color: #333;
        border-color: #333;
    }

    .pagination .page-link {
        color: #333;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-banner {
            padding: 1.5rem 0;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
            width: calc(100% - 1rem);
        }
        
        .hero-banner h1 {
            font-size: 2rem;
        }
        
        .table-responsive {
            border: 0;
        }
        
        .table thead {
            display: none;
        }
        
        .table tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #eee;
            border-radius: 8px;
        }
        
        .table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border-bottom: 1px solid #eee;
        }
        
        .table td:before {
            content: attr(data-label);
            font-weight: bold;
            margin-right: 1rem;
        }
        
        .table td:last-child {
            border-bottom: 0;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Make table rows clickable
        document.querySelectorAll('.order-row').forEach(row => {
            row.addEventListener('click', function(e) {
                // Don't navigate if the click was on a button or link
                if (!e.target.closest('a, button')) {
                    const link = this.querySelector('a');
                    if (link) {
                        window.location = link.href;
                    }
                }
            });
            
            // Add hover effect
            row.style.cursor = 'pointer';
            row.style.transition = 'all 0.2s ease';
        });

        // Add animation to cards
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.card').forEach(card => {
            observer.observe(card);
        });
    });
</script>
@endsection