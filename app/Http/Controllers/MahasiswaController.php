<?php

namespace App\Http\Controllers;

use App\Models\Timeline;  // Import model Timeline
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar timeline.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua data timeline dari database
        $timelines = Timeline::all(); 

        // Kirim data 'timelines' ke view yang sesuai (misalnya 'admin')
        return view('dashboardmahasiswa', compact('timelines'));
    }
}
