<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';
    protected $primaryKey = 'id_jurusan';
    protected $fillable = ['nama_jurusan'];

    public function prodis():HasMany
    {
        return $this->hasMany(Prodi::class, 'jurusan_id');
    }
}

