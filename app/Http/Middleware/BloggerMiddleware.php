<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BloggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login'); // redirect unauthenticated users
        }

        // Check if the user has blogger role
        if (Auth::user()->role !== 'blogger') {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
