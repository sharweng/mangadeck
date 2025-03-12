<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status === 'deactivated') {
            Auth::logout();
            
            return redirect()->route('login')
                ->with('error', 'Your account has been deactivated. Please contact support for assistance.');
        }
        
        return $next($request);
    }
}

