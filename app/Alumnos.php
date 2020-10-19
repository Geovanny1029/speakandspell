<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
	protected $table = "alumnos";

	protected $fillable = [
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

	public function setNombreAttribute($value)
	{
		$this->attributes['nombre'] = Str::upper($value);
	}

	public function setApAttribute($value)
	{
		$this->attributes['ap'] = Str::upper($value);
	}

	public function setAmAttribute($value)
	{
		$this->attributes['am'] = Str::upper($value);
	}

	public function setDireccionAttribute($value)
	{
		$this->attributes['direccion'] = Str::upper($value);
	}

	public function setCiudadAttribute($value)
	{
		$this->attributes['ciudad'] = Str::upper($value);
	}

	public function setOcupacionAttribute($value)
	{
		$this->attributes['ocupacion'] = Str::upper($value);
	}

	public function setEstudiosAttribute($value)
	{
		$this->attributes['estudios'] = Str::upper($value);
	}
	

	public $timestamps = false;

	public function nivelAl()
	{
		return $this->belongsTo('App\Nivel', 'nivel');
	}

	public function pago()
	{
		return $this->hasMany('App\Pagos');
	}
}
