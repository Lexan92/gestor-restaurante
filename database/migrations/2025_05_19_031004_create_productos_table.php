<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('producto_nombre', 80);
            $table->foreignId('proveedor_id')->constrained('proveedores');
            $table->text('unidad')->nullable();
            $table->decimal('precio_compra', 10, 2)->nullable()->default(0.00);
            $table->text('notas')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();

            // Índices adicionales para mejor rendimiento
            $table->index('producto_nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
