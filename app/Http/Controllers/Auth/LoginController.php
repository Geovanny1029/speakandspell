<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\Birthday;

class LoginController extends Controller {
	use AuthenticatesUsers, Birthday;

	public function login(Request $request) {
		$credentials = request(['name','password']);

		if(!auth()->attempt($credentials)){
			return view('auth.login');
		}

        $alumnos = $this->BirthdayListbyMonth(now()->format('m'));

        $niveles = $this->ExpiredLevel();

        $html    = view('Components.AlertBirthday',compact('alumnos','niveles'));

        alert()->html(
        	"Cumpleañeros de ".now()->formatLocalized('%B')." : ",
        	$html->render(),
        	''
        )->persistent('Close');

        return redirect()->route('user.menu');        
    }//fin de funcion login

    

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
