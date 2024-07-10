<?php

namespace Database\Seeders;

use App\Models\Estudio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estudio::factory()->count(10)->create();
    }
}
