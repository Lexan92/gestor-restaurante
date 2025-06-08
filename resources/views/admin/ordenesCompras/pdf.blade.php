<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden de Compra #{{ $orden->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Orden de Compra #{{ $orden->id }}</h2>
    <p><strong>Proveedor:</strong> {{ $proveedor->nombre }}</p>
    <p><strong>Estado:</strong> {{ $orden->estado }}</p>
    <p><strong>Fecha:</strong> {{ $orden->created_at ? $orden->created_at->format('d/m/Y H:i') : now()->format('d/m/Y H:i') }}</p>

    <h3>Detalles de la Orden</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad a Ordenar</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orden->items as $item)
               // @if ()
                    
               // @endif
                <tr>
                    <td>{{ $item->producto->producto_nombre ?? 'Producto' }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio_unitario, 2) }}</td>
                    <td>${{ number_format($item->cantidad * $item->precio_unitario, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay productos en esta orden.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>