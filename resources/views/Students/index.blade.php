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
                    Listado de Alumnos <b id="titlestudents"></b>
                </h3>
            </center>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-1">
                    <button 
                        type           = "button"
                        class          = "btn btn-success btn-md"
                        data-toggle    = "tooltip"
                        data-placement = "top" 
                        title          = "Nuevo Alumno"
                        id             = "btncreatestudent"
                        value          = "{{ route('student.create') }}"
                    >
                        <i class="icon-plus-sign icon-large"></i> 
                    </button>

                    <button 
                        type           = "button"
                        class          = "btn btn-primary btn-md"
                        data-toggle    = "tooltip"
                        data-placement = "top" 
                        title          = "Lista de Asistencia"
                        id             = "btnstudentpdf"
                        value          = "{{ route('students.pdf') }}"
                    >
                        <i class="icon-list icon-large"></i> 
                    </button>
                </div>
                <div class="form-group col-md-5">
                    {{-- <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> --}}
                </div>
                <div class="form-group col-md-6 ml-auto">
                    <div class="form-row">                        
                        <div class="form-group col-md-5">
                            {!! 
                                Form::select(
                                    'level',
                                    Levels::List()->pluck('nombre', 'nombre'),
                                    null,
                                    [
                                        'class'       => 'form-control',
                                        'id'          => 'level',
                                        'placeholder' => 'Seleccione Nivel'
                                    ]
                                ) 
                            !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! 
                                Form::select(
                                    'schedule',
                                    Levels::Schedule(),
                                    null,
                                    [
                                        'class'       => 'form-control',
                                        'id'          => 'schedule',
                                        'placeholder' => 'Seleccione Horario'
                                    ]
                                ) 
                            !!}
                        </div>
                        <div class="form-group col-md-2 text-right">
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
                                id                  = 'checkactivo'
                                name                = "activo"
                            >
                        </div>
                        <div class="form-group col-md-1 text-right">
                            <button 
                                type           = "button"
                                class          = "btn btn-primary btn-md ml-auto"
                                data-toggle    = "tooltip"
                                data-placement = "top" 
                                title          = "Buscar"   
                                id             = "btnfilterstudentstable" 
                            >
                                <i class="icon icon-search icon-large"></i>
                            </button>                  
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered" id="studentstable">
                <thead>
                    <th>Matrícula</th>
                    <th>Nombre completo</th>
                    <th>Nivel</th>
                    <th>Horario</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                </tbody>
            </table>  
        </div>
    </div>
    <div id="modalformstudent"></div>
@endsection

@section('script')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/students.js') }}"></script>
@endsection