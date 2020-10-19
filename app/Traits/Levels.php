<?php

namespace App\Traits;

use App\Nivel;

trait Levels
{
    public function ExpiredLevels()
    {
        return Nivel::whereraw('CURDATE() >= STR_TO_DATE(`ffin`, "%d/%m/%Y")')->get();
    }

    public static function LevelsList()
    {
        return Nivel::where('activo', 1)->groupBy('nombre')->orderBY('nombre', 'ASC')->get();
    }

    public static function Schedule()
    {
        return Nivel::where('activo', 1)->orderBY('horario', 'ASC')->get();
    }
}
