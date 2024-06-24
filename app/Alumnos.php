<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
	protected $table = "students";

	protected $fillable = [
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

	// public $timestamps = false;

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
	
	public function getCompleteName()
	{
		return "{$this->nombre} {$this->ap} {$this->am}";
	}

	public function FileName($ext){
		return "{$this->id}_{$this->nombre}_{$this->ap}_{$this->am}.$ext";
	}	

	public function nivelAl()
	{
		return $this->belongsTo('App\Nivel', 'nivel')->with('levelSchedule');
	}

	public function scopeActive($query, $status = 1)
    {
        return $query->where('activo', $status);
    }

	public function getSchedule()
	{
		$nivel = Nivel::find($this->nivel);
		return isset($nivel) ? $nivel->horario : null;
	}

	public function pago()
	{
		return $this->hasMany('App\Pagos');
	}
}
