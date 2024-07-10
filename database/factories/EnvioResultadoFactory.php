<?php

namespace Database\Factories;

use App\Models\Repartidor;
use App\Models\Resultado;
use App\Models\Ubicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EnvioResultado>
 */
class EnvioResultadoFactory extends Factory
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
            'estado_envio' => 'pendiente',
            'resultado_id' => Resultado::all()->random()->id,
            'ubicacion_id' => Ubicacion::all()->random()->id,
            'repartidor_id' => Repartidor::all()->random()->id
        ];
    }
}
