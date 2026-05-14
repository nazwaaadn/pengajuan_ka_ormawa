<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KetuaOrmawa extends Model
{
    use HasFactory;

    protected $table = 'ketua_ormawa';
    protected $primaryKey = 'id_ketua_ormawa';
    protected $fillable = ['nama_ketua', 'ormawa_id'];

    public function ormawa(): BelongsTo
    {
        return $this->belongsTo(Ormawa::class, 'ormawa_id', 'id_ormawa');
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'ketua_ormawa', 'nama_ketua');
    }
}
