<?php

namespace App\Http\Controllers\V1\Students;

use App\Nivel;
use App\Traits\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataTableController extends Controller
{
    use Students;

    public function index(Request $request)
    {
        $schedule = isset($request->horario) ? $request->horario : null;
        $level    = isset($request->nivel) ? $request->nivel : null;
        $active   = isset($request->activo) ? $request->activo : 0;

        return datatables()
            ->eloquent(
                $this->StudentsWithLevels($active, $schedule, $level)
            )->toJson();
    }
}
