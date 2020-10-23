@extends('usuarios.index')
@section('content')
    <div class="widget-header"> 
        <center><h3>Alta Alumno</h3></center>
    </div>
    <div class="widget-content">
        <div class="shortcuts">
            <div class="form-group col-md-12" id="gralprevio">
            <div class="dropdown" >
                <button 
                    class="form-group col-md-12 btn btn-success dropdown-toggle" 
                    type="button" 
                    id="dropdownMenuButton" 
                    data-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false" >
                    ACCIÓN
                </button>
                <ul class="dropdown-menu form-group col-md-12">
                    <li>
                        <a href="{{route('user.menu')}}">INICIO</a>
                    </li>
                    <li>
                        <a href="{{route('user.index')}}">LISTA ALUMNOS</a>
                    </li>
                </ul>
            </div> 
        </div>
        
        {!! Form::open(['route' => 'user.store', 'method' => 'POST' ,'files'=>true]) !!}

            <div class="row">
                <div class="form-group col-md-12">
                    {!! Form::label('matricula', 'Matricula') !!} 
                    {!! 
                        Form::text(
                            'id',
                            $ultimo,
                            [
                                'class'       => 'form-control',
                                'style'       => 'text-transform: uppercase;', 
                                'placeholder' => 'matricula', 
                                'readonly'    => ' readonly', 
                                'required'                                
                            ] 
                        ) 
                    !!}
                </div>
            </div> 

            <div class="row">
                <div class="form-group col-md-3">
                    {!! Form::label('nombre', 'Nombre(s)') !!} 
                    <div class="input-group">
                        <span class="input-group-addon"> 
                            <i class="shortcut-icon icon-user"></i>
                        </span>
                        {!!
                            Form::text(
                                'nombre',
                                null,
                                [
                                    'class'       => 'form-control',
                                    'style'       => 'text-transform: uppercase;', 
                                    'placeholder' => 'Nombre(s)', 
                                    'required' 
                                ] 
                            ) 
                        !!}
                    </div>
                </div>

                <div class="form-group col-md-3">
                    {!! Form::label('apellido_paterno','Apellido Paterno') !!} 
                    {!! 
                        Form::text(
                            'apellido_paterno',
                            null,
                            [
                                'class'       => 'form-control',
                                'style'       => 'text-transform: uppercase;', 
                                'placeholder' => 'Apellido Paterno', 
                                'required' 
                            ] 
                        ) 
                    !!}
                </div>

                <div class="form-group col-md-3">
                    {!! Form::label('Apellido_materno', 'Apellido Materno') !!} 
                    {!! 
                        Form::text(
                            'apellido_materno',
                            null,
                            [
                                'class' => 'form-control',
                                'style' => 'text-transform:uppercase;', 
                                'placeholder' => 'Apellido Materno', 
                                'required' 
                            ]
                        ) 
                    !!}
                </div>

                <div class="form-group col-md-3">
                    {!! Form::label('nacimiento', 'Nacimiento') !!} 
                    <div class="input-group">
                        <span class="input-group-addon"> 
                            <i class="shortcut-icon icon-calendar"></i>
                        </span>
                        {!! 
                            Form::date(
                                'nacimiento',
                                null,
                                [
                                    'class'       => 'form-control',
                                    'style'       => 'text-transform: uppercase;', 
                                    'placeholder' => 'Nacimiento', 
                                    'required' 
                                ] 
                            ) 
                        !!}
                    </div>
                </div>  
            </div> 
            <br>

            <div class="row">

                <div class="form-group col-md-3">
                    {!! Form::label('direccion', 'Direccion') !!} 
                    <div class="input-group">
                        <span class="input-group-addon"> 
                            <i class="shortcut-icon icon-home"></i>
                        </span>
                        {!! 
                            Form::text(
                                'direccion',
                                null,
                                [
                                    'class'       => 'form-control',
                                    'style'       => 'text-transform: uppercase;', 
                                    'placeholder' => 'Direccion', 
                                    'required' 
                                ] 
                            ) 
                        !!}
                    </div>
                </div>

                <div class="form-group col-md-3">
                    {!! Form::label('ciudad', 'Ciudad') !!} 
                    {!! 
                        Form::text(
                            'ciudad',
                            null,
                            [
                                'class'       => 'form-control',
                                'style'       => 'text-transform: uppercase;', 
                                'placeholder' => 'Ciudad', 
                                'required' 
                            ]
                        ) 
                    !!}
                </div>

                <div class="form-group col-md-3">
                    {!! Form::label('ocupacion', 'Ocupacion') !!} 
                    <div class="input-group">
                        <span class="input-group-addon"> 
                            <i class="shortcut-icon icon-user-md"></i>
                        </span>
                        {!! 
                            Form::text(
                                'ocupacion',
                                null,
                                [
                                    'class'       => 'form-control',
                                    'style'       => 'text-transform: uppercase;', 
                                    'placeholder' => 'Ocupacion', 
                                    'required' 
                                ] 
                            ) 
                        !!}
                    </div>
                </div>

                <div class="form-group col-md-3">
                    {!! Form::label('estudios', 'Estudios') !!} 
                    <div class="input-group">
                        <span class="input-group-addon"> 
                            <i class="shortcut-icon icon-book"></i>
                        </span>
                        {!! 
                            Form::text(
                                'estudios',
                                null,
                                [
                                    'class'       => 'form-control',
                                    'style'       => 'text-transform: uppercase;', 
                                    'placeholder' => 'Estudios', 
                                    'required' 
                                ] 
                            ) 
                        !!}
                    </div>
                </div>   

            </div>
            <hr>

            <div class="row">

                <div class="form-group col-md-4">
                    {!! Form::label('Nivel', 'Nivel') !!} 
                    <div class="input-group">
                        <span class="input-group-addon"> 
                            <i class="shortcut-icon icon-bar-chart"></i>
                        </span>
                        {!! 
                            Form::select(
                                'nivel',
                                $listaN,
                                null,
                                [
                                    'class'       => 'form-control',
                                    'id'          => 'nivel',
                                    'placeholder' => 'selecciona'
                                ]
                            ) 
                        !!}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('horario', 'Horario') !!} 
                    <div class="input-group">
                        <span class="input-group-addon"> 
                            <i class="shortcut-icon icon-calendar-empty"></i>
                        </span>
                        {!! 
                            Form::select(
                                'horario',
                                [
                                    'selecciona' => 'Seleccione Horario'
                                ],
                                null,
                                [
                                    'class' => 'form-control',
                                    'id'    => 'horario'
                                ]
                            ) 
                        !!}
                    </div>
                </div> 

            </div>
            <hr>
            <h6>Telefonos</h6>

            <div class="row">
                <div class="form-group col-md-4">
                    {!! Form::label('casa', 'Casa') !!}
                    <div class="input-group">
                        <span class="input-group-addon"> 
                            <i class="shortcut-icon icon-home"></i>
                        </span> 
                        {!! 
                            Form::text(
                                'casa',
                                null,
                                [
                                    'class'       => 'form-control',
                                    'style'       => 'text-transform: uppercase;', 
                                    'placeholder' => 'Casa' 
                                ] 
                            ) 
                        !!}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('celular', 'Celular') !!} 
                    <div class="input-group">
                        <span class="input-group-addon"> 
                            <i class="shortcut-icon icon-mobile-phone"></i>
                        </span>
                        {!! 
                            Form::text(
                                'celular',
                                null,
                                [
                                    'class'       => 'form-control',
                                    'style'       => 'text-transform: uppercase;', 
                                    'placeholder' => 'Celular' 
                                ] 
                            ) 
                        !!}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oficina', 'Oficina') !!} 
                    <div class="input-group">
                        <span class="input-group-addon"> 
                            <i class="shortcut-icon icon-phone"></i>
                        </span>
                        {!! 
                            Form::text(
                                'oficina',
                                null,
                                [
                                    'class'       => 'form-control',
                                    'style'       => 'text-transform: uppercase;', 
                                    'placeholder' => 'Oficina' 
                                ] 
                            ) 
                        !!}
                    </div>
                </div>                    
            </div>
            <hr>
            <h6>Pago</h6>

            <div class="row">
                <div class="form-group col-md-2">
                    {!! Form::label('FamiliarDirecto', 'Familiar Directo') !!}<br>
                    {!! 
                        Form::checkbox(
                            'familiard', 
                            '1',
                            null,
                            [
                                'class' => 'familiar',
                                'id'    => 'familiard'
                            ]
                        ) 
                    !!}
                </div>  

                <div class="form-group col-md-4" id="labelinscripcion" style="display: inline-block">
                    {!! Form::label('Inscripcion', 'inscripcion') !!}
                    <div class="input-group">
                        <span class="input-group-addon"> $</span> 
                        {!! 
                            Form::number(
                                'inscripcion',
                                null,
                                [
                                    'class' => 'form-control',
                                    'style' => 'text-transform: uppercase;',
                                    'id'    => 'inscripcion',
                                    'min'   => "1",
                                    'max'   => '500' 
                                ] 
                            ) 
                        !!}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('Colegiatura', 'Colegiatura') !!} 
                    <div class="input-group">
                        <span class="input-group-addon"> $</span>
                        {!! 
                            Form::number(
                                'colegiatura',
                                null,
                                [
                                    'class' => 'form-control',
                                    'style' => 'text-transform: uppercase;',
                                    'id'    => 'colegio',
                                    'min'   => '1' 
                                ] 
                            ) 
                        !!}
                    </div>
                </div> 
                                
            </div>  

            <div class="row">
                <div class="form-group col-md-4">
                    {!! Form::label('Foto', 'Foto') !!} 
                    {!! Form::file('ruta_foto') !!}
                </div>                  
            </div>    
                                                                                                                                   
            <div class="row">
                <div class="form-group col-md-3">
                    {!! Form::submit('Registrar',[ 'class' => 'btn btn-primary']) !!} 
                </div>
            </div>

        {!! Form::close()!!}
    </div>
@endsection