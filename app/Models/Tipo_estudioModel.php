<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_estudioModel extends Model
{
    use HasFactory;
    protected $table = 'tipo_estudio';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'estado'
    ];

    public $timestamps = true;
}
