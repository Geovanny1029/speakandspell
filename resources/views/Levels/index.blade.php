@extends('layouts.index')
@section('styles')
    <link href="{{ asset('css/datatable.css') }}" rel="stylesheet">
    <link 
        href = "{{ asset('bootstrap4-glyphicons-master/bootstrap4-glyphicons/css/bootstrap-glyphicons.min.css') }}" 
        rel  = "stylesheet" 
        type = "text/css"
    >
    <link href="{{ asset('css/custom-file-input.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <center>
                <h3>
                    Listado de Niveles <b id="titlelevels"></b>
                </h3>
            </center>
        </div>
        <div class="card-body">   
            <div class="form-row">
                <div class="form-group">
                    <button 
                        type           = "button"
                        class          = "btn btn-success btn-md"
                        data-toggle    = "tooltip"
                        data-placement = "top" 
                        title          = "Nuevo Nivel"
                        id             = "btncreatelevel"
                    >
                        <i class="icon-plus-sign icon-large"></i> 
                    </button>

                    <button 
                        type           = "button"
                        class          = "btn btn-primary btn-md"
                        data-toggle    = "tooltip"
                        data-placement = "top" 
                        title          = "Crear Horario"
                        id             = "btnhorario"
                    >
                        <i class="icon-time icon-large"></i> 
                    </button>

                    <input 
                                class               = "form-control"
                                type                = "checkbox" 
                                checked data-toggle = "toggle" 
                                data-on             = "Activos" 
                                data-off            = "Inactivos" 
                                data-onstyle        = "success" 
                                data-offstyle       = "danger"
                                data-width          = "100"
                                value               = 1
                                id                  = 'checklevelactivo'
                                name                = "activo"
                            >
                </div>
            </div>
            
            <table class="table table-striped table-bordered" id="levelstable">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Horario</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Costo</th>
                    <th></th>  {{-- invisible --}}
                </thead>
                <tbody>
                </tbody>
            </table>  
        </div>
    </div>
    @include('Levels.Modal.schedule')
    @include('Levels.Modal.newLevel')
@endsection

@section('script')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/levels.js') }}"></script>
@endsection