<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Empleado;

class Fichaje extends Model
{
    protected $fillable = ['empleado_id', 'entrada', 'salida', 'ubicacion','tarde'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
