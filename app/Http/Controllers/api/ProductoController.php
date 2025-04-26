<?php

namespace App\Http\Controllers\api;
use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return response()->json(["mensaje" => 'Controller API Running...'],200);
        $productos= Producto::all();
        return response()->json(["listaproductos" => $productos],200);
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
        $producto->save();
        return response()->json(["producto"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return response()->json(["producto" => $producto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Producto $producto)
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
        $producto->save();
        return response()->json(["producto" => $producto],201);
    }
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json(["producto eliminado correctamente" => $producto],200);
    }

}
