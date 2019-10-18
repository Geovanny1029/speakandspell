@extends('usuarios.index')
@section('content')
            <div class="widget-header"> 
              <center><h3>Niveles</h3></center>
            </div>
            <div class="widget-content">
              <div class="shortcuts">
                Lista de niveles 
              </div><br>
        <table class="table table-striped" id="tablaniveles">
          <thead>
            <th>Nivel</th>
            <th>Horario</th>
            <th>Fecha Inicio</th>
            <th>Fecha Finalizacion</th>
            <th>Costo</th>
          </thead>
          <tbody>
            @foreach($niveles as $nivel)
            <tr>

              <td> {{$nivel->nombre}} </td>
              <td> {{$nivel->horario}} </td>
              <td> {{$nivel->finicio}} </td>
              <td> {{$nivel->ffin}}</td>
              <td> {{$nivel->costo}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>              
            </div>
@endsection