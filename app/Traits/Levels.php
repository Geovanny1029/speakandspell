<?php

namespace App\Traits;

use App\Nivel;

trait Levels
{
    public function ExpiredLevels()
    {
        return Nivel::whereraw('CURDATE() >= STR_TO_DATE(`ffin`, "%d/%m/%Y")')->get();
    }

    public function LevelsList()
    {
        return Nivel::where('activo', 1)->groupBy('nombre')->orderBY('nombre', 'ASC')->get();
    }

    public function Schedule()
    {
        return Nivel::where('activo', 1)->orderBY('horario', 'ASC')->get();
    }
}
