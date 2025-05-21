<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    /** @use HasFactory<\Database\Factories\ProductosFactory> */
    use HasFactory;

        protected $table = 'products';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'producto_nombre',
        'precio_producto',
        'cantidad_producto',
        'unidad_medida',
        'descripcion',
        'stock_actual',
        'stock_minimo',
        'notas',
        'fecha_ultima_actualizacion_stock',
        'categoria_productos_id_categoria'
    ];

    protected $casts = [
        'precio_producto' => 'decimal:2',
        'fecha_ultima_actualizacion_stock' => 'datetime',
    ];

    // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(CategoriaProductos::class, 'categoria_productos_id_categoria', 'id_categoria');
    }

    // Scope para productos con bajo stock
    public function scopeBajoStock($query)
    {
        return $query->whereColumn('stock_actual', '<=', 'stock_minimo');
    }

    // Scope para buscar por nombre
    public function scopeNombreLike($query, $nombre)
    {
        return $query->where('producto_nombre', 'LIKE', "%{$nombre}%");
    }
}
