<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berkas;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Enums\PengajuanStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SKTerbitNotifikasi;
use App\Notifications\PengajuanNotifikasi;
use Illuminate\Support\Facades\Notification;

class BerkasController extends Controller
{
    public function index()
    {
        if (!session()->has('pengajuan')) {
            return redirect()->route('form')->with('error', 'Harap lengkapi data biodata terlebih dahulu.');
        }
        $pengajuanData = session('pengajuan');
        return view('pengajuanberkas', ['pengajuanData' => $pengajuanData]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'scan_ktp' => 'required|mimes:pdf|max:2048',
            'surat_sehat' => 'required|mimes:pdf|max:2048',
            'surat_rekomendasi_jurusan' => 'required|mimes:pdf|max:2048',
            'transkip_rekomendasi_jurusan' => 'required|mimes:pdf|max:2048',
            'sertifikat_lkmm' => 'required|mimes:pdf|max:2048',
            'sertifikat_pelatihan_kepemimpinan' => 'required|mimes:pdf|max:2048',
            'sertifikat_pelatihan_emosional_spiritual' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_bahasa_asing' => 'required|mimes:pdf|max:2048',
            'scan_ktm' => 'required|mimes:pdf|max:2048',
            'surat_keterangan_berkelakuan_baik' => 'required|mimes:pdf|max:2048',
            'surat_penyataan_mandiri' => 'required|mimes:pdf|max:2048',
            'sertifikat_pkkmb' => 'required|mimes:pdf|max:2048',
            'sertifikat_bela_negara' => 'required|mimes:pdf|max:2048',
            'sertifikat_agent_of_change' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_berorganisasi' => 'required|mimes:pdf|max:2048',
            'berita_acara_pemilihan' => 'required|mimes:pdf|max:2048',
            'surat_pernyataan' => 'nullable|file|mimes:pdf|max:2048',
            'surat_perjanjian' => 'nullable|file|mimes:pdf|max:2048',
            'surat_mou' => 'nullable|file|mimes:pdf|max:5120',
            'surat_kak' => 'nullable|file|mimes:pdf|max:5120',
        ], [
            'scan_ktp.mimes' => 'File KTP harus berformat PDF.',
            'scan_ktp.max' => 'Ukuran file KTP tidak boleh lebih dari 2 MB.',
            'surat_sehat.mimes' => 'Surat sehat harus berformat PDF.',
            'surat_sehat.max' => 'Ukuran file surat sehat tidak boleh lebih dari 2 MB.',
            'surat_rekomendasi_jurusan.mimes' => 'Surat rekomendasi jurusan harus berformat PDF.',
            'surat_rekomendasi_jurusan.max' => 'Ukuran file surat rekomendasi jurusan tidak boleh lebih dari 2 MB.',
            'transkip_rekomendasi_jurusan.mimes' => 'Transkip rekomendasi jurusan harus berformat PDF.',
            'transkip_rekomendasi_jurusan.max' => 'Ukuran file transkip rekomendasi jurusan tidak boleh lebih dari 2 MB.',
            'sertifikat_lkmm.mimes' => 'Sertifikat LKMM harus berformat PDF.',
            'sertifikat_lkmm.max' => 'Ukuran file sertifikat LKMM tidak boleh lebih dari 2 MB.',
            'sertifikat_pelatihan_kepemimpinan.mimes' => 'Sertifikat pelatihan kepemimpinan harus berformat PDF.',
            'sertifikat_pelatihan_kepemimpinan.max' => 'Ukuran file sertifikat pelatihan kepemimpinan tidak boleh lebih dari 2 MB.',
            'sertifikat_pelatihan_emosional_spiritual.mimes' => 'Sertifikat pelatihan emosional spiritual harus berformat PDF.',
            'sertifikat_pelatihan_emosional_spiritual.max' => 'Ukuran file sertifikat pelatihan emosional spiritual tidak boleh lebih dari 2 MB.',
            'sertifikat_bahasa_asing.mimes' => 'Sertifikat bahasa asing harus berformat PDF.',
            'sertifikat_bahasa_asing.max' => 'Ukuran file sertifikat bahasa asing tidak boleh lebih dari 2 MB.',
            'scan_ktm.mimes' => 'File KTM harus berformat PDF.',
            'scan_ktm.max' => 'Ukuran file KTM tidak boleh lebih dari 2 MB.',
            'surat_keterangan_berkelakuan_baik.mimes' => 'Surat keterangan berkelakuan baik harus berformat PDF.',
            'surat_keterangan_berkelakuan_baik.max' => 'Ukuran file surat keterangan berkelakuan baik tidak boleh lebih dari 2 MB.',
            'surat_penyataan_mandiri.mimes' => 'Surat penyataan mandiri harus berformat PDF.',
            'surat_penyataan_mandiri.max' => 'Ukuran file surat penyataan mandiri tidak boleh lebih dari 2 MB.',
            'sertifikat_pkkmb.mimes' => 'Sertifikat PKKMB harus berformat PDF.',
            'sertifikat_pkkmb.max' => 'Ukuran file sertifikat PKKMB tidak boleh lebih dari 2 MB.',
            'sertifikat_bela_negara.mimes' => 'Sertifikat bela negara harus berformat PDF.',
            'sertifikat_bela_negara.max' => 'Ukuran file sertifikat bela negara tidak boleh lebih dari 2 MB.',
            'sertifikat_agent_of_change.mimes' => 'Sertifikat Agent of Change harus berformat PDF.',
            'sertifikat_agent_of_change.max' => 'Ukuran file sertifikat Agent of Change tidak boleh lebih dari 2 MB.',
            'sertifikat_berorganisasi.mimes' => 'Sertifikat berorganisasi harus berformat PDF.',
            'sertifikat_berorganisasi.max' => 'Ukuran file sertifikat berorganisasi tidak boleh lebih dari 2 MB.',
            'berita_acara_pemilihan.mimes' => 'Berita acara pemilihan harus berformat PDF.',
            'berita_acara_pemilihan.max' => 'Ukuran file berita acara pemilihan tidak boleh lebih dari 2 MB.',
            'surat_pernyataan.mimes' => 'Surat pernyataan harus berformat PDF.',
            'surat_pernyataan.max' => 'Ukuran file surat pernyataan tidak boleh lebih dari 2 MB.',
            'surat_perjanjian.mimes' => 'Surat perjanjian harus berformat PDF.',
            'surat_perjanjian.max' => 'Ukuran file surat perjanjian tidak boleh lebih dari 2 MB.',
            'surat_mou.mimes' => 'Surat MoU harus berformat PDF.',
            'surat_mou.max' => 'Ukuran file surat MoU tidak boleh lebih dari 5 MB.',
            'surat_kak.mimes' => 'Surat KAK harus berformat PDF.',
            'surat_kak.max' => 'Ukuran file surat KAK tidak boleh lebih dari 5 MB.',
        ]);

