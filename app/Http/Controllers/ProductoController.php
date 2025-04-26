<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Producto::query();

        // Verificar si hay un término de búsqueda
        if ($request->filled('busqueda')) {
            $busqueda = $request->busqueda;

            // Buscar en los campos deseados
            $query->where('nombre_producto', 'like', "%$busqueda%")
                ->orWhere('lote', 'like', "%$busqueda%")
                ->orWhere('codigo_barras', 'like', "%$busqueda%");
        }

        // Obtener los productos paginados
        $productos = $query->paginate(6);

        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->lote = $request->lote;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->cantidad_producto = $request->cantidad_producto;
        $producto->fecha_vencimiento = $request->fecha_vencimiento;
        $producto->descripcion = $request->descripcion;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->estado = $request->estado;
        $producto->codigo_barras = $request->codigo_barras;
        $producto->invima = $request->invima;

        // Subida de imagen
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombre = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes'), $nombre);
            $producto->imagen = $nombre;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $producto->lote = $request->lote;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->cantidad_producto = $request->cantidad_producto;
        $producto->fecha_vencimiento = $request->fecha_vencimiento;
        $producto->descripcion = $request->descripcion;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->estado = $request->estado;
        $producto->codigo_barras = $request->codigo_barras;
        $producto->invima = $request->invima;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombre = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes'), $nombre);
            $producto->imagen = $nombre;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

    public function exportarPDF()
    {
        $productos = Producto::all();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('productos.reportepdf', compact('productos'));
        return $pdf->download('reporte_productos.pdf');
    }
}
