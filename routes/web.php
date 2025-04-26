<?php
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    //return view('welcome');
    return view('home');
})-> name('home');

Route::resource('productos', ProductoController::class);

Route::get('productospdf', [ProductoController::class, 'exportarPDF'])->name('productos.pdf');

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// Route::middleware(['auth'])->group(function () {
//     Route::resource('productos', ProductoController::class);
//     Route::resource('compras', CompraController::class);
//     Route::resource('proveedores', ProveedorController::class);
// });
