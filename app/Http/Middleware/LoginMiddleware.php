<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('loginId')) {
            // If 'loginId' key exists, proceed with the request
            return $next($request);
        }

        // If 'loginId' key doesn't exist in the session, redirect to the login page
        return redirect('/');
    }
}
