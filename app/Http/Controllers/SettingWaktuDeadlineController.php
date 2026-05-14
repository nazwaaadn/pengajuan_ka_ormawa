<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timedeadline;

class SettingWaktuDeadlineController extends Controller
{
    public function updateAccesTime(Request $request)
{
    $request->validate([
        'submission_end_time' => 'required|date',
        'submission_start_time' => 'required|date|before_or_equal:submission_end_time',
    ]);

    // Simpan ke dalam database menggunakan Timedeadline
    Timedeadline::updateOrCreate(
        ['id' => 1],
        [
            'submission_start_time' => $request->submission_start_time,
            'submission_end_time' => $request->submission_end_time,
            'updated_at' => now(),
        ]
    );

    // Redirect ke dashboard dengan pesan sukses
    return redirect()->route('dashboard')->with('success', 'Waktu akses berhasil diperbarui.');
}

}
