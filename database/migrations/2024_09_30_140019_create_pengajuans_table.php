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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->text('nama');
            $table->text('nim')->unique();
            $table->text('jurusan');
            $table->string('prodi');
            $table->text('ormawa');
            $table->text('ketua_ormawa');
            $table->text('periode');
            $table->text('telp');
            $table->text('email');
            $table->enum('status', ['Menunggu Verifikasi', 'Diterima', 'Perlu Revisi', 'Menunggu Verifikasi Ulang'])->default('Menunggu Verifikasi');
            $table->text('keterangan')->default('Kosong');
            $table->foreignId('user_id')
            ->nullable() // Penting agar kolom bisa diset null
            ->constrained('users')
            ->onDelete('set null');
            $table->unique('user_id');
            $table->timestamps();
        });
    }

    public function constraint(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            // Hapus foreign key yang ada
            $table->dropForeign('pengajuan_user_id');

            // Tambahkan foreign key baru dengan aturan SET NULL
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
