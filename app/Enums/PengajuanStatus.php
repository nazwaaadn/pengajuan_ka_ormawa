<?php

namespace App\Enums;

enum PengajuanStatus: string
{   
    case MenungguVerifikasi = 'Menunggu Verifikasi';
    case Diterima = 'Diterima';
    case PerluRevisi = 'Perlu Revisi';
    case MenungguVerifikasiUlang = 'Menunggu Verifikasi Ulang';
}


