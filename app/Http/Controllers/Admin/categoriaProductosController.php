<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProductos;
use Illuminate\Http\Request;

class CategoriaProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriaProductos = categoriaProductos::orderBy('id', 'desc')->get();
        return view('admin.categoriaProductos.index', compact('categoriaProductos'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categoriaProductos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->validate([
            'nombre_categoria' => 'required|string|min:3|max:255',
            'descripcion' => 'nullable|string|max:255',
        ]);

        CategoriaProductos::create($data);

        // Flash message
        session()->flash('swal',[
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La categoria de producto se ha creado correctamente.',
        ]

        );
        return redirect()->route('admin.categoriaProductos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(categoriaProductos $categoriaProductos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categoriaProductos $categoriaProducto)
    {
        return view('admin.categoriaProductos.edit', compact('categoriaProducto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, categoriaProductos $categoriaProducto)
    {
        $data = $request->validate([
            'nombre_categoria' => 'required|string|min:3|max:255',
            'descripcion' => 'nullable|string|max:255',
        ]);

        
        $categoriaProducto->update($data);

        // Flash message
        session()->flash('swal',[
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La categoria de producto se ha actualizado correctamente.',
        ]

        );
        return redirect()->route('admin.categoriaProductos.edit', $categoriaProducto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categoriaProductos $categoriaProducto)
    {
        $categoriaProducto->delete();

        // Flash message
        session()->flash('swal',[
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La categoria de producto se ha eliminado correctamente.',
        ]

        );
        return redirect()->route('admin.categoriaProductos.index');
    }
}
