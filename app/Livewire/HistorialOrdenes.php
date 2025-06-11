<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrdenesCompra;
use Illuminate\Support\Facades\Log;

class HistorialOrdenes extends Component
{
    public $proveedorId;
    public $refresh = 0; // Variable para forzar el renderizado

    protected $listeners = ['actualizarHistorial' => 'actualizarHistorial'];

    public function actualizarHistorial($proveedorId)
{


     Log::info('Evento recibido en Livewire', [
        'componente' => $this->proveedorId,
        'evento' => $proveedorId
    ]);

    if ($this->proveedorId == $proveedorId) {
        // Forzar renderizado
        $this->refresh++;
        Log::info('Historial actualizado para proveedor', ['proveedorId' => $proveedorId]);
    }
}

    public function mount($proveedorId)
    {
        $this->proveedorId = $proveedorId;
    }

    public function render()
    {
        Log::info('Renderizando historial para proveedor', ['proveedorId' => $this->proveedorId]);
         $ordenes = OrdenesCompra::where('proveedor_id', $this->proveedorId)
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.historial-ordenes', compact('ordenes'));
    }
}
