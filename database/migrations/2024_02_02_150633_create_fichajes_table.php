<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichajesTable extends Migration
{
    public function up()
    {
        Schema::create('fichajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')->constrained();
            $table->dateTime('entrada');
            $table->dateTime('salida')->nullable();
            $table->string('ubicacion')->nullable(); // Agregar columna para la ubicación
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fichajes');
    }
}
