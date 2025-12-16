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

// compra 
Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
Route::get('/compras/create', [CompraController::class, 'create'])->name('compras.create');
Route::post('/compras', [CompraController::class, 'store'])->name('compras.store');
Route::get('/compras/{id}/detalle', [CompraController::class, 'detalle'])->name('compras.detalle');

Route::get('/compras/{id}/detalle/agregar', [DetalleCompraController::class, 'create'])->name('detalleCompra.create');
Route::post('/compras/{id}/detalle', [DetalleCompraController::class, 'store'])->name('detalleCompra.store');


// Mostrar los productos de una compra
Route::get('/compras/{id}/detalle', [\App\Http\Controllers\DetalleCompraController::class, 'index'])->name('detalleCompra.index');

// Agregar producto a la compra
Route::post('/compras/{id}/detalle', [\App\Http\Controllers\DetalleCompraController::class, 'store'])->name('detalleCompra.store');

// Eliminar producto de la compra
Route::delete('/compras/{id}/detalle/{detalleId}', [\App\Http\Controllers\DetalleCompraController::class, 'destroy'])->name('detalleCompra.destroy');


// Productos
Route::resource('productos', ProductoController::class);
Route::get('/productos/por-rol/{rol}', [ProductoController::class, 'porRol']);


// Proveedores
Route::get('/proveedores', [\App\Http\Controllers\ProveedorController::class, 'index'])->name('proveedores.index');
Route::post('/proveedores', [\App\Http\Controllers\ProveedorController::class, 'store'])->name('proveedores.store');
Route::delete('/proveedores/{id}', [\App\Http\Controllers\ProveedorController::class, 'destroy'])->name('proveedores.destroy');
Route::put('/proveedores/{id}', [\App\Http\Controllers\ProveedorController::class, 'update'])->name('proveedores.update');


// Reportes
Route::resource('reportes', ReporteController::class);

// Herramientas

Route::prefix('herramientas')->group(function () {
    Route::get('/logs', [HerramientaController::class, 'logs'])->name('herramienta.logs');
    Route::get('/tareas', [HerramientaController::class, 'tareas'])->name('herramienta.tareas');
    Route::get('/accesos', [HerramientaController::class, 'accesos'])->name('herramienta.accesos');
    Route::get('/', [HerramientaController::class, 'index'])->name('herramienta.index');

}
);

