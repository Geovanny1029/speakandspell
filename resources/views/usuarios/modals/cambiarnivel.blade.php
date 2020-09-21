<!-- Add Modal start -->
<div class="modal fade" id="modalcambionivel" role="dialog">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar Nuevo Nivel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              
                   <div class="form-horizontal"> 
                     {!! Form::open(['route' => 'users.actualiza', 'method' => 'POST','files'=>true]) !!}
                    <div class="control-group">
                      {!! Form::label('Nivel', 'Nivel') !!} 
                    <div class="controls">
                      {!! Form::select('niveln',$listaN,null,['class' => 'span3','id'=>'nivelc']) !!}
                    </div>
                    </div>
                    <div class="control-group">
                      {!! Form::label('horario', 'Horario') !!} 
                    <div class="controls">
                      <span class="input-group-addon"> <i class="shortcut-icon icon-calendar-empty"></i></span>
                      {!! Form::select('horarion',['selecciona'=>'Seleccione Horario'],null,['class' => 'span2','id'=>'horarioc']) !!}
                       <input type="hidden" id="nam_id" name="nam_id" value="{{$alumno->id}}">
                    </div>
                    </div>                    
                  </div>
                  
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
         {!! Form::submit('Cambiar',[ 'id'=>'cambiodenivel','class' => 'btn btn-primary']) !!} 
        
        
         {!! Form::close()!!}
      </div>
    </div>
  </div>
</div>
    <!-- add code ends -->