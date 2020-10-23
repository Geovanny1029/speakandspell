<table class='table table-striped'>
	<thead class='thead-dark'>
		<th>NOMBRE</th>
		<th>DIA</th>
	</thead>
	<tbody>
		@if(count($alumnos) > 0)
			@foreach($alumnos as $alumno)
				<tr>
					<td> {{ $alumno->nombre }} </td>
					<td> {{ substr($alumno->nacimiento,0,8) }} </td>
				</tr>				
			@endforeach
		@else
			<tr>
				<td>
				<td>
			</tr>			
		@endif
	</tbody>
</table>
@if(count($niveles) == 0)
	<br>
@else
	<h4>
		<span class='label label-danger'>
		Hay {{ count($niveles) }} Niveles que ya vencieron
		</span>
	</h4> 
	<br> 
	<h4>
		<span class='label label-danger'>
			verificalos en el modulo de niveles
		</span>
	</h4>

	<a href='/listaNivel' class='btn btn-danger'>revisar</a>
@endif