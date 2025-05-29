<?php

namespace Database\Factories;

use App\Models\Proveedores;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrdenesCompra>
 */
class OrdenesCompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'proveedor_id' => Proveedores::all()->random()->id,
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            
        ];
    }
}
