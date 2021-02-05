<?php

namespace App\Http\Controllers\Auth;

use App\Nivel;
use App\Traits\Levels;
use App\Traits\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers, Students,Levels;

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'login','index']]);
        setlocale(LC_TIME, 'es_Es.utf8');
    }

    public function login(Request $request)
    {
        $credentials = request(['name', 'password']);

        if (!auth()->attempt($credentials)) {
            toast('Usuario o Contraseña no valido','error');

            return view('auth.login');
        }

        $html    = view('Components.AlertBirthday', array(
            'alumnos' => $this->BirthdayListbyMonth(now()->format('m')),
            'niveles' => $this->ExpiredLevels()
        ));

        alert()->html(
            "Cumpleañeros de " . ucwords(now()->formatLocalized('%B')) . " : ",
            $html->render(),
            ''
        )->persistent('Close');

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return redirect('/');
    }
}
