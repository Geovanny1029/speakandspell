<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('Nombre') !!}
                {!! 
                    Form::text(
                        'nombre',
                        null,
                        [                                            
                            'class'       => 'form-control',
                            'placeholder' => 'Nombre', 
                            'id'          => 'nombrelevel'                                    
                        ]
                    ); 
                !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('Inicio') !!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="shortcut-icon icon-calendar"></i>
                        </div>
                    </div>
                    {!! 
                        Form::text(
                            'finicio',
                            null,
                            [
                                'class'       => 'date form-control',
                                'step'        => 7, 
                                'placeholder' => 'Fecha de inicio', 
                                'id'          => 'finicio'
                            ] 
                        ) 
                    !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('Fin') !!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="shortcut-icon icon-calendar"></i>
                        </div>
                    </div>
                    {!! 
                        Form::text(
                            'ffin',
                            null,
                            [
                                'class'       => 'date form-control',
                                'step'        => 7, 
                                'placeholder' => 'Fecha fin', 
                                'id'          => 'ffin'
                            ] 
                        ) 
                    !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('Horario') !!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="shortcut-icon icon-time"></i>
                        </div>
                    </div>
                    {!! 
                        Form::select(
                            'horario',
                            Levels::Schedule(),
                            null,
                            [
                                'class'       => 'form-control',
                                'id'          => 'schedule',
                                'placeholder' => 'Seleccione Horario'
                            ]
                        ) 
                    !!}
                </div>               
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('Costo') !!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            $
                        </div>
                    </div>
                    {!! 
                        Form::number(
                            'costo',
                            null,
                            [
                                'class'       => 'form-control',
                                'id'          => 'costo',
                                'placeholder' => 'Costo del curso'
                            ]
                        ) 
                    !!}
                </div>                
            </div>
        </div>
    </div>  

    {!! Form::submit('Registrar',[ 'class' => 'btn btn-primary']) !!}
</div>