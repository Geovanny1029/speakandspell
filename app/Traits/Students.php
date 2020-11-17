<?php

namespace App\Traits;

use DB;
use File;
use Storage;
use App\Alumnos;

trait Students
{
	public function BirthdayListbyMonth($month)
	{
		return Alumnos::where('activo', 1)
			->whereMonth('nacimiento', $month)
			->orderby('nacimiento', 'asc')
			->get();
	}

	public function StudentsActive($with = null)
	{
		$students = Alumnos::orderBy('id', 'asc')->where('activo', '1');

		if ($with) {
			$students->with($with);
		}

		return $students->get();
	}

	public function NextID()
	{
		return Alumnos::latest('id')->first()->id + 1;
	}

	public function StudentsWithLevels($active, $schedule, $level){
		$students = Alumnos::select(
			'id',
			DB::raw('CONCAT(students.nombre," ",ap," ",am) as nombre'),
			'nivel'
		)
		->with('nivelAl:id,horario,nombre')
		->where('activo', $active)
		->get();

		if ($schedule) {
			$students = collect($students->toArray())->where('nivel_al.level_schedule.id', $schedule);
		}

		if ($level) {
			$students = collect($students->toArray())->where('nivel_al.nombre', $level);
		}

		return $students;
	}

	public function StudentAvatar($file,$student)
	{
		$name = $student->FileName($file->getClientOriginalExtension());
		$root = "/fotos/$name";

		$student->update(['ruta_foto' => $root]);

		Storage::put($name, File::get($file));

		return $root;
	}
}
