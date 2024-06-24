<?php

namespace App\Http\Controllers\Helpers;

use App\Traits\Levels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelsController extends Controller
{
    use Levels;

    public function List()
    {
        return $this->LevelsList();
    }

    public function Schedule()
    {
        return $this->horary()->pluck('schedule', 'id');
    }
}
