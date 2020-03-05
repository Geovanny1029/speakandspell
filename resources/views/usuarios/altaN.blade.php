@extends('usuarios.index')
@section('content')
            <div class="widget-header"> 
              <center><h3>Alta Nivel</h3></center>
            </div>
            <div class="widget-content">
              <div class="shortcuts">
                  <div class="row">
                    <div class="form-group col-md-12">
                    <a href="{{route('user.menu')}}" class="btn btn-success" style="width: 100%">INICIO</a>
                    </div>
                  </div>                
                {!! Form::open(['route' => 'user.altaNivel', 'method' => 'POST']) !!}

                  <div class="row"><br>
                    <div class="form-group col-md-6">
                      <div class="input-group">
                      <span class="input-group-addon">Nombre</span>
                      {!! Form::text('nombre',null,['class' => 'form-control','style' => 'text-transform:uppercase;' , 'placeholder' => 'Nombre(s)', 'required' ] ) !!}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="input-group">
                      <span class="input-group-addon">Horario</span>
                      {!! Form::text('horario',null,['class' => 'form-control','style' => 'text-transform:uppercase;' , 'placeholder' => 'horario', 'required' ] ) !!}</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
                      <div class="input-group">
                      <span class="input-group-addon"> <i class="shortcut-icon icon-calendar"></i></span> 
                      {!! Form::date('fecha_inicio',null,['class' => 'form-control','style' => 'text-transform:uppercase;' , 'placeholder' => 'Fecha Inicio', 'required' ] ) !!}</div>
                    </div>
                    <div class="form-group col-md-6">
                      {!! Form::label('fecha_fin', 'Fecha Fin') !!} 
                      <div class="input-group">
                      <span class="input-group-addon"> <i class="shortcut-icon icon-calendar"></i></span>
                      {!! Form::date('fecha_fin',null,['class' => 'form-control','style' => 'text-transform:uppercase;' , 'placeholder' => 'Fecha Fin', 'required' ] ) !!}</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      {!! Form::label('costo', 'Costo') !!} 
                      <div class="input-group">
                      <span class="input-group-addon"> $</span>
                      {!! Form::text('costo',null,['class' => 'form-control','style' => 'text-transform:uppercase;' , 'placeholder' => 'Costo', 'required' ] ) !!}</div>
                    </div>
                  </div>
                                                                                                                           
                  <div class="row">
                    <div class="form-group col-md-3">
                    {!! Form::submit('Registrar',[ 'class' => 'btn btn-primary']) !!} 
                    </div>
                  </div>

              {!! Form::close()!!}
              </div>
              
            </div>
@endsection