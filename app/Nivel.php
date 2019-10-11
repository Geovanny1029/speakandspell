<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
	protected $table = "niveles";

	protected $fillable= [
   		'id',
   		'nombre',
   		'horario',
   		'finicio',
   		'ffin',
   		'costo',   
   	];

    public function alumno(){

        return $this->hasMany('App\Alumnos'); 
    }   	

}
