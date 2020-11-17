<?php

namespace App\Traits;

use App\Nivel;
use App\Models\Schedule;

trait Levels
{
    public function ExpiredLevels()
    {
        return Nivel::whereraw('CURDATE() >= STR_TO_DATE(`ffin`, "%d/%m/%Y")')->get();
    }

    public function LevelsList()
    {
        return Nivel::where('active', 1)->groupBy('nombre')->orderBY('nombre', 'ASC')->get();
    }

    public function horary()
    {
        return Schedule::orderBY('schedule', 'ASC')->get();
    }

    public function LevelswithSchedule($active)
    {
        return Nivel::where('active', $active)->with('levelSchedule');
    }
}
