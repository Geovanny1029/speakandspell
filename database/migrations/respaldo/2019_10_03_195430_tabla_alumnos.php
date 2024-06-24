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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('ap');
            $table->string('am');
            $table->date('nacimiento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('estudios')->nullable();
            $table->string('nivel')->nullable();
            $table->integer('descuento')->nullable();
            $table->string('casa')->nullable();
            $table->string('oficina')->nullable();
            $table->string('celular')->nullable();
            $table->integer('activo')->nullable();  
            $table->string('ruta_foto')->nullable();          
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
        Schema::dropIfExists('students');
    }
}
