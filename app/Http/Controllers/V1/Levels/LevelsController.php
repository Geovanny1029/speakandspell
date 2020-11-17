<?php

namespace App\Http\Controllers\V1\Levels;

use App\Http\Controllers\Controller;
use App\Http\Requests\LevelRequest;
use App\Nivel;
use Illuminate\Http\Request;

class LevelsController extends Controller
{
    public function index(Request $request)
    {
        return view('Levels.index');
    }

    public function store(LevelRequest $request){
        toast('Nivel Creado','success');

        Nivel::create($request->all());

        return back();
    }

    public function show(Request $request, Nivel $level){
        $schedules = Nivel::select('horario')
            ->where('nombre', $level->nombre)
            ->with('levelSchedule')
            ->distinct()
            ->get();

        return response()->json($schedules);
    }
}
