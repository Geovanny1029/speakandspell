<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
	protected $table = "alumnos";

	protected $fillable= [
   		'matricula',
   		'nombre',
   		'ap',
   		'am',
   		'edad',
   		'nacimiento', 
   		'direccion',
   		'ciudad',
   		'ocupacion',
   		'estudios',
   		'nivel',
   		'descuento',  
   		'casa',
   		'oficina',
   		'celular',
   		'activo',   		   		 
   	];

   		public function nivelAl(){

        return $this->belongsTo('App\Nivel','nivel'); 
    }

}
