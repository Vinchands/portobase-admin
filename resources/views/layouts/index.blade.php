<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') - {{ env('APP_NAME') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  @yield('head')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <header class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <span id="realtime-clock" class="nav-link"></span>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <button type="submit" class="btn btn-sm nav-link text-danger" title="Sign Out" onclick="showLogoutConfirmation()">
          <i class="fas fa-power-off"></i>
        </button>
        <form action="{{ route('logout') }}" method="post" id="logout-form">
          @csrf
        </form>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </header>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE" class="brand-image img-circle elevation-3">
      <span class="brand-text">Portobase Admin</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image" style="aspect-ratio: 1/1;">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @php
            $links = [
                [
                    'name' => 'Dashboard',
                    'alias' => 'dashboard',
                    'href' => route('dashboard'),
                    'icon' => 'fas fa-tachometer-alt',
                ],
                [
                    'name' => 'Projects',
                    'alias' => 'projects',
                    'href' => route('projects.index'),
                    'icon' => 'fas fa-folder-open',
                ],
                [
                    'name' => 'Categories',
                    'alias' => 'categories',
                    'href' => route('categories.index'),
                    'icon' => 'fas fa-list',
                ],
                [
                    'name' => 'Tags',
                    'alias' => 'tags',
                    'href' => route('tags.index'),
                    'icon' => 'fas fa-code',
                ],
                [
                    'name' => 'API',
                    'alias' => 'api',
                    'href' => '#',
                    'icon' => 'fas fa-plug',
                ],
            ];
        @endphp
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @foreach ($links as $link)
            <li class="nav-item">
              <a
                href="{{ $link['href'] }}"
                @class(['nav-link', 'active' => request()->is($link['alias'])])
              >
                <i class="nav-icon {{ $link['icon'] }}"></i>
                <p>{{ $link['name'] }}</p>
              </a>
            </li>
          @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('title')</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      "Talk is cheap. Show me your code." - Linus Torvalds
    </div>
    <!-- Default to the left -->
    <strong>&copy; 2025 Kevin CS.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- SweetAlert 2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script type="text/javascript">
  
  const clock = document.getElementById('realtime-clock')
  
  function updateClock() {
    const datetime = new Intl.DateTimeFormat('en-US', {
      dateStyle: 'medium',
      timeStyle: 'short'
    }).format(Date.now())
    clock.innerHTML = datetime
  }
  
  setInterval(updateClock, 1000)
  updateClock()
  
  function showLogoutConfirmation() {
    const logoutForm = document.getElementById('logout-form')
    Swal.fire({
      // title: "Confirmation",
      text: "Are you sure want to logout?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Yes",
      cancelButtonColor: "#d33",
      cancelButtonText: "No"
    }).then((result) => {
      if (result.isConfirmed) {
        logoutForm.submit()
      }
    });
  }
  
</script>
@yield('scripts')
</body>
</html>
