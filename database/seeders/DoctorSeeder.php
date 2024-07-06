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
            'nombre' => 'Doctor 1 ',
            'paterno' => 'Vargas',
            'materno' => 'Espinoza',
            'especialidad' => 'Cirugia',
            'genero' => 'M',
            'user_id' => '3',
        ]);
    }
}
