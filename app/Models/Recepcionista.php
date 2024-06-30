<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcionista extends Model
{
    use HasFactory;
    protected $table = 'recepcionista';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'user_id',
        'estado',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
