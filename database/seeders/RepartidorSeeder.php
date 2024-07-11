<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Repartidor;

class RepartidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Repartidor::create([
            'nombre' => 'Ronald',
            'paterno' => 'Flores',
            'materno' => 'Del Campo',
            'telefono' => '69875412',
            'licencia_conducir' => '13025887 M',
            'user_id' => '5',
        ]);
    }
}
