<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedores::active()->orderBy('id', 'desc')->get();
        return view('admin.proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'telefono' => 'nullable|string|max:15',
        ]);
        Proveedores::create($data);
        // Flash message
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El proveedor se ha creado correctamente.',
        ]);
        return redirect()->route('admin.proveedores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedores $proveedores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedores $proveedore)
    {
        return view('admin.proveedores.edit', compact('proveedore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedores $proveedores)
    {
        $data = $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'telefono' => 'nullable|string|max:15',
        ]);
        $proveedores->update($data);
        // Flash message
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El proveedor se ha actualizado correctamente.',
        ]);
        return redirect()->route('admin.proveedores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedores $proveedores)
    {
        $proveedores->estado = 'inactivo'; // Cambiar el estado a inactivo
        $proveedores->save(); // Guardar el cambio en la base de datos
        // Flash message
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El proveedor se ha eliminado correctamente.',
        ]);
        return redirect()->route('admin.proveedores.index');
    }
}
