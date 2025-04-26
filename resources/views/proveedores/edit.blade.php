{{-- filepath: resources/views/proveedores/edit.blade.php --}}
@extends('layout.plantilla')

@section('title', 'Editar Proveedor')

@section('content')
<div class="container py-5">
    <h2 class="mb-4"><i class="fa-solid fa-user-edit me-2"></i> Editar Proveedor</h2>

    <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $proveedor->nombre) }}">
            @error('nombre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $proveedor->telefono) }}">
            @error('telefono')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $proveedor->email) }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <textarea name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror">{{ old('direccion', $proveedor->direccion) }}</textarea>
            @error('direccion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-save"></i> Actualizar Proveedor
        </button>
    </form>
</div>
@endsection