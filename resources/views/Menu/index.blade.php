@extends('layouts.index')
@section('content')
    <div class="card">
        <div class="card-header">
            <center>
                <h3>
                    Menú de Opciones
                </h3>
            </center>
        </div>
        <div class="card-body">
            <div class="shortcuts">
                <a href="{{ route('students') }}" class="shortcut">
                    <i class="shortcut-icon icon icon-group"></i>
                    <span class="shortcut-label">Alumnos</span> 
                </a>                
                <a href="javascript:;" class="shortcut" data-toggle="modal" data-target="#menuNiveles">
                    <i class="shortcut-icon icon icon-sitemap"></i>
                    <span class="shortcut-label">Niveles</span> 
                </a>
                <a href="{{route('user.pagosalumnos')}}" class="shortcut">
                    <i class="shortcut-icon icon icon-usd"></i>
                    <span class="shortcut-label">Pagos</span>
                </a>
                <a href="{{route('user.corte')}}" class="shortcut"> 
                    <i class="shortcut-icon icon icon-desktop"></i>
                    <span class="shortcut-label">Corte</span> 
                </a>            
            </div>
        </div>
    </div>    
@endsection