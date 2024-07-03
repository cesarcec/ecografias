<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdenExamen;
use App\Models\Sala;
use App\Models\Resultado;

class Examen extends Model
{
    use HasFactory;
    protected $table = 'examen';
    protected $fillable = [
        'observaciones',
        'fecha',
        'estado',
        'orden_examen_id',
        'sala_id',
    ];

    public $timestamps = true;

    public function ordenExamen () {
        return $this->belongsTo(OrdenExamen::class, 'orden_examen_id');
    }

    public function sala () {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    public function resultadoExamen() {
        return $this->hasOne(Resultado::class);
    }
}
