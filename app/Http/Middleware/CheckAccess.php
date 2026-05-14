<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Contoh pengecekan akses (bisa diganti sesuai kebutuhan)
        $accessStart = now()->setTime(8, 0); // Akses mulai pukul 08:00
        $accessEnd = now()->setTime(17, 0);  // Akses berakhir pukul 17:00

        if (now()->between($accessStart, $accessEnd)) {
            return $next($request); // Lanjutkan jika akses valid
        }

        return response()->json(['message' => 'Akses tidak diizinkan di luar jam kerja.'], 403);
    }
}
