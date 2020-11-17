<div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
    <div class="row">
        <div class="col-sm-4 text-center">
            {!! Form::text('ruta_foto',null,['style' => 'display:none','id' => 'ruta_foto']) !!}
            <div class="kv-avatar">
                <div class="file-loading">
                    {!! Form::file('avatar',['id' => 'avatar']) !!}
                </div>
            </div>
            <div class="kv-avatar-hint">
                <small>Select file < 1500 KB</small>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre(s)') !!} 
                        <div class="input-group mb-2">                            
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="shortcut-icon icon-user"></i>
                                </div>
                            </div>
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
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('apellido_paterno','Apellido Paterno') !!} 
                        {!! 
                            Form::text(
                                'ap',
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
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('Apellido_materno', 'Apellido Materno') !!} 
                        {!! 
                            Form::text(
                                'am',
                                null,
                                [
                                    'class'       => 'form-control',
                                    'style'       => 'text-transform: uppercase;', 
                                    'placeholder' => 'Apellido Materno', 
                                    'required' 
                                ]
                            ) 
                        !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nacimiento', 'Nacimiento') !!} 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="shortcut-icon icon-calendar"></i>
                                </div>
                            </div>
                            {!! 
                                Form::text(
                                    'nacimiento',
                                    null,
                                    [
                                        'class'       => 'date form-control',
                                        'step'        => 7, 
                                        'placeholder' => 'Nacimiento', 
                                        'id'          => 'nacimiento'
                                    ] 
                                ) 
                            !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('direccion', 'Direccion') !!} 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="shortcut-icon icon-home"></i>
                                </div>
                            </div>
                            {!! 
                                Form::text(
                                    'direccion',
                                    null,
                                    [
                                        'class'       => 'form-control',
                                        'style'       => 'text-transform: uppercase;', 
                                        'placeholder' => 'Direccion'
                                    ] 
                                ) 
                            !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('ciudad', 'Ciudad') !!} 
                        {!! 
                            Form::text(
                                'ciudad',
                                null,
                                [
                                    'class'       => 'form-control',
                                    'style'       => 'text-transform: uppercase;', 
                                    'placeholder' => 'Ciudad'
                                ]
                            ) 
                        !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('ocupacion', 'Ocupacion') !!} 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="shortcut-icon icon-user-md"></i>
                                </div>
                            </div>
                            {!! 
                                Form::text(
                                    'ocupacion',
                                    null,
                                    [
                                        'class'       => 'form-control',
                                        'style'       => 'text-transform: uppercase;', 
                                        'placeholder' => 'Ocupacion'
                                    ] 
                                ) 
                            !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('estudios', 'Estudios') !!} 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="shortcut-icon icon-book"></i>
                                </div>
                            </div>
                            {!! 
                                Form::text(
                                    'estudios',
                                    null,
                                    [
                                        'class'       => 'form-control',
                                        'style'       => 'text-transform: uppercase;', 
                                        'placeholder' => 'Estudios'
                                    ] 
                                ) 
                            !!}
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <h6 class="text-center">Telefonos</h6>   
            
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('casa', 'Casa') !!}
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="shortcut-icon icon-home"></i>
                                </div>
                            </div>
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
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('celular', 'Celular') !!} 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="shortcut-icon icon-mobile-phone"></i>
                                </div>
                            </div>
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
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('oficina', 'Oficina') !!} 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="shortcut-icon icon-phone"></i>
                                </div>
                            </div>
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
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('Nivel', 'Nivel') !!} 
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="shortcut-icon icon-bar-chart"></i>
                        </div>
                    </div>
                    {!! 
                        Form::select(
                            'nivel',
                            Levels::List()->pluck('nombre', 'id'),
                            null,
                            [
                                'class'       => 'form-control',
                                'id'          => 'nivel',
                                'placeholder' => 'Selecciona el nivel'
                            ]
                        ) 
                    !!}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('horario', 'Horario') !!} 
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="shortcut-icon icon-calendar-empty"></i>
                        </div>
                    </div>
                    {!! 
                        Form::select(
                            'horario',
                            Levels::Schedule(),
                            isset($student) ? $student->getSchedule() : null,
                            [
                                'class'       => 'form-control',
                                'id'          => 'horario',
                                'placeholder' => 'Seleccione Horario',
                                'disabled'    => true
                            ]
                        ) 
                    !!}
                </div>
            </div>
        </div>
    </div>   

    <div class="form-group">
        <hr>
        <div class="text-center">
            {!! Form::submit('Registrar',[ 'class' => 'btn btn-primary']) !!} 
        </div>
    </div>
