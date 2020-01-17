<!-- Add Modal start -->
    <div class="modal fade" id="modalpago" role="dialog">
      <div class="modal-dialog modal-sm">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Pagar</h4>
          </div>
          <div class="modal-body">
              {!! Form::open(['route' => 'user.pagomesalum', 'method' => 'POST','files'=>true]) !!}
              <div class="row">
               <div class="form-group col-md-12">
               <center>  {!! Form::label('pago', 'Ingresa Cantidad') !!} </center> 
               <b>Alumno:</b> <label id="pag_nom_alum"></label><br>
               <b>Nivel:</b> <label id="pag_nivel_alum"></label><br>
               <b>Mes a pagar:</b><label id="pag_mes_alum"></label><br>
                 {!! Form::text('pago',null,['class' => 'form-control','style' => 'text-transform:uppercase;', 'placeholder' => '$','id' => 'pago', 'required' ] ) !!}
               </div>

              </div>
           
              <div class="row">
                <div class="form-group col-md-2">
                 {!! Form::submit('pagar',[ 'class' => 'btn btn-primary']) !!} 
                 <input type="hidden" id="id_alum" name="id_alum">
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