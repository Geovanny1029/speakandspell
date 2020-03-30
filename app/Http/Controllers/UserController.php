<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Alumnos;
use App\User;
use App\Nivel;
use App\Pagos;
use Carbon\Carbon;
use DB;
use PDF;
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

        $alumnos = Alumnos::orderBy('id','asc')->where('activo','1')->get();
        $listaN = Nivel::groupBy('nombre')->orderBY('nombre','ASC')->pluck('nombre','nombre');
        $listaH = Nivel::orderBY('horario','ASC')->pluck('horario','id');

        $alumnos->each(function($alumnos){
            $alumnos->nivelAl;
        });

        return view('usuarios.lista')->with('alumnos',$alumnos)->with('listaN',$listaN)->with('listaH',$listaH);
    }

    public function inactivos()
    {

        $alumnos = Alumnos::orderBy('id','asc')->where('activo','0')->get();
        return view('usuarios.listainactivos')->with('alumnos',$alumnos);
    }

    public function listaxnivel(){
        $listaN = Nivel::groupBy('nombre')->orderBY('nombre','ASC')->pluck('nombre','nombre');
        $listaH = Nivel::orderBY('horario','ASC')->pluck('horario','id');
        return view('usuarios.listarxnivel')->with('listaN',$listaN)->with('listaH',$listaH);
    }


    public function pagos(){
        $alumnos = Alumnos::orderBy('id','asc')->where('activo','1')->get();

        $alumnos->each(function($alumnos){
            $alumnos->nivelAl;
        });
        return view('usuarios.pagos')->with('alumnos',$alumnos);
    }

    public function corte(){

        $listaN = Nivel::groupBy('nombre')->orderBY('nombre','ASC')->pluck('nombre','nombre');
        $listaH = Nivel::orderBY('horario','ASC')->pluck('horario','id');
        return view('usuarios.corte');
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
        $matricula = DB::table('alumnos')->orderBy('id', 'DESC')->first();
        $ultimo = $matricula->id+1;
        $listaN = Nivel::groupBy('nombre')->orderBY('nombre','ASC')->pluck('nombre','nombre');
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



        if($request->hasFile('ruta_foto')){
            $file = $request->file('ruta_foto');
            $name = $request->id."_".$request->nombre."_".$request->apellido_paterno;
            $file->move(public_path().'/fotos/',$name);
        }else{
            $name = $request->ruta_foto;
        }


            $cumpleaños =date_create($request->nacimiento);
            $nacimeinto = date_format($cumpleaños,"d/m/Y");

            
            
            $user = new Alumnos($request->all());
            $user->id = $request->id;
            $user->nombre=strtoupper($request->nombre);
            $user->ap=strtoupper($request->apellido_paterno);
            $user->am=strtoupper($request->apellido_materno);
            $user->nacimiento=$nacimeinto;
            $user->direccion=strtoupper($request->direccion);
            $user->ciudad=strtoupper($request->ciudad);
            $user->ocupacion=strtoupper($request->ocupacion);
            $user->estudios=strtoupper($request->estudios);
            $user->nivel=strtoupper($request->horario);
            $user->casa=strtoupper($request->casa);
            $user->oficina=strtoupper($request->celular);
            $user->celular=strtoupper($request->oficina);
            $user->activo=1;
            $user->ruta_foto= $name;
            $user->save();


            $hoy = Carbon::now();
            $today = $hoy->format('Y-m-d');
            $monthactual = $hoy->format('m');

            //sacar meses
            $input = date($request->nacimiento);
            $date2 = Carbon::parse($input);
            $date = $date2->format('Y-m-d');
            $edad = Carbon::createFromDate($date)->age;

            //calculando meses de nivel
            $nivel = Nivel::find($request->horario);
            $start = date($nivel->finicio);
            $inicio = 'd/m/Y';

            $end = date($nivel->ffin);
            $fin = 'd/m/Y';

            $finicio = Carbon::createFromFormat($inicio, $start);
            $ffin = Carbon::createFromFormat($fin, $end);

            $primer_pago = Carbon::createFromFormat('d/m/Y', $nivel->finicio)->format('m');

            $meses = $finicio->diffInMonths($ffin) + 1;

            $inscripcionR = $request->inscripcion;
            $colegiaturaR = $request->colegiatura;
            $letras = $this->convertir($request->colegiatura);

            $pdf = PDF::loadView('pdf.fichaInscripcion',['user'=>$user,'meses'=>$meses,'edad'=>$edad,'colegiatura'=>$colegiaturaR,'inscripcion'=>$inscripcionR,'letras'=>$letras]);

            //datos necesarios para algortitmo de pago
            $nivelP = Nivel::find($request->horario);
            $abono = $request->colegiatura;
            $colegiatura = $nivelP->costo;
            $CostoC = $meses*$colegiatura;


        //pagos inscripcion y colegiatura
    //si abono es menor o igual al total del curso   
    if($abono <= $CostoC){        
        //si el curso ya empezo paga el mes que entra
        if($primer_pago >= $monthactual){
            //si marcan la casilla familiar directo
            if($request->familiard == 1){
                Pagos::create(
                ['id_usuario'  => $request->id,
                 'id_nivel' => $request->horario,
                 'fecha_pago' => $today,
                 'estatus' => 1,
                 'monto' => 500,
                 'mes' =>  $primer_pago,
                 'tipo' => 1]
                );

                //metodo propuesto si tiene colegiatura
                //si el abono es menor a la colegiatura
                if($abono != null || $abono == "null"){
                    if($abono < $colegiatura ){
                        Pagos::create(
                        ['id_usuario'  => $request->id,
                        'id_nivel' => $request->horario,
                        'fecha_pago' => $today,
                        'estatus' => 2,
                        'monto' => $abono,
                        'mes' =>  $primer_pago,
                        'tipo' => 2]);                    
                    }else{
                        //si el abono es entero 
                        if(is_int($abono/$colegiatura) == true){
                            $mesesApagar = $abono/$colegiatura;

                            for ($i=0; $i < $mesesApagar ; $i++) { 
                                $aux = 0;
                                Pagos::create(
                                ['id_usuario'  => $request->id,
                                'id_nivel' => $request->horario,
                                'fecha_pago' => $today,
                                'estatus' => 1,
                                'monto' => 500,
                                'mes' =>  $primer_pago+$i,
                                'tipo' => 2]);
                                $aux++;
                            }
                        }else{
                            //si no es entero saca los enteros y el residuo del saldo
                            $mesesApagarC= explode(".", $abono/$colegiatura);
                            $numeroMeses = $mesesApagarC[0]+1;
                            
                            for ($i=0; $i < $numeroMeses; $i++) { 
                                if($i == ($numeroMeses-1)){
                                    $residuo = $abono%$colegiatura;
                                    Pagos::create(
                                    ['id_usuario'  => $request->id,
                                    'id_nivel' => $request->horario,
                                    'fecha_pago' => $today,
                                    'estatus' => 2,
                                    'monto' => $residuo,
                                    'mes' =>  $primer_pago+($numeroMeses-1),
                                    'tipo' => 2]);
                                } else{
                                    Pagos::create(
                                    ['id_usuario'  => $request->id,
                                    'id_nivel' => $request->horario,
                                    'fecha_pago' => $today,
                                    'estatus' => 1,
                                    'monto' => 500,
                                    'mes' =>  $primer_pago+$i,
                                    'tipo' => 2]);      
                                }

                            }                                                       

                        }
                    }
                }
                    

                // if($request->colegiatura != null || $request->colegiatura != ""){
                //     if($request->colegiatura == 500){
                //         Pagos::create(
                //         ['id_usuario'  => $request->id,
                //         'id_nivel' => $request->horario,
                //         'fecha_pago' => $today,
                //         'estatus' => 1,
                //         'monto' => 500,
                //         'mes' =>  $primer_pago,
                //         'tipo' => 2]);
                //     }else{
                //         Pagos::create(
                //         ['id_usuario'  => $request->id,
                //         'id_nivel' => $request->horario,
                //         'fecha_pago' => $today,
                //         'estatus' => 2,
                //         'monto' => $request->colegiatura,
                //         'mes' =>  $primer_pago,
                //         'tipo' => 2]);
                //     }                    
                // }

            }else{
                if($request->inscripcion != null || $request->inscripcion != ""){
                    if($request->inscripcion == 500){
                        Pagos::create(
                        ['id_usuario'  => $request->id,
                        'id_nivel' => $request->horario,
                        'fecha_pago' => $today,
                        'estatus' => 1,
                        'monto' => 500,
                        'mes' =>  $primer_pago,
                        'tipo' => 1]);
                    }else{
                        Pagos::create(
                        ['id_usuario'  => $request->id,
                        'id_nivel' => $request->horario,
                        'fecha_pago' => $today,
                        'estatus' => 2,
                        'monto' => $request->inscripcion,
                        'mes' =>  $primer_pago,
                        'tipo' => 1]);
                    }
                }
                // if($request->colegiatura != null || $request->colegiatura != ""){
                //     if($request->colegiatura == 500){
                //         Pagos::create(
                //         ['id_usuario'  => $request->id,
                //         'id_nivel' => $request->horario,
                //         'fecha_pago' => $today,
                //         'estatus' => 1,
                //         'monto' => 500,
                //         'mes' =>  $primer_pago,
                //         'tipo' => 2]);
                //     }else{
                //         Pagos::create(
                //         ['id_usuario'  => $request->id,
                //         'id_nivel' => $request->horario,
                //         'fecha_pago' => $today,
                //         'estatus' => 2,
                //         'monto' => $request->colegiatura,
                //         'mes' =>  $primer_pago,
                //         'tipo' => 2]);
                //     }                    
                // }                
            
                //metodo propuesto si se llena abono si no no hace nada
                if($abono != null || $abono != "" ){
                    if($abono < $colegiatura ){
                        Pagos::create(
                        ['id_usuario'  => $request->id,
                        'id_nivel' => $request->horario,
                        'fecha_pago' => $today,
                        'estatus' => 2,
                        'monto' => $abono,
                        'mes' =>  $primer_pago,
                        'tipo' => 2]);                    
                    }else{
                        if(is_int($abono/$colegiatura) == true){
                            $mesesApagar = $abono/$colegiatura;

                            for ($i=0; $i < $mesesApagar ; $i++) { 
                                $aux = 0;
                                Pagos::create(
                                ['id_usuario'  => $request->id,
                                'id_nivel' => $request->horario,
                                'fecha_pago' => $today,
                                'estatus' => 1,
                                'monto' => 500,
                                'mes' =>  $primer_pago+$i,
                                'tipo' => 2]);
                                $aux++;
                            }
                        }else{
                            
                            $mesesApagarC= explode(".", $abono/$colegiatura);
                            $numeroMeses = $mesesApagarC[0]+1;
                            
                            for ($i=0; $i < $numeroMeses; $i++) { 
                                if($i == ($numeroMeses-1)){
                                    $residuo = $abono%$colegiatura;
                                    Pagos::create(
                                    ['id_usuario'  => $request->id,
                                    'id_nivel' => $request->horario,
                                    'fecha_pago' => $today,
                                    'estatus' => 2,
                                    'monto' => $residuo,
                                    'mes' =>  $primer_pago+($numeroMeses-1),
                                    'tipo' => 2]);
                                }else{
                                    Pagos::create(
                                    ['id_usuario'  => $request->id,
                                    'id_nivel' => $request->horario,
                                    'fecha_pago' => $today,
                                    'estatus' => 1,
                                    'monto' => 500,
                                    'mes' =>  $primer_pago+$i,
                                    'tipo' => 2]);      
                                }

                            }                                                       
                        }
                    }
                }//fin metodo propuesto
            }
        }
        else{
            //si paga despues del mes que empieza
            if($request->familiard == 1){
                Pagos::create(
                ['id_usuario'  => $request->id,
                 'id_nivel' => $request->horario,
                 'fecha_pago' => $today,
                 'estatus' => 1,
                 'monto' => 500,
                 'mes' =>  $hoy->format('m'),
                 'tipo' => 1]
                );

                //metodo propuesto
                if($abono < $colegiatura ){
                    Pagos::create(
                    ['id_usuario'  => $request->id,
                    'id_nivel' => $request->horario,
                    'fecha_pago' => $today,
                    'estatus' => 2,
                    'monto' => $abono,
                    'mes' =>  $hoy->format('m'),
                    'tipo' => 2]);                    
                }else{
                    if(is_int($abono/$colegiatura) == true){
                        $mesesApagar = $abono/$colegiatura;

                        for ($i=0; $i < $mesesApagar ; $i++) { 
                            $aux = 0;
                            Pagos::create(
                            ['id_usuario'  => $request->id,
                            'id_nivel' => $request->horario,
                            'fecha_pago' => $today,
                            'estatus' => 1,
                            'monto' => 500,
                            'mes' =>  $hoy->format('m')+$i,
                            'tipo' => 2]);
                            $aux++;
                        }
                    }else{
                        
                        $mesesApagarC= explode(".", $abono/$colegiatura);
                        $numeroMeses = $mesesApagarC[0]+1;
                        
                        for ($i=0; $i < $numeroMeses; $i++) { 
                            if($i == ($numeroMeses-1)){
                                $residuo = $abono%$colegiatura;
                                Pagos::create(
                                ['id_usuario'  => $request->id,
                                'id_nivel' => $request->horario,
                                'fecha_pago' => $today,
                                'estatus' => 2,
                                'monto' => $residuo,
                                'mes' =>  $hoy->format('m')+($numeroMeses-1),
                                'tipo' => 2]);
                            } else{
                                Pagos::create(
                                ['id_usuario'  => $request->id,
                                'id_nivel' => $request->horario,
                                'fecha_pago' => $today,
                                'estatus' => 1,
                                'monto' => 500,
                                'mes' =>  $hoy->format('m')+$i,
                                'tipo' => 2]);      
                            }

                        }                                                       

                    }
                }
                // if($request->colegiatura != null || $request->colegiatura != ""){
                //     if($request->colegiatura == 500){
                //         Pagos::create(
                //         ['id_usuario'  => $request->id,
                //         'id_nivel' => $request->horario,
                //         'fecha_pago' => $today,
                //         'estatus' => 1,
                //         'monto' => 500,
                //         'mes' =>  $hoy->format('m'),
                //         'tipo' => 2]);
                //     }else{
                //         Pagos::create(
                //         ['id_usuario'  => $request->id,
                //         'id_nivel' => $request->horario,
                //         'fecha_pago' => $today,
                //         'estatus' => 2,
                //         'monto' => $request->colegiatura,
                //         'mes' =>  $hoy->format('m'),
                //         'tipo' => 2]);
                //     }                    
                // }

            }else{
                if($request->inscripcion != null || $request->inscripcion != ""){
                    if($request->inscripcion == 500){
                        Pagos::create(
                        ['id_usuario'  => $request->id,
                        'id_nivel' => $request->horario,
                        'fecha_pago' => $today,
                        'estatus' => 1,
                        'monto' => 500,
                        'mes' =>  $hoy->format('m'),
                        'tipo' => 1]);
                    }else{
                        Pagos::create(
                        ['id_usuario'  => $request->id,
                        'id_nivel' => $request->horario,
                        'fecha_pago' => $today,
                        'estatus' => 2,
                        'monto' => $request->inscripcion,
                        'mes' =>  $hoy->format('m'),
                        'tipo' => 1]);
                    }
                }
                // if($request->colegiatura != null || $request->colegiatura != ""){
                //     if($request->colegiatura == 500){
                //         Pagos::create(
                //         ['id_usuario'  => $request->id,
                //         'id_nivel' => $request->horario,
                //         'fecha_pago' => $today,
                //         'estatus' => 1,
                //         'monto' => 500,
                //         'mes' =>  $hoy->format('m'),
                //         'tipo' => 2]);
                //     }else{
                //         Pagos::create(
                //         ['id_usuario'  => $request->id,
                //         'id_nivel' => $request->horario,
                //         'fecha_pago' => $today,
                //         'estatus' => 2,
                //         'monto' => $request->colegiatura,
                //         'mes' =>  $hoy->format('m'),
                //         'tipo' => 2]);
                //     }                    
                // }                
                //metodo propuesto
                if($abono < $colegiatura ){
                    Pagos::create(
                    ['id_usuario'  => $request->id,
                    'id_nivel' => $request->horario,
                    'fecha_pago' => $today,
                    'estatus' => 2,
                    'monto' => $abono,
                    'mes' =>  $primer_pago,
                    'tipo' => 2]);                    
                }else{
                    if(is_int($abono/$colegiatura) == true){
                        $mesesApagar = $abono/$colegiatura;

                        for ($i=0; $i < $mesesApagar ; $i++) { 
                            $aux = 0;
                            Pagos::create(
                            ['id_usuario'  => $request->id,
                            'id_nivel' => $request->horario,
                            'fecha_pago' => $today,
                            'estatus' => 1,
                            'monto' => 500,
                            'mes' =>  $primer_pago+$i,
                            'tipo' => 2]);
                            $aux++;
                        }
                    }else{
                        
                        $mesesApagarC= explode(".", $abono/$colegiatura);
                        $numeroMeses = $mesesApagarC[0]+1;
                        
                        for ($i=0; $i < $numeroMeses; $i++) { 
                            if($i == ($numeroMeses-1)){
                                $residuo = $abono%$colegiatura;
                                Pagos::create(
                                ['id_usuario'  => $request->id,
                                'id_nivel' => $request->horario,
                                'fecha_pago' => $today,
                                'estatus' => 2,
                                'monto' => $residuo,
                                'mes' =>  $primer_pago+($numeroMeses-1),
                                'tipo' => 2]);
                            }else{
                                Pagos::create(
                                ['id_usuario'  => $request->id,
                                'id_nivel' => $request->horario,
                                'fecha_pago' => $today,
                                'estatus' => 1,
                                'monto' => 500,
                                'mes' =>  $primer_pago+$i,
                                'tipo' => 2]);      
                            }
                        }                                                       
                    }
                }           
            }            
        }
    }else{
        return back();
    }

            return $pdf->stream(); 
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumnos::find($id);
        $input = date($alumno->nacimiento);
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $input)->format('Y-m-d');
        $edad = Carbon::createFromDate($date)->age;

