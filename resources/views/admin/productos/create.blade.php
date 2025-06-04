<x-layouts.app>

    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href=" route('admin.productos.index') ">Productos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="">Nuevo Producto</flux:breadcrumbs.item>
    </flux:breadcrumbs>


    <div class="card">

        <form action="{{ route('admin.productos.store') }}" method="POST">
            @csrf


            <flux:input name="producto_nombre" label="Nombre del Producto" value="{{ old('producto_nombre') }}"
                placeholder="Escribe el nombre del Producto" class="mb-4" />
            <flux:input name="unidad" label="Unidad Medida (Opcional)" value="{{ old('unidad') }}"
                placeholder="Escriba unidad de medida (Opcional)" class="mb-4" />
            <flux:input name="notas" label="Notas (Opcional)" value="{{ old('notas') }}"
                placeholder="Escriba Notas adicioanles (Opcional)" class="mb-4" />

            <flux:select label="Proveedor" name="proveedor_id" class="mb-4">
                @foreach ($proveedores as $proveedor)
                    <flux:select.option value="{{ $proveedor->id }}">
                        {{ $proveedor->nombre }}

                    </flux:select.option>
                @endforeach

            </flux:select>



            <div class="flex justify-end mt-4">
                <flux:button type="submit" class="btn btn-blue">Guardar</flux:button>
                <a href=" {{ route('admin.categoriaProductos.index') }} " class="btn btn-red">Cancelar</a>
            </div>
        </form>
    </div>

</x-layouts.app>
