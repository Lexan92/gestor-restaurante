<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Proveedores;
use App\Models\Inventarios;

class InventariosSeeder extends Seeder
{
    public function run()
    {
        foreach (Proveedores::with('productos')->get() as $proveedor) {
            foreach ($proveedor->productos as $producto) {
                Inventarios::firstOrCreate(
                    [
                        'producto_id' => $producto->id,
                        'proveedor_id' => $proveedor->id,
                    ],
                    [
                        'cantidad' => rand(1, 100),
                        'cantidad_minima' => rand(1, 10),
                    ]
                );
            }
        }
    }
}