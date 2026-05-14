<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ormawa;
use App\Models\Prodi;
use App\Models\Jurusan;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            ['nama_jurusan' => 'Teknik Sipil'],
            ['nama_jurusan' => 'Teknik Mesin'],
            ['nama_jurusan' => 'Teknik Refrigasi dan tata udara'],
            ['nama_jurusan' => 'Teknik Konversi Energi'],
            ['nama_jurusan' => 'Teknik Elektro'],
            ['nama_jurusan' => 'Teknik Kimia'],
            ['nama_jurusan' => 'Teknik Komputer dan Informatika'],
            ['nama_jurusan' => 'Akutansi'],
            ['nama_jurusan' => 'Administrasi Niaga'],
            ['nama_jurusan' => 'Bahasa Inggris'],
        ];

        // Insert data ke tabel jurusan
        Jurusan::insert($jurusans);
        $prodis = [
            // Teknik Sipil
            ['nama_prodi' => 'D-3 Teknik Konstruksi Sipil', 'jurusan_id' => 1],
            ['nama_prodi' => 'D-3 Teknik Konstruksi Gedung', 'jurusan_id' => 1],
            ['nama_prodi' => 'D-4 Teknik Perancangan Jalan dan Jembatan', 'jurusan_id' => 1],
            ['nama_prodi' => 'D-4 Teknik Perawatan dan Perbaikan Gedung', 'jurusan_id' => 1],
            // Teknik Mesin
            ['nama_prodi' => 'D-3 Teknik Mesin', 'jurusan_id' => 2],
            ['nama_prodi' => 'D-3 Teknik Aeronautika', 'jurusan_id' => 2],
            ['nama_prodi' => 'D-4 Teknik Perancangan dan Konstruksi Mesin ', 'jurusan_id' => 2],
            ['nama_prodi' => 'D-4 Proses Manufaktur', 'jurusan_id' => 2],
            // Teknik Refrigasi dan tata udara
            ['nama_prodi' => 'D-3 Teknik Pendingin dan Tata Udara', 'jurusan_id' => 3],
            ['nama_prodi' => 'D-4 Teknik Pendingin dan Tata Udara', 'jurusan_id' => 3],
            // Teknik Konversi Energi
            ['nama_prodi' => 'D-3 Teknik Konversi Energi', 'jurusan_id' => 4],
            ['nama_prodi' => 'D-4 Teknologi Pembangkit Tenaga Listrik', 'jurusan_id' => 4],
            ['nama_prodi' => 'D-4 Teknik Konservasi Energi', 'jurusan_id' => 4],
            // Teknik Elektro
            ['nama_prodi' => 'D-3 Teknik Elektronika', 'jurusan_id' => 5],
            ['nama_prodi' => 'D-3 Teknik Listrik', 'jurusan_id' => 5],
            ['nama_prodi' => 'D-3 Teknik Telekomunikasi', 'jurusan_id' => 5],
            ['nama_prodi' => 'D-4 Teknik Elektronika', 'jurusan_id' => 5],
            ['nama_prodi' => 'D-4 Teknik Telekomunikasi', 'jurusan_id' => 5],
            ['nama_prodi' => 'D-4 Teknik Otomasi Industri', 'jurusan_id' => 5],
            // Teknik Kimia
            ['nama_prodi' => 'D-3 Teknik Kimia', 'jurusan_id' => 6],
            ['nama_prodi' => 'D-3 Analis Kimia', 'jurusan_id' => 6],
            ['nama_prodi' => 'D-4 Teknik Kimia Produksi Bersih', 'jurusan_id' => 6],
            // Teknik Komputer dan Informatika
            ['nama_prodi' => 'D-3 Teknik Informatika', 'jurusan_id' => 7],
            ['nama_prodi' => 'D-4 Teknik Informatika', 'jurusan_id' => 7],
            // Akutansi
            ['nama_prodi' => 'D-3 Akuntansi', 'jurusan_id' => 8],
            ['nama_prodi' => 'D-3 Keuangan dan Perbankan', 'jurusan_id' => 8],
            ['nama_prodi' => 'D-4 Akuntansi Manajemen Pemerintahan', 'jurusan_id' => 8],
            ['nama_prodi' => 'D-4 Akuntansi', 'jurusan_id' => 8],
            ['nama_prodi' => 'D-4 Keuangan Syariah', 'jurusan_id' => 8],
            // Administrasi Niaga
            ['nama_prodi' => 'D-3 Administrasi Bisnis', 'jurusan_id' => 9],
            ['nama_prodi' => 'D-3 Manajemen Pemasaran', 'jurusan_id' => 9],
            ['nama_prodi' => 'D-3 Usaha Perjalanan Wisata', 'jurusan_id' => 9],
            ['nama_prodi' => 'D-3 Manajemen Aset', 'jurusan_id' => 9],
            ['nama_prodi' => 'D-4 Manajemen Aset', 'jurusan_id' => 9],
            ['nama_prodi' => 'D-4 Administrasi Bisnis', 'jurusan_id' => 9],
            ['nama_prodi' => 'D-4 Manajemen Pemasaran', 'jurusan_id' => 9],
            ['nama_prodi' => 'D-4 Destinasi Pariwisata', 'jurusan_id' => 9],
            // Bahasa Inggris
            ['nama_prodi' => 'D-3 Bahasa Inggris', 'jurusan_id' => 10],
        ];

        // Insert data ke tabel prodi
        Prodi::insert($prodis);

        $ormawaData = [
            ['id_ormawa' => 1, 'nama_ormawa' => 'UKM',],
            ['id_ormawa' => 2, 'nama_ormawa' => 'BEM&MPM'],
            ['id_ormawa' => 3, 'nama_ormawa' => 'HMJ'],
        ];

        // Menggunakan Eloquent untuk menyimpan data
        foreach ($ormawaData as $data) {
            Ormawa::create($data);
        }
    }
}
	