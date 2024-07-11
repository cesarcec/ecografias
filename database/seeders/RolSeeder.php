<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::create([
            'id' => 1,
            'nombre' => 'Administrador',
        ]);

        Rol::create([
            'id' => 2,
            'nombre' => 'Recepcionista',
        ]);

        Rol::create([
            'id' => 3,
            'nombre' => 'Doctor',
        ]);

        Rol::create([
            'id' => 4,
            'nombre' => 'Paciente',
        ]);

        Rol::create([
            'id' => 5,
            'nombre' => 'Repartidor',
        ]);
    }
}
