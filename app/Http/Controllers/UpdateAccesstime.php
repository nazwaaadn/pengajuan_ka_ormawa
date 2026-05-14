<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
class UpdateAccesstime extends Controller
{
    public function updateAccessTime(Request $request)
{
    $validated = $request->validate([
        'tanggal_dibuka' => 'required|date',
        'tanggal_deadline' => 'required|date|after_or_equal:tanggal_dibuka',
    ]);

    Setting::updateOrCreate(
        ['key' => 'access_time'],
        ['access_start' => $validated['tanggal_dibuka'], 'access_end' => $validated['tanggal_deadline']]
    );

    return back()->with('success', 'Waktu akses berhasil diperbarui.');
}

}
