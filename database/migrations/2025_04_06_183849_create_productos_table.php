<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('lote', 50);
            $table->string('nombre_producto', 100);
            $table->integer('cantidad_producto');
            $table->date('fecha_vencimiento');
            $table->text('descripcion')->nullable();
            $table->decimal('precio_unitario', 10, 2);
            $table->date('fecha_ingreso');
            $table->enum('estado', ['activo', 'inactivo', 'vencido'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
