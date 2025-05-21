<?php

use App\Http\Controllers\Admin\categoriaProductosController;
use Illuminate\Support\Facades\Route;

Route::resource('categoriaProductos',categoriaProductosController::class);