<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Listar todas las compras con sus productos relacionados
        $compras = Compra::with('productos')->get();
        return response()->json(['compras' => $compras], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha_compra' => 'required|date',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Crear la compra
        $compra = Compra::create([
            'proveedor_id' => $validated['proveedor_id'],
            'fecha_compra' => $validated['fecha_compra'],
            'total' => 0, // Se calculará más adelante
        ]);

        $total = 0;

        // Asociar productos a la compra
        foreach ($validated['productos'] as $producto) {
            $compra->productos()->attach($producto['producto_id'], [
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio_unitario'],
            ]);

            $total += $producto['cantidad'] * $producto['precio_unitario'];
        }

        // Actualizar el total de la compra
        $compra->update(['total' => $total]);

        return response()->json(['compra' => $compra->load('productos')], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mostrar una compra específica con sus productos relacionados
        $compra = Compra::with('productos')->findOrFail($id);
        return response()->json(['compra' => $compra], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de la solicitud
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha_compra' => 'required|date',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Buscar la compra
        $compra = Compra::findOrFail($id);

        // Actualizar la compra
        $compra->update([
            'proveedor_id' => $validated['proveedor_id'],
            'fecha_compra' => $validated['fecha_compra'],
        ]);

        // Eliminar los productos existentes
        $compra->productos()->detach();

        $total = 0;

        // Asociar los nuevos productos
        foreach ($validated['productos'] as $producto) {
            $compra->productos()->attach($producto['producto_id'], [
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio_unitario'],
            ]);

            $total += $producto['cantidad'] * $producto['precio_unitario'];
        }

        // Actualizar el total de la compra
        $compra->update(['total' => $total]);

        return response()->json(['compra' => $compra->load('productos')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar una compra
        $compra = Compra::findOrFail($id);
        $compra->productos()->detach(); // Eliminar relaciones con productos
        $compra->delete();

        return response()->json(['message' => 'Compra eliminada correctamente'], 200);
    }
}
