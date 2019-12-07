<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{

	protected $table = "alumnos";

	protected $fillable= [
      		'id',
   		'id_usuario',
   		'id_nivel',
   		'fecha_pago',
   		'estatus',
   		'monto',
   		'mes',
   		'tipo', ]

   	public $timestamps = false;

   	 public function alumnop(){

        return $this->belongsTo('App\Alumnos','id_usuario'); 
    }

   	 public function nivelp(){

        return $this->belongsTo('App\Nivel','id_nivel'); 
    }    
}
