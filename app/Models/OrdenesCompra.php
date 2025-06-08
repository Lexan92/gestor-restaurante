<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenesCompra extends Model
{
    /** @use HasFactory<\Database\Factories\OrdenesCompraFactory> */
    use HasFactory;
    protected $table = 'ordenes_compras';
    protected $primaryKey = 'id';
    protected $fillable = [
        'proveedor_id',
        'estado',
    ];

    public function items(){
        return $this->hasMany(DetalleOrdenes::class, 'orden_compra_id');
    }
    
}