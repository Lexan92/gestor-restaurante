<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProductos extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaProductosFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre_categoria',
        'descripcion',
    ];
}
