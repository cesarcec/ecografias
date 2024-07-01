<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoEstudio;

class Estudio extends Model
{
    use HasFactory;
    protected $table = 'estudio';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'descripcion',
        'requerimientos',
        'precio',
        'estado',
        'tipo_estudio_id',
    ];

    public $timestamps = true;

    public function tipoEstudio()
    {
        return $this->belongsTo(TipoEstudio::class, 'tipo_estudio_id');
    }
}
