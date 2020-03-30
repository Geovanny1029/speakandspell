@extends('usuarios.index')
@section('content')
            <div class="widget-header"> 
              <center><h3>Niveles</h3></center>
            </div>
            <div class="widget-content">
              <div class="shortcuts">
                  <div class="row">
                    <div class="form-group col-md-12">
                    <a href="{{route('user.menu')}}" class="btn btn-success" style="width: 100%">INICIO</a>
                    </div>
                  </div> 
                Lista de niveles 
              </div><br>
        <table class="table table-striped" id="tablaniveles">
          <thead>
            <th>Nivel</th>
            <th>Horario</th>
            <th>Fecha Inicio</th>
            <th>Fecha Finalizacion</th>
            <th>Costo</th>
            <th>Vigencia</th>
            <th>Accion</th>
          </thead>
          <tbody>
            @foreach($niveles as $nivel)
            <tr>

              <td> {{$nivel->nombre}} </td>
              <td> {{$nivel->horario}} </td>
              <td> {{$nivel->finicio}} </td>
              <td> {{$nivel->ffin}}</td>
              <td> {{$nivel->costo}}</td>
              <td>
                <?php 
                  $date = str_replace("/","-", $nivel->ffin);
                  $d=Carbon\Carbon::parse($date);
                  $e=$d->format("Y-m-d");

                  $tod = Carbon\Carbon::now();
                  $hoy = $tod->format("Y-m-d");

                  if($e <= $hoy){?>
                      <span class="label label-danger">FINALIZADO</label><?php
                  }else{ ?>
                     <span class="label label-info">VIGENTE</label> <?php
                  }
                ?>
              </td>
              <td><button class="btn btn-warning" data-toggle="modal" data-target="#editNModal" onclick="fun_edit_nivel('{{$nivel->id}}')" id="editarN" value="{{route('nivel.view')}}">Editar </button></td>
            </tr>
            @endforeach
          </tbody>
@include('usuarios.modals.editaN')
        </table>              
            </div>
@endsection