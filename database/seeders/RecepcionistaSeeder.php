<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recepcionista;

class RecepcionistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recepcionista::create([
            'nombre' => 'Administrador',
            'paterno' => 'Sistema',
            'materno' => 'SN',
            'user_id' => '1',
        ]);

      /*  Recepcionista::create([
            'nombre' => 'Administrador2',
            'paterno' => 'Sistema',
            'materno' => 'SN',
            'user_id' => '2',
        ]);*/

        ////
        Recepcionista::create([
            'nombre' => 'Lucia',
            'paterno' => 'Carrazco',
            'materno' => 'Torrez',
            'user_id' => '2',
        ]);

    }
}
