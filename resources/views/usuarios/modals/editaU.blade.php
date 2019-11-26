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
              {!! Form::open(['route' => 'users.actualiza', 'method' => 'POST','files'=>true]) !!}
              <div class="row">
               <div class="form-group col-md-4">
                 {!! Form::label('edit_nombre', 'Nombre(s)') !!}  
                 {!! Form::text('edit_nombre',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Usuario','id' => 'edit_nombre', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_ap', 'Apellido Paterno') !!}  
                 {!! Form::text('edit_ap',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Apellido Paterno','id' => 'edit_ap', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_am', 'Apellido Materno') !!}  
                 {!! Form::text('edit_am',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'contraseña','id' => 'edit_am', 'required' ] ) !!}
               </div>
              </div>
              <div class="row">
               <div class="form-group col-md-4">
                 {!! Form::label('edit_nacimiento', 'Nacimiento') !!}  
                 {!! Form::text('edit_nacimiento',null,['class' => 'form-control', 'placeholder' => 'Nacimiento','id' => 'edit_nacimiento', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_direccion', 'Direccion') !!}  
                 {!! Form::text('edit_direccion',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Direccion','id' => 'edit_direccion', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_ciudad', 'Ciudad') !!}  
                 {!! Form::text('edit_ciudad',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Ciudad','id' => 'edit_ciudad', 'required' ] ) !!}
               </div>
              </div>
              <div class="row">
               <div class="form-group col-md-4">
                 {!! Form::label('edit_ocupacion', 'Ocupacion') !!}  
                 {!! Form::text('edit_ocupacion',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Ocupacion','id' => 'edit_ocupacion', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_estudios', 'Estudios') !!}  
                 {!! Form::text('edit_estudios',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Estudios','id' => 'edit_estudios', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_nivel', 'Nivel') !!}  
                 {!! Form::select('edit_nivel',$listaN,null,['class'=>'form-control','id' => 'edit_nivel']) !!} 
               </div>
              </div>
              <div class="row">
               <div class="form-group col-md-4">
                 {!! Form::label('edit_descuento', 'Descuento') !!}  
                 {!! Form::text('edit_descuento',null,['class' => 'form-control', 'placeholder' => 'Descuento','id' => 'edit_descuento' ] ) !!}
               </div>
              </div>
              <div class="row">
               <div class="form-group col-md-4">
                 {!! Form::label('edit_casa', 'Numero Casa') !!}  
                 {!! Form::text('edit_casa',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Numero Casa','id' => 'edit_casa' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_oficina', 'Numero Oficina') !!}  
                 {!! Form::text('edit_oficina',null,['class' => 'form-control', 'placeholder' => 'Numero Oficina','id' => 'edit_oficina' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_celular', 'Numero Celular') !!}  
                 {!! Form::text('edit_celular',null,['class' => 'form-control', 'placeholder' => 'Numero Celular','id' => 'edit_celular' ] ) !!}
               </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  {!! Form::label('','' ,['id' => 'edit_f']) !!} 
                  {!! Form::file('edit_ruta_foto',['id'=>'edit_foto','accept'=>'image/*','capture'=>'capture']) !!}
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