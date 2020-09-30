<!-- Add Modal start -->
<div class="modal fade" id="modalcambionivel" role="dialog">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Opciones del Alumno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              
                   <div class="form-horizontal"> 
                     {!! Form::open(['route' => 'users.actualiza', 'method' => 'POST','files'=>true]) !!}

                    <div class="control-group">
                     
                    <div class="controls">
                      <center><a class='btn btn-danger' onclick="return confirm('¿Seguro que deseas dar de baja este Usuario?')" href="{{route('user.destroy', $alumno->id)}}">Dar Baja</a></center>
                    </div>
                    </div><br>
                    <div class="control-group">
                     
                    <div class="controls">
                      <center><div> Asignar otro nivel</div></center>
                    </div>
                    </div>
                    <div class="control-group">
                      {!! Form::label('Nivel', 'Nivel') !!} 
                    <div class="controls">
                      {!! Form::select('niveln',$listaN,null,['class' => 'span3','id'=>'nivelc','placeholder'=>'selecciona']) !!}
                    </div>
                    </div>
                    <div class="control-group">
                      {!! Form::label('horario', 'Horario') !!} 
                    <div class="controls">
                      <span class="input-group-addon"> <i class="shortcut-icon icon-calendar-empty"></i></span>
                      {!! Form::select('horarion',['selecciona'=>'Seleccione Horario'],null,['class' => 'span2','id'=>'horarioc']) !!}
                       <input type="hidden" id="nam_id" name="nam_id" value="{{$alumno->id}}">
                       <input type="hidden" id="cursoanter" name="cursoanter" value="{{$alumno->nivel}}">
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