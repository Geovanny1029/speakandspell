<?php

namespace App\Http\Controllers;

use App\Nivel;
use App\Alumnos;
use App\Traits\Levels;
use App\Traits\Students;

use Illuminate\Http\Request;

class LevelController extends Controller
{
    use Students,Levels;
    public function index(Request $request)
    {
        $niveles = $this->LevelsList();
        
        return view('Nivel.index', compact('niveles'));
    }  
}
