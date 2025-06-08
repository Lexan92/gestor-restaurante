<x-layouts.app>

    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('admin.productos.index') }}">Productos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="">Editar Producto</flux:breadcrumbs.item>
    </flux:breadcrumbs>


    <div class="card">

        <form action="{{ route('admin.productos.update', $productos) }}" method="POST">
            @csrf
            @method('PUT')


            <flux:input name="producto_nombre" label="Nombre del Producto"
                value="{{ old('producto_nombre', $productos->producto_nombre) }}"
                placeholder="Escribe el nombre del Producto" class="mb-4" />
            <flux:input name="unidad" label="Unidad Medida (Opcional)" value="{{ old('unidad', $productos->unidad) }}"
                placeholder="Escriba unidad de medida (Opcional)" class="mb-4" />

            <flux:input name="precio_compra" label="Precio (Opcional)" value="{{ old('precio_compra',$productos->precio_compra) }}"
                placeholder="Escriba el Precio del Producto (Opcional)" class="mb-4"  />

            <flux:input name="notas" label="Notas (Opcional)" value="{{ old('notas', $productos->notas) }}"
                placeholder="Escriba Notas adicionales (Opcional)" class="mb-4" />

            <flux:select label="Proveedor" name="proveedor_id" class="mb-4">
                @foreach ($proveedores as $proveedor)
                    <flux:select.option value="{{ $proveedor->id }}" :selected="$proveedor->id == old('proveedor_id', $productos->proveedor_id)">
                        {{ $proveedor->nombre }}

                    </flux:select.option>
                @endforeach

            </flux:select>



            <div class="flex justify-end mt-4">
                <flux:button type="submit" class="btn btn-blue">Guardar</flux:button>
                <a href=" {{ route('admin.productos.index') }} " class="btn btn-red">Cancelar</a>
            </div>
        </form>
    </div>

</x-layouts.app>
