<x-layouts.app>

    <div class="mb-4 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href=" {{ route('admin.proveedores.index') }} ">Proveedores
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <a href="{{ route('admin.proveedores.create') }}" class="btn btn-blue text-xs">Crear Proveedor
            Producto</a>
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                        Telefono
                    </th>


                    <th scope="col" class="px-6 py-3" width="10px">
                        <span class="sr-only">Editar</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($proveedores as $proveedor)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $proveedor->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $proveedor->nombre }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $proveedor->telefono }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.proveedores.edit', $proveedor) }}"
                                    class="btn btn-blue text-xs">Editar
                                </a>

                                <form class="delete-form" action="{{ route('admin.proveedores.destroy', $proveedor) }}" method="POST">
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

    @push('js')
        <script>

            forms= document.querySelectorAll('.delete-form');
            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
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