@extends('usuarios.index')
@section('content')

            <div class="widget-header"> 
              <center><h3>Listar Usuarios</h3></center>
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
                    {!! Form::label('NivelLists', 'Selecciona Nivel',['class' => 'col-sm-2 col-form-label']) !!} 
                    <div class="col-sm-3"> 
                 
                      {!! Form::select('nivellist',$listaN,null,['class' => 'form-control','id'=>'nivellist']) !!}
                    </div>

                 {!! Form::label('HorarioList', 'Selecciona Horario',['class' => 'col-sm-2 col-form-label']) !!} 
                    <div class="col-sm-3"> 
                      
                      {!! Form::select('horariolists',$listaH,null,['class' => 'form-control','id'=>'horariolist']) !!}
                    </div>
                    <div class="col-sm-2"> 
                       {!! Form::submit('Buscar',[ 'class' => 'btn btn-primary','onclick' => 'muestralista()']) !!} 
                    </div>
                  </div>
                </div> 
                <div>
                  <div id="listarNivel"></div>
                </div>              
            </div>
@endsection