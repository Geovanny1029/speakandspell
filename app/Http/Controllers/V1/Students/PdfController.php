<?php

namespace App\Http\Controllers\V1\Students;

use PDF;
use App\Traits\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    use Students;
    
    public function __invoke(Request $request)
    {
        $schedule = isset($request->horario) ? $request->horario : null;
        $level    = isset($request->nivel) ? $request->nivel : null;
        $active   = isset($request->activo) ? $request->activo : 0;

        $students = $this->StudentsWithLevels($active, $schedule, $level);   
        
        return PDF::loadView(
            'Students.pdf', 
            compact('students','level', 'schedule')
        )->stream();
    }
}
