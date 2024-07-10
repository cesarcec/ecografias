<?php

namespace Database\Seeders;

use App\Models\EnvioResultado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnvioResultadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EnvioResultado::factory()->count(10)->create();
    }
}
