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
            'nombre' => 'Administrador',
        ]);

        Rol::create([
            'nombre' => 'Recepcionista',
        ]);

        Rol::create([
            'nombre' => 'Doctor',
        ]);

        Rol::create([
            'nombre' => 'Paciente',
        ]);

        Rol::create([
            'nombre' => 'Repartidor',
        ]);
    }
}
