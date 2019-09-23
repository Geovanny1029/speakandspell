<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Login - Bootstrap Admin Template</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
     <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('css/login/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/login/bootstrap-responsive.min.css')}}">
<link rel="stylesheet" href="{{asset('css/login/font-awesome.css')}}">
<link rel="stylesheet" href="{{asset('http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600')}}">
<link rel="stylesheet" href="{{asset('css/login/style.css')}}">
<link rel="stylesheet" href="{{asset('css/login/pages/signin.css')}}">



    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>
    
    <div class="navbar navbar-fixed-top">
    
    <div class="navbar-inner">
        
        <div class="container">
            
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            
            <a class="brand" href="index.html">
                Speak and Spell System              
            </a>        
            
            <div class="nav-collapse">
                <ul class="nav pull-right">
                    
                    <li class="">                       
                        <a href="signup.html" class="">
                            Don't have an account?
                        </a>
                        
                    </li>
                    
                    <li class="">                       
                        <a href="" class="">
                            <i class="icon-chevron-left"></i>
                            Back to Homepage
                        </a>
                        
                    </li>
                </ul>
                
            </div><!--/.nav-collapse -->    
    
        </div> <!-- /container -->
        
    </div> <!-- /navbar-inner -->
    
</div> <!-- /navbar -->



<div class="account-container">
    
    <div class="content clearfix">
        
        <form class="login-form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
            <h1>Ingresar al Sistema</h1>        
            
            <div class="login-fields">
                
                <p>Por favor ingresa usuario y contraseña</p>
                
                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="name" value="{{ old('usuario') }}" placeholder="Usuario" class="login username-field"  required autofocus/>
                    @if ($errors->has('usuario'))
                        <span class="help-block">
                            <strong>{{ $errors->first('usuario') }}</strong>
                        </span>
                    @endif
                </div> <!-- /field -->
                
                <div class="field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="" placeholder="Contraseña" class="login password-field"/>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div> <!-- /password -->
                
            </div> <!-- /login-fields -->
            
            <div class="login-actions">
                
                <span class="login-checkbox">
                    <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
                    <label class="choice" for="Field">Keep me signed in</label>
                </span>
                                    
                <button class="button btn btn-success btn-large">Ingresar</button>
                
            </div> <!-- .actions -->
            
            
            
        </form>
        
    </div> <!-- /content -->
    
</div> <!-- /account-container -->



<div class="login-extra">
    <a href="#">Reset Password</a>
</div> <!-- /login-extra -->

<script src="{{ URL::asset('js/login/jquery-1.7.2.min.js')}}"></script>
<script src="{{ URL::asset('js/login/bootstrap.js')}}"></script>
<script src="{{ URL::asset('js/login/signin.js')}}"></script>

</body>

</html>
