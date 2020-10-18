<?php

namespace App\Traits;

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
}
