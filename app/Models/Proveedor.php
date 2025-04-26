<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Proveedor extends Model

{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'telefono', 'direccion'];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
