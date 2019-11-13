@extends('usuarios.index')
@section('content')
            <div class="widget-header"> 
              <center><h3>Listado de Usuarios</h3></center>
            </div>
            <div class="widget-content">
              <div class="shortcuts">
                Lista de usuarios activos 
              </div><br>
        <table class="table table-striped" id="tablaasignaturas">
          <thead>
            <th>Matricula</th>
            <th>Nombre completo</th>
            <th>Nivel</th>
            <th>Accion</th>
          </thead>
          <tbody>
            @foreach($alumnos as $alumno)
            <tr>

              <td> {{$alumno->matricula}}   </td>
              <td> {{$alumno->nombre}} {{$alumno->ap}} {{$alumno->am}} </td>
              <td> {{$alumno->nivel}} </td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      Accion
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#">Ver perfil</a></li>
                    <li><a data-toggle="modal" data-target="#editModal" onclick="fun_edit('{{$alumno->matricula}}')" id="editar" value="{{route('users.view')}}">Editar</a></li>
                    <li><a href="#">Pagos</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a onclick="return confirm('¿Seguro que deseas dar de baja este Usuario?')" href="{{route('user.destroy', $alumno->matricula)}}">Dar Baja</a></li>
                  </ul>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
          @include('usuarios.modals.editaU')
        </table>              
            </div>
@endsection