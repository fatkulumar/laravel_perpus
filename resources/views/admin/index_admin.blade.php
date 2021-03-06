<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | {{ $foto_instansi->nama_instansi }} </title>  
  {{-- template external datatable--}}

  <link rel="stylesheet" type="text/css" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}"/>
  <script src="{{ asset('jquery/jquery.min.js') }}"></script>

  {{-- template external --}}
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>--}}
    </ul> 

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <div class="dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ $name }}
        </a>
        <div style="line-height: 10px" class="dropdown-menu">
          <x-jet-responsive-nav-link href="/admin/profil" :active="request()->routeIs('profile.show')">
            <span class="dropdown-item mt-0">{{ __('Profile') }}</span>
          </x-jet-responsive-nav-link>

          <x-jet-responsive-nav-link href="/admin/profil/logo" :active="request()->routeIs('profile.logo')">
            <span class="dropdown-item mt-0">{{ __('Profile Logo') }}</span>
          </x-jet-responsive-nav-link>

          <x-jet-responsive-nav-link href="/admin/pinjam/batas/" :active="request()->routeIs('setBatasPinjam')">
            <span class="dropdown-item mt-0">{{ __('Set Batas Pinjam') }}</span>
          </x-jet-responsive-nav-link>

          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
              <span class="dropdown-item mt-0">{{ __('Logout') }}</span>
            </a>
           
          </form>
          
        </div>
      </div> 

      

      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/profil" class="brand-link">
      <img src="{{ Storage::url('fotoku/') }}{{$foto_instansi->nama_logo}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{$foto_instansi->nama_instansi}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ Storage::url('fotoku/') }}{{$profils->fotoku}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/admin/profil" class="d-block">{{ $name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-close">

            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="/admin/grafik" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grafik</p>
                </a>
              </li>
            </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-close">

            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="/admin/user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/lokasi_buku" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lokasi Buku</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/buku" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buku</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/jurusan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jurusan</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/kelas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/offering" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Offering</p>
                </a>
              </li>
           
              <li class="nav-item">
                <a href="/admin/pinjam" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pinjam & Kembali</p>
                </a>
              </li>

            </ul>

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview menu-open">
    
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Laporan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
    
                <ul class="nav nav-treeview">
    
                  <li class="nav-item" data-toggle="modal" data-target="#laporan_tanggal_pinjam">
                    <a href="#" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lap. Tanggal Pinjam</p>
                    </a>
                  </li>

                  <li class="nav-item" data-toggle="modal" data-target="#laporan_tanggal_kembali"">
                    <a href="#" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lap. Tanggal Kembali</p>
                    </a>
                  </li>
                </ul>    
          </li>
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
            {{-- <h1 class="m-0 text-dark">Dashboard</h1> --}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      @yield('content')

      <!-- Modal laporan tanngal kembali-->
      <div class="modal fade" id="laporan_tanggal_kembali" tabindex="-1" role="dialog" aria-labelledby="laporan_tanggal_kembaliTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title" id="laporan_tanggal_kembaliTitle"><strong>Lap. Tanggal Kembali</strong></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-body">
                    <!-- Date range -->
                    <div class="form-group">
                      <label>Date range:</label>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <form action="/admin/laporan/tanggal_kembali" method="post">
                          @csrf
                        <input type="text" class="form-control float-right" name="datePickerKembali" id="reservation2">
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button id="btn_kembali" type="submit" class="btn btn-primary">Download</button>
            </div>
          </div>
        </form>
        </div>
      </div>

      <!-- Modal laporan tanngal pinjam -->
      <div class="modal fade" id="laporan_tanggal_pinjam" tabindex="-1" role="dialog" aria-labelledby="laporan_tanggal_pinjamTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title" id="exampleModalLongTitle">Lap. Tanggal Pinjam</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          
            <div class="modal-body">

              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-body">
                    <!-- Date range -->
                    <div class="form-group">
                      <label>Date range:</label>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <form action="/admin/laporan/tanggal_pinjam" method="post">
                          @csrf
                        <input type="text" data-date-format="dd/mm/yyyy" class="form-control float-right" name="datePickerPinjam" id="reservation">
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button id="btn_pinjam" type="submit" class="btn btn-primary" data-dismiss="" aria-label="Close">Download</button>
            </div>
          </div>
        </form>
        </div>
      </div>
      
      <!-- disini kontennya -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->





<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
{{-- external datatable --}}
<script type="text/javascript" src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>

<!-- date-range-picker -->
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>


<script>
  $(function () {
    
    //Date range picker
    $('#reservation').daterangepicker({
      autoclose:true
    })
    $('#reservation2').daterangepicker()

    $('#btn_pinjam').click(function(){
      $('#laporan_tanggal_pinjam').modal('hide');
    })

    $('#btn_kembali').click(function(){
      $('#laporan_tanggal_kembali').modal('hide');
    })

  })
</script>
</body>
</html>
