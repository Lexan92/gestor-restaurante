<x-layouts.app>

    <div class="mb-4 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.inventarios.index') }}">Inventarios</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href=""> Inventario de {{ $proveedor->nombre }}</flux:breadcrumbs.item>
        </flux:breadcrumbs>

    </div>

    <form action="{{ route('admin.inventarios.update', $proveedor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                <caption
                    class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Inventario de {{ $proveedor->nombre }}
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                        Aquí puedes ver los productos asociados a este proveedor. Puedes ajustar las cantidades según
                        sea necesario.
                    </p>
                </caption>

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3">
                            Nombre del Producto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Unidad de Medida
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio Unitario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad en Inventario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad Minima
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $producto->producto_nombre }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $producto->unidad }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <span class="mr-2 text-gray-500 dark:text-gray-400">$</span>
                                    <input type="number" name="precios[{{ $producto->id }}]"
                                        value="{{ $producto->precio_compra ?? '' }}" step="0.01" min="0"
                                        class="bg-gray-50 w-24 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="0.00" />
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <button
                                        class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 1h16" />
                                        </svg>
                                    </button>
                                    <div>
                                        <input type="number" name="cantidades[{{ $producto->id }}]"
                                            value="{{ $producto->inventario->cantidad ?? '' }}"
                                            class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="0" required />
                                    </div>
                                    <button
                                        class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 1v16M1 9h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <button
                                        class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 1h16" />
                                        </svg>
                                    </button>
                                    <div>
                                        <input type="number" name="cantidades_minimas[{{ $producto->id }}]"
                                            value="{{ $producto->inventario->cantidad_minima ?? '' }}"
                                            class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="0" required />
                                    </div>
                                    <button
                                        class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 1v16M1 9h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Guardar Cambios</button>
        <a href="{{ url()->previous() }}" class="mt-4 px-4 py-2 bg-red-400 text-white rounded ml-2 inline-block">Cancelar</a>
    </form>

</x-layouts.app>
