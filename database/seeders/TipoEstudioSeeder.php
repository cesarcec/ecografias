<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoEstudio;

class TipoEstudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoEstudio::create([
            'nombre' => 'Tipo estudio 1'
        ]);

        TipoEstudio::create([
            'nombre' => 'Tipo estudio 2'
        ]);
    }
}
