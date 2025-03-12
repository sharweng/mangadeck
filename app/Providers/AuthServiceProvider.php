<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Customer::class => \App\Policies\CustomerPolicy::class,
        \App\Models\Item::class => \App\Policies\ItemPolicy::class,
        \App\Models\OrderInfo::class => \App\Policies\OrderInfoPolicy::class,
        \App\Models\Genre::class => \App\Policies\GenrePolicy::class,
        \App\Models\Review::class => \App\Policies\ReviewPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Admin gates
        Gate::define('accessAdmin', function ($user) {
            return $user->isAdmin() || $user->isStaff();
        });

        // User management gate
        Gate::define('manageUsers', function ($user) {
            return $user->isAdmin();
        });

        // Reports gate
        Gate::define('viewReports', function ($user) {
            return $user->isAdmin() || $user->isStaff();
        });
    }
}

