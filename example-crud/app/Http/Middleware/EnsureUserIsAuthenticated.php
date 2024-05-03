<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd('hello');
        // dd($request);
        \Log::info('Current URL: ' . $request->path());
        // Check if the user is accessing a route under '/products'
        if ($request->is('products') || $request->is('products/*')) {
            // Check if the user is not authenticated
            // dd($request);
            // dd('hello');

            if (!Auth::check()) {
                // Redirect to login page
                return redirect()->route('login');

            }
        }
        else{
            dd('hello');
        }

        // If the user is authenticated or not accessing '/products', proceed with the request
        return $next($request);
    }
}
