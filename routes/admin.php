<?php

use App\Http\Controllers\Admin\categoriaProductosController;
use App\Http\Controllers\Admin\InventariosController;
use App\Http\Controllers\Admin\ProductosController;
use App\Http\Controllers\Admin\ProveedoresController;
use App\Http\Controllers\Admin\OrdenesCompraController;
use App\Models\DetalleOrdenes;

use Illuminate\Support\Facades\Route;

Route::resource('categoriaProductos',categoriaProductosController::class);
Route::resource('proveedores', ProveedoresController::class);
Route::resource('productos', ProductosController::class)->parameters([
    'productos' => 'productos'
]);
Route::resource('inventarios', InventariosController::class);
Route::resource('ordenesCompras', OrdenesCompraController::class);
Route::resource('detalleOrdenesCompras', DetalleOrdenes::class);
Route::post('/admin/ordenes-compras/{proveedor}', [OrdenesCompraController::class, 'generarOrden'])->name('admin.ordenesCompras.pdf');
