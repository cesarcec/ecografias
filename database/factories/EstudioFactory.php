<?php

namespace Database\Factories;

use App\Models\TipoEstudio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudio>
 */
class EstudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'descripcion' => $this->faker->paragraph(),
            'requerimientos' => $this->faker->firstName(),
            'precio' => $this->faker->randomFloat(2, 1, 100),
            'tipo_estudio_id' =>  TipoEstudio::all()->random()->id
        ];
    }
}
