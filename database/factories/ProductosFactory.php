<?php

namespace Database\Factories;

use App\Models\Proveedores;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Productos>
 */
class ProductosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'producto_nombre' => $this->faker->word(),
            'proveedor_id' => Proveedores::all()->random()->id,
            'unidad' => $this->faker->randomElement(['kg', 'g', 'l', 'ml']),
            'precio_compra' => $this->faker->randomFloat(2, 1, 1000), // Precio entre 1 y 1000 con 2 decimales
            'notas' => $this->faker->sentence(),
            'estado' => 'activo', // Estado por defecto
        ];
    }
}
