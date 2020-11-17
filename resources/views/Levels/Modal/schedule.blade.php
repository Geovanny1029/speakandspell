<div class="modal fade" id="createschedule" role="dialog">
    <div class="modal-dialog">    
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'schedule.store', 'method' => 'POST']) !!}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('Inicio') !!}
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="shortcut-icon icon-time"></i>
                                            </div>
                                        </div>
                                        {!! 
                                            Form::text(
                                                'inicio',
                                                null,
                                                [                                            
                                                    'class'       => 'date form-control',
                                                    'placeholder' => 'Inicio', 
                                                    'id'          => 'scheduleinicio'                                    
                                                ]
                                            ); 
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
                                                <i class="shortcut-icon icon-time"></i>
                                            </div>
                                        </div>
                                        {!! 
                                            Form::text(
                                                'fin', 
                                                null, 
                                                [
                                                    'class' => 'form-control input-small',
                                                    'placeholder' => 'Fin', 
                                                    'id'    => 'schedulefin'
                                                ]
                                            ); 
                                        !!}
			                        </div> 
                                </div>
                            </div>
                        </div>
                        {!! Form::submit('Crear',[ 'class' => 'btn btn-primary']) !!} 
                    </div>
                {!! Form::close()!!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

