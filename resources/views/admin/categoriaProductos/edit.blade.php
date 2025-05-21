<x-layouts.app>

    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href=" {{route('admin.categoriaProductos.index')}} ">Categorias Productos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="">Editar Categoria</flux:breadcrumbs.item>
    </flux:breadcrumbs>


    <div class="card">

        <form action="{{ route('admin.categoriaProductos.update', $categoriaProducto) }}" method="POST">
            @csrf
            @method('PUT')
            
               
                <flux:input name="nombre_categoria" label="Nombre Categoria" value="{{ old('nombre_categoria', $categoriaProducto->nombre_categoria) }}" placeholder="Escribe el nombre de la Categoria" class="mb-4"/>
                <flux:input name="descripcion" label="Descripcion Categoria (Opcional)" value="{{ old('descripcion', $categoriaProducto->descripcion) }}" placeholder="Escriba una descripcion de la categoria (Opcional)" class="mb-4"/> 
                
                <div class="flex justify-end mt-4">
                <flux:button type="submit" class="btn btn-blue">Guardar</flux:button>
                <a href=" {{route('admin.categoriaProductos.index')}} " class="btn btn-red" >Cancelar</a>
                </div>
        </form>
    </div>

</x-layouts.app>
