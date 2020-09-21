<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos_estatus extends Model
{
	protected $table = "pagos_estatus";

	protected $fillable= [
      	'id',
   		'id_usuario',
   		'id_nivel',
   		'estatus_c', ];

   	public $timestamps = false;

   	 public function alumnop(){

        return $this->belongsTo('App\Alumnos','id_usuario'); 
    }

   	 public function nivelp(){

        return $this->belongsTo('App\Nivel','id_nivel'); 
    }   
}
