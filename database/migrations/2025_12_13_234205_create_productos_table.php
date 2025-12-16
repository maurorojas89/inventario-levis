<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombreProducto', 100);
            $table->string('descripcionProducto', 255)->nullable();
            $table->decimal('precioProducto', 10, 2)->nullable(); // precio se pone manualmente
            $table->integer('stockProducto')->default(0);
            $table->string('estadoProducto', 20)->default('Activo');
            $table->string('rolProducto', 50)->nullable(); // categoría: Chaquetas, Camisas, Prendas de cabeza, etc.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
