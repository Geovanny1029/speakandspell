<!DOCTYPE html>
<html>
<head>
    <title></title>
<link rel="stylesheet" href="{{asset('css/login/lity.css')}}">
<link href="{{asset('css/perfil/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="{{asset('css/perfil/style.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>


<!------ Include the above in your HEAD tag ---------->

<div class="container emp-profile" style="max-width: 920px;">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            @if($alumno->ruta_foto == null)
                            <img src="/fotos/speakandspell.png" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                No hay foto
                                
                            </div>
                            @else
                            <img src="/fotos/{{$alumno->ruta_foto}}" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        {{$alumno->nombre}} {{$alumno->ap}}
                                    </h5>
                                    <h6>
                                        Nivel : {{$alumno->nivel}}
                                    </h6>
                                    <h6>
                                        Duracion : {{$meses}} Meses
                                    </h6>
                                 
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informacion Basica</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Otros</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        PERFIL
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>Telefonos</p>
                            <a href="#">Casa: {{$alumno->casa}}</a><br/>
                            <a href="#">Oficina: {{$alumno->oficina}}</a><br/>
                            <a href="#">Celular: {{$alumno->Celular}}</a>
                         
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nombre</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$alumno->nombre}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Apellido Paterno</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$alumno->ap}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Apellido Materno</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$alumno->am}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nacimiento</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$alumno->nacimiento}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Edad:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$edad}} Años</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Direccion</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$alumno->direccion}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Ciudad</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$alumno->ciudad}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Ocupacion</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$alumno->ocupacion}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Estudios</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$alumno->estudios}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Descuento</label>
                                            </div>
                                            <div class="col-md-6">
                                              
                                                <p>{{$alumno->descuento}}</p>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>

<script src="{{ URL::asset('js/perfil/jquery.min.js')}}"></script>
<script src="{{ URL::asset('js/lity.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
{{-- 





//////////////////

<!DOCTYPE html>
<html>
<head>
	<title>perfil alumno</title>
<link rel="stylesheet" href="{{asset('css/login/bootstrap.css')}}">

<link rel="stylesheet" href="{{asset('css/login/font-awesome.css')}}">
<link rel="stylesheet" href="{{asset('css/login/style.css')}}">
<link rel="stylesheet" href="{{asset('css/login/pages/dashboard.css')}}">
<link rel="stylesheet" href="{{asset('css/login/lity.css')}}">
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
</head>
<body>
  <div class="container-fluid"><br>
    <div class="panel panel-info">
      <div class="panel-heading"><center><h4><b>PERFIL ALUMNO: {{$alumno->nombre}}</b></h4></center></center></div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-6">
            	Nombre completo:{{$alumno->nombre}} {{$alumno->ap}} {{$alumno->am}}
            </div>
          </div>
        </div>
    </div>  
<script src="{{ URL::asset('js/login/jquery-3.4.0.min.js')}}"></script>
<script src="{{ URL::asset('js/metodos.js')}}"></script>
<script src="{{ URL::asset('js/login/excanvas.min.js')}}"></script>
<script src="{{ URL::asset('js/login/bootstrap.js')}}"></script>

<script src="{{ URL::asset('js/login/full-calendar/fullcalendar.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('js/lity.js')}}"></script> 
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script src="{{ URL::asset('js/login/base.js')}}"></script>
<script> 
</body>
</html> --}}