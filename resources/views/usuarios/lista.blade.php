@extends('usuarios.index')
@section('content')
    <div class="widget-header"> 
        <center>
            <h3>
                Listado de Alumnos Activos
            </h3>
        </center>
    </div>
    <div class="widget-content">
        <div class="shortcuts">
            <div class="form-group col-md-12" id="gralprevio">
                <div class="dropdown" >
                    <button 
                        class         = "form-group col-md-12 btn btn-success dropdown-toggle" 
                        type          = "button" 
                        id            = "dropdownMenuButton" 
                        data-toggle   = "dropdown" 
                        aria-haspopup = "true" 
                        aria-expanded = "false" 
                    >
                        ACCION
                    </button>
                    <ul class="dropdown-menu form-group col-md-12">
                        <li>
                            <a href="{{route('user.menu')}}">INICIO</a>
                        </li>
                        <li>
                            <a href="{{route('user.create')}}">ALTA ALUMNO</a>
                        </li>
                    </ul>
                </div> 
            </div>
            <a href="/listaAlumno/1" data-lity class='btn btn-primary'>Generar Lista</a>
            <br>
        </div>    
    </div>
    <br>
    <table class="table table-striped" id="tablaasignaturas">
        <thead>
            <th>Matricula</th>
            <th>Nombre completo</th>
            <th>Nivel</th>
            <th>Horario</th>
            <th>Accion</th>
        </thead>
        <tbody>
            @foreach($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->id }}</td>
                    <td>{{ $alumno->nombre }} {{ $alumno->ap  }} {{ $alumno->am }}</td>
                    <td>{{ $alumno->nivelal->nombre }}</td>
                    <td>{{ $alumno->nivelal->horario }}</td>
                    <td>
                        <div class="dropdown">
                            <button 
                                class         = "btn btn-success dropdown-toggle" 
                                type          = "button" 
                                id            = "dropdownMenu1" 
                                data-toggle   = "dropdown" 
                                aria-haspopup = "true" 
                                aria-expanded = "true"
                            >
                                Acción
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li>
                                    <a href="{{ route('user.show',$alumno->id) }}" data-lity>Ver perfil</a>
                                </li>
                                <li>
                                    <a  
                                        {{-- data-toggle = "modal" 
                                        data-target = "#editModal"  --}}
                                        onclick     = "fun_edit('{{ route('student.edit',['student' => $alumno->id]) }}')" 
                                        id          = "editaU" 
                                    >
                                        Editar
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('user.pagosal',$alumno->id)}}" data-lity>Pagos</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a 
                                        onclick = "return confirm('¿Seguro que deseas dar de baja este Usuario?')" 
                                        href    = "{{ route('user.destroy', $alumno->id) }}"
                                    >
                                        Dar Baja
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>  
    <input type="hidden" data-toggle="modal" data-target="editstudent" id="showmodaledit">
    <div id="modaleditstudent"></div>
@endsection