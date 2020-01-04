<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
	protected $table = "alumnos";

	protected $fillable= [
   		'id',
   		'nombre',
   		'ap',
   		'am',
   		'nacimiento', 
   		'direccion',
   		'ciudad',
   		'ocupacion',
   		'estudios',
   		'nivel',
   		'casa',
   		'oficina',
   		'celular',
   		'activo',
         'ruta_foto',   		   		 
   	];
         public $timestamps = false;
         
   		public function nivelAl(){

        return $this->belongsTo('App\Nivel','nivel'); 
    }

        public function pago(){

        return $this->hasMany('App\Pagos'); 
    }   

}
