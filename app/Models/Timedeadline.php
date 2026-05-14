<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timedeadline extends Model
{
    use HasFactory;

    protected $table = 'timedeadline'; // Pastikan nama tabel benar
    protected $fillable = [
        'submission_start_time',
        'submission_end_time',
    ];
}
