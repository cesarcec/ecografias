<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sala;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sala::create([
            'nombre' => 'Sala 1'
        ]);

        Sala::create([
            'nombre' => 'Sala 2'
        ]);
    }
}
