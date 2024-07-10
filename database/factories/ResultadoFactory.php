<?php

namespace Database\Factories;

use App\Models\Examen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resultado>
 */
class ResultadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'informe' => $this->faker->paragraph(),
            'conclusion' => $this->faker->paragraph(),
            'recomendacion' => $this->faker->paragraph(),
            'fecha' => $this->faker->date('Y-m-d'),
            'imagen_1' => $this->faker->firstName(),
            'imagen_2' => $this->faker->firstName(),
            'imagen_3' => $this->faker->firstName(),
            'examen_id' => Examen::all()->random()->id
        ];
    }
}
