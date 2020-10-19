<!-- Add Modal start -->
<div class="modal fade" id="editstudent" role="dialog">
    <div class="modal-dialog-md">    
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Alumno</h4>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    
    </div>
</div>
    <!-- add code ends -->