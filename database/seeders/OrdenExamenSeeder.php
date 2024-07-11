<?php

namespace Database\Seeders;

use App\Models\OrdenExamen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdenExamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrdenExamen::factory()->count(10)->create();
    }
}
