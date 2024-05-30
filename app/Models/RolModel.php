<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolModel extends Model
{
    use HasFactory;

    protected $table = 'rol'; // Nombre de la tabla
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'estado'
    ];

    public $timestamps = true;

    /**
     * Relación con el modelo User
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
