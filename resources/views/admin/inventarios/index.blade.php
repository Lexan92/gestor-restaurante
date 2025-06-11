<x-layouts.app>

    <div class="mb-4 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href=" {{ route('admin.inventarios.index') }} ">Inventarios
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>



    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

            <caption
                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Inventarios por Proveedores
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                    Aquí puedes ver los inventarios asociados a cada proveedor. Puedes editar o eliminar los
                    registros según sea necesario.
                </p>
            </caption>



            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Proveedor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha Actualización
                    </th>


                    <th scope="col" class="px-6 py-3"">
                        <span class="sr-only">Editar</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($proveedores as $proveedore)
                    @php
                        $fecha = $proveedore->inventarios_max_updated_at;
                    @endphp
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $proveedore->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $proveedore->nombre }}
                        </td>

                        <td class="px-6 py-4" id="fecha-actualizacion-{{ $proveedore->id }}"
                            data-fecha="{{ $fecha ? \Carbon\Carbon::parse($fecha)->toIso8601String() : '' }}">
                            {{ $fecha ? \Carbon\Carbon::parse($fecha)->diffForHumans() : 'Sin Inventario' }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.inventarios.show', $proveedore->id) }}"
                                    class="btn btn-blue text-xs">Editar Inventario
                                </a>

                                <form action="{{ route('admin.ordenesCompras.pdf', $proveedore->id) }}" method="POST"
                                    target="_blank">
                                    @csrf
                                    <button type="submit" class="btn btn-green text-xs">
                                        Generar Orden de Compra
                                    </button>
                                </form>

                                <button onclick="abrirModal({{ $proveedore->id }})" class="btn btn-red text-xs"
                                    type="button">
                                    Ver Ordenes de Compra
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Main modal -->
                    <div id="modal-ordenes-{{ $proveedore->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden fixed top-0 right-0 left-0 z-50 w-full h-full bg-black/50 flex justify-center items-center">

                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Historial de Ordenes Proveedor: {{ $proveedore->nombre }}
                                    </h3>
                                    <button type="button" onclick="cerrarModal({{ $proveedore->id }})"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 max-h-[70vh] overflow-y-auto">
                                    @livewire('historial-ordenes', ['proveedorId' => $proveedore->id], key('historial-ordenes-' . $proveedore->id))
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </tbody>
        </table>




    </div>




    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/locale/es.min.js"></script>
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
        <script>
            moment.locale('es');

            function actualizarFechas() {
                document.querySelectorAll('[id^="fecha-actualizacion-"]').forEach(function(td) {
                    const fecha = td.getAttribute('data-fecha');
                    if (fecha) {
                        td.textContent = moment(fecha).fromNow();
                    } else {
                        td.textContent = 'Sin Inventario';
                    }
                });
            }
            setInterval(actualizarFechas, 60000);
            actualizarFechas(); // Al cargar
        </script>


        <script>
            function abrirModal(id) {
                const modal = document.getElementById('modal-ordenes-' + id);
                modal.classList.remove('hidden');
                modal.setAttribute('aria-hidden', 'false');
                Livewire.emit('actualizarHistorial', id); // Emitir evento para actualizar el historial
            }

            function cerrarModal(id) {
                const modal = document.getElementById('modal-ordenes-' + id);
                modal.classList.add('hidden');
                modal.setAttribute('aria-hidden', 'true');
            }
        </script>
    @endpush


</x-layouts.app>
