<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoriaProductos>
 */
class CategoriaProductosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_categoria' => $this->faker->word(),
            'descripcion' => $this->faker->word(),
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
        ];
    }
}
