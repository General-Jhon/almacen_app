{{-- filepath: resources/views/proveedores/index.blade.php --}}
@extends('layout.plantilla')

@section('title', 'Lista de Proveedores')

@section('content')
<div class="container py-5">
    <h2 class="mb-4"><i class="fa-solid fa-users me-2"></i> Lista de Proveedores</h2>

    <a href="{{ route('proveedores.create') }}" class="btn btn-primary mb-3">
        <i class="fa-solid fa-plus"></i> Nuevo Proveedor
    </a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->id }}</td>
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->email }}</td>
                    <td>{{ $proveedor->direccion }}</td>
                    <td>
                        <a href="{{ route('proveedores.show', $proveedor) }}" class="btn btn-sm btn-info">
                            <i class="fa-solid fa-eye"></i> Ver
                        </a>
                        <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-pen"></i> Editar
                        </a>
                        <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este proveedor?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay proveedores registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $proveedores->links() }}
</div>
@endsection