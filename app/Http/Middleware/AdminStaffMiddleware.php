<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminStaffMiddleware
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
        if (auth()->user()->isAdmin() || auth()->user()->isStaff()) {
            return $next($request);
        }
        
        return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    }
}