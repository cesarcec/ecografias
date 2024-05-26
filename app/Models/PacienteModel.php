<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteModel extends Model
{
    use HasFactory;
    protected $table = 'paciente';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'genero',
        'fecha_nacimiento',
        'estado'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
