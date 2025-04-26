<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Reporte de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Lote</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Vencimiento</th>
                <th>Precio</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->lote }}</td>
                <td>{{ $producto->nombre_producto }}</td>
                <td>{{ $producto->cantidad_producto }}</td>
                <td>{{ $producto->fecha_vencimiento }}</td>
                <td>{{ $producto->precio_unitario }}</td>
                <td>{{ $producto->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
