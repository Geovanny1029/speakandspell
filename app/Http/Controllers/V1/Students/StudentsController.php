<?php

namespace App\Http\Controllers\V1\Students;

use App\Alumnos;
use App\Nivel;
use App\Traits\Levels;
use App\Traits\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    use Students,Levels;

    public function index(Request $request)
    {
        $alumnos = $this->StudentsActive('nivelAl');
        $listaN  = $this->LevelsList()->pluck('nombre', 'nombre');
        $listaH  = $this->Schedule()->pluck('horario', 'id');

        return view('usuarios.lista', compact('alumnos', 'listaN', 'listaH'));
    }

    public function create(Request $request)
    {
        $ultimo = $this->NextID();

        return view('Students.create',compact('ultimo'));
    }

    public function store(Request $request)
    {
        dd(new Alumnos($request->all()));
    }

    public function edit(Request $request, Alumnos $student)
    {
        return view('Students.update',compact('student'));
    }
}
