<!-- Add Modal start -->
<div class="modal fade" id="editNModalpe" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form>
  <fieldset>
   
    <label>Ultimo pago</label>
    <input type="text" id="lastpagoup" name="lastpagoup">
    <input type="hidden" id="id_alumlastp" name="id_alumlastp">
    <input type="hidden" id="id_st" name="id_st" value="{{$alumno->id}}">
    <input type="hidden" id="id_costocr" name="id_costocr" value="{{$colegiatura}}">
  </fieldset>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="editlastpago" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>
    <!-- add code ends -->