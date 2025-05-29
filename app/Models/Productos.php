<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    /** @use HasFactory<\Database\Factories\ProductosFactory> */
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'producto_nombre',
        'proveedor_id',
        'unidad',
        'notas',
        'estado',
    ];


    // Scope para buscar por nombre
    public function scopeNombreLike($query, $nombre)
    {
        return $query->where('producto_nombre', 'LIKE', "%{$nombre}%");
    }

    public function scopeActive($query)
    {
        return $query->where('estado', 'activo');
    }
}
