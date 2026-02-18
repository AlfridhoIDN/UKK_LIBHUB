<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class adminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   // Di dalam middleware adminCheck kamu
public function handle(Request $request, Closure $next): Response
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu.');
    }

    if (Auth::user()->role !== 'admin') {
        return redirect()->route('landingpage')->with('error', 'Anda tidak memiliki akses');
    }

    return $next($request);
    }
}
