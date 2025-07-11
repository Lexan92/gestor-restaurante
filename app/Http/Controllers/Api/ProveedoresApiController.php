<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProveedoresApiController extends Controller
{
    // Listar proveedores
    public function index()
    {
        $proveedores = Proveedores::all();
        return response()->json($proveedores);
    }

    // Mostrar proveedor específico
    public function show($id)
    {
        $proveedor = Proveedores::findOrFail($id);
        return response()->json($proveedor);
    }

    // Crear proveedor
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);
        $proveedor = Proveedores::create($data);
        return response()->json($proveedor, 201);
    }

    // Actualizar proveedor
    public function update(Request $request, $id)
    {
        $proveedor = Proveedores::findOrFail($id);
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);
        $proveedor->update($data);
        return response()->json($proveedor);
    }

    // Eliminar proveedor
    public function destroy($id)
    {
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->delete();
        return response()->json(['message' => 'Proveedor eliminado']);
    }
}