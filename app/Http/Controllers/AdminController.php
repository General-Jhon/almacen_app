<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        //*****Validar los datos del formulario*****
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        //****Buscar al administrador por nombre de usuario****
        $admin = Admin::where('username', $request->username)->first();

        //*****Verificar si el administrador existe y la contraseña es correcta*****
        if ($admin && Hash::check($request->password, $admin->password)) {
            //*****Redirigir a productos.index si las credenciales son correctas*****
            return redirect()->route('productos.index');
        }

        //*****Si las credenciales son incorrectas, redirigir de vuelta con un mensaje de error*****
        return redirect()->back()->with('error', 'Credenciales incorrectas.');
    }
}
