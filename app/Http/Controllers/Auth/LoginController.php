<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Nivel;
use App\Alumnos;
use Carbon\Carbon;

class LoginController extends Controller
{

 public function login(Request $request)
    {

        if (Auth::attempt(['name' =>$request['name'], 'password' => $request['password']])) {


            $date1 = Carbon::now('America/Mexico_City');
            $hoy = $date1->format('Y-m-d');
            $mesnum = $date1->format('m');
            setlocale(LC_TIME, 'es_Es.utf8');
            setlocale(LC_TIME, 'Spanish');
            $fechacre = Carbon::parse($hoy);
            $mes = strtoupper($fechacre->formatLocalized('%B'));

            $alumnos = Alumnos::whereraw('`activo` = 1 AND MONTH(STR_TO_DATE(`nacimiento`, "%d/%m/%Y")) = '.$mesnum)->get();
            $cuantos = count($alumnos);
            $fecha = "Cumpleañeros del mes de: <b>".$mes."</b>:\n\n";
            $cumpleañeros = "";
            for ($i=0; $i <  $cuantos; $i++) { 
                $valor ="<b>".substr($alumnos[$i]->nacimiento,0,-8)."</b>";
                $cumpleañeros .= "<b>".$alumnos[$i]->nombre.$alumnos[$i]->am."</b> Dia: ".$valor."\n"; 
            }

            $cumple = nl2br($cumpleañeros);
            alert()->html('<i>'.$fecha.'</i>','<h5>'.$cumple.'</h5>','message')->autoClose(8000);;

                   return redirect()->route('user.menu');
             
            // Authentication passed...
        }else{
            return view('auth.login');
        }
    }//fin de funcion login

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('guest', ['except' =>['logout','login'] ]);
    }
}
