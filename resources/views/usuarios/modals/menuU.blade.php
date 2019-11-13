<!-- Modal Usuarios -->
    <div class="modal fade" id="menuUsuarios"  tabindex="-1" role="dialog">
      <div class="modal-dialog modalCenter">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Elige una Accion</h4>
          </div>
          <div class="modal-body">
                <div class="shortcuts">
                  <a href="{{route('user.create')}}" class="shortcut">
                    <i class="shortcut-icon icon-user"></i>
                    <span class="shortcut-label">Alta Alumno</span> 
                  </a>                
                  <a href="{{route('user.index')}}" class="shortcut">
                    <i class="shortcut-icon icon-list-alt"></i>
                    <span class="shortcut-label">Ver alumnos</span> 
                  </a>
                  <a href="{{route('user.inactivos')}}" class="shortcut">
                    <i class="shortcut-icon icon icon-minus-sign-alt"></i>
                    <span class="shortcut-label">Baja Alumno</span>
                  </a>
                </div>
          </div>
        </div> 
      </div>
    </div>
    <!-- add code ends -->