<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Redirect /home to / (home route)
Route::redirect('/home', '/');

// Item routes
Route::get('/manga', [ItemController::class, 'index'])->name('items.index');
Route::get('/manga/{item}', [ItemController::class, 'show'])->name('items.show');

// Genre routes
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');

// Authentication routes with email verification enabled
Auth::routes(['verify' => true]);

// User authenticated routes
Route::middleware('auth')->group(function () {
    Route::middleware(\App\Http\Middleware\CheckUserStatus::class)->group(function () {
        // Profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        
        // Cart routes
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{item}', [CartController::class, 'add'])->name('cart.add');
        Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.process');

        // Review routes
        Route::post('/reviews/{item}', [ReviewController::class, 'store'])->name('reviews.store');
        Route::get('/reviews/{item}/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
        Route::put('/reviews/{item}/{review}', [ReviewController::class, 'update'])->name('reviews.update');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        
        // Order routes
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware(\App\Http\Middleware\CheckUserStatus::class)->group(function () {
            // Restrict access to admin and staff only
            Route::middleware(\App\Http\Middleware\AdminStaffMiddleware::class)->group(function () {
                Route::get('/', [AdminController::class, 'index'])->name('dashboard');
                
                // DataTables data routes
                Route::get('/items/data', [AdminItemController::class, 'getData'])->name('items.data');
                Route::get('/customers/data', [CustomerController::class, 'getData'])->name('customers.data');
                Route::get('/orders/data', [OrderController::class, 'getData'])->name('orders.data');
                Route::get('/genres/data', [GenreController::class, 'getData'])->name('genres.data');
                Route::get('/reviews/data', [ReviewController::class, 'getData'])->name('reviews.data');

                Route::get('/genres/{genre}', [GenreController::class, 'adminShow'])->name('genres.show');
                
                // Admin resource routes
                Route::resource('items', AdminItemController::class);
                Route::resource('customers', CustomerController::class);
                Route::resource('orders', OrderController::class);
                Route::resource('genres', GenreController::class);
                
                // Trashed items
                Route::get('/items/trashed/list', [AdminItemController::class, 'trashed'])->name('items.trashed');
                Route::get('/items/trashed/data', [AdminItemController::class, 'getTrashedData'])->name('items.trashed.data');
                Route::get('/items/trashed/{id}/restore', [AdminItemController::class, 'restore'])->name('items.restore');
                Route::delete('/items/trashed/{id}', [AdminItemController::class, 'forceDelete'])->name('items.force-delete');
                
                // Import/Export
                Route::get('/items/export/excel', [AdminItemController::class, 'export'])->name('items.export');
                Route::get('/items/export/template', [AdminItemController::class, 'exportTemplate'])->name('items.export.template');
                Route::get('/items/import/form', [AdminItemController::class, 'importForm'])->name('items.import.form');
                Route::post('/items/import', [AdminItemController::class, 'import'])->name('items.import');
                
                // Reviews management
                Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
                Route::patch('/reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
                Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
                
                // Reports
                Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
                Route::get('/reports/customers', [ReportController::class, 'exportCustomers'])->name('reports.customers');
                Route::get('/reports/orders', [ReportController::class, 'exportOrders'])->name('reports.orders');
                Route::get('/reports/items', [ReportController::class, 'exportItems'])->name('reports.items');
                Route::get('/reports/sales', [ReportController::class, 'exportSales'])->name('reports.sales');
            });
            
            // User management (admin only)
            Route::middleware(\App\Http\Middleware\AdminOnlyMiddleware::class)->group(function () {
                Route::get('/users', [AdminController::class, 'users'])->name('users');
                Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
                Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
                Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
                Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
                Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
            });
        });
    });
});