//calculando meses de nivel
        $nivel = Nivel::find($alumno->nivel);
        $start = date($nivel->finicio);
        $inicio = 'd/m/Y';

        $end = date($nivel->ffin);
        $fin = 'd/m/Y';

        $finicio = Carbon::createFromFormat($inicio, $start);
        $ffin = Carbon::createFromFormat($fin, $end);

        $meses = $finicio->diffInMonths($ffin) + 1;
        
        return view('usuarios.show')->with('alumno',$alumno)->with('edad',$edad)->with('meses',$meses);
    }


    public function listaNivel(){

        $niveles = Nivel::orderBy('id','asc')->get();
        return view('usuarios.listaN')->with('niveles',$niveles);
    }

    public function createNivel(){
        return view('usuarios.altaN');
    }

    public function altaNivel(Request $request){

        $nacimeinto =date_create($request->fecha_inicio);
        $finicio = date_format($nacimeinto,"d/m/Y");

        $nacimeinto2 =date_create($request->fecha_fin);
        $ffin= date_format($nacimeinto2,"d/m/Y");


        $nivel = new Nivel($request->all());
        $nivel->nombre = strtoupper($request->nombre);
        $nivel->horario = $request->horario;
        $nivel->finicio = $finicio;
        $nivel->ffin = $ffin;
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

    public function actualiza(Request $request){

        $id = $request->edit_id;
        $data = Alumnos::find($id);

        if($request->hasFile('edit_ruta_foto')){
            $file = $request->file('edit_ruta_foto');
            $name = $data->id."_".$request->edit_nombre."_".$request->edit_ap;
            $file->move(public_path().'/fotos/',$name);

        }else{
            $name = $request->edit_ruta_foto;
        }


        $data->nombre= strtoupper($request->edit_nombre);
        $data->ap = strtoupper($request->edit_ap);
        $data->am = strtoupper($request->edit_am);
        $data->nacimiento = $request->edit_nacimiento;
        $data->direccion = strtoupper($request->edit_direccion);
        $data->ciudad = strtoupper($request->edit_ciudad);
        $data->ocupacion = strtoupper($request->edit_ocupacion);
        $data->estudios = strtoupper($request->edit_estudios);
        $data->nivel = strtoupper($request->edit_horario);
        $data->descuento = strtoupper($request->edit_descuento);
        $data->casa = strtoupper($request->edit_casa);
        $data->oficina = strtoupper($request->edit_oficina);
        $data->celular= strtoupper($request->edit_celular);
        $data->ruta_foto= $name;
        $data->save();

        return back();
    }


    public function actualizan(Request $request){

        $id = $request->editn_id;
        $data = Nivel::find($id);
        $data->nombre= strtoupper($request->edit_nombren);
        $data->horario = strtoupper($request->edit_horario);
        $data->finicio = strtoupper($request->edit_finicio);
        $data->ffin = strtoupper($request->edit_ffin);
        $data->costo = strtoupper($request->edit_costo);
        $data->save();

        return back();
    }


//actualiza usuario de login
   public function actualizaUser(Request $request){

        $id = $request->change_id;
        $data = User::find($id);
        $data->nombre_completo= strtoupper($request->edit_nombre_user);
        $data->email = strtoupper($request->edit_email);
        $data->name = strtoupper($request->edit_user);
        $data->password = bcrypt($request->edit_contraseña);
        $data->backub_contraseña = strtoupper($request->edit_contraseña);
        $data->save();

        return redirect()->route('login');
    }

    public function view(Request $request)
        {
            if($request->ajax()){
                $id = $request->id;
                $info = Alumnos::where('id',$id)->first();
                $nivel = Nivel::find($info->nivel);
                $pagos = Pagos::where('id_usuario',$info->id)->orderBy('id','desc')->first();

                // $mes_fi = Carbon::parse($nivel->ffin);
                // dd($mes_fi);
                // $mes_fin = $mes_fi->format('m');
                $mes_finicio = Carbon::createFromFormat('d/m/Y', $nivel->finicio)->format('m');

                $mes_fin = Carbon::createFromFormat('d/m/Y', $nivel->ffin)->format('m');

                return response()->json(array('info'=>$info,'nivel'=>$nivel,'pagos'=>$pagos,'mes_fin'=>$mes_fin,'mes_finicio'=>$mes_finicio));
            }
        }

    public function viewn(Request $request)
        {
            if($request->ajax()){
                $id = $request->id;
                $info = Nivel::find($id);
                return response()->json($info);
            }
        }

        public function viewU(Request $request)
        {
            if($request->ajax()){
                $id = $request->id;
                $info = User::find($id);
                return response()->json($info);
            }
        }

    public function gethorario($id){
              
                return $horario = Nivel::where('nombre','like',$id)->get();
              
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno = Alumnos::find($id);
        $alumno->activo = 0;
        $alumno->save();

        return redirect()->route('user.index');
    }

    public function pagosal($id)
    {
        //sacar id alumno
        $alumno = Alumnos::find($id);

        //sacar sus pagos
        $pagos = Pagos::where('id_usuario',$alumno->id)->where('id_nivel',$alumno->nivel)->get();

        //fechas de inicio y fin 
        $ini = Nivel::where('id',$alumno->nivel)->first();
        $mesinicio = date_create($ini->finicio);
        $mesi = date_format($mesinicio,'m');

        $mesfin = date_create($ini->ffin);
       
         return view('usuarios.pagosal')->with('alumno',$alumno)->with('pagos',$pagos)->with('mesi',$mesi)->with('mesf',$mesf);
    }

    public function pagomesalum(Request $request){
        //fecha actual y mes actual
        $hoy = Carbon::now();
        $today = $hoy->format('Y-m-d');
        $mesactual = $hoy->format('m');
       
        //id del alumno
        $id = $request->id_alum;
        //sacamos informacion de nivel por el costo 
        $infoa = Alumnos::where('id',$id)->first();
        $nivel = Nivel::find($infoa->nivel);
        $costoN = $nivel->costo;
        $primer_pago = Carbon::createFromFormat('d/m/Y', $nivel->finicio)->format('m');


        //sacamos registro del ultimo pago
        $info = Pagos::where('id_usuario',$id)->where('id_nivel',$nivel->id)->where('tipo',2)->orderBy('id','desc')->first();

        $info2 = Pagos::where('id_usuario',$id)->where('id_nivel',$nivel->id)->where('tipo',1)->orderBy('id','desc')->first();


        if($info == null){
            $numeroinf = 0;
        }else{
            $numeroinf = 1;
        }
        
        if($numeroinf != 0){
            $mp = Carbon::parse($info->fecha_pago);
            $mes_pago = $mp->format('m');
        }

      
        //lo que el usuario teclea
        $abono = $request->pago;

        // si el abono es igual ala colegiatura le pone estatus 1 si no 2
        if($abono == $costoN){
            $estatus = 1; 
        }else{
            $estatus = 2;
        }

      //pagar primer mes si solo pago inscripcion detecta si algun dato tipo colegiatura
      if($numeroinf != 0){
         // si cuando paga es el mismo mes
         if($info->mes == $mesactual){
            //y ya esta pagado crea registros de siguiente mes correspondiente
            if($info->estatus == 1){
                //si abonado es igual actualiza a 1
                if(($abono)==$costoN){
                        Pagos::create(
                        ['id_usuario'  => $info->id_usuario,
                        'id_nivel' => $info->id_nivel,
                        'fecha_pago' => $today,
                        'estatus' => $estatus,
                        'monto' => $abono,
                        'mes' => $info->mes+1,
                        'tipo' => 2]);
                    return back();
                }else
                // si el abono es menor crea con estatus 2
                 if(($abono)<$costoN){
                    Pagos::create(
                        ['id_usuario'  => $info->id_usuario,
                        'id_nivel' => $info->id_nivel,
                        'fecha_pago' => $today,
                        'estatus' => $estatus,
                        'monto' => $abono,
                        'mes' => $info->mes+1,
                        'tipo' => 2]);
                    return back();
                }else
                 // si abono es mayor crea a sts 1 y la diferencia crea registro del siguiente mes
                 if ($abono>$costoN) {
                
                    if(is_int($abono/$costoN) == true){
                        $mesesApagar = $abono/$costoN;
                        $meses_corridos = $info->mes + 1;
                        for ($i=0; $i < $mesesApagar ; $i++) { 
                            $aux = 0;

                            Pagos::create(
                            ['id_usuario'  => $info->id_usuario,
                            'id_nivel' => $info->id_nivel,
                            'fecha_pago' => $today,
                            'estatus' => 1,
                            'monto' => 500,
                            'mes' =>  $meses_corridos + $i,
                            'tipo' => 2]);
                            $aux++;
                        }
                    }else{
                        
                        $mesesApagarC= explode(".", $abono/$costoN);
                        $numeroMeses = $mesesApagarC[0]+1;
                        
                        for ($i=0; $i < $numeroMeses; $i++) { 
                            if($i == ($numeroMeses-1)){
                                $residuo = $abono%$costoN;
                                Pagos::create(
                                ['id_usuario'  => $info->id_usuario,
                                'id_nivel' => $info->id_nivel,
                                'fecha_pago' => $today,
                                'estatus' => 2,
                                'monto' => $residuo,
                                'mes' =>  $info->mes+$numeroMeses,
                                'tipo' => 2]);
                            }else{
                                Pagos::create(
                                ['id_usuario'  => $info->id_usuario,
                                'id_nivel' => $info->id_nivel,
                                'fecha_pago' => $today,
                                'estatus' => 1,
                                'monto' => 500,
                                'mes' =>  $info->mes+$i+1,
                                'tipo' => 2]);      
                            }
                        }
                    }
                }
                return back();
            }// si no esta pagado hace condiciones
            else{ 
        //////////////////////////////////////////////              
                //si el monto que tenia mas el abonado es igual actualiza a 1
                if(($abono+$info->monto)==$costoN){

                    $pagoupdate = array_merge($request->all(),array(
                    'fecha_pago' => $today,
                    'estatus'=>1,
                    'monto' => ($abono+$info->monto)));

                    $pag = Pagos::find($info->id);
                    $pag->update($pagoupdate);
                    return back();
                }else
                // si el monto que tenia mas el abonado es menor actualiza monto
                 if(($abono+$info->monto)<$costoN){
                    $pagoupdate = array_merge($request->all(),array(
                    'fecha_pago' => $today,
                    'monto' => ($abono+$info->monto)));

                    $pag = Pagos::find($info->id);
                    $pag->update($pagoupdate);
                    return back();
                }else
                 // si el monto que tenia mas el abonado es mayor actualiza a 1 y la diferencia crea registro del siguiente mes
                 if (($abono+$info->monto)>$costoN) {
                   $pagoupdate = array_merge($request->all(),array(
                    'fecha_pago' => $today,
                    'estatus'=>1,
                    'monto' => $costoN));
                    $pag = Pagos::find($info->id);
                    $pag->update($pagoupdate);

                    $faltante = $costoN - $info->monto;
                    $abonado2 = $abono - $faltante;
                    if(is_int($abonado2/$costoN) == true){
                        $mesesApagar = $abonado2/$costoN;
                        $meses_corridos = $info->mes + 1;
                        for ($i=0; $i < $mesesApagar ; $i++) { 
                            $aux = 0;

                            Pagos::create(
                            ['id_usuario'  => $info->id_usuario,
                            'id_nivel' => $info->id_nivel,
                            'fecha_pago' => $today,
                            'estatus' => 1,
                            'monto' => 500,
                            'mes' =>  $meses_corridos + $i,
                            'tipo' => 2]);
                            $aux++;
                        }
                    }else{
                        
                        $mesesApagarC= explode(".", $abonado2/$costoN);
                        $numeroMeses = $mesesApagarC[0]+1;
                        //si abonado 2 es menor ala colegitura solo se agrega el reg del lo restante si no agrega registros de meses +
                        if($abonado2<$costoN){
                            $residuo = $abonado2%$costoN;
                            Pagos::create(
                            ['id_usuario'  => $info->id_usuario,
                            'id_nivel' => $info->id_nivel,
                            'fecha_pago' => $today,
                            'estatus' => 2,
                            'monto' => $abonado2,
                            'mes' =>  $info->mes+$numeroMeses,
                            'tipo' => 2]);
                        }else{
                            for ($i=0; $i < $numeroMeses; $i++) { 
                                if($i == ($numeroMeses-1)){
                                    $residuo = $abonado2%$costoN;
                                    Pagos::create(
                                    ['id_usuario'  => $info->id_usuario,
                                    'id_nivel' => $info->id_nivel,
                                    'fecha_pago' => $today,
                                    'estatus' => 2,
                                    'monto' => $residuo,
                                    'mes' =>  $info->mes+$numeroMeses,
                                    'tipo' => 2]);
                                }else{
                                    Pagos::create(
                                    ['id_usuario'  => $info->id_usuario,
                                    'id_nivel' => $info->id_nivel,
                                    'fecha_pago' => $today,
                                    'estatus' => 1,
                                    'monto' => 500,
                                    'mes' =>  $info->mes+$i+1,
                                    'tipo' => 2]);      
                                }
                            }
                        }
                                                                                   
                    }
                }
                return back();
            }
            ///////////////////////////////////////
         }// si no es del mismo mes crea la siguiente dependiente del mes
         else{
            if($mes_pago == $mesactual && $mes_pago != $info->mes){
                if($info->estatus == 1){
                    //si abonado es igual actualiza a 1
                    if(($abono)==$costoN){
                            Pagos::create(
                            ['id_usuario'  => $info->id_usuario,
                            'id_nivel' => $info->id_nivel,
                            'fecha_pago' => $today,
                            'estatus' => $estatus,
                            'monto' => $abono,
                            'mes' => $info->mes+1,
                            'tipo' => 2]);
                        return back();
                    }else
                    // si el abono es menor crea con estatus 2
                     if(($abono)<$costoN){
                        Pagos::create(
                            ['id_usuario'  => $info->id_usuario,
                            'id_nivel' => $info->id_nivel,
                            'fecha_pago' => $today,
                            'estatus' => $estatus,
                            'monto' => $abono,
                            'mes' => $info->mes+1,
                            'tipo' => 2]);
                        return back();
                    }else
                     // si abono es mayor crea a sts 1 y la diferencia crea registro del siguiente mes
                     if ($abono>$costoN) {
                    
                        if(is_int($abono/$costoN) == true){
                            $mesesApagar = $abono/$costoN;
                            $meses_corridos = $info->mes + 1;
                            for ($i=0; $i < $mesesApagar ; $i++) { 
                                $aux = 0;

                                Pagos::create(
                                ['id_usuario'  => $info->id_usuario,
                                'id_nivel' => $info->id_nivel,
                                'fecha_pago' => $today,
                                'estatus' => 1,
                                'monto' => 500,
                                'mes' =>  $meses_corridos + $i,
                                'tipo' => 2]);
                                $aux++;
                            }
                        }else{
                            
                            $mesesApagarC= explode(".", $abono/$costoN);
                            $numeroMeses = $mesesApagarC[0]+1;
                            
                            for ($i=0; $i < $numeroMeses; $i++) { 
                                if($i == ($numeroMeses-1)){
                                    $residuo = $abonado2%$costoN;
                                    Pagos::create(
                                    ['id_usuario'  => $info->id_usuario,
                                    'id_nivel' => $info->id_nivel,
                                    'fecha_pago' => $today,
                                    'estatus' => 2,
                                    'monto' => $residuo,
                                    'mes' =>  $info->mes+$numeroMeses,
                                    'tipo' => 2]);
                                }else{
                                    Pagos::create(
                                    ['id_usuario'  => $info->id_usuario,
                                    'id_nivel' => $info->id_nivel,
                                    'fecha_pago' => $today,
                                    'estatus' => 1,
                                    'monto' => 500,
                                    'mes' =>  $info->mes+$i+1,
                                    'tipo' => 2]);      
                                }
                            }
                        }
                    }
                    return back();
                }else{//
                    //si el monto que tenia mas el abonado es igual actualiza a 1
                    if(($abono+$info->monto)==$costoN){

                        $pagoupdate = array_merge($request->all(),array(
                        'fecha_pago' => $today,
                        'estatus'=>1,
                        'monto' => ($abono+$info->monto)));

                        $pag = Pagos::find($info->id);
                        $pag->update($pagoupdate);
                        return back();
                    }else
                    // si el monto que tenia mas el abonado es menor actualiza monto
                     if(($abono+$info->monto)<$costoN){
                        $pagoupdate = array_merge($request->all(),array(
                        'fecha_pago' => $today,
                        'monto' => ($abono+$info->monto)));

                        $pag = Pagos::find($info->id);
                        $pag->update($pagoupdate);
                        return back();
                    }else
                     // si el monto que tenia mas el abonado es mayor actualiza a 1 y la diferencia crea registro del siguiente mes
                     if (($abono+$info->monto)>$costoN) {
                       $pagoupdate = array_merge($request->all(),array(
                        'fecha_pago' => $today,
                        'estatus'=>1,
                        'monto' => $costoN));
                        $pag = Pagos::find($info->id);
                        $pag->update($pagoupdate);

                        $faltante = $costoN - $info->monto;
                        $abonado2 = $abono - $faltante;
                        if(is_int($abonado2/$costoN) == true){
                            $mesesApagar = $abonado2/$costoN;
                            $meses_corridos = $info->mes + 1;
                            for ($i=0; $i < $mesesApagar ; $i++) { 
                                $aux = 0;

                                Pagos::create(
                                ['id_usuario'  => $info->id_usuario,
                                'id_nivel' => $info->id_nivel,
                                'fecha_pago' => $today,
                                'estatus' => 1,
                                'monto' => 500,
                                'mes' =>  $meses_corridos + $i,
                                'tipo' => 2]);
                                $aux++;
                            }
                        }else{
                            
                            $mesesApagarC= explode(".", $abonado2/$costoN);
                            $numeroMeses = $mesesApagarC[0]+1;
                            //si abonado 2 es menor ala colegitura solo se agrega el reg del lo restante si no agrega registros de meses +
                            if($abonado2<$costoN){
                                $residuo = $abonado2%$costoN;
                                Pagos::create(
                                ['id_usuario'  => $info->id_usuario,
                                'id_nivel' => $info->id_nivel,
                                'fecha_pago' => $today,
                                'estatus' => 2,
                                'monto' => $abonado2,
                                'mes' =>  $info->mes+$numeroMeses,
                                'tipo' => 2]);
                            }else{
                                for ($i=0; $i < $numeroMeses; $i++) { 
                                    if($i == ($numeroMeses-1)){
                                        $residuo = $abonado2%$costoN;
                                        Pagos::create(
                                        ['id_usuario'  => $info->id_usuario,
                                        'id_nivel' => $info->id_nivel,
                                        'fecha_pago' => $today,
                                        'estatus' => 2,
                                        'monto' => $residuo,
                                        'mes' =>  $info->mes+$numeroMeses,
                                        'tipo' => 2]);
                                    }else{
                                        Pagos::create(
                                        ['id_usuario'  => $info->id_usuario,
                                        'id_nivel' => $info->id_nivel,
                                        'fecha_pago' => $today,
                                        'estatus' => 1,
                                        'monto' => 500,
                                        'mes' =>  $info->mes+$i+1,
                                        'tipo' => 2]);      
                                    }
                                }
                            }
                                                                                       
                        }
                    }
                    return back();                   
                }//

            }else{
            //pago mes normal correspondiente
                Pagos::create(
                    ['id_usuario'  => $id,
                    'id_nivel' => $info->id_nivel,
                    'fecha_pago' => $today,
                    'estatus' => $estatus,
                    'monto' => $abono,
                    'mes' => $hoy->format('m'),
                    'tipo' => 2]);
                    return back();
            }
         }
      }else{
        //si no crea registro del primer mes de colegiatura
        //si el curso ya empezo y paga un mes despues o dependiendo guarda el mes que entra
        if($primer_pago >= $mesactual){
            if(($abono)==$costoN){
                Pagos::create(
                ['id_usuario'  => $info2->id_usuario,
                'id_nivel' => $info2->id_nivel,
                'fecha_pago' => $today,
                'estatus' => $estatus,
                'monto' => $abono,
                'mes' => $primer_pago,
                'tipo' => 2]);
                return back();
            }else
                // si el abono es menor crea con estatus 2
                if(($abono)<$costoN){
                Pagos::create(
                    ['id_usuario'  => $info2->id_usuario,
                    'id_nivel' => $info2->id_nivel,
                    'fecha_pago' => $today,
                    'estatus' => $estatus,
                    'monto' => $abono,
                    'mes' => $primer_pago,
                    'tipo' => 2]);
                    return back();
                }else
                 // si abono es mayor crea a 1 y la diferencia crea registro del siguiente mes
                 if (($abono)>$costoN) {
                    
                    if(is_int($abono/$costoN) == true){
                        $mesesApagar = $abono/$costoN;
                        $meses_corridos = $info2->mes;
                        for ($i=0; $i < $mesesApagar ; $i++) { 
                            $aux = 0;

                            Pagos::create(
                            ['id_usuario'  => $info2->id_usuario,
                            'id_nivel' => $info2->id_nivel,
                            'fecha_pago' => $today,
                            'estatus' => 1,
                            'monto' => 500,
                            'mes' =>  $meses_corridos + $i,
                            'tipo' => 2]);
                            $aux++;
                        }
                    }else{
                        
                        $mesesApagarC= explode(".", $abono/$costoN);
                        $numeroMeses = $mesesApagarC[0]+1;
                        
                        for ($i=0; $i < $numeroMeses; $i++) { 
                            if($i == ($numeroMeses-1)){
                                $residuo = $abono%$costoN;
                                Pagos::create(
                                ['id_usuario'  => $info2->id_usuario,
                                'id_nivel' => $info2->id_nivel,
                                'fecha_pago' => $today,
                                'estatus' => 2,
                                'monto' => $residuo,
                                'mes' =>  $info2->mes+($numeroMeses-1),
                                'tipo' => 2]);
                            }else{
                                Pagos::create(
                                ['id_usuario'  => $info2->id_usuario,
                                'id_nivel' => $info2->id_nivel,
                                'fecha_pago' => $today,
                                'estatus' => 1,
                                'monto' => 500,
                                'mes' =>  $info2->mes+$i,
                                'tipo' => 2]);      
                            }
                        }
                    }
                }
                return back();

        }else{
            if(($abono)==$costoN){
                Pagos::create(
                ['id_usuario'  => $info2->id_usuario,
                'id_nivel' => $info2->id_nivel,
                'fecha_pago' => $today,
                'estatus' => $estatus,
                'monto' => $abono,
                'mes' => $mesactual,
                'tipo' => 2]);
                return back();
            }else
                // si el abono es menor crea con estatus 2
                if(($abono)<$costoN){
                Pagos::create(
                    ['id_usuario'  => $info2->id_usuario,
                    'id_nivel' => $info2->id_nivel,
                    'fecha_pago' => $today,
                    'estatus' => $estatus,
                    'monto' => $abono,
                    'mes' => $mesactual,
                    'tipo' => 2]);
                    return back();
                }else
                 // si abono es mayor crea a 1 y la diferencia crea registro del siguiente mes
                 if (($abono)>$costoN) {
                    
                    if(is_int($abono/$costoN) == true){
                        $mesesApagar = $abono/$costoN;
                        $meses_corridos = $info2->mes;
                        for ($i=0; $i < $mesesApagar ; $i++) { 
                            $aux = 0;

                            Pagos::create(
                            ['id_usuario'  => $info2->id_usuario,
                            'id_nivel' => $info2->id_nivel,
                            'fecha_pago' => $today,
                            'estatus' => 1,
                            'monto' => 500,
                            'mes' =>  $meses_corridos + $i,
                            'tipo' => 2]);
                            $aux++;
                        }
                    }else{
                        
                        $mesesApagarC= explode(".", $abono/$costoN);
                        $numeroMeses = $mesesApagarC[0]+1;
                        
                        for ($i=0; $i < $numeroMeses; $i++) { 
                            if($i == ($numeroMeses-1)){
                                $residuo = $abonado2%$costoN;
                                Pagos::create(
                                ['id_usuario'  => $info2->id_usuario,
                                'id_nivel' => $info2->id_nivel,
                                'fecha_pago' => $today,
                                'estatus' => 2,
                                'monto' => $residuo,
                                'mes' =>  $info2->mes+$numeroMeses,
                                'tipo' => 2]);
                            }else{
                                Pagos::create(
                                ['id_usuario'  => $info2->id_usuario,
                                'id_nivel' => $info2->id_nivel,
                                'fecha_pago' => $today,
                                'estatus' => 1,
                                'monto' => 500,
                                'mes' =>  $info2->mes+$i,
                                'tipo' => 2]);      
                            }
                        }
                    }
                }
                return back();
        }
      }
    }

    public function ChangeUser(){
        return view('usuarios.CambioUsuario');
    }

    public function cortecaja(Request $request){
         if($request->ajax()){
                $fecha = $request->fecha;
                $info = Pagos::where('fecha_pago',"=",$fecha)->get();
            
            $info->each(function($info){
                        $info->alumnop;
                        $info->nivelp;
                    });


                return response()->json($info);
            }
    }

    public function listaxnivel1(Request $request){
         if($request->ajax()){
                $horario = $request->horario;
                $info = Alumnos::where('nivel',"=",$horario)->where('activo','=',1)->get();
            
            $info->each(function($info){
                        $info->nivelAl;
                    });


                return response()->json($info);
        }
    }

    public function listarpdf($id){
        $info = Alumnos::where('nivel',"=",$id)->get();
            
        $info->each(function($info){
                        $info->nivelAl;
                    });
        $pdf = PDF::loadView('pdf.listarxnivel',['info'=>$info]);

        return $pdf->stream(); 
    }

public function basico($numero) {
        $valor = array ('uno','dos','tres','cuatro','cinco','seis','siete','ocho',
        'nueve','diez','once','doce','trece','catorce','quince','dieciseis','diecisiete','dieciocho','diecinueve','veinte','veintiuno','veintidos','veintitres', 'veinticuatro','veinticinco',
        'veintiséis','veintisiete','veintiocho','veintinueve');
        return $valor[$numero - 1];
    }

    public function decenas($n) {
        $decenas = array (30=>'treinta',40=>'cuarenta',50=>'cincuenta',60=>'sesenta',
        70=>'setenta',80=>'ochenta',90=>'noventa');
        if( $n <= 29) return $this->basico($n);
        $x = $n % 10;
        if ( $x == 0 ) {
        return $decenas[$n];
        } else return $decenas[$n - $x].' y '. $this->basico($x);
    }

    public function centenas($n) {
        $cientos = array (100 =>'cien',200 =>'doscientos',300=>'trecientos',
        400=>'cuatrocientos', 500=>'quinientos',600=>'seiscientos',
        700=>'setecientos',800=>'ochocientos', 900 =>'novecientos');
        if( $n >= 100) {
            if ( $n % 100 == 0 ) {
                return $cientos[$n];
            } else {
                $u = (int) substr($n,0,1);
                $d = (int) substr($n,1,2);
                return (($u == 1)?'ciento':$cientos[$u*100]).' '.$this->decenas($d);
            }
        } else return $this->decenas($n);
    }

    public function miles($n) {
        if($n > 999) {
            if( $n == 1000) {return 'mil';}
            else {
                $l = strlen($n);
                $c = (int)substr($n,0,$l-3);
                $x = (int)substr($n,-3);
                if($c == 1) {$cadena = 'mil '.$this->centenas($x);}
                else if($x != 0) {$cadena = $this->centenas($c).' mil '.       $this->centenas($x);}
                else $cadena = $this->centenas($c). ' mil';
                    return $cadena;
            }
        } else return $this->centenas($n);
    }

    public function millones($n) {
        if($n == 1000000) {return 'un millón';}
        else {
            $l = strlen($n);
            $c = (int)substr($n,0,$l-6);
            $x = (int)substr($n,-6);
            if($c == 1) {
                $cadena = ' millón ';
            } else {
                $cadena = ' millones ';
            }
                return $this->miles($c).$cadena.(($x > 0)?$this->miles($x):'');
        }
    }
    public function convertir($n) {
        switch (true) {
        case ( $n >= 1 && $n <= 29) : return $this->basico($n); break;
        case ( $n >= 30 && $n < 100) : return $this->decenas($n); break;
        case ( $n >= 100 && $n < 1000) : return $this->centenas($n); break;
        case ($n >= 1000 && $n <= 999999): return $this->miles($n); break;
        case ($n >= 1000000): return $this->millones($n);
        }
    }
}
