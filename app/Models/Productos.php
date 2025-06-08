<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    /** @use HasFactory<\Database\Factories\ProductosFactory> */
    use HasFactory;

    protected $table = 'productos';


    protected $fillable = [
        'proveedor_id',
        'producto_nombre',
        'unidad',
        'precio_compra',
        'notas',
        'estado',
    ];


    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class);
    }

    public function inventario()
    {
        return $this->hasOne(Inventarios::class, 'producto_id', 'id');
    }

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
