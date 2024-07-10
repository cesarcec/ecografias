<?php

namespace Database\Seeders;

use App\Models\EnvioResultado;
use App\Models\Examen;
use App\Models\OrdenExamen;
use App\Models\Ubicacion;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            UserSeeder::class,
            RecepcionistaSeeder::class,
            DoctorSeeder::class,
            PacienteSeeder::class,
            RepartidorSeeder::class,
            SalaSeeder::class,
            TipoEstudioSeeder::class,
            UbicacionSeeder::class,
            EstudioSeeder::class,
            OrdenExamenSeeder::class,
            ExamenSeeder::class,
            ResultadoSeeder::class,
            EnvioResultadoSeeder::class
        ]);
    }
}
