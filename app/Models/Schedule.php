<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';

    protected $fillable = ['schedule'];

    public $timestamps = false;

    public function levelSchedule()
    {
        return $this->hasMany('App\Nivel');
    }
}
