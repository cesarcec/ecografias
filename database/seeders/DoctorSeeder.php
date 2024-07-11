<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;


class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::create([
            'nombre' => 'Liliana',
            'paterno' => 'Fernandez',
            'materno' => 'Ortega',
            'especialidad' => 'Tomografia',
            'genero' => 'F',
            'user_id' => '3',
        ]);
/*
        Doctor::create([
            'nombre' => 'Carlos',
            'paterno' => 'Colon',
            'materno' => 'Rosales',
            'especialidad' => 'Ecografia',
            'genero' => 'M',
            'user_id' => '6',
        ]);

        Doctor::create([
            'nombre' => 'Pedro',
            'paterno' => 'Perez',
            'materno' => 'Jimenez',
            'especialidad' => 'Rayos X',
            'genero' => 'M',
            'user_id' => '7',
        ]);*/
    }
}
