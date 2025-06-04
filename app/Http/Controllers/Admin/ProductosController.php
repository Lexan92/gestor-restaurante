<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Productos;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

// Obtener proveedores activos ordenados alfabéticamente
    $proveedores = Proveedores::active()
                    ->orderBy('nombre')
                    ->get();

    // Consulta base con eager loading y filtros
    $productos = Productos::query()
        ->active() // Filtrar productos activos
        ->with(['proveedor' => function($query) {
            $query->active();
        }])
        ->when($request->filled('proveedor_id'), function($query) use ($request) {
            $query->where('proveedor_id', $request->proveedor_id);
        })
        ->orderBy('id', 'desc') // Ordenar por ID de producto
        ->paginate(10)
        ->withQueryString(); // Mantiene los parámetros en la paginación

    return view('admin.productos.index', compact('productos', 'proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.productos.create', [
            'proveedores' => Proveedores::active()->orderBy('nombre')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data =  $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'producto_nombre' => 'required|string|min:3|max:255',
            'unidad' => 'required|string|max:50',
            'notas' => 'nullable|string|max:255',
            
        ]);
        $data['estado'] = 'activo'; // Asignar estado por defecto
        Productos::create($data);
        // Flash message
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El producto se ha creado correctamente.',
        ]);
        return redirect()->route('admin.productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $productos)
    {
        return view('admin.productos.edit', [
            'productos' => $productos,
            'proveedores' => Proveedores::active()->orderBy('nombre')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Productos $productos)
    {
        $data = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'producto_nombre' => 'required|string|min:3|max:255',
            'unidad' => 'required|string|max:50',
            'notas' => 'nullable|string|max:255',
        ]);
        $data['estado'] = 'activo'; // Asignar estado por defecto
        $productos->update($data);
        // Flash message
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El producto se ha actualizado correctamente.',
        ]);
        return redirect()->route('admin.productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $productos)
    {
        $productos->estado = 'inactivo'; // Cambiar estado a inactivo
        $productos->save(); // Guardar el cambio de estado
        // Flash message
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El producto se ha eliminado correctamente.',
        ]);
        return redirect()->route('admin.productos.index');
    }
}
