@extends('usuarios.index')
@section('content')

            <div class="widget-header"> 
              <center><h3>Corte</h3></center>
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

                Lista Alumnos por Nivel
              </div><br>
        <table class="table table-striped" id="tablaasignaturas">
         
        </table>              
            </div>
@endsection