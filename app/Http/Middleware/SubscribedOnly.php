<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SubscribedOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user is subscribed (you need to define your subscription logic)
            if (Auth::user()->is_subscribed) {
                return $next($request);
            }
        }

        // Redirect or return an error response for unauthorized access
        return redirect()->back()->with('error', 'You must be subscribed to access this feature.');
    }
}
