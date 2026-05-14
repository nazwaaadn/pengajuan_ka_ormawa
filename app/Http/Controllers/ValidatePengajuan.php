<?php

namespace App\Http\Controllers;
use App\Models\Pengajuan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Enums\PengajuanStatus;

class ValidatePengajuan extends Controller
{
    public function validatePengajuanStatus(): JsonResponse
    {
        $menungguVerifikasiCount = Pengajuan::where('status', PengajuanStatus::MenungguVerifikasi->value)->count();
        $perluRevisiCount = Pengajuan::where('status', PengajuanStatus::PerluRevisi->value)->count();
        $MenungguVerifikasiUlang = Pengajuan::where('status', PengajuanStatus::MenungguVerifikasiUlang->value)->count();
        $Diterima = Pengajuan::where('status', PengajuanStatus::Diterima->value)->count();

        if ($menungguVerifikasiCount > 0 || $perluRevisiCount > 0 || $MenungguVerifikasiUlang > 0) {
            return response()->json([
                'success' => false,
                'Menunggu Verifikasi' => $menungguVerifikasiCount,
                'Perlu Revisi' => $perluRevisiCount,
                'Menunggu Verifikasi Ulang' => $MenungguVerifikasiUlang,
                'Diterima' => $Diterima
            ]);
        }
    
        return response()->json(['success' => true]);
    }
}
