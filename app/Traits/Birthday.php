<?php

namespace App\Traits;

use App\Nivel;
use App\Alumnos;

Trait Birthday {
	public function BirthdayListbyMonth($month) {
		return Alumnos::where('activo',1)
			->whereraw('MONTH(STR_TO_DATE(nacimiento, "%d/%m/%Y")) = '.$month)
			->orderby('nacimiento','asc')
			->get();
	}

	public function ExpiredLevel(){
		return Nivel::whereraw('CURDATE() >= STR_TO_DATE(`ffin`, "%d/%m/%Y")')->get();
	}
}