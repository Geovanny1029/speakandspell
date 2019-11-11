<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Alumnos;
use App\User;
use App\Nivel;
use DB;
class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');///se configura en midlewere/autenticate para proteger las rutas
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $alumnos = Alumnos::orderBy('matricula','asc')->where('activo','1')->get();

        $alumnos->each(function($alumnos){
            $alumnos->nivelAl;
        });
        return view('usuarios.lista')->with('alumnos',$alumnos);
    }

    public function inactivos()
    {

        $alumnos = Alumnos::orderBy('matricula','asc')->where('activo','0')->get();
        return view('usuarios.listainactivos')->with('alumnos',$alumnos);
    }

    public function menu()
    {
        
        return view('usuarios.menu');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matricula = DB::table('alumnos')->orderBy('matricula', 'DESC')->first();
        $ultimo = $matricula->matricula+1;
        $listaN = Nivel::orderBY('nombre','ASC')->pluck('nombre','id');
        $listaH = Nivel::orderBY('horario','ASC')->pluck('horario','id');
         return view('usuarios.altaU')->with('listaN',$listaN)->with('listaH',$listaH)->with('ultimo',$ultimo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new Alumnos($request->all());
        $user->matricula = $request->matricula;
        $user->nombre=strtoupper($request->nombre);
        $user->ap=strtoupper($request->apellido_paterno);
        $user->am=strtoupper($request->apellido_materno);
        $user->nacimiento=strtoupper($request->nacimiento);
        $user->direccion=strtoupper($request->direccion);
        $user->ciudad=strtoupper($request->ciudad);
        $user->ocupacion=strtoupper($request->ocupacion);
        $user->estudios=strtoupper($request->estudios);
        $user->nivel=strtoupper($request->nivel);
        $user->descuento=strtoupper($request->descuento);
        $user->casa=strtoupper($request->casa);
        $user->oficina=strtoupper($request->celular);
        $user->celular=strtoupper($request->oficina);
        $user->activo=1;
        $user->save();

        return view('usuarios.menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function listaNivel(){
        $niveles = Nivel::orderBy('id','asc')->get();
        return view('usuarios.listaN')->with('niveles',$niveles);
    }

    public function createNivel(){
        return view('usuarios.altaN');
    }

    public function altaNivel(Request $request){
        $nivel = new Nivel($request->all());
        $nivel->nombre = strtoupper($request->nombre);
        $nivel->horario = $request->horario;
        $nivel->finicio = $request->fecha_inicio;
        $nivel->ffin = $request->fecha_fin;
        $nivel->costo = $request->costo;
        $nivel->save();

        return view('usuarios.menu');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno = Alumnos::where('matricula as id',$id)->first();
        dd($alumno);
        $alumno->activo = 0;
        $alumno->save();

        return redirect()->route('user.index');
    }
}
