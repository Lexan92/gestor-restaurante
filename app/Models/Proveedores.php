<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    /** @use HasFactory<\Database\Factories\ProveedoresFactory> */
    use HasFactory;
    protected $table = 'proveedores';
    protected $fillable = [
        'nombre',
        'telefono',
        'estado',
    ];

    // Scope para registros activos
    public function scopeActive($query)
    {
        return $query->where('estado', 'activo');
    }
}
