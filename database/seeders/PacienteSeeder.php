<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paciente::create([
            'nombre' => 'Paciente 1 ',
            'paterno' => 'Vaca',
            'materno' => 'Gonzales',
            'fecha_nacimiento' => '2000-09-19',
            // 'direccion' => 'S/D',
            'genero' => 'M',
            'user_id' => '4',
        ]);
    }
}
