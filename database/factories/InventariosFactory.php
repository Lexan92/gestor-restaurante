<?php

namespace Database\Factories;

use App\Models\Productos;
use App\Models\Proveedores;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventarios>
 */
class InventariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'producto_id' => Productos::all()->random()->id,
            'proveedor_id' => Proveedores::all()->random()->id,
            'cantidad' => $this->faker->numberBetween(1, 100),
            'cantidad_minima' => $this->faker->numberBetween(1, 10),
            
        ];
    }
}
