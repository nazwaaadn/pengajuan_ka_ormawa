<?php

namespace Database\Seeders;

use App\Models\Pengajuan;
use Illuminate\Database\Seeder;

class PengajuanSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $ketuaOrmawaList = [
            ['nama_ketua' => 'BEM', 'ormawa_id' => 2],
            ['nama_ketua' => 'MPM', 'ormawa_id' => 2],

            ['nama_ketua' => 'HMJ Administrasi Niaga', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Akuntansi', 'ormawa_id' => 3], // PERLU REVISI
            ['nama_ketua' => 'HMJ Bahasa Inggris', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Elektro', 'ormawa_id' => 3], // EXCLUDED
            ['nama_ketua' => 'HMJ Teknik Kimia', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Komputer dan Informatika', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Konversi Energi', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Mesin', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Refrigrasi dan Tata Udara', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Sipil', 'ormawa_id' => 3], // PERLU REVISI
            ['nama_ketua' => 'HMJ TES 1', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ TES 2', 'ormawa_id' => 3],
           
        ];

        // ❌ Ormawa yang tidak dibuat pengajuan
        $excluded = [
            'UKM Tenis Meja',
            'HMJ Teknik Elektro',
            'UKM Bulutangkis',
            'UKM Pramuka',
            'UKM E-SPORT', // tidak ada di list, tetap aman
        ];

        // ⚠ Ormawa dengan status Perlu Revisi
        $needRevision = [
            'HMJ Teknik Sipil',
            'HMJ Akuntansi',
            'UKM PMK',
            'UKM Sepak Bola dan Futsal',
            'UKM Fellas',
        ];

        $pengajuans = [];
        $nimBase = 50000;

        foreach ($ketuaOrmawaList as $i => $ketua) {

            // Skip jika termasuk excluded
            if (in_array($ketua['nama_ketua'], $excluded)) {
                continue;
            }

            // Tentukan nama ormawa berdasarkan ormawa_id
            $ormawaNama = match ($ketua['ormawa_id']) {
                1 => 'UKM',
                2 => $ketua['nama_ketua'], // BEM / MPM
                3 => 'HMJ',
                default => '-',
            };

            // Tentukan status
            $status = in_array($ketua['nama_ketua'], $needRevision)
                ? 'Perlu Revisi'
                : 'Menunggu Verifikasi';

            $pengajuans[] = [
                'id' => '50' . ($i),
                'nama' => 'Dummy ' . $ketua['nama_ketua'],
                'nim' => (string)($nimBase + $i),
                'jurusan' => 'Dummy Jurusan',
                'prodi' => 'Dummy Prodi',
                'ormawa' => $ormawaNama,
                'ketua_ormawa' => $ketua['nama_ketua'],
                'periode' => '2025-2026',
                'telp' => '6281' . (10000 + $i),
                'email' => strtolower(str_replace([' ', '(', ')'], ['', '', ''], $ketua['nama_ketua'])) . '@example.com',
                'status' => $status,
                'keterangan' => 'Kosong',
                'user_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Pengajuan::insert($pengajuans);
    }
}
