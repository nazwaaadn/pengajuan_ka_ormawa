<?php  
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ormawa extends Model
{
    use HasFactory;

    protected $table = 'ormawa';
    protected $primaryKey = 'id_ormawa';
    protected $fillable = ['nama_ormawa'];

    public function ketua_ormawa():HasMany
    {
        return $this->hasMany(KetuaOrmawa::class, 'ormawa_id', 'id_ormawa');
    }
}
