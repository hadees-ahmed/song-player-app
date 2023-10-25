<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use League\Flysystem\Config;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('locale')) {
            session()->put('locale', $request->get('locale'));
        }

        $locale = session('locale', config('app.locale'));

        app()->setLocale($locale);

        return $next($request);
    }
}
