<?php

namespace Database\Seeders;

use App\Models\categoriaProductos;
use App\Models\DetalleOrdenes;
use App\Models\Inventarios;
use App\Models\OrdenesCompra;
use App\Models\Productos;
use App\Models\Proveedores;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use OCILob;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('123456789'),
        ]);

        CategoriaProductos::factory(5)->create();
        Proveedores::factory(10)->create();
        Productos::factory(50)->create();
       // Inventarios::factory(200)->create();
        OrdenesCompra::factory(10)->create();
        DetalleOrdenes::factory(50)->create();

        $this->call(InventariosSeeder::class);
    }
}
