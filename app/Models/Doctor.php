<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'genero',
        'especialidad',
        'user_id',
        'estado',
    ];

    public $timestamps = true;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
