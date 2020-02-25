<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Lista x Nivel</title>
	<link rel="stylesheet" type="text/css" href="./css/cabecera.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<center><h4>Lista de Alumnos del Nivel cual</h4></center>
    <table class="table table-striped" style='width:100%;'>
         <tr>
            <th>Matricula</th>
            <th>Nombre(s)</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
         </tr>
          @foreach($info as $alumno)
            <tr>
              <td> {{$alumno->id}} </td>
              <td> {{$alumno->nombre}} </td>
              <td> {{$alumno->ap}}</td>
              <td>{{$alumno->am}}</td>
            </tr>
          @endforeach
     </table> 
</body>
</html>