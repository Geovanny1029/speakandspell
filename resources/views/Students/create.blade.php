@extends('usuarios.index')
@section('content')
    <div class="widget-header"> 
        <center><h3>Alta Alumno</h3></center>
    </div>
    <div class="widget-content">
        <div class="shortcuts">
            <div class="form-group col-md-12" id="gralprevio">
            <div class="dropdown" >
                <button 
                    class="form-group col-md-12 btn btn-success dropdown-toggle" 
                    type="button" 
                    id="dropdownMenuButton" 
                    data-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false" >
                    ACCIÓN
                </button>
                <ul class="dropdown-menu form-group col-md-12">
                    <li>
                        <a href="{{route('user.menu')}}">INICIO</a>
                    </li>
                    <li>
                        <a href="{{route('user.index')}}">LISTA ALUMNOS</a>
                    </li>
                </ul>
            </div> 
        </div>
        
        {!! Form::open(['route' => 'student.store', 'method' => 'POST' ,'files'=>true]) !!}
            <div class="row">
                <div class="form-group col-md-12">
                    {!! Form::label('matricula', 'Matricula') !!} 
                    {!! 
                        Form::text(
                            'id',
                            $ultimo,
                            [
                                'class'       => 'form-control',
                                'style'       => 'text-transform: uppercase;', 
                                'placeholder' => 'matricula', 
                                'readonly'    => ' readonly', 
                                'required'                                
                            ] 
                        ) 
                    !!}
                </div>
            </div> 

            @include('Students.Form')

        {!! Form::close()!!}
    </div>
@endsection