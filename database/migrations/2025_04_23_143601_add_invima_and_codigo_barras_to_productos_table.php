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
        Schema::table('productos', function (Blueprint $table) {
            $table->string('invima', 50)->nullable()->after('estado'); // Nueva columna para INVIMA
            $table->string('codigo_barras', 100)->nullable()->after('invima'); // Nueva columna para código de barras
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn(['invima', 'codigo_barras']); // Eliminar las columnas si se revierte la migración
        });
    }
};
