<!-- Add Modal start -->
    <div class="modal fade" id="editNModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Nivel</h4>
          </div>
          <div class="modal-body">
              {!! Form::open(['route' => 'nivel.actualiza', 'method' => 'POST']) !!}
              <div class="row">
               <div class="form-group col-md-4">
                 {!! Form::label('edit_nombren', 'Nombre Nivel') !!}  
                 {!! Form::text('edit_nombren',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Nivel','id' => 'edit_nombren', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_horario', 'Horario') !!}  
                 {!! Form::text('edit_horario',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Horario','id' => 'edit_horario', 'required' ] ) !!}
               </div>
              </div>
              <div class="row">
               <div class="form-group col-md-4">
                 {!! Form::label('edit_finicio', 'Fecha Inicio') !!}  
                 {!! Form::text('edit_finicio',null,['class' => 'form-control', 'placeholder' => 'Fecha Inicio','id' => 'edit_finicio', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_ffin', 'Fecha Fin') !!}  
                 {!! Form::text('edit_ffin',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Fecha Fin','id' => 'edit_ffin', 'required' ] ) !!}
               </div>
               <div class="form-group col-md-4">
                 {!! Form::label('edit_costo', 'Costo') !!}  
                 {!! Form::text('edit_costo',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => 'Costo','id' => 'edit_costo', 'required' ] ) !!}
               </div>
              </div>
           
              <div class="row">
                <div class="form-group col-md-2">
                 {!! Form::submit('Actualizar',[ 'class' => 'btn btn-primary']) !!} 
                 <input type="hidden" id="editn_id" name="editn_id">
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