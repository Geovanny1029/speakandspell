@extends('usuarios.index')
@section('content')
            <div class="widget-header"> 
              <center><h3>Listado de Usuarios Inactivos</h3></center>
            </div>
            <div class="widget-content">
              <div class="shortcuts">
                  <div class="row">
                    <div class="form-group col-md-12">
                    <a href="{{route('user.menu')}}" class="btn btn-success" style="width: 100%">INICIO</a>
                    </div>
                  </div> 
                 <a href="/listaAlumno/0" data-lity class='btn btn-primary'>Generar Lista</a><br><br>
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

              <td> {{$alumno->id}} </td>
              <td> {{$alumno->nombre}} {{$alumno->ap}} {{$alumno->am}}  </td>
              <td> {{$alumno->nivel}} </td>
              <td>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalreincorporar">
                               Reincorporar
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
          @include('usuarios.modals.inactivos')
        </table>              
            </div>
@endsection