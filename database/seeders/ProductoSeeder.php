<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductoModelo;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        ProductoModelo::create([
            'nombreProducto' => 'Gorra básica',
            'descripcionProducto' => 'Prenda de cabeza',
            'precioProducto' => 0, // se pone manual en la compra
            'stockProducto' => 10,
            'estadoProducto' => 'Activo',
            'rolProducto' => 'Prendas de cabeza'
        ]);

        ProductoModelo::create([
            'nombreProducto' => 'Chaqueta Levi\'s',
            'descripcionProducto' => 'Chaqueta de invierno',
            'precioProducto' => 0,
            'stockProducto' => 5,
            'estadoProducto' => 'Activo',
            'rolProducto' => 'Chaquetas'
        ]);

        ProductoModelo::create([
            'nombreProducto' => 'Camisa clásica',
            'descripcionProducto' => 'Camisa de algodón',
            'precioProducto' => 0,
            'stockProducto' => 20,
            'estadoProducto' => 'Activo',
            'rolProducto' => 'Camisas'
        ]);
    }
}
