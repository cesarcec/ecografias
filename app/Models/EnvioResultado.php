<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioResultado extends Model
{
    use HasFactory;
    protected $table = 'envio_resultado';
    protected $fillable = [
        'fecha',
        'estado_envio',
        'resultado_id',
        'ubicacion_id',
        'repartidor_id',
        'estado',
    ];

    public function resultado()
    {
        return $this->belongsTo(Resultado::class, 'resultado_id');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }

    public function repartidor()
    {
        return $this->belongsTo(Repartidor::class, 'repartidor_id');
    }
}
