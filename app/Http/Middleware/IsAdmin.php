<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // PENTING: Cek apakah user sudah login DAN memiliki flag is_admin = true
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Jika tidak valid (bukan Admin), alihkan ke halaman utama
        abort(403, 'Akses Ditolak. Anda tidak memiliki izin Administrator.');
    }
}
