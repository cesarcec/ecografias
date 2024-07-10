<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Estudio;
use App\Models\Paciente;
use App\Models\Recepcionista;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrdenExamen>
 */
class OrdenExamenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_cita' => $this->faker->date('Y-m-d'),
            'fecha_programada' => $this->faker->date('Y-m-d'),
            'hora_inicio' => $this->faker->time('H:i:s'),
            'hora_fin' => $this->faker->time('H:i:s'),
            'estado_orden' => 'aceptado',
            'paciente_id' => Paciente::all()->random()->id,
            'recepcionista_id' => Recepcionista::all()->random()->id,
            'doctor_id' => Doctor::all()->random()->id,
            'estudio_id' => Estudio::all()->random()->id

        ];
    }
}
