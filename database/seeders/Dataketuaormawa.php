<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KetuaOrmawa;


class Dataketuaormawa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ketuas = [
            ['nama_ketua' => 'UKM Assalam', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Bela Diri', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Bola Basket', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Bola Voli', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Bulutangkis', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Catur', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Kabayan', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM KMK', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Kewirausahaan', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM KSR PMI', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Musik dan Theater', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Otomotif', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM PSM', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM (PPRPG) SAGA', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM PMK', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Pramuka', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Robotika', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Sepak Bola dan Futsal', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM ELTRAS', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM UBSU', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM UKBM', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Fellas', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Flag Football', 'ormawa_id' => 1],
            ['nama_ketua' => 'UKM Tenis Meja', 'ormawa_id' => 1],
            ['nama_ketua' => 'BEM', 'ormawa_id' => 2],
            ['nama_ketua' => 'MPM', 'ormawa_id' => 2],
            ['nama_ketua' => 'HMJ Administrasi Niaga', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Akuntansi', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Bahasa Inggris', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Elektro', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Kimia', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Komputer dan Informatika', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Konversi Energi', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Mesin', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Refrigrasi dan Tata Udara', 'ormawa_id' => 3],
            ['nama_ketua' => 'HMJ Teknik Sipil', 'ormawa_id' => 3],
            ['nama_ketua' => 'UKM E-Sport', 'ormawa_id' => 1],
            ['nama_ketua' => 'HMJ TES 2', 'ormawa_id' => 3],
        ];

        KetuaOrmawa::insert($ketuas);
    }
}
