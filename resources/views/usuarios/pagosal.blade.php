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
                    <div class="col-md-12">
                        <center>Informacion</center>
                        Alumno: {{$alumno->nombre}}<br>
                        Nivel: {{$alumno->nivel}}<br>
                        <br>

                        Estado de pagos:<br>
                        @foreach($pagos as $pago)
                          @if($pago->tipo == 1)
                          inscripcion
                          @elseif($pago->tipo == 2)
                          colegiatura
                          @else
                          @endif
                         {{$pago->tipo}}<br>
                        @endforeach

      <?php
       $mes = [];
        for ($i=$mesi; $i <= $mesf ; $i++) { 
           echo $mes[$i];
         } 
      ?>
                    </div>
                </div>
                <div class="row">
                    
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