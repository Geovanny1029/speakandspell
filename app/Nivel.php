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
        'activo',   
   	];

    public $timestamps = false;

    public function alumno(){

        return $this->hasMany('App\Alumnos'); 
    }   	

    public function pagos(){

        return $this->hasMany('App\Pagos'); 
    }   

    public function pagosp(){

        return $this->hasMany('App\Pagos_estatus'); 
    }  
}
