<?php

namespace App\Http\Controllers\V1\Students;

use File;
use Storage;
use App\Nivel;
use App\Alumnos;
use App\Traits\Levels;
use App\Traits\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    use Students, Levels;

    public function index(Request $request)
    {
        $alumnos = $this->StudentsActive('nivelAl');

        return view('Students.index', compact('alumnos'));
    }

    public function create(Request $request)
    {
        $ultimo = $this->NextID();

        return view('Students.create', compact('ultimo'));
    }

    public function store(Request $request)
    {
        $student = new Alumnos($request->all());
        $student->save();

        if (isset($request->avatar)) {
            $file = $request->file('avatar');
            $this->StudentAvatar($file, $student);
        }

        toast("Bienvenido {$student->getCompleteName()}", 'success');

        return redirect()->route('students');
    }

    public function show(Request $request, Alumnos $student)
    {
        $nivel  = $student->nivelAl()->where('active', 1)->first();

        $schedule = $nivel ? $nivel->levelSchedule()->first() : null;

        return view('Students.show', compact('student', 'nivel', 'schedule'));
    }

    public function edit(Request $request, Alumnos $student)
    {
        return view('Students.update', compact('student'));
    }

    public function update(Request $request, Alumnos $student)
    {
        $student->update($request->all());

        if ($request->ajax()) {
            return response()->json(true);
        }

        toast("Alumno {$student->getCompleteName()}, ¡Actualizado!", 'success');

        return back();
    }
}
