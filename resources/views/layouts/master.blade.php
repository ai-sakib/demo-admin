<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Demo</title>
  {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('public') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('public') }}/dist/css/adminlte.min.css">
  <link href="{{ url('public/css/app.css') }}" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
  <div id="app">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>

        
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="{{ url('public') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">Demo Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ url('public') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              @can('isAdminOrGO')
              <li class="nav-item">
                <router-link to="/" onclick="changeActiveStatus(1)" id="menu-1" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='/roles' onclick="changeActiveStatus(2)" id="menu-2" class="nav-link">
                  <i class="nav-icon fa fa-tasks"></i>
                  <p>
                    Roles
                  </p>
                </router-link>
              </li>
              @endcan
              @can('isAdmin')
              <li class="nav-item">
                <router-link to="/users" onclick="changeActiveStatus(3)" id="menu-3" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    Users
                  </p>
                </router-link>
              </li>
              @endcan
              @can('isAdminOrGO')
              <li class="nav-item">
                <router-link to="/branches" onclick="changeActiveStatus(4)" id="menu-4" class="nav-link">
                  <i class="nav-icon fa fa-building"></i>
                  <p>
                    Branches
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/centa" onclick="changeActiveStatus(5)" id="menu-5" class="nav-link">
                  <i class="nav-icon fa fa-user"></i>
                  <p>
                    Centa
                  </p>
                </router-link>
              </li>
              @endcan
              <li class="nav-item">
                <router-link to="/attendance" onclick="changeActiveStatus(6)" id="menu-6" class="nav-link">
                  <i class="nav-icon fa fa-clock"></i>
                  <p>
                    Attendance
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <a href="#" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                  <i class="nav-icon fa fa-power-off"></i>
                  <p>
                    Logout
                    {{-- <span class="right badge badge-danger">New</span> --}}
                  </p>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </a>
              </li>
              
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
        <router-view></router-view>
      </div>
      
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      {{-- <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
          Anything you want
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
      </footer> --}}
    </div>
  </div>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="{{ url('public/js/app.js') }}" defer></script>
<!-- jQuery -->
<script src="{{ url('public') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('public') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<!-- AdminLTE App -->
<script src="{{ url('public') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('public') }}/dist/js/demo.js"></script>

<script type="text/javascript">
  function changeActiveStatus(id){
    $('.nav-link').removeAttr('style');
    $('.nav-link').addClass('router-link-exact-active');
    $('#menu-'+id).attr('style','background-color:#17a2b8; color:white');
  }
</script>

</body>
</html>
