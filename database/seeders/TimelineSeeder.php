<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timelines')->insert([
            [
                'judul_timeline' => 'Pendaftaran Calon Ketua ORMAWA',
                'tanggal_timeline_awal' => '2025-01-01',
                'tanggal_timeline_akhir' => '2025-01-15',
            ],
            [
                'judul_timeline' => 'Verifikasi Calon Ketua ORMAWA',
                'tanggal_timeline_awal' => '2025-01-01',
                'tanggal_timeline_akhir' => '2025-01-15',
            ],
            [
                'judul_timeline' => 'Peresmian Ketua ORMAWA',
                'tanggal_timeline_awal' => '2025-01-16',
                'tanggal_timeline_akhir' => '2025-01-16',
            ],
            // Tambahkan data lainnya jika diperlukan
        ]);
    }
}
