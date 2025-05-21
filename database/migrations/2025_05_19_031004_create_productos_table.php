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
            $table->decimal('precio_producto', 10, 2);
            $table->integer('cantidad_producto');
            $table->string('unidad_medida', 45);
            $table->string('descripcion', 255)->nullable();
            $table->integer('stock_actual');
            $table->integer('stock_minimo');
            $table->string('notas', 45)->nullable();
            $table->dateTime('fecha_ultima_actualizacion_stock');
            $table->foreign('id_categoria')
          ->references('id_categoria')
          ->on('categoria_productos')
          ->const;
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
            
            // Índices adicionales para mejor rendimiento
            $table->index('producto_nombre');
            $table->index('stock_actual');
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
