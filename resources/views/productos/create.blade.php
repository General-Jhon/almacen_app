@extends('layout.plantilla')

@section('title', 'Crear Producto')

@section('content')

    <style>
        body {
            background: linear-gradient(145deg, #0f2027, #203a43, #2c5364);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-container {
            max-width: 700px;
            margin: 3rem auto;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 2rem 2.5rem;
            border-radius: 20px;
            color: #f1faee;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: bold;
        }

        .form-floating label {
            color: #adb5bd;
            padding-left: 2.0rem;

        }

        .form-control {
            background: transparent;
            border: none;
            border-bottom: 2px solid #bde0fe;
            color: white;
            border-radius: 0;
            transition: all 0.3s ease;

        }

        .form-control:focus {
            border-color: #00f7ff;
            box-shadow: none;
            background: transparent;
            color: white;
        }

        .form-icon {
            position: absolute;
            left: 10px;
            top: 12px;
            color: #00f7ff;

        }

        .form-floating {
            position: relative;
        }

        .form-floating .form-control {
            padding-left: 2.2rem;
            padding-top: 1.2rem;
        }

        .btn-guardar {
            background: linear-gradient(135deg, #00f7ff, #00c3ff);
            border: none;
            color: #0f2027;
            font-weight: bold;
            padding: 0.7rem 1.5rem;
            border-radius: 30px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .btn-guardar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.5);
        }

        .text-danger {
            font-size: 0.8rem;
        }

        option {
            background-color: #203a43;
            color: #f1faee;
        }
    </style>

    <div class="form-container">
        <h2><i class="fa-solid fa-plus me-2"></i> Nuevo Producto</h2>

        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @php
                $iconos = [
                    'lote' => 'fa-hashtag',
                    'nombre_producto' => 'fa-box',
                    'cantidad_producto' => 'fa-sort-numeric-up',
                    'fecha_vencimiento' => 'fa-calendar-xmark',
                    'descripcion' => 'fa-align-left',
                    'precio_unitario' => 'fa-dollar-sign',
                    'fecha_ingreso' => 'fa-calendar-plus',
                    'estado' => 'fa-toggle-on',
                ];
            @endphp

            @foreach ([
            'lote' => 'Lote',
            'nombre_producto' => 'Nombre del Producto',
            'cantidad_producto' => 'Cantidad',
            'fecha_vencimiento' => 'Fecha de Vencimiento',
            'descripcion' => 'Descripción',
            'precio_unitario' => 'Precio Unitario',
            'fecha_ingreso' => 'Fecha de Registro',
        ] as $campo => $label)
                <div class="form-floating mb-3">
                    <i class="fa-solid {{ $iconos[$campo] }} form-icon"></i>
                    <input type="{{ in_array($campo, ['fecha_vencimiento', 'fecha_ingreso']) ? 'date' : 'text' }}"
                        name="{{ $campo }}" class="form-control @error($campo) is-invalid @enderror"
                        id="{{ $campo }}" placeholder="{{ $label }}" value="{{ old($campo) }}">
                    <label for="{{ $campo }}">{{ $label }}</label>
                    @error($campo)
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach

            <div class="form-floating mb-3">
                <i class="fa-solid fa-barcode form-icon"></i>
                <input type="text" name="codigo_barras" class="form-control @error('codigo_barras') is-invalid @enderror"
                    id="codigo_barras" placeholder="Código de Barras" value="{{ old('codigo_barras') }}">
                <label for="codigo_barras">Código de Barras</label>
                @error('codigo_barras')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <i class="fa-solid fa-certificate form-icon"></i>
                <input type="text" name="invima" class="form-control @error('invima') is-invalid @enderror"
                    id="invima" placeholder="Código INVIMA" value="{{ old('invima') }}">
                <label for="invima">Código INVIMA</label>
                @error('invima')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-4">
                <i class="fa-solid fa-toggle-on form-icon"></i>
                <select name="estado" class="form-control" id="estado">
                    <option value="ACTIVO" {{ old('estado') == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="INACTIVO" {{ old('estado') == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
                </select>
                <label for="estado">Estado</label>
                @error('estado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Subir Imagen</label>
                <input class="form-control" type="file" id="imagen" name="imagen">
            </div>

            <button type="submit" class="btn btn-guardar">
                <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Producto
            </button>
        </form>
    </div>
@endsection
