<?php

namespace App\Models;

use App\Enums\PengajuanStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Pengajuan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'pengajuans';
    protected $fillable = [
        'nama',
        'nim',
        'jurusan',
        'prodi',
        'ormawa',
        'ketua_ormawa',
        'periode',
        'telp',
        'email',
        'status',
        'keterangan',
        'user_id'
    ];

    protected $casts = [
        'status' => PengajuanStatus::class,
    ];

    public function berkas(): HasOne
    {
        return $this->hasOne(Berkas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function ketuaOrmawa()
    {
        return $this->belongsTo(KetuaOrmawa::class, 'ketua_ormawa', 'nama_ketua');
    }
}
