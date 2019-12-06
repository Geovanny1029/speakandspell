<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
	protected $table = "pagos";

	protected $fillable= [
   		'id',
   		'id_usuario',
   		'id_nivel',
   		'fecha_pago',
   		'estatus',
   		'monto',
   		'mes',
   		'tipo',   
   	];

    public $timestamps = false;
}
