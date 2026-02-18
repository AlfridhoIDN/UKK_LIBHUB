<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Jangan lupa import ini
use Symfony\Component\HttpFoundation\Response;

class AdminOrStaff
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'staff')) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Akses Ditolak. Halaman ini khusus Admin atau Staff.');
    }
}