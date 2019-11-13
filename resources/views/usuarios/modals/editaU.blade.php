<!-- Add Modal start -->
    <div class="modal fade" id="editModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Alumno</h4>
          </div>
          <div class="modal-body">
              {!! Form::open(['route' => 'users.actualiza', 'method' => 'POST']) !!}
              <div class="row">
               <div class="form-group col-md-6">
                 {!! Form::label('edit_nombre', 'alumno') !!}  
                 {!! Form::text('edit_nombre',null,['class' => 'form-control', 'placeholder' => 'Usuario','id' => 'edit_nombre', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-6">
                 {!! Form::label('edit_am', 'Apellido Materno') !!}  
                 {!! Form::text('edit_am',null,['class' => 'form-control', 'placeholder' => 'contraseña','id' => 'edit_am', 'required' ] ) !!}
               </div>
              </div>

           
              <div class="row">
                <div class="form-group col-md-2">
                 {!! Form::submit('Actualizar',[ 'class' => 'btn btn-primary']) !!} 
                 <input type="hidden" id="edit_id" name="edit_id">
                </div>
              </div>

              {!! Form::close()!!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>
    <!-- add code ends -->