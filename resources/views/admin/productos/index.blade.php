<x-layouts.app>

    <div class="mb-4 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.productos.index') }}">Productos</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <a href="{{ route('admin.productos.create') }}" class="btn btn-blue text-xs">Crear Producto</a>
    </div>

    <!-- Filtro mejorado con diseño coherente -->
    <div class="mb-4 bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
        <form method="GET" action="{{ route('admin.productos.index') }}"
            class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div class="md:col-span-3">
                <label for="proveedor_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filtrar
                    por proveedor</label>
                <select name="proveedor_id" id="proveedor_id"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white text-sm">
                    <option value="">Todos los proveedores</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}"
                            {{ request('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                            {{ $proveedor->nombre }}
                            @if ($proveedor->telefono)
                                ({{ $proveedor->telefono }})
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn btn-blue text-xs w-full md:w-auto">
                    <i class="fas fa-filter mr-1"></i> Filtrar
                </button>
                @if (request()->has('proveedor_id'))
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-gray text-xs w-full md:w-auto">
                        <i class="fas fa-times mr-1"></i> Limpiar
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="relative overflow-x-auto mb-4 shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Proveedor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Unidad de Medida
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Precio de Compra
                    </th>
                    <th scope="col" class="px-6 py-3" width="10px">
                        <span class="sr-only">Editar</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $producto->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $producto->producto_nombre }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $producto->proveedor->nombre ?? 'No asignado' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $producto->unidad }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $producto->precio_compra ? '$' . number_format($producto->precio_compra, 2) : 'No definido' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-blue text-xs">
                                    Editar
                                </a>
                                <form class="delete-form" action="{{ route('admin.productos.destroy', $producto) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-red text-xs">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación con mantenimiento de parámetros GET -->
    <div class="mt-4">
        {{ $productos->appends(request()->query())->links() }}
    </div>

    @push('js')
        <script>
            forms = document.querySelectorAll('.delete-form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro de eliminar el registro?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    })
                });
            });
        </script>
    @endpush


</x-layouts.app>
