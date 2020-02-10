<!-- Add Modal start -->
    <div class="modal fade" id="ChangeUser" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Usuario</h4>
          </div>
          <div class="modal-body">
              {!! Form::open(['route' => 'users.CambioUsuario', 'method' => 'POST']) !!}
              <div class="row">
               <div class="form-group col-md-6">
                 {!! Form::label('edit_nombre_user', 'Nombre Completo') !!}  
                 {!! Form::text('edit_nombre_user',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Usuario','id' => 'edit_nombre_user', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-6">
                 {!! Form::label('edit_email', 'E-mail') !!}  
                 {!! Form::text('edit_email',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Apellido Paterno','id' => 'edit_email', 'required' ] ) !!}
               </div>
              </div>
              <div class="row">
               <div class="form-group col-md-6">
                 {!! Form::label('edit_user', 'Usuario') !!}  
                 {!! Form::text('edit_user',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'contraseña','id' => 'edit_user', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-6">
                 {!! Form::label('edit_contraseña', 'Contraseña') !!}  
                 {!! Form::text('edit_contraseña',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'contraseña','id' => 'edit_contraseña', 'required' ] ) !!}
               </div>               
              </div>


           
              <div class="row">
                <div class="form-group col-md-2">
                 {!! Form::submit('Actualizar',[ 'class' => 'btn btn-primary']) !!} 
                 <input type="hidden" id="change_id" name="change_id">
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