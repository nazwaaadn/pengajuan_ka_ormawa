<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained(
                table : 'pengajuans',
                indexName: 'berkas_pengajuan_id'
            );
            $table->string('scan_ktp');
            $table->string('surat_sehat');
            $table->string('surat_rekomendasi_jurusan');
            $table->string('transkip_rekomendasi_jurusan');
            $table->string('sertifikat_lkmm');
            $table->string('sertifikat_pelatihan_kepemimpinan');
            $table->string('sertifikat_pelatihan_emosional_spiritual');
            $table->string('sertifikat_bahasa_asing');
            $table->string('scan_ktm');
            $table->string('surat_keterangan_berkelakuan_baik');
            $table->string('surat_penyataan_mandiri');
            $table->string('sertifikat_pkkmb');
            $table->string('sertifikat_bela_negara');
            $table->string('sertifikat_agent_of_change');
            $table->string('sertifikat_berorganisasi');
            $table->string('berita_acara_pemilihan');
            $table->string('surat_pernyataan');
            $table->string('surat_perjanjian');
            $table->string('surat_mou');
            $table->string('surat_kak');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
