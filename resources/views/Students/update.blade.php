<div class="modal fade" id="editstudent" role="dialog">
    <div class="modal-dialog modal-xl">    
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Alumno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! 
                    Form::model(
                        $student,
                        [
                            'route' => [
                                'student.update',
                                $student->id
                            ],
                            'method' => 'PUT',
                            'id'     => 'editstudent'
                        ]
                    ) 
                !!}
                    @include('Students.Form')           		    
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
    <!-- add code ends -->