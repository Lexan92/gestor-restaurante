<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventarios;
use App\Models\OrdenesCompra;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class OrdenesCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(OrdenesCompra $ordenesCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdenesCompra $ordenesCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrdenesCompra $ordenesCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrdenesCompra $ordenesCompra)
    {
        //
    }

        public function generarOrden(Request $request, $proveedorId)
{
    // Buscar proveedor
    $proveedor = Proveedores::findOrFail($proveedorId);

    // Crear la orden de compra (ajusta los campos según tu modelo)
    $orden = OrdenesCompra::create([
        'proveedor_id' => $proveedor->id,
        'estado' => 'activo', // o el estado que necesites
        
    ]);
    

    $inventarios = Inventarios::where('proveedor_id', $proveedor->id)
        ->with('producto') // Cargar los productos relacionados
        ->get();
    // Agregar los productos a la orden de compra
    foreach ($inventarios as $inventario) {
        $orden->items()->create([
            'producto_id' => $inventario->producto_id,
            'cantidad' => $inventario->cantidad, // o la cantidad que necesites
            'precio_unitario' => $inventario->producto->precio_compra, // Precio del producto
        ]);
    }


   



    // Generar PDF (usa dompdf, snappy, etc.)
    $pdf = PDF::loadView('admin.ordenesCompras.pdf', compact('orden', 'proveedor'));

    // Descargar o mostrar el PDF
   return $pdf->stream('orden_compra_'.$orden->id.'.pdf');
}
}
