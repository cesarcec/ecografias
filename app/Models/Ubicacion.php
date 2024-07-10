<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $table = 'ubicacion';
=======

    protected $table = 'ubicacion';
    protected $primaryKey = 'id';
>>>>>>> 09431d3243e15b2cd18f312f8e1699d11d066835
    protected $fillable = [
        'latitud',
        'longitud',
        'referencia',
<<<<<<< HEAD
=======
        'estado'
>>>>>>> 09431d3243e15b2cd18f312f8e1699d11d066835
    ];

    public $timestamps = true;
}
