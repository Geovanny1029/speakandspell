<?php

namespace App;

use Str;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = "levels";

    protected $fillable = [
        'id',
        'nombre',
        'horario',
        'finicio',
        'ffin',
        'costo',
        'active',
    ];

    public $timestamps = false;

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = Str::upper($value);
    }

    public function alumno()
    {

        return $this->hasMany('App\Alumnos');
    }

    public function pagos()
    {

        return $this->hasMany('App\Pagos');
    }

    public function pagosp()
    {

        return $this->hasMany('App\Pagos_estatus');
    }

    public function levelSchedule()
    {
        return $this->belongsTo('App\Models\Schedule', 'horario');
    }
}
