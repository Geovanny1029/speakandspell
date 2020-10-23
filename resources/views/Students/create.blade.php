<div class="modal fade" id="createstudent" role="dialog">
    <div class="modal-dialog modal-xl">    
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Matrícula {{ $ultimo }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'student.store', 'method' => 'POST' ,'files'=>true]) !!}
                    @include('Students.Form')
                {!! Form::close()!!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>