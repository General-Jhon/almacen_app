<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'lote',
        'nombre_producto',
        'cantidad_producto',
        'fecha_vencimiento',
        'descripcion',
        'precio_unitario',
        'fecha_ingreso',
        'estado',
        'invima', 
        'codigo_barras', 
    ];
}
