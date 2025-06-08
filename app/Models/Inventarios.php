<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventarios extends Model
{
    /** @use HasFactory<\Database\Factories\InventariosFactory> */
    use HasFactory;
    protected $table = 'inventarios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'producto_id',
        'proveedor_id',
        'cantidad',
        'cantidad_minima',
    ];

    public function producto()
    {
        return $this->belongsTo(Productos::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'proveedor_id');
    }

    public function isLowStock()
    {
        return $this->cantidad_minima !== null && $this->cantidad < $this->cantidad_minima;
    }

}
