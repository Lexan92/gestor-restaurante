<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventarios;
use App\Models\Productos;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class InventariosApiController extends Controller
{
    // Listar inventarios
    public function index()
    {
        $inventarios = Inventarios::with(['producto', 'proveedor'])->get();
        return response()->json($inventarios);
    }

    // Mostrar inventario específico
    public function show($id)
    {
        $inventario = Inventarios::with(['producto', 'proveedor'])->findOrFail($id);
        return response()->json($inventario);
    }

    // Crear inventario
    public function store(Request $request)
    {
        $data = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'cantidad' => 'required|numeric',
            'cantidad_minima' => 'nullable|numeric',
        ]);
        $inventario = Inventarios::create($data);
        return response()->json($inventario, 201);
    }

    // Actualizar inventario
    public function update(Request $request, $id)
    {
        $inventario = Inventarios::findOrFail($id);
        $data = $request->validate([
            'cantidad' => 'sometimes|numeric',
            'cantidad_minima' => 'sometimes|numeric',
        ]);
        $inventario->update($data);
        return response()->json($inventario);
    }

    // Eliminar inventario
    public function destroy($id)
    {
        $inventario = Inventarios::findOrFail($id);
        $inventario->delete();
        return response()->json(['message' => 'Inventario eliminado']);
    }
}
