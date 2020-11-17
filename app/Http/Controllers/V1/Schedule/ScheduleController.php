<?php

namespace App\Http\Controllers\V1\Schedule;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;

class ScheduleController extends Controller
{
    public function store(ScheduleRequest $request)
    {
        $schedule = "{$request->inicio} - {$request->fin}";
        Schedule::create(['schedule' => $schedule]);

        toast("Horario Creado", 'success');
        return back();
    }
}
