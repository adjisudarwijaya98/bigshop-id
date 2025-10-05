<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUmkm
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // PENTING: Cek apakah user sudah login DAN memiliki relasi umkmProfile
        if (Auth::check() && Auth::user()->umkmProfile) {
            return $next($request);
        }

        // Jika tidak valid (bukan UMKM), alihkan ke halaman utama
        return redirect('/')->with('error', 'Akses Ditolak. Halaman ini hanya untuk mitra UMKM.');
    }
}
