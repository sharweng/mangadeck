<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;

class RegisterMiddleware
{
    public static function register()
    {
        App::singleton('middleware.check.status', function () {
            return new CheckUserStatus();
        });
        
        App::singleton('middleware.admin.staff', function () {
            return new AdminStaffMiddleware();
        });
        
        App::singleton('middleware.admin.only', function () {
            return new AdminOnlyMiddleware();
        });
    }
}

