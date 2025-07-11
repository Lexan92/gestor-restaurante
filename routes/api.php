<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InventariosApiController;
use App\Http\Controllers\Api\ProveedoresApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('inventarios', InventariosApiController::class);
    Route::apiResource('proveedores', ProveedoresApiController::class);
});

Route::post('/auth/login', [AuthController::class, 'login']);
