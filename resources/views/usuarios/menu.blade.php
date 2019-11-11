@extends('usuarios.index')
@section('content')
            <div class="widget-header"> 
              <center><h3>Menu de Opciones</h3></center>
            </div>
            <div class="widget-content">
              <div class="shortcuts">
                <a href="#" class="shortcut" data-toggle="modal" data-target="#menuUsuarios">
                  <i class="shortcut-icon icon icon-group"></i>
                  <span class="shortcut-label">Alumnos</span> 
                </a>                
                <a href="javascript:;" class="shortcut" data-toggle="modal" data-target="#menuNiveles">
                  <i class="shortcut-icon icon icon-sitemap"></i>
                  <span class="shortcut-label">Niveles</span> 
                </a>
                <a href="javascript:;" class="shortcut">
                  <i class="shortcut-icon icon icon-usd"></i>
                  <span class="shortcut-label">Pagos</span>
                </a>
                <a href="javascript:;" class="shortcut"> 
                  <i class="shortcut-icon icon-comment"></i>
                  <span class="shortcut-label">Corte</span> 
                </a>

 @include('usuarios.modals.menuN')
 @include('usuarios.modals.menuU')
              </div>
            </div>
@endsection