        $pengajuanData = session('pengajuan');

        DB::transaction(function () use ($request, $pengajuanData) {
            $pengajuan = Pengajuan::create($pengajuanData);

            $berkas = new Berkas();
            $folderPath = 'app/PDF/' . $pengajuan->id;

            $publicPath = storage_path($folderPath);

            Storage::makeDirectory($folderPath);
            $berkas->scan_ktp = $request->file('scan_ktp')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_scan_ktp.pdf') ? 'Pengaju_' . $pengajuan->id . '_scan_ktp.pdf' : 'data gagal terupload';
            $berkas->surat_sehat = $request->file('surat_sehat')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_sehat.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_sehat.pdf' : 'data gagal terupload';
            $berkas->surat_rekomendasi_jurusan = $request->file('surat_rekomendasi_jurusan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_rekomendasi_jurusan.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_rekomendasi_jurusan.pdf' : 'data gagal terupload';
            $berkas->transkip_rekomendasi_jurusan = $request->file('transkip_rekomendasi_jurusan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_transkip_rekomendasi_jurusan.pdf') ? 'Pengaju_' . $pengajuan->id . '_transkip_rekomendasi_jurusan.pdf' : 'data gagal terupload';
            $berkas->sertifikat_lkmm = $request->file('sertifikat_lkmm')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_lkmm.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_lkmm.pdf' : 'data gagal terupload';
            $berkas->sertifikat_pelatihan_kepemimpinan = $request->file('sertifikat_pelatihan_kepemimpinan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_kepemimpinan.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_kepemimpinan.pdf' : 'data gagal terupload';
            // $berkas->sertifikat_pelatihan_emosional_spiritual = $request->file('sertifikat_pelatihan_emosional_spiritual')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_emosional_spiritual.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_emosional_spiritual.pdf' : $berkas->sertifikat_pelatihan_emosional_spiritual = null;
            if ($request->hasFile('sertifikat_pelatihan_emosional_spiritual')) {
                $berkas->sertifikat_pelatihan_emosional_spiritual = $request->file('sertifikat_pelatihan_emosional_spiritual')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_emosional_spiritual.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_emosional_spiritual.pdf' : 'data gagal terupload';
            } else {
                $berkas->sertifikat_pelatihan_emosional_spiritual = 'pengaju tidak mengirimkan file ini';
            }
            $berkas->sertifikat_bahasa_asing = $request->file('sertifikat_bahasa_asing')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_bahasa_asing.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_bahasa_asing.pdf' : 'data gagal terupload';
            $berkas->scan_ktm = $request->file('scan_ktm')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_scan_ktm.pdf') ? 'Pengaju_' . $pengajuan->id . '_scan_ktm.pdf' : 'data gagal terupload';
            $berkas->surat_keterangan_berkelakuan_baik = $request->file('surat_keterangan_berkelakuan_baik')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_keterangan_berkelakuan_baik.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_keterangan_berkelakuan_baik.pdf' : 'data gagal terupload';
            $berkas->surat_penyataan_mandiri = $request->file('surat_penyataan_mandiri')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_penyataan_mandiri.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_penyataan_mandiri.pdf' : 'data gagal terupload';
            $berkas->sertifikat_pkkmb = $request->file('sertifikat_pkkmb')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_pkkmb.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_pkkmb.pdf' : 'data gagal terupload';
            $berkas->sertifikat_bela_negara = $request->file('sertifikat_bela_negara')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_bela_negara.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_bela_negara.pdf' : 'data gagal terupload';
            // $berkas->sertifikat_agent_of_change = $request->file('sertifikat_agent_of_change')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_agent_of_change.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_agent_of_change.pdf' : 'data gagal terupload';
            if ($request->hasFile('sertifikat_agent_of_change')) {
                $berkas->sertifikat_agent_of_change = $request->file('sertifikat_agent_of_change')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_agent_of_change.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_agent_of_change.pdf' : 'data gagal terupload';
            } else {
                $berkas->sertifikat_agent_of_change = 'pengaju tidak mengirimkan file ini';
            }
            $berkas->sertifikat_berorganisasi = $request->file('sertifikat_berorganisasi')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_berorganisasi.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_berorganisasi.pdf' : 'data gagal terupload';
            $berkas->berita_acara_pemilihan = $request->file('berita_acara_pemilihan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_berita_acara_pemilihan.pdf') ? 'Pengaju_' . $pengajuan->id . '_berita_acara_pemilihan.pdf' : 'data gagal terupload';
            if ($request->hasFile('surat_pernyataan')) {
                $berkas->surat_pernyataan = $request->file('surat_pernyataan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_pernyataan.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_pernyataan.pdf' : 'data gagal terupload';
            } else {
                $berkas->surat_pernyataan = 'pengaju belum mengirimkan file ini';
            }
            if ($request->hasFile('surat_perjanjian')) {
                $berkas->surat_perjanjian = $request->file('surat_perjanjian')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_perjanjian.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_perjanjian.pdf' : 'data gagal terupload';
            } else {
                $berkas->surat_perjanjian = 'pengaju belum mengirimkan file ini';
            }
            if ($request->hasFile('surat_mou')) {
                $berkas->surat_mou = $request->file('surat_mou')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_mou.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_mou.pdf' : 'data gagal terupload';
            } else {
                $berkas->surat_mou = 'pengaju belum mengirimkan file ini';
            }
            if ($request->hasFile('surat_kak')) {
                $berkas->surat_kak = $request->file('surat_kak')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_kak.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_kak.pdf' : 'data gagal terupload';
            } else {
                $berkas->surat_kak = 'pengaju belum mengirimkan file ini';
            }

            $request->session()->put('berkas', [
                'scan_ktp' => Auth::id()
            ]);

            $berkas->pengajuan_id = $pengajuan->id;
            $pengajuan->status = PengajuanStatus::MenungguVerifikasi;
            $berkas->save();

            //notifikasi mahasiswa
            // $pengajuan->user->notify(new PengajuanNotifikasi($pengajuan->toArray()));
            $user = User::find($pengajuan->user_id);
            $user->notify(new PengajuanNotifikasi($pengajuan, 'baru', false));
            // $pengajuan->user->notify(new PengajuanNotifikasi($pengajuan, 'baru', false));


            // Notifikasi ke staff_polban
            $staffs = User::where('role_id', 'staff_kemahasiswaan')->get();
            Notification::send($staffs, new PengajuanNotifikasi($pengajuan, 'baru', true));
        });

        $request->session()->forget('pengajuan');
        return redirect()->route('progrestabel')->with('success', 'Pengajuan berhasil disimpan.');
        // return redirect('/progrestabel')->with('success', 'Proses Pengajuan Telah Berhasil !');
    }

    public function progrestabel(Request $request)
    {
        $userId = Auth::id();
        $exists = Pengajuan::where('user_id', $userId)->exists();

        if (!session()->has('berkas') && !$exists) {
            return redirect()->route('pengajuanberkas')->with('error', 'Harap lengkapi data biodata terlebih dahulu.');
        }

        $request->session()->forget('berkas');
        $pengajuans = Pengajuan::with('berkas')->where('user_id', Auth::id())->get();
        return view('progrestabel', compact('pengajuans'));
    }

    public function edit($nim, $id)
    {
        $revisiPengajuan = session('revisiPengajuan');
        // $pengajuans = Pengajuan::with('berkas')->find($id)->where('nim', $nim);
        $pengajuan = Pengajuan::with('berkas')
        ->where('id', $id)
        ->where('nim', $nim)
        ->firstOrFail();
        // dd($pengajuan);

        return view('editPengajuBerkas', ['nim' => $nim, 'pengajuan' => $pengajuan, 'revisiPengajuan' => $revisiPengajuan]);
    }

    public function update(Request $request, $nim, $id)
    {
        $request->validate([
            'scan_ktp' => 'nullable|file|mimes:pdf|max:2048',
            'surat_sehat' => 'nullable|file|mimes:pdf|max:2048',
            'surat_rekomendasi_jurusan' => 'nullable|file|mimes:pdf|max:2048',
            'transkip_rekomendasi_jurusan' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_lkmm' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_pelatihan_kepemimpinan' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_pelatihan_emosional_spiritual' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_bahasa_asing' => 'nullable|file|mimes:pdf|max:2048',
            'scan_ktm' => 'nullable|file|mimes:pdf|max:2048',
            'surat_keterangan_berkelakuan_baik' => 'nullable|file|mimes:pdf|max:2048',
            'surat_penyataan_mandiri' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_pkkmb' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_bela_negara' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_agent_of_change' => 'nullable|file|mimes:pdf|max:2048',
            'sertifikat_berorganisasi' => 'nullable|file|mimes:pdf|max:2048',
            'berita_acara_pemilihan' => 'nullable|file|mimes:pdf|max:2048',
            'surat_pernyataan' => 'nullable|file|mimes:pdf|max:2048',
            'surat_perjanjian' => 'nullable|file|mimes:pdf|max:2048',
            'surat_mou' => 'nullable|file|mimes:pdf|max:5120',
            'surat_kak' => 'nullable|file|mimes:pdf|max:5120',
        ], [
            'scan_ktp.mimes' => 'File KTP harus berformat PDF.',
            'scan_ktp.max' => 'Ukuran file KTP tidak boleh lebih dari 2 MB.',
            'surat_sehat.mimes' => 'Surat sehat harus berformat PDF.',
            'surat_sehat.max' => 'Ukuran file surat sehat tidak boleh lebih dari 2 MB.',
            'surat_rekomendasi_jurusan.mimes' => 'Surat rekomendasi jurusan harus berformat PDF.',
            'surat_rekomendasi_jurusan.max' => 'Ukuran file surat rekomendasi jurusan tidak boleh lebih dari 2 MB.',
            'transkip_rekomendasi_jurusan.mimes' => 'Transkip rekomendasi jurusan harus berformat PDF.',
            'transkip_rekomendasi_jurusan.max' => 'Ukuran file transkip rekomendasi jurusan tidak boleh lebih dari 2 MB.',
            'sertifikat_lkmm.mimes' => 'Sertifikat LKMM harus berformat PDF.',
            'sertifikat_lkmm.max' => 'Ukuran file sertifikat LKMM tidak boleh lebih dari 2 MB.',
            'sertifikat_pelatihan_kepemimpinan.mimes' => 'Sertifikat pelatihan kepemimpinan harus berformat PDF.',
            'sertifikat_pelatihan_kepemimpinan.max' => 'Ukuran file sertifikat pelatihan kepemimpinan tidak boleh lebih dari 2 MB.',
            'sertifikat_pelatihan_emosional_spiritual.mimes' => 'Sertifikat pelatihan emosional spiritual harus berformat PDF.',
            'sertifikat_pelatihan_emosional_spiritual.max' => 'Ukuran file sertifikat pelatihan emosional spiritual tidak boleh lebih dari 2 MB.',
            'sertifikat_bahasa_asing.mimes' => 'Sertifikat bahasa asing harus berformat PDF.',
            'sertifikat_bahasa_asing.max' => 'Ukuran file sertifikat bahasa asing tidak boleh lebih dari 2 MB.',
            'scan_ktm.mimes' => 'File KTM harus berformat PDF.',
            'scan_ktm.max' => 'Ukuran file KTM tidak boleh lebih dari 2 MB.',
            'surat_keterangan_berkelakuan_baik.mimes' => 'Surat keterangan berkelakuan baik harus berformat PDF.',
            'surat_keterangan_berkelakuan_baik.max' => 'Ukuran file surat keterangan berkelakuan baik tidak boleh lebih dari 2 MB.',
            'surat_penyataan_mandiri.mimes' => 'Surat penyataan mandiri harus berformat PDF.',
            'surat_penyataan_mandiri.max' => 'Ukuran file surat penyataan mandiri tidak boleh lebih dari 2 MB.',
            'sertifikat_pkkmb.mimes' => 'Sertifikat PKKMB harus berformat PDF.',
            'sertifikat_pkkmb.max' => 'Ukuran file sertifikat PKKMB tidak boleh lebih dari 2 MB.',
            'sertifikat_bela_negara.mimes' => 'Sertifikat bela negara harus berformat PDF.',
            'sertifikat_bela_negara.max' => 'Ukuran file sertifikat bela negara tidak boleh lebih dari 2 MB.',
            'sertifikat_agent_of_change.mimes' => 'Sertifikat Agent of Change harus berformat PDF.',
            'sertifikat_agent_of_change.max' => 'Ukuran file sertifikat Agent of Change tidak boleh lebih dari 2 MB.',
            'sertifikat_berorganisasi.mimes' => 'Sertifikat berorganisasi harus berformat PDF.',
            'sertifikat_berorganisasi.max' => 'Ukuran file sertifikat berorganisasi tidak boleh lebih dari 2 MB.',
            'berita_acara_pemilihan.mimes' => 'Berita acara pemilihan harus berformat PDF.',
            'berita_acara_pemilihan.max' => 'Ukuran file berita acara pemilihan tidak boleh lebih dari 2 MB.',
            'surat_pernyataan.mimes' => 'Surat pernyataan harus berformat PDF.',
            'surat_pernyataan.max' => 'Ukuran file surat pernyataan tidak boleh lebih dari 2 MB.',
            'surat_perjanjian.mimes' => 'Surat perjanjian harus berformat PDF.',
            'surat_perjanjian.max' => 'Ukuran file surat perjanjian tidak boleh lebih dari 2 MB.',
            'surat_mou.mimes' => 'Surat MoU harus berformat PDF.',
            'surat_mou.max' => 'Ukuran file surat MoU tidak boleh lebih dari 5 MB.',
            'surat_kak.mimes' => 'Surat KAK harus berformat PDF.',
            'surat_kak.max' => 'Ukuran file surat KAK tidak boleh lebih dari 5 MB.',
        ]);

        $revisiPengajuan = session('revisiPengajuan');

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = PengajuanStatus::MenungguVerifikasiUlang;
        $pengajuan->update($revisiPengajuan);

        $berkas = $pengajuan->berkas;


        $folderPath = 'app/PDF/' . $pengajuan->id;

        $publicPath = storage_path($folderPath);

        Storage::makeDirectory($folderPath);
        if ($request->hasFile('scan_ktp')) {
            $berkas->scan_ktp = $request->file('scan_ktp')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_scan_ktp.pdf') ? 'Pengaju_' . $pengajuan->id . '_scan_ktp.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_sehat')) {
            $berkas->surat_sehat = $request->file('surat_sehat')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_sehat.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_sehat.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_rekomendasi_jurusan')) {
            $berkas->surat_rekomendasi_jurusan = $request->file('surat_rekomendasi_jurusan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_rekomendasi_jurusan.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_rekomendasi_jurusan.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('transkip_rekomendasi_jurusan')) {
            $berkas->transkip_rekomendasi_jurusan = $request->file('transkip_rekomendasi_jurusan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_transkip_rekomendasi_jurusan.pdf') ? 'Pengaju_' . $pengajuan->id . '_transkip_rekomendasi_jurusan.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('sertifikat_lkmm')) {
            $berkas->sertifikat_lkmm = $request->file('sertifikat_lkmm')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_lkmm.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_lkmm.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('sertifikat_pelatihan_kepemimpinan')) {
            $berkas->sertifikat_pelatihan_kepemimpinan = $request->file('sertifikat_pelatihan_kepemimpinan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_kepemimpinan.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_kepemimpinan.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('sertifikat_pelatihan_emosional_spiritual')) {
            $berkas->sertifikat_pelatihan_emosional_spiritual = $request->file('sertifikat_pelatihan_emosional_spiritual')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_emosional_spiritual.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_emosional_spiritual.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('sertifikat_bahasa_asing')) {
            $berkas->sertifikat_bahasa_asing = $request->file('sertifikat_bahasa_asing')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_bahasa_asing.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_bahasa_asing.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('scan_ktm')) {
            $berkas->scan_ktm = $request->file('scan_ktm')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_scan_ktm.pdf') ? 'Pengaju_' . $pengajuan->id . '_scan_ktm.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_keterangan_berkelakuan_baik')) {
            $berkas->surat_keterangan_berkelakuan_baik = $request->file('surat_keterangan_berkelakuan_baik')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_keterangan_berkelakuan_baik.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_keterangan_berkelakuan_baik.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_penyataan_mandiri')) {
            $berkas->surat_penyataan_mandiri = $request->file('surat_penyataan_mandiri')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_penyataan_mandiri.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_penyataan_mandiri.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('sertifikat_pkkmb')) {
            $berkas->sertifikat_pkkmb = $request->file('sertifikat_pkkmb')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_pkkmb.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_pkkmb.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('sertifikat_bela_negara')) {
            $berkas->sertifikat_bela_negara = $request->file('sertifikat_bela_negara')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_bela_negara.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_bela_negara.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('sertifikat_agent_of_change')) {
            $berkas->sertifikat_agent_of_change = $request->file('sertifikat_agent_of_change')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_agent_of_change.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_agent_of_change.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('sertifikat_berorganisasi')) {
            $berkas->sertifikat_berorganisasi = $request->file('sertifikat_berorganisasi')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_sertifikat_berorganisasi.pdf') ? 'Pengaju_' . $pengajuan->id . '_sertifikat_berorganisasi.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('berita_acara_pemilihan')) {
            $berkas->berita_acara_pemilihan = $request->file('berita_acara_pemilihan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_berita_acara_pemilihan.pdf') ? 'Pengaju_' . $pengajuan->id . '_berita_acara_pemilihan.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_pernyataan')) {
            $berkas->surat_pernyataan = $request->file('surat_pernyataan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_pernyataan.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_pernyataan.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_perjanjian')) {
            $berkas->surat_perjanjian = $request->file('surat_perjanjian')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_perjanjian.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_perjanjian.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_mou')) {
            $berkas->surat_mou = $request->file('surat_mou')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_mou.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_mou.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_kak')) {
            $berkas->surat_kak = $request->file('surat_kak')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_kak.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_kak.pdf' : 'data gagal terupload';
        }

        $berkas->save();

        $user = User::find($pengajuan->user_id);
        $user->notify(new PengajuanNotifikasi($pengajuan, 'revisi_dikirim', false));

        // Notifikasi ke staff_polban
        $staffs = User::where('role_id', 'staff_kemahasiswaan')->get();
        Notification::send($staffs, new PengajuanNotifikasi($pengajuan, 'revisi_dikirim', true));

        return redirect()->route('progrestabel')->with('success', 'Data updated successfully');
    }

    public function indexUpdateSurat($nim, $id)
    {
        $pengajuan = Pengajuan::with('berkas')
        ->where('user_id', Auth::id()) // Filter pengguna yang sedang login
        ->where('id', $id) // Filter berdasarkan ID pengajuan
        ->where('nim', $nim) // Filter berdasarkan NIM
        ->firstOrFail(); // Ambil data atau gagal jika tidak ditemukan

        return view('uploadSurat', ['pengajuan' => $pengajuan]);
    }

    public function updateSurat(Request $request, $nim, $id)
    {
        $request->validate([
            'surat_pernyataan' => 'nullable|file|mimes:pdf|max:2048',
            'surat_perjanjian' => 'nullable|file|mimes:pdf|max:2048',
            'surat_mou' => 'nullable|file|mimes:pdf|max:5120',
            'surat_kak' => 'nullable|file|mimes:pdf|max:5120',
        ], [
            'surat_pernyataan.mimes' => 'Surat pernyataan harus berformat PDF.',
            'surat_pernyataan.max' => 'Ukuran file surat pernyataan tidak boleh lebih dari 2 MB.',
            'surat_perjanjian.mimes' => 'Surat perjanjian harus berformat PDF.',
            'surat_perjanjian.max' => 'Ukuran file surat perjanjian tidak boleh lebih dari 2 MB.',
            'surat_mou.mimes' => 'Surat MoU harus berformat PDF.',
            'surat_mou.max' => 'Ukuran file surat MoU tidak boleh lebih dari 5 MB.',
            'surat_kak.mimes' => 'Surat KAK harus berformat PDF.',
            'surat_kak.max' => 'Ukuran file surat KAK tidak boleh lebih dari 5 MB.',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        $berkas = $pengajuan->berkas;


        $folderPath = 'app/PDF/' . $pengajuan->id;

        $publicPath = storage_path($folderPath);

        Storage::makeDirectory($folderPath);
        if ($request->hasFile('surat_pernyataan')) {
            $berkas->surat_pernyataan = $request->file('surat_pernyataan')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_pernyataan.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_pernyataan.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_perjanjian')) {
            $berkas->surat_perjanjian = $request->file('surat_perjanjian')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_perjanjian.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_perjanjian.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_mou')) {
            $berkas->surat_mou = $request->file('surat_mou')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_mou.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_mou.pdf' : 'data gagal terupload';
        }
        if ($request->hasFile('surat_kak')) {
            $berkas->surat_kak = $request->file('surat_kak')->move($publicPath, 'Pengaju_' . $pengajuan->id . '_surat_kak.pdf') ? 'Pengaju_' . $pengajuan->id . '_surat_kak.pdf' : 'data gagal terupload';
        }

        $berkas->save();

        // $user = User::find($pengajuan->user_id);
        // $user->notify(new PengajuanNotifikasi($pengajuan, 'revisi_dikirim', false));

        // // Notifikasi ke staff_polban
        // $staffs = User::where('role_id', 'staff_kemahasiswaan')->get();
        // Notification::send($staffs, new PengajuanNotifikasi($pengajuan, 'revisi_dikirim', true));

        return redirect()->route('mahasiswa.index')->with('success', 'Proses Upload Persuratan Berhasil !');
    }

    public function uploadMOU(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $currentYear = date('Y');
        $folderPath = 'app/PDF/Template_Surat_MOU';
        $publicPath = storage_path($folderPath);
        Storage::makeDirectory($folderPath);

        $filePath = $request->file('file')->move($publicPath,  $currentYear . '_TemplateSuratMOU.pdf') ? $currentYear . '_TemplateSuratMOU.pdf' : 'data gagal terupload';

        // $mahasiswas = User::where('role_id', 'mahasiswa')->get();
        // Notification::send($mahasiswas, new SKTerbitNotifikasi('sk_terbit'));

        return response()->json([
            'message' => 'File berhasil diunggah!',
            'path' => $filePath,
            'year' => $currentYear,
        ]);
    }
    
    public function uploadPersyaratanPengajuan(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $currentYear = date('Y');
        $folderPath = 'PDF/Persyaratan';
        $publicPath = storage_path("app/$folderPath");

        // Pastikan direktori ada
        Storage::disk('local')->makeDirectory($folderPath);

        // Simpan file
        $filePath = $request->file('file')->move($publicPath, $currentYear . '_PersyaratanPengajuan.pdf');

        return response()->json([
            'message' => 'File berhasil diunggah!',
            'path' => $filePath,
            'year' => $currentYear,
        ]);
    }

    // public function deleteSK(Request $request)
    // {
    //     $fileUrl = $request->fileUrl;

    //     // Dapatkan path file relatif terhadap public_path
    //     $relativePath = str_replace(asset(''), '', $fileUrl);

    //     // Path lengkap ke file
    //     $filePath = public_path($relativePath);

    //     // Hapus file jika ada
    //     if (File::exists($filePath)) {
    //         File::delete($filePath);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'File berhasil dihapus.'
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => false,
    //         'message' => 'File tidak ditemukan.'
    //     ], 404);
    // }
}
