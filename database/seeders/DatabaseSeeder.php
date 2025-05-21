<?php

namespace Database\Seeders;

use App\Models\categoriaProductos;
use App\Models\Productos;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        Productos::factory(20)->create();
    }
}
