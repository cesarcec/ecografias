<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEstudio extends Model
{
    use HasFactory;
    protected $table = 'tipo_estudio';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'estado'
    ];

    public $timestamps = true;

    public function estudios()
    {
        return $this->hasMany(Estudio::class, 'tipo_estudio_id');
    }
}
