<?php

namespace Database\Factories;

use App\Models\CategoriaProductos;
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
            'producto_nombre' => $this->faker->unique()->words(3, true),
            'precio_producto' => $this->faker->randomFloat(2, 1, 1000),
            'cantidad_producto' => $this->faker->numberBetween(0, 100),
            'unidad_medida' => $this->faker->randomElement(['kg', 'g', 'lt', 'ml', 'unid']),
            'descripcion' => $this->faker->sentence(),
            'stock_actual' => $this->faker->numberBetween(0, 500),
            'stock_minimo' => $this->faker->numberBetween(5, 50),
            'notas' => $this->faker->optional()->word(),
            'fecha_ultima_actualizacion_stock' => $this->faker->dateTimeThisYear(),
            'categoria_productos_id_categoria' => CategoriaProductos::all()->random()->id_categoria,
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
        ];
    }
}
