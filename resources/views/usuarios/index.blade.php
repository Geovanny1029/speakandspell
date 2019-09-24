<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Administrador</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="stylesheet" href="{{asset('css/login/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/login/bootstrap-responsive.min.css')}}">
<link rel="stylesheet" href="{{asset('css/login/font-awesome.css')}}">
<link rel="stylesheet" href="{{asset('css/login/style.css')}}">
<link rel="stylesheet" href="{{asset('css/login/pages/dashboard.css')}}">


<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html">Sistema de administracion de Usuarios </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> {{ Auth::user()->name}} <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();    document.getElementById('logout-form').submit();"><span class="icon-bar"></span>Salir</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div><br><br>
<!-- /navbar -->

<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Menu de Opciones</h3>
            </div>
            <div class="widget-content">
              <div class="shortcuts">
                <a href="javascript:;" class="shortcut">
                  <i class="shortcut-icon icon-user"></i>
                  <span class="shortcut-label">Usuarios</span> 
                </a>                
                <a href="javascript:;" class="shortcut">
                  <i class="shortcut-icon icon-bookmark"></i>
                  <span class="shortcut-label">Pagos</span>
                </a>
                <a href="javascript:;" class="shortcut">
                  <i class="shortcut-icon icon-file"></i>
                  <span class="shortcut-label">Notes</span> 
                </a>
                <a href="javascript:;" class="shortcut"> 
                  <i class="shortcut-icon icon-comment"></i>
                  <span class="shortcut-label">Corte</span> 
                </a>
                <a href="javascript:;" class="shortcut">
                  <i class="shortcut-icon icon-list-alt"></i>
                  <span class="shortcut-label">Utilerias</span> 
                </a>
                <a href="javascript:;" class="shortcut">
                  <i class="shortcut-icon icon-picture"></i>
                  <span class="shortcut-label">Bloc</span> 
                </a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- /main-inner --> 

<!-- /extra -->
<div class="extra">
  <div class="extra-inner">
    <div class="container">
      <div class="row">

                    <!-- /span3 -->
                </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /extra-inner --> 
</div>
<!-- /footer --> 

<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="{{ URL::asset('js/login/jquery-1.7.2.min.js')}}"></script>
<script src="{{ URL::asset('js/login/excanvas.min.js')}}"></script>
<script src="{{ URL::asset('js/login/bootstrap.js')}}"></script>
<script src="{{ URL::asset('js/login/full-calendar/fullcalendar.min.js')}}"></script>
<script src="{{ URL::asset('js/login/base.js')}}"></script>

</body>
</html>
