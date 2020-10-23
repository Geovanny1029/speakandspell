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
			->whereraw('MONTH(STR_TO_DATE(nacimiento, "%d/%m/%Y")) = ' . $month)
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
				'alumnos.id as id',
				DB::raw('CONCAT(alumnos.nombre," ",ap," ",am) as nombre'),
				'niveles.horario as horario',
				'niveles.nombre as nivel'
			)
			->leftjoin('niveles', 'niveles.id', 'alumnos.nivel')
			->where('alumnos.activo', $active);

		if ($schedule) {
			$students->where('niveles.horario', $schedule);
		}

		if ($level) {
			$students->where('niveles.nombre', $level);
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
