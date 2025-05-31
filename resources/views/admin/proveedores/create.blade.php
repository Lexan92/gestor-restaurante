<x-layouts.app>

    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href=" route('admin.proveedores.index') ">Proveedores</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="">Nuevo Proveedor</flux:breadcrumbs.item>
    </flux:breadcrumbs>


    <div class="card">

        <form action="{{ route('admin.proveedores.store') }}" method="POST">
            @csrf
            
               
                <flux:input name="nombre" label="Nombre Proveedor" value="{{ old('nombre') }}" placeholder="Escribe el nombre del Proveedor" class="mb-4"/>
                <flux:input name="telefono" label="Telefono" value="{{ old('telefono') }}" placeholder="Escriba un telefono de contacto" class="mb-4"/> 
                
                <div class="flex justify-end mt-4">
                <flux:button type="submit" class="btn btn-blue">Guardar</flux:button>
                <a href=" {{route('admin.proveedores.index')}} " class="btn btn-red" >Cancelar</a>
                </div>
        </form>
    </div>

</x-layouts.app>