<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="{{asset('/adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('/adminlte/dist/css/adminlte.min.css')}}">
  <link rel="shortcut icon" href="/images/default/favicon.png" type="image/x-icon">
  <style>
    [class*=sidebar-dark-] {
      background-color: #3d2cb1
    }
  </style>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper t">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light d-flex">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars fs-4 me-2" style="margin-left: 18px"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav" style="margin-left: auto; margin-right: 18px; margin-top:8px">
      <li class="nav-item dropdown d-flex">
        <div>
          @if(Auth::user()->image == null)
            <img src="{{asset('images/default/img-profile-user-default.jpeg')}}" class="img-circle elevation-2" style="width: 30px; height: 30px; object-fit:cover" alt="User Image">
          @else
            <img src="{{asset('images/users/'.Auth::user()->image)}}" class="img-circle elevation-2" style="width: 30px; height: 30px; object-fit:cover" alt="User Image">
          @endif
        </div>
        <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }} {{ Auth::user()->surname }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" href="{{route('editProfile', Auth::user()->id)}}">Perfil</a></li>
            <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar Sesión
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 s">
    <!-- Brand Logo -->
    <div href="#" class="brand-link ml-3 mt-2">
      <i class="fa-solid fa-gauge fs-3"></i>
      <a href="{{route('dashboard')}}" class="text-white">
        <span class="brand-text font-weight-light ml-2">Dashboard</span>
      </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(Auth::user()->image == null)
            <img src="{{asset('images/default/img-profile-user-default.jpeg')}}" class="img-circle elevation-2" style="width: 30px; height: 30px; object-fit:cover" alt="User Image">
          @else
            <img src="{{asset('images/users/'.Auth::user()->image)}}" class="img-circle elevation-2" style="width: 30px; height: 30px; object-fit:cover" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="{{route('dashboard')}}" class="d-block">{{Auth::user()->role->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Perfil
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('editProfile', Auth::user()->id)}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Perfil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('editPassword', Auth::user()->id)}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cambiar Contraseña</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Inicio
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Página Principal</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Mantenimientos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('mantenimiento-categorias.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('mantenimiento-libros.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Libros</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('mantenimiento-publicaciones.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Publicaciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('mantenimiento-tiendas.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tiendas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('getBookComments')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Comentarios</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Reportes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('bookReport')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Libros</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('saleReport')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ventas</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      @yield('content')
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
</div>

<script src="{{asset('/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/adminlte/dist/js/adminlte.min.js')}}"></script>
<script>
  let url = window.location;

  $('ul.nav-sidebar a').filter(function() {
      if (this.href && String(this.href).split("/").length != 4) {
          return this.href == url || url.href.indexOf(this.href) == 0;
      }
  }).addClass('active');

  $('ul.nav-treeview a').filter(function() {
      if (this.href && String(this.href).split("/").length != 4) {
          return this.href == url || url.href.indexOf(this.href) == 0;
      }
  }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>
@yield('js')
</body>
</html>
