<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrdenes extends Model
{
    /** @use HasFactory<\Database\Factories\DetalleOrdenesFactory> */
    use HasFactory;
    protected $table = 'detalle_ordenes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'orden_compra_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
    ];
    
}
