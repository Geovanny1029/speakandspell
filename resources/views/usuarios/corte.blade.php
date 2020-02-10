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

                <div class="row">
                  <div class="form-group row">
                    {!! Form::label('edit_nombre_user', 'Selecciona una Fecha',['class' => 'col-sm-2 col-form-label']) !!} 
                    <div class="col-sm-3"> 
                        {{ Form::date('deadline', \Carbon\Carbon::now()->format('Y-m-d'),['class' => 'form-control']) }}
                    </div>
                    <div class="col-sm-2"> 
                       {!! Form::submit('Aceptar',[ 'class' => 'btn btn-primary','onclick' => 'muestra()']) !!} 
                    </div>
                  </div>
                </div> 
                <div>
                  
                </div>           
            </div>
          </div>
@endsection