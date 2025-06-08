<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventarios;
use App\Models\Productos;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class InventariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    $proveedores = Proveedores::active()
        ->withMax('inventarios', 'updated_at')
        ->get();

    return view('admin.inventarios.index', [
        'proveedores' => $proveedores,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inventarios.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        $proveedor = Proveedores::with(['productos.inventario' => function ($query) {
            $query->with('producto'); // Carga adicional si necesitas
        }])
            ->active() // Solo proveedores activos
            ->findOrFail($id);

        return view('admin.inventarios.show', [
            'proveedor' => $proveedor,
            'productos' => $proveedor->productos // Accede a los productos ya cargados
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventarios $inventarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $proveedor_id)
    {
        // Actualiza inventarios
        if ($request->has('cantidades')) {
            foreach ($request->cantidades as $producto_id => $cantidad) {
                $inventario = Inventarios::where('producto_id', $producto_id)
                    ->where('proveedor_id', $proveedor_id)
                    ->first();

                if ($inventario) {
                    $inventario->cantidad = $cantidad;
                    $inventario->cantidad_minima = $request->cantidades_minimas[$producto_id] ?? $inventario->cantidad_minima;
                    $inventario->save();
                } else {
                    Inventarios::create([
                        'producto_id' => $producto_id,
                        'proveedor_id' => $proveedor_id,
                        'cantidad' => $cantidad,
                        'cantidad_minima' => $request->cantidades_minimas[$producto_id] ?? 0,
                    ]);
                }
            }
        }

        // Actualiza precios de productos
        if ($request->has('precios')) {
            foreach ($request->precios as $producto_id => $precio) {
                $producto = Productos::find($producto_id);
                if ($producto) {
                    $producto->precio_compra = $precio;
                    $producto->save();
                }
            }
        }

        // Flash message
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El inventario se ha actualizado correctamente.',
        ]);
        return redirect()->route('admin.inventarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventarios $inventarios)
    {
        //
    }
}
