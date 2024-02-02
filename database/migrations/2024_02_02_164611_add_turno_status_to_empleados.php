<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->string('turno')->nullable();
            $table->integer('status')->default(1); // Puedes ajustar el valor por defecto según tus necesidades
        });
    }

    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropColumn('turno');
            $table->dropColumn('status');
        });
    }
};
