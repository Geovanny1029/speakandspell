<?php

namespace App\Http\Controllers\V1\Levels;

use App\Traits\Levels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DatatableController extends Controller
{
    use Levels;

    public function index(Request $request)
    {
        $active   = isset($request->activo) ? $request->activo : 0;

        return datatables()
            ->eloquent(
                $this->LevelswithSchedule($active)
            )->toJson();
    }
}
