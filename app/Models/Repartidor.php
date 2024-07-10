<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repartidor extends Model
{
    use HasFactory;
    protected $table = 'repartidor';
    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'telefono',
        'licencia_conducir',
        'user_id',
        'estado',
    ];

    public $timestamps = true;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function envios()
    {
        return $this->hasMany(EnvioResultado::class, 'repartidor_id');
    }

    public function envioResultados() {
        return $this->hasMany(EnvioResultado::class, 'repartidor_id');
    }
}
