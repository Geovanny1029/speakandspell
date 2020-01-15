@extends('usuarios.index')
@section('content')

            <div class="widget-header"> 
              <center><h3>Pagos Alumnos</h3></center>
            </div>
            <div class="widget-content">
              <div class="shortcuts">
                  <div class="form-group col-md-12" id="gralprevio">
                    <div class="dropdown" >
                      <button class="form-group col-md-12 btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                         ACCION
                      </button>
                    <ul class="dropdown-menu form-group col-md-12">
                      <li><a href="{{route('user.menu')}}">INICIO</a></li>
                      <li><a href="{{route('user.create')}}">ALTA ALUMNO</a></li>
                    </ul>
                    </div> 
                  </div>

                  Lista de alumnos a pagar 
              </div><br>
        <table class="table table-striped" id="tablapagoalumnos">
          <thead>
            <th>Matricula</th>
            <th>Nombre completo</th>
            <th>Nivel</th>
            <th>Pagar</th>
          </thead>
          <tbody>
            @foreach($alumnos as $alumno)
            <tr>

              <td> {{$alumno->id}}   </td>
              <td> {{$alumno->nombre}} {{$alumno->ap}} {{$alumno->am}} </td>
              <td> {{$alumno->nivel}} </td>
              <td>
               <button class="btn btn-info" data-toggle="modal" data-target="#modalpago" onclick="fun_edit('{{$alumno->id}}')" id="editar" value="{{route('pagos.view')}}">Pagar </button>
              </td>
            </tr>
            @endforeach
          </tbody>
               @include('usuarios.modals.pagos')       
        </table>             
            </div>
@endsection