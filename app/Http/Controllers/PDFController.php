<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class PDFController extends Controller
{
    public function suratPernyataan(Request $request)
    {
        // $pengajuans = Pengajuan::all();

        $userId = Auth::id();
        $exists = Pengajuan::where('user_id', $userId)->exists();

        if (!session()->has('berkas') && !$exists) {
            return redirect()->route('pengajuanberkas')->with('error', 'Harap lengkapi data biodata terlebih dahulu.');
        }

        $request->session()->forget('berkas');
        $pengajuans = Pengajuan::with('berkas')->where('user_id', Auth::id())->get();

        $berkas = [
            'ktp' => 'KTP',
            'ktm' => 'KTM',
            'surat_sehat' => 'Surat Sehat',
            'surat_keterangan_berkelakuan_baik' => 'Surat Keterangan Kelakuan Baik',
            'surat_rekomendasi_jurusan' => 'Surat Rekomendasi Jurusan',
            'surat_pernyataan_mandiri' => 'Surat Pernyataan Mandiri',
            'transkrip_nilai' => 'Transkrip Nilai IPK',
            'sertifikat_pkkmb' => 'Sertifikat PKKMB',
            'sertifikat_lkmm' => 'Sertifikat LKMM',
            'sertifikat_bela_negara' => 'Sertifikat Bela Negara',
            'sertifikat_bahasa_asing' => 'Sertifikat EPT',
            'sertifikat_pelatihan_kepemimpinan' => 'Sertifikat Pelatihan Kepemimpinan',
            'sertifikat_pelatihan_emosional_spiritual' => 'Sertifikat Pelatihan Emosional Spiritual',
            'sertifikat_agent_of_change' => 'Sertifikat Agent of Change',
            'sertifikat_berorganisasi' => 'Sertifikat Berorganisasi (memiliki pengalaman berorganisasi minimal sebagai koordinator dalam panitia kemahasiswaan/program kerja).',
            'berita_acara_pemilihan' => 'Berita Acara Pemilihan',
        ];

        // Nama file dinamis dengan tanggal
        $fileName = 'Surat_Pernyataan_Ketua_Ormawa_' . date('Y-m-d') . '.pdf';

        $pdf = Pdf::loadview('suratPernyataan', compact('pengajuans', 'berkas'));
        // return view('suratPernyataan', compact('pengajuans', 'berkas')); // Tampilkan PDF di browser
        // return $pdf->stream(); // Tampilkan PDF di browser
        return $pdf->download($fileName); // Tampilkan PDF di browser
    }

    public function suratPerjanjian(Request $request)
    {
        $userId = Auth::id();
        $exists = Pengajuan::where('user_id', $userId)->exists();

        if (!session()->has('berkas') && !$exists) {
            return redirect()->route('pengajuanberkas')->with('error', 'Harap lengkapi data biodata terlebih dahulu.');
        }

        $request->session()->forget('berkas');
        $pengajuans = Pengajuan::with('berkas')->where('user_id', Auth::id())->get();

        $fileName = 'Surat_Perjanjian_Ketua_Ormawa_' . date('Y-m-d') . '.pdf';

        $pdf = Pdf::loadview('suratPerjanjian', compact('pengajuans'));
        // return view('suratPerjanjian'); // Tampilkan PDF di browser
        // return $pdf->stream();
        return $pdf->download($fileName); // Tampilkan PDF di browser

    }
}
