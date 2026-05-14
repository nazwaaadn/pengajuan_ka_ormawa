<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\KetuaOrmawa;
use Illuminate\Http\Request;
use App\Enums\PengajuanStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Timeline;  // Import model Timeline

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        $year = date('Y');
        $month = date('n');

        $periodeAktif = $month >= 11
            ? "$year-" . ($year + 1)
            : ($year - 1) . "-$year";

        // Ambil semua data timeline dari database
        $timelines = Timeline::all();

        // Hitung total jumlah ORMAWA
        // $totalOrmawa = KetuaOrmawa::count();

        // Hitung jumlah Ormawa yang sudah mengajukan pengajuan
        // $jumlahDiterima = Pengajuan::where('status', PengajuanStatus::Diterima->value)->count();

        // Hitung jumlah Ormawa yang pengajuannya belum disetujui
        // $jumlahBelumDisetujui = Pengajuan::whereIn('status', [
        //     PengajuanStatus::MenungguVerifikasi->value,
        //     PengajuanStatus::PerluRevisi->value,
        //     PengajuanStatus::MenungguVerifikasiUlang->value
        // ])->count();

        // Ambil data Ormawa yang belum mengajukan pengajuan
        // $ormawaBelumMengajukan = DB::table('ketua_ormawa')
        //     ->leftJoin('pengajuans', 'ketua_ormawa.nama_ketua', '=', 'pengajuans.ketua_ormawa')
        //     ->whereNull('pengajuans.id') // Hanya ambil Ormawa yang belum ada pengajuannya
        //     ->get();

        // Ambil data pengajuan yang belum disetujui
        // $pengajuanBelumDisetujui = Pengajuan::whereIn('status', [
        //     PengajuanStatus::MenungguVerifikasi->value,
        //     PengajuanStatus::PerluRevisi->value,
        //     PengajuanStatus::MenungguVerifikasiUlang->value,
        // ])->get();

        // Gabungkan data Ormawa yang belum mengajukan dan pengajuan yang belum disetujui
        // $allOrmawaBelumDisetujui = $ormawaBelumMengajukan->merge($pengajuanBelumDisetujui);

        // Ambil user login
        $userId = Auth::id();

        // ------------------------------------------
        // 🔥 2. Pengajuan mahasiswa HANYA untuk periode aktif
        // ------------------------------------------
        $exists = Pengajuan::where('user_id', $userId)
            ->where('periode', $periodeAktif)
            ->exists();

        $pengajuan = Pengajuan::where('user_id', $userId)
            ->where('periode', $periodeAktif)
            ->select('id', 'nim', 'status')
            ->first();
        // ------------------------------------------

        // Status selain diterima
        $statusKecuali = [
            PengajuanStatus::MenungguVerifikasi,
            PengajuanStatus::PerluRevisi,
            PengajuanStatus::MenungguVerifikasiUlang,
        ];

        // ------------------------------------------
        // 🔥 3. Filter ormawa yang belum mengajukan untuk PERIODE AKTIF
        // ------------------------------------------
        $ketuaOrmawas = KetuaOrmawa::with(['pengajuans' => function ($q) use ($periodeAktif) {
            $q->where('periode', $periodeAktif);
        }])->get();

        $filteredOrmawas = $ketuaOrmawas->filter(function ($ketuaOrmawa) use ($statusKecuali) {

            // Jika tidak punya pengajuan sama sekali → belum mengajukan
            if ($ketuaOrmawa->pengajuans->isEmpty()) {
                return true;
            }

            // Jika ada pengajuan diterima → tidak termasuk
            $pengajuanTelahDiterima = $ketuaOrmawa->pengajuans->contains(function ($p) {
                return $p->status === PengajuanStatus::Diterima;
            });

            if ($pengajuanTelahDiterima) {
                return false;
            }

            // Jika statusnya hanya status pending/revisi → masih belum diterima
            return $ketuaOrmawa->pengajuans->contains(function ($p) use ($statusKecuali) {
                return in_array($p->status, $statusKecuali);
            });
        });

        $totalBelumMengajukan = $filteredOrmawas->count();
        // ------------------------------------------

        return view('dashboardmahasiswa', [
            'exists' => $exists,
            'pengajuan' => $pengajuan,
            'totalOrmawaBelumMengajukan' => $totalBelumMengajukan,
            'allOrmawaBelumDisetujui' => $filteredOrmawas,
            'timelines' => $timelines,
            'periodeAktif' => $periodeAktif, // optional: ditampilkan di view
        ]);
    }
}

