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
        <div class="container emp-profile" style="max-width: 920px;">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="{{ isset($student->ruta) ? '/fotos/'.$student->ruta : '/img/avatar-default.jpg' }}" alt="" width="200px;"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                {{$student->nombre}} {{$student->ap}}
                            </h5>
                            <h6>
                                Nivel : {{ isset($nivel) ? $nivel->nombre : ''}}
                            </h6>
                            <h6>
                                Duracion : {{
                                    isset($nivel)
                                    ? now()->createFromFormat('d/m/Y',$nivel->finicio)
                                        ->diffInMonths(
                                            now()->createFromFormat('d/m/Y',$nivel->ffin)
                                        ) + 1
                                    : 0
                                }} Meses
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
                            <a href="#">Casa: {{$student->casa}}</a><br/>
                            <a href="#">Oficina: {{$student->oficina}}</a><br/>
                            <a href="#">Celular: {{$student->Celular}}</a>
                         
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
                                        <p>{{$student->nombre}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Apellido Paterno</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$student->ap}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Apellido Materno</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$student->am}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nacimiento</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$student->nacimiento}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Edad:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ now()->diffInYears(now()->createFromFormat('d/m/Y',$student->nacimiento)) }} Años</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Direccion</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$student->direccion}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Ciudad</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$student->ciudad}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Ocupacion</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$student->ocupacion}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Estudios</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$student->estudios}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Descuento</label>
                                    </div>
                                    <div class="col-md-6">
                                        
                                        <p>{{$student->descuento}}</p>
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