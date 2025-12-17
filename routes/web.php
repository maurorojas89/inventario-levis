<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\LoginController;

// Ruta inicial: login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Alias para evitar error de Fortify/Volt con "home"
Route::get('/home', function () {
    return redirect()->route('login');
})->name('home');

// Clientes
Route::resource('clientes', ClienteController::class);

// Ventas
Route::resource('ventas', VentaController::class);

// Compras
Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
Route::post('/compras', [CompraController::class, 'store'])->name('compras.store');
Route::get('/compras/{id}/detalle', [CompraController::class, 'detalle'])->name('compras.detalle');

// Detalle de compra
Route::get('/compras/{id}/detalle', [\App\Http\Controllers\DetalleCompraController::class, 'index'])->name('detalleCompra.index');
Route::post('/compras/{id}/detalle', [\App\Http\Controllers\DetalleCompraController::class, 'store'])->name('detalleCompra.store');
Route::delete('/compras/{id}/detalle/{detalleId}', [\App\Http\Controllers\DetalleCompraController::class, 'destroy'])->name('detalleCompra.destroy');

// Productos
Route::resource('productos', ProductoController::class);
Route::get('/productos/por-rol/{rol}', [ProductoController::class, 'porRol']);

// Proveedores
Route::resource('proveedores', ProveedorController::class);

// Reportes
Route::resource('reportes', ReporteController::class);

// Herramientas
Route::prefix('herramientas')->group(function () {
    Route::get('/logs', [HerramientaController::class, 'logs'])->name('herramienta.logs');
    Route::get('/tareas', [HerramientaController::class, 'tareas'])->name('herramienta.tareas');
    Route::get('/accesos', [HerramientaController::class, 'accesos'])->name('herramienta.accesos');
    Route::get('/', [HerramientaController::class, 'index'])->name('herramienta.index');
});
