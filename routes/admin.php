<?php

use App\Http\Controllers\Admin\categoriaProductosController;
use App\Http\Controllers\Admin\ProveedoresController;
use Illuminate\Support\Facades\Route;

Route::resource('categoriaProductos',categoriaProductosController::class);
Route::resource('proveedores', ProveedoresController::class)->parameters([
    'proveedores' => 'proveedores'
]);