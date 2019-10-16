@extends('usuarios.index')
@section('content')
            <div class="widget-header"> 
              <center><h3>Listado de Usuarios</h3></center>
            </div>
            <div class="widget-content">
              <div class="shortcuts">
                Lista de usuarios inactivos 
              </div>
        <table class="table table-striped" id="tablaasignaturas">
          <thead>
            <th>Matricula</th>
            <th>Nombre</th>
            <th>Nivel</th>
            <th>Accion</th>
          </thead>
          <tbody>
            @foreach($alumnos as $alumno)
            <tr>

              <td> {{$alumno->matricula}} </td>
              <td> {{$alumno->nombre}} </td>
              <td> {{$alumno->nivel}} </td>
              <td>
                perfil
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>              
            </div>
@endsection