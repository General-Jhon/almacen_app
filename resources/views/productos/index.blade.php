@extends('layout.plantilla')

@section('title', 'Gestor de Productos')

@section('content')
    <style>
        body {
            background: linear-gradient(145deg, #0f2027, #203a43, #2c5364);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2 {
            color: #f1faee;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: bold;
        }

        .btn-nuevo {
            background: linear-gradient(135deg, #00f7ff, #00c3ff);
            border: none;
            color: #0f2027;
            font-weight: bold;
            padding: 0.7rem 1.5rem;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .btn-nuevo:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }

        .product-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            color: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 255, 255, 0.1);
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .product-info small {
            color: #bde0fe;
        }

        .badge-estado {
            padding: 0.4em 0.8em;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .estado-ACTIVO {
            background-color: #38b000;
            color: #fff;
        }

        .estado-INACTIVO {
            background-color: #e63946;
            color: #fff;
        }

        .acciones .btn {
            font-size: 0.9rem;
        }

        .acciones .btn i {
            margin-right: 5px;
        }

        .pagination {
            justify-content: center;
        }

        .pagination .page-link {
            background-color: transparent;
            color: #00f7ff;
            border: 1px solid #00f7ff;
            border-radius: 10px;
            margin: 0 4px;
            transition: all 0.3s ease;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #00f7ff, #00c3ff);
            color: #0f2027;
            font-weight: bold;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
            border: none;
        }

        .pagination .page-link:hover {
            background-color: rgba(0, 247, 255, 0.1);
            box-shadow: 0 0 8px rgba(0, 255, 255, 0.3);
        }
    </style>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fa-solid fa-boxes-stacked me-2"></i>Listado de Productos</h2>
            <a href="{{ route('productos.pdf') }}" class="btn btn-danger">
                <i class="fa-solid fa-file-pdf me-1"></i> Descargar PDF
            </a>
            <a href="{{ route('productos.create') }}" class="btn btn-nuevo">
                <i class="fa-solid fa-plus"></i> Nuevo Producto



            </a>
        </div>

        <form action="{{ route('productos.index') }}" method="GET" class="mb-4 d-flex justify-content-center">
            <input type="text" name="busqueda" class="form-control w-50 me-2"
                placeholder="Buscar producto por nombre, lote o código de barras..." value="{{ request('busqueda') }}">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i> Buscar
            </button>
        </form>


        <div class="row">
            @forelse ($productos as $producto)
                <div class="col-md-6 col-lg-4">
                    <div class="product-card">

                        @if ($producto->imagen)
                            <img src="{{ asset('imagenes/' . $producto->imagen) }}" alt="{{ $producto->nombre_producto }}"
                                class="img-fluid mb-3" style="border-radius: 10px; max-height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-title">{{ $producto->nombre_producto }}</div>
                        <div class="product-info">
                            <p><small>Lote:</small> {{ $producto->lote }}</p>
                            <p><small>Cantidad:</small> {{ $producto->cantidad_producto }}</p>
                            <p><small>Vence:</small> {{ $producto->fecha_vencimiento }}</p>
                            <p><small>Precio:</small> ${{ number_format($producto->precio_unitario, 2) }}</p>
                            <p><small>Registrado:</small> {{ $producto->fecha_ingreso }}</p>
                            <p><small>Descripción:</small> {{ $producto->descripcion }}</p>
                            <p><small>Código de Barras:</small> {{ $producto->codigo_barras }}</p> <!-- Nuevo campo -->
                            <p><small>Código INVIMA:</small> {{ $producto->invima }}</p> <!-- Nuevo campo -->
                            <span class="badge-estado estado-{{ $producto->estado }}">{{ $producto->estado }}</span>
                        </div>

                        <div class="acciones mt-3 d-flex gap-2">
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-outline-info">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </a>

                            <form action="{{ route('productos.destroy', $producto) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de eliminar el producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-white text-center">No hay productos registrados.</p>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $productos->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
