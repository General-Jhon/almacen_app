<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;

use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Listar todos los proveedores.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return response()->json(['proveedores' => $proveedores], 200);
    }

    /**
     * Crear un nuevo proveedor.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:proveedores,email',
            'direccion' => 'nullable|string|max:255',
        ]);

        $proveedor = Proveedor::create($validated);

        return response()->json(['proveedor' => $proveedor], 201);
    }

    /**
     * Mostrar un proveedor específico.
     */
    public function show(Proveedor $proveedor)
    {
        return response()->json(['proveedor' => $proveedor], 200);
    }

    /**
     * Actualizar un proveedor.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:proveedores,email,' . $proveedor->id,
            'direccion' => 'nullable|string|max:255',
        ]);

        $proveedor->update($validated);

        return response()->json(['proveedor' => $proveedor], 200);
    }

    /**
     * Eliminar un proveedor.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return response()->json(['message' => 'Proveedor eliminado correctamente'], 200);
    }
}
