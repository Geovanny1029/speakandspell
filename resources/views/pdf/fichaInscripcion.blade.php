<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Ficha Inscripcion</title>
	<link rel="stylesheet" type="text/css" href="./css/cabecera.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<center><img src="./images/speakn1.jpg" width="220" height="80" align="center"></center>
	<div class="cabecera">
		<div class="cabecera1">
		<center><b>Escuela de Ingles</b> <br> 
		Calle 29 No. 108 x 72 y 74, Progreso, Yuc. Tel. (969) 935 1608<br>
	Ficha de Inscripcion</center>
		</div>
	</div>

	<div class="contenido">
		<br>
		<table style="width: 100%;  border-collapse: separate;
  border-spacing:  5px 5px;  ">
			<tr>
				<td colspan="2"><b>Matricula:</b>  {{$user->id}}</td>
				
			</tr>
			<tr>
				<td style="width: 40%"><b>Nombres:</b>  {{$user->nombre}}</td>
				
				<td colspan="2"><b>Apellidos:</b>  {{$user->ap}} {{$user->am}}</td>
			</tr>
			<tr>
				<td colspan="3"><b>Direccion:</b> {{$user->direccion}}</td>
			</tr>
			<tr>
				<td style="width: 40%"><b>Ciudad:</b> {{$user->ciudad}}</td>
				<td><b>Estado:</b> Yucatan</td>
				<td><b>Ocupacion:</b> {{$user->ocupacion}}</td>
				
			</tr>
			<tr>
				<td colspan="3"><b>Telefonos</b> </td>
			</tr>
			<tr>
				<td><b>Casa:</b> {{$user->casa}}</td>
				<td><b>Oficina:</b> {{$user->oficina}}</td>
				<td><b>Celular:</b> {{$user->celular}}</td>
			</tr>
			<tr>
				<td><b>Fecha de nacimiento:</b> {{$user->nacimiento}} </td>
				<td><b>Edad:</b> {{$edad}}</td>
				<td><b>Grado:</b>4TO PRIMARIA</td>
			</tr>
			<tr>
				<td><b>Nivel: </b> {{$user->nivel}}</td>
				<td><b>Horario:</b> {{$user->nivel}}</td>

			</tr>

		</table><br>

		<center>Control de Pago</center><br>
		<table class="pago">
			<tr class="pago1">
				<td colspan="2"  class="pago1"><center><b>CURSO DE INGLES</b></center></td>
			</tr>
			<tr class="pago1">
				<td class="pago2">Duracion:</td>
				<td class="pago1">{{$meses}}</td>
			</tr class="pago1">
			<tr class="pago1">
				<td class="pago2">Inscripcion:</td>
				<td class="pago1">$500</td>
			</tr>
			<tr class="pago1">
				<td class="pago2">Mensualidad:</td>
				<td class="pago1">$500</td>
			</tr>
			<tr class="pago1">
				<td class="pago2">Inicio Curso:</td>
				<td class="pago1">curso</td>
			</tr>
		</table><br>
		<div>
			<div class="left">Fecha: 02 Diciembre 2019</div>
			<div class="right">Prof David Mendez Morales</div>
		</div><br>
		<div><br>
			<center><b>COMPROMISO DE ASISTENCIA</b></center><br>
			Me comprometo a manifestar mi baja definitiva en la oficina personalmente, para que los pagos se cancelen y no sigan causando pago alguno (los pagos ya efectuados no tienen devolucion). <br><br>

			<div class="right">__________________________    <br>
				  Firma del padre o tutor
			</div>
		</div>
	</div>

		@if($colegiatura == null || $colegiatura == "")
		@else<br>
		<hr>
			<div class="contenidop">
				<div style="border-style: solid;  margin:5px;padding: 5px">
					<div class="cabecera" >
						<div class="cabecera1">
							<center><b>Escuela de Ingles</b> <br> 
							Calle 29 No. 108 x 72 y 74,<br> Progreso, Yucatan, Mexico.
							</center><br>
							<div style="float: left; padding: 1em">Porgreso Yucatan a dia mes año  </div>
							<div style="float: right; padding: 1em">bueno por ${{$colegiatura}}</div>
						</div><br>
					</div>

					              
					<div class="contenido" style="border-style: solid;">
						<center>
					Recibi de {{$user->nombre}} {{$user->ap}} {{$user->am}}  la cantidad de: ${{$colegiatura}} (son: {{$letras}} Pesos, 00/100 mon. nal) por concepto del mes de 
						</center>
					</div>

					<div>
						<div class="right"><center>Recibi</center>

						<center>Prof. David Mendez Morales<br>
						Director "SPEAK and SPELL"</center>
						</div>
					</div>
				</div>
			</div>

		@endif

</body>
</html>