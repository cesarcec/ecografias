<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;
    protected $table = 'resultado';
    protected $fillable = [
        'informe',
        'conclusion',
        'recomendacion',
        'fecha',
        'imagen_1',
        'imagen_2',
        'imagen_3',
        'estado',
        'examen_id',
    ];

    public $timestamps = true;

    public function examen() {
        return $this->belongsTo(Examen::class, 'examen_id');
    }
}
