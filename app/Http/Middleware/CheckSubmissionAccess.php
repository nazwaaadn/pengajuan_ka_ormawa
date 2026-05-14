<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Timedeadline;
use Carbon\Carbon;

class CheckSubmissionAccess
{
    public function handle(Request $request, Closure $next)
    {
        $timeDeadline = Timedeadline::find(1); // Ambil pengaturan waktu dari ID tertentu

        if ($timeDeadline) {
            $now = Carbon::now();

            if ($now->lt($timeDeadline->submission_start_time) || $now->gt($timeDeadline->submission_end_time)) {
                // Jika di luar waktu akses, redirect ke halaman lain atau tampilkan pesan error
                return redirect()->route('dashboard')->with('error', 'Halaman pengajuan tidak dapat diakses saat ini.');
            }
        }

        return $next($request);
    }
}
