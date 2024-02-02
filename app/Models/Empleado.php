<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fichaje;

class Empleado extends Model
{
    protected $fillable = ['dni','nombre','telefono', 'turno', 'status'];

    public function fichajes()
    {
        return $this->hasMany(Fichaje::class);
    }
}
