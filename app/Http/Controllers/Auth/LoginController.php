<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

 public function login(Request $request)
    {

        if (Auth::attempt(['name' =>$request['name'], 'password' => $request['password']])) {


                   return redirect()->route('user.index');
             
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
