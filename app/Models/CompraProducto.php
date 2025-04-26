<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraProducto extends Model
{
    use HasFactory;

    protected $table = 'compra_producto';

    protected $fillable = ['compra_id', 'producto_id', 'cantidad', 'precio_unitario'];
}
