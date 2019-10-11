<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->bigIncrements('matricula');
            $table->string('nombre');
            $table->string('ap');
            $table->string('am');
            $table->string('edad');
            $table->string('nacimiento');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('ocupacion');
            $table->string('estudios');
            $table->string('nivel');
            $table->string('descuento');
            $table->string('casa');
            $table->string('oficina');
            $table->string('celular');
            $table->string('activo');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
