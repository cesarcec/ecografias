<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\Recepcionista;
use App\Models\Doctor;
use App\Models\Estudio;

class OrdenExamen extends Model
{
    use HasFactory;
    protected $table = 'orden_examen';
    protected $fillable = [
        'fecha_cita',
        'fecha_programada',
        'hora_inicio',
        'hora_fin',
        'estado_orden',
        'paciente_id',
        'recepcionista_id',
        'doctor_id',
        'estudio_id',
        'estado',
    ];

    public $timestamps = true;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function recepcionista()
    {
        return $this->belongsTo(Recepcionista::class, 'recepcionista_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function estudio()
    {
        return $this->belongsTo(Estudio::class);
    }

    public function examenes() {
        return $this->hasMany(Examen::class, 'orden_examen_id');
    }
}
