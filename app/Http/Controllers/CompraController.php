<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $compras = Compra::with('proveedor')->paginate(10);
        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener los proveedores y productos para el formulario
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('compras.create', compact('proveedores', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha_compra' => 'required|date',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);


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

        return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {

        $compra->load('productos', 'proveedor');
        return view('compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        // Obtener los proveedores y productos
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $compra->load('productos');
        return view('compras.edit', compact('compra', 'proveedores', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {

        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha_compra' => 'required|date',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);


        $compra->update([
            'proveedor_id' => $validated['proveedor_id'],
            'fecha_compra' => $validated['fecha_compra'],
        ]);


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


        $compra->update(['total' => $total]);

        return redirect()->route('compras.index')->with('success', 'Compra actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {

        $compra->productos()->detach();
        $compra->delete();

        return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente.');
    }
}
