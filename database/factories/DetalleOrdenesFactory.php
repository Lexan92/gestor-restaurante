<?php

namespace Database\Factories;

use App\Models\OrdenesCompra;
use App\Models\Productos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleOrdenes>
 */
class DetalleOrdenesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'orden_compra_id' => OrdenesCompra::all()->random()->id,
            'producto_id' => Productos::all()->random()->id,
            'cantidad' => $this->faker->numberBetween(1, 100),
            'precio_unitario' => $this->faker->randomFloat(2, 1, 1000),
            

        ];
    }
}
