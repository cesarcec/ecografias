<?php

namespace Database\Factories;

use App\Models\OrdenExamen;
use App\Models\Sala;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Examen>
 */
class ExamenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->date('Y-m-d'),
            'observaciones' => $this->faker->paragraph(),
            'orden_examen_id' => OrdenExamen::all()->random()->id,
            'sala_id' => Sala::all()->random()->id
        ];
    }
}
