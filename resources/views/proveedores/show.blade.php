{{-- filepath: resources/views/proveedores/show.blade.php --}}
@extends('layout.plantilla')

@section('title', 'Detalles del Proveedor')

@section('content')
<div class="container py-5">
    <h2 class="mb-4"><i class="fa-solid fa-user me-2"></i> Detalles del Proveedor</h2>

    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> {{ $proveedor->id }}</li>
        <li class="list-group-item"><strong>Nombre:</strong> {{ $proveedor->nombre }}</li>
        <li class="list-group-item"><strong>Teléfono:</strong> {{ $proveedor->telefono }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $proveedor->email }}</li>
        <li class="list-group-item"><strong>Dirección:</strong> {{ $proveedor->direccion }}</li>
    </ul>

    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary mt-3">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>
</div>
@endsection