<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Administrador</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">        
        <link href="{{ asset('css/custom-efects.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/login/font-awesome.css') }}">
        @yield('styles')

    </head>
    <body>
        <nav class="navbar navbar-default sticky-top bg-danger">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="icon-home icon-large text-white"></i>
                </a>
                <div class="navbar-header"> 
                    <a class="navbar-brand" href="{{ route('home') }}" style="color: white;">Sistema de administracion de Alumnos</a>
                </div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a 
                            href          = "#" 
                            class         = "nav-link dropdown-toggle text-white"  
                            data-toggle   = "dropdown" 
                            role          = "button" 
                            aria-expanded = "false"
                        >
                            {{ Auth::user()->name}} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu">                                           
                            <a 
                                href        = "#" 
                                class       = "dropdown-item" 
                                data-toggle = "modal" 
                                data-target = "#ChangeUser" 
                                onclick     = "fun_ChangeUser('{{ Auth::user()->id}}')" 
                                id          = "editaUser" 
                                value       = "{{route('users.changeU')}}"
                            >
                                Cambio Usuario
                            </a>                        
                            <a 
                                href    = "{{ url('/logout') }}" 
                                onclick = "event.preventDefault(); document.getElementById('logout-form').submit();"
                                class   = "dropdown-item"
                            >
                                Salir
                            
                                <form 
                                    id     = "logout-form" 
                                    action = "{{ route('logout') }}" 
                                    method = "POST"
                                    style  = "display: none;"
                                >
                                    {{ csrf_field() }}
                                </form>  
                            </a>                          
                        </div>
                    </li>
                </ul>
            </div>
            @include('usuarios.modals.CambioUser')
        </nav>

        <main class="container-fluid pt-2" role="main">
            @yield('content')
        </main> 
        @include('sweetalert::alert')
        <script src="{{ asset('js/app.js') }}"></script> 
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();                   
            });
        </script>
        @yield('script')
    </body>
</html>
