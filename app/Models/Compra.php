<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['proveedor_id', 'fecha_compra', 'total'];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'compra_producto')
                    ->withPivot('cantidad', 'precio_unitario')
                    ->withTimestamps();
    }
}