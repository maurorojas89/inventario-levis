<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\HerramientaController;

Route::get('/', function () {
    return redirect()->route('clientes.index');
});

// Clientes
Route::resource('clientes', ClienteController::class);


// Ventas (ya existente)
Route::get('/ventas', [\App\Http\Controllers\VentaController::class, 'index'])->name('ventas.index');
Route::post('/ventas', [\App\Http\Controllers\VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/{id}/edit', [\App\Http\Controllers\VentaController::class, 'edit'])->name('ventas.edit');
Route::put('/ventas/{id}', [\App\Http\Controllers\VentaController::class, 'update'])->name('ventas.update');
Route::delete('/ventas/{id}', [\App\Http\Controllers\VentaController::class, 'destroy'])->name('ventas.destroy');

// Detalle de venta (agregar y eliminar líneas de producto)
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::resource('ventas', VentaController::class);

// Compras
Route::get('/compras', [\App\Http\Controllers\CompraController::class, 'index'])->name('compras.index');
Route::post('/compras', [\App\Http\Controllers\CompraController::class, 'store'])->name('compras.store');
Route::delete('/compras/{id}', [\App\Http\Controllers\CompraController::class, 'destroy'])->name('compras.destroy');


// Mostrar los productos de una compra
Route::get('/compras/{id}/detalle', [\App\Http\Controllers\DetalleCompraController::class, 'index'])->name('detalleCompra.index');

// Agregar producto a la compra
Route::post('/compras/{id}/detalle', [\App\Http\Controllers\DetalleCompraController::class, 'store'])->name('detalleCompra.store');

// Eliminar producto de la compra
Route::delete('/compras/{id}/detalle/{detalleId}', [\App\Http\Controllers\DetalleCompraController::class, 'destroy'])->name('detalleCompra.destroy');


// Productos
Route::resource('productos', ProductoController::class);

// Proveedores
Route::get('/proveedores', [\App\Http\Controllers\ProveedorController::class, 'index'])->name('proveedores.index');
Route::post('/proveedores', [\App\Http\Controllers\ProveedorController::class, 'store'])->name('proveedores.store');
Route::delete('/proveedores/{id}', [\App\Http\Controllers\ProveedorController::class, 'destroy'])->name('proveedores.destroy');
Route::put('/proveedores/{id}', [\App\Http\Controllers\ProveedorController::class, 'update'])->name('proveedores.update');


// Reportes
Route::resource('reportes', ReporteController::class);

// Herramientas
Route::resource('herramientas', HerramientaController::class);
