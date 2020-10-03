<?php
  session_start();
  if(!$_SESSION["username"]){
    header("location : ../../index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PERPUS | GRISA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
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
      <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../../../proses/logout.php" class="nav-link">Logout</a>
        </li>
      </ul>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
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
    <a href="#" class="brand-link">
      <img src="dist/img/grisa.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SMK PGRI 1 NGAWI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $_SESSION["username"]; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <?php if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1): ?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?users=users" class="nav-link <?php if(isset($_GET["users"])) {echo "active";}elseif(isset($_GET["tambahUsers"])){echo "active";}elseif(isset($_GET["editUsers"])){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <?php endif ?>

              <li class="nav-item">
                <a href="index.php?buku=buku" class="nav-link <?php if(isset($_GET["buku"])) {echo "active";}elseif(isset($_GET["tambahBuku"])){echo "active";}elseif(isset($_GET["editBuku"])){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buku</p>
                </a>
              </li>

              <?php if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1): ?>
              <li class="nav-item">
                <a href="index.php?lokasiBuku=lokasiBuku" class="nav-link <?php if(isset($_GET["lokasiBuku"])) {echo "active";}elseif(isset($_GET["tambahLokasiBuku"])){echo "active";}elseif(isset($_GET["editLokasiBuku"])){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lokasi Buku</p>
                </a>
              </li>
              <?php endif ?>

              <?php if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1): ?>
              <li class="nav-item">
                <a href="index.php?petugas=petugas" class="nav-link <?php if(isset($_GET["petugas"])) {echo "active";}elseif(isset($_GET["tambahPetugas"])){echo "active";}elseif(isset($_GET["editPetugas"])){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Petugas</p>
                </a>
              </li>
              <?php endif ?>

              <?php if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1): ?>
              <li class="nav-item">
                <a href="index.php?anggota=anggota" class="nav-link <?php if(isset($_GET["anggota"])) {echo "active";}elseif(isset($_GET["tambahAnggota"])){echo "active";}elseif(isset($_GET["editAnggota"])){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Anggota</p>
                </a>
              </li>
              <?php endif ?>

              <?php if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1): ?>
              <li class="nav-item">
                <a href="index.php?kelas=kelas" class="nav-link <?php if(isset($_GET["kelas"])) {echo "active";}elseif(isset($_GET["tambahKelas"])){echo "active";}elseif(isset($_GET["editKelas"])){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <?php endif ?>

              <li class="nav-item">
                <a href="index.php?pinjam=pinjam" class="nav-link <?php if(isset($_GET["pinjam"])) {echo "active";}elseif(isset($_GET["tambahPinjam"])){echo "active";}elseif(isset($_GET["editPinjam"])){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pinjam</p>
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
            <!-- <h1 class="m-0 text-dark">Dashboardd</h1> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <?php
        include "../../../koneksi/koneksi.php";
        if(isset($_GET["users"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/users/users.php";
          }
        }elseif(isset($_GET["editUsers"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/users/editUsers.php";
          }
        }elseif(isset($_GET["tambahUsers"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/users/tambahUsers.php";
          }
        }elseif(isset($_GET["buku"])){
          include "../../../form/buku/buku.php";
        }elseif(isset($_GET["editBuku"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/buku/editBuku.php";
          }
        }elseif(isset($_GET["tambahBuku"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/buku/tambahBuku.php";
          }
        }elseif(isset($_GET["tambahPetugas"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/petugas/tambahPetugas.php";
          }
        }elseif(isset($_GET["petugas"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/petugas/petugas.php";
          }
        }elseif(isset($_GET["editPetugas"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/petugas/editPetugas.php";
          }
        }elseif(isset($_GET["anggota"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/anggota/anggota.php";
          }
        }elseif(isset($_GET["tambahAnggota"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/anggota/tambahAnggota.php";
          }
        }elseif(isset($_GET["editAnggota"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/anggota/editAnggota.php";
          }
        }elseif(isset($_GET["kelas"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/kelas/kelas.php";
          }
        }elseif(isset($_GET["tambahKelas"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/kelas/tambahKelas.php";
          }
        }elseif(isset($_GET["editKelas"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/kelas/editKelas.php";
          }
        }elseif(isset($_GET["lokasiBuku"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/lokasiBuku/lokasiBuku.php";
          }
        }elseif(isset($_GET["tambahLokasiBuku"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/lokasiBuku/tambahLokasiBuku.php";
          }
        }elseif(isset($_GET["editLokasiBuku"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/lokasiBuku/editLokasiBuku.php";
          }
        }elseif(isset($_GET["pinjam"])){
          // if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/pinjam/pinjam.php";
          // }
        }elseif(isset($_GET["tambahpinjam"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/pinjam/tambahPinjam.php";
          }
        }elseif(isset($_GET["editpinjam"])){
          if($_SESSION["cekStatus"] == 0 || $_SESSION["cekStatus"] == 1){
            include "../../../form/pinjam/editPinjam.php";
          }
        }elseif(isset($_GET["page"])){
            include "../../../form/pinjam/pinjam.php";
        }elseif(isset($_GET["pageBuku"])){
          include "../../../form/buku/buku.php";
        }else{
          echo "tidak ada yang di kirim";
        }
      ?>
      <!-- disini kontennya -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#">Fatkhul Umar 16112307</a>.</strong>
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
