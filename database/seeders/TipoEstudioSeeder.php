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
            'nombre' => 'Rayos X'
        ]);

        TipoEstudio::create([
            'nombre' => 'Tomografia'
        ]);

        
        TipoEstudio::create([
            'nombre' => 'Ecografia'
        ]);
    }
}
