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
        return view('usuarios.listaxnivel');
    }


    public function pagos(){
        $alumnos = Alumnos::orderBy('id','asc')->where('activo','1')->get();

        $alumnos->each(function($alumnos){
            $alumnos->nivelAl;
        });
        return view('usuarios.pagos')->with('alumnos',$alumnos);
    }

    public function corte(){
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

            $user = new Alumnos($request->all());
            $user->id = $request->id;
            $user->nombre=strtoupper($request->nombre);
            $user->ap=strtoupper($request->apellido_paterno);
            $user->am=strtoupper($request->apellido_materno);
            $user->nacimiento=strtoupper($request->nacimiento);
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
            // $user->save();


            $hoy = Carbon::now();
            $today = $hoy->format('Y-m-d');
            $monthactual = $hoy->format('m');

            //sacar meses
            $input = date($request->nacimiento);
            $format = 'd/m/Y';
            $date = Carbon::createFromFormat($format, $input)->format('Y-m-d');
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


            $pdf = PDF::loadView('pdf.fichaInscripcion',['user'=>$user,'meses'=>$meses,'edad'=>$edad]);

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

                //metodo propuesto
                //si el abono es menor a la colegiatura
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
            //y ya esta pagado crea registros de siguiente mes
            if($info->estatus == 1){
                Pagos::create(
                ['id_usuario'  => $id,
                    'id_nivel' => $info->id_nivel,
                    'fecha_pago' => $today,
                    'estatus' => $estatus,
                    'monto' => $abono,
                    'mes' => $hoy->format('m')+1,
                    'tipo' => 2]);
                 return back();
            }// si no esta pagado hace condiciones
            else{
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

                    Pagos::create(
                    ['id_usuario'  => $id,
                        'id_nivel' => $info->id_nivel,
                        'fecha_pago' => $today,
                        'estatus' => 2,
                        'monto' => ($abono+$info->monto)-$costoN,
                        'mes' => $hoy->format('m')+1,
                        'tipo' => 2]);

                }
                return back();
            }
         }// si no es del mismo mes crea la siguiente dependiente del mes
         else{
            if($mes_pago == $mesactual && $mes_pago != $info->mes){
                if($info->estatus == 1){
                     Pagos::create(
                        ['id_usuario'  => $id,
                        'id_nivel' => $info->id_nivel,
                        'fecha_pago' => $today,
                        'estatus' => $estatus,
                        'monto' => $abono,
                        'mes' => $info->mes+1,
                        'tipo' => 2]);
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

                        Pagos::create(
                        ['id_usuario'  => $id,
                            'id_nivel' => $info->id_nivel,
                            'fecha_pago' => $today,
                            'estatus' => 2,
                            'monto' => ($abono+$info->monto)-$costoN,
                            'mes' => $info->mes+1,
                            'tipo' => 2]);

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
            Pagos::create(
            ['id_usuario'  => $id,
            'id_nivel' => $info2->id_nivel,
            'fecha_pago' => $today,
            'estatus' => $estatus,
            'monto' => $abono,
            'mes' => $primer_pago,
            'tipo' => 2]);
            return back();
        }else{
            Pagos::create(
            ['id_usuario'  => $id,
            'id_nivel' => $info2->id_nivel,
            'fecha_pago' => $today,
            'estatus' => $estatus,
            'monto' => $abono,
            'mes' => $mesactual,
            'tipo' => 2]);
            return back();
        }
      }
    }
}
