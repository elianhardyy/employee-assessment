<?php

@session_start();
error_reporting(0);
include 'config/connection.php';
require_once __DIR__ . '/vendor/autoload.php';

if ($_SESSION['id_user'] == null) {
  echo "<script>alert('Harap login terlebih dahulu');window.location.href='login.php'</script>";
}
if (isset($_GET['logout'])) {
  session_destroy();
  header('Location:login.php');
}

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Kinerja</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="icon" type="image/x-icon" href="purnama.jpg">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <!--charts js-->
  <script src="https://kit.fontawesome.com/bd20a423ca.js" crossorigin="anonymous"></script>
  <script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <style type="text/css">
    body {}

    .atas {
      color: white;
    }

    /*footer{
      margin-top: -100px;
      width: 100%;
      position: relative;
    }*/
    .wrapper {
      height: 90%;
    }

    #notification {
      position: fixed;
      top: 20px;
      z-index: 5;
      margin-top: 10vh;
      right: -300px;
      /* Mulai di luar layar */
      background-color: #4CAF50;
      /* Hijau untuk notifikasi sukses */
      color: white;
      width: 30vh;
      padding: 15px 0px 0px;
      border-radius: 5px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      opacity: 0;
      transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
      transform: translateX(100%);
      /* Posisi awal */
    }

    #notification.show {
      opacity: 1;
      transform: translateX(0);
      /* Geser ke posisi normal */
      right: 20px;
      /* Tetap di posisi kanan layar */
    }

    #notification.hidden {
      opacity: 0;
      transform: translateX(-100%);
      /* Geser ke luar layar (kiri) */
    }

    #progress-bar {
      width: 100%;
      /* Awalnya penuh */
      height: 5px;
      /* Tinggi progress bar */
      background-color: #81C784;
      /* Warna hijau terang */
      border-radius: 5px;
      margin-top: 10px;
      transition: width 0.1s linear;
    }
  </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">GMI</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>E</b>-Kinerja</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <?php if (@$_SESSION['logged'] == null): ?>
              <li class="dropdown user user-menu">
                <a href="login.php">
                  <span class="hidden-xs">Login</span>
                </a>
              </li>
            <?php endif ?>
            <?php if (@$_SESSION['logged'] == 2 || @$_SESSION['logged'] == 1 || @$_SESSION['logged'] == 3 || @$_SESSION['logged'] == 4): ?>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu">
                  <img src="assets/img/user.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= $_SESSION['name'] ?></span>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenu" style="width: 100px">
                  <a class="dropdown-item pull-right" href="?logout" style="color: red;margin: 10px;font-size: 20px"><i class="fa fa-circle-o text-red"></i> Logout</a>

                </div>
              </li>
            <?php endif ?>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->

    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
          <li class="<?= (@$_GET['p'] == '') ? 'active' : '' ?>">
            <a href="index.php">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

          <!-- pemilik -->
          <?php if ($_SESSION['logged'] == 1): ?>
            <li class="treeview <?= (@$_GET['p'] == 'user') ? 'active' : '' ?>">
              <a href="#">
                <i class="fa fa-user"></i> <span>User</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

                <li><a href="?p=user"><i class="fa fa-circle-o"></i> Data User</a></li>
              </ul>
            </li>
            <li class="treeview <?= (@$_GET['p'] == 'jabatan') ? 'active' : '' ?>">
              <a href="#">
                <i class="fa fa-solid fa-user-nurse"></i> <span>Jabatan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?p=jabatan"><i class="fa fa-circle-o"></i> Data Jabatan</a></li>
              </ul>
            </li>

            <li class="treeview <?= (@$_GET['p'] == 'karyawan') ? 'active' : '' ?>">
              <a href="#">
                <i class="fa fa-user-secret"></i> <span>Karyawan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?p=karyawan"><i class="fa fa-circle-o"></i> Data Karyawan</a></li>

              </ul>
            </li>
          <?php endif; ?>


          <?php if ($_SESSION['logged'] == 1): ?>

            <li class="treeview <?= (@$_GET['p'] == 'criteria') ? 'active' : '' ?>">
              <a href="#">
                <i class="fa fa-list"></i> <span>Kriteria & Sub Kriteria</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

                <li><a href="?p=criteria"><i class="fa fa-circle-o"></i> Data Kriteria & Sub Kriteria</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if (@$_SESSION['logged'] == 1): ?>
            <li class="treeview <?= (@$_GET['p'] == 'periode') ? 'active' : '' ?>">
              <a href="">
                <i class="fa fa-clock-o"></i><span>Periode</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?p=periode&act=tahun"><i class="fa fa-circle-o"></i> Periode Tahun </a></li>
              </ul>
              <ul class="treeview-menu">
                <li><a href="?p=periode&act=bulan"><i class="fa fa-circle-o"></i> Periode Bulan </a></li>
              </ul>
            </li>
            <li class="treeview <?= (@$_GET['p'] == 'penilaian') ? 'active' : '' ?>">
              <a href="#">
                <i class="fa fa-clock-o"></i> <span>Penilaian</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?p=penilaian"><i class="fa fa-circle-o"></i> Penilaian Pemilik </a></li>
              </ul>
              <ul class="treeview-menu">

                <li><a href="?p=penilaian&act=status-koordinator"><i class="fa fa-circle-o"></i> Cek Status Penilaian Koordinator </a></li>
              </ul>
            </li>
          <?php endif; ?>
          <?php if (@$_SESSION['logged'] != 1): ?>
            <li class="<?= (@$_GET['p'] == 'penilaian') ?>">
              <a href="?p=penilaian"><i class="fa fa-clock-o"></i> Penilaian Koordinator </a>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['logged'] == 1): ?>
            <li class="treeview <?= (@$_GET['p'] == 'laporan') ? 'active' : '' ?>">
              <a href="#">
                <i class="fa fa-list"></i> <span>Hasil & Laporan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?p=laporan&act=penilaian"><i class="fa fa-circle-o"></i> Hasil & Laporan Per Karyawan </a></li>
                <li><a href="?p=laporan&act=terbaik"><i class="fa fa-circle-o"></i> Ranking Karyawan </a></li>
              </ul>
            </li>
          <?php endif ?>

          <?php if (@$_SESSION['logged'] == true): ?>
            <li class="header">OTHER</li>
            <li><a href="?logout"><i class="fa fa-circle-o text-red"></i> <span>Logout</span></a></li>
          <?php endif; ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">

        <?php

        $page = @$_GET['p']; //parameter //page
        $action = @$_GET['act']; //parameter //action
        $method = @$_GET['m'];

        switch ($page) {
          case 'user': //localhost/php/ahp/index.php?p=user
            if ($action == "create") {
              include 'page/user/create.php'; //letak file
            } else if ($action == "edit") {
              include 'page/user/edit.php';   //letak file
            } else {
              include 'page/user/index.php';
            }
            break;

          case 'criteria':
            if ($action == "create") {
              include 'page/kriteria/create.php';
            } else if ($action == "edit") {
              include 'page/kriteria/edit.php';
            } else if ($action == "show") {
              include 'page/kriteria/show.php';
            } else {
              include 'page/kriteria/index.php';
            }
            break;

          case 'subkriteria':
            if ($action == "create") {
              include 'page/sub_kriteria/create.php';
            } else if ($action == "edit") {
            } else {
              include 'page/sub_kriteria/index.php';
            }

          case 'karyawan':
            if ($action == "create") {
              include 'page/karyawan/create.php';
            } else if ($action == "edit") {
              include 'page/karyawan/edit.php';
            } else {
              include 'page/karyawan/index.php';
            }
            break;

          case 'laporan':
            if ($action == "penilaian") {
              include 'page/laporan/penilaian.php';
            } else if ($action == "terbaik") {
              include 'page/laporan/terbaik.php';
            } else if ($action == "rankprint") {
              include 'page/cetak/terbaik.php';
            }
            break;
          case 'penilaian':
            if ($action == "status-koordinator") {
              include 'page/penilaian/status/koordinator.php';
            } else if ($action == "nilai") {
              include 'page/penilaian/nilai.php';
            } else {
              include 'page/penilaian/index.php';
            }
            break;

          case 'periode':
            if ($action == "tahun") {
              include 'page/periode/tahun/index.php';
            } else if ($action == "etahun") {
              include 'page/periode/tahun/edit.php';
            } else if ($action == "ctahun") {
              include 'page/periode/tahun/create.php';
            } else if ($action == "bulan") {
              include 'page/periode/bulan/index.php';
            } else {
              include 'page/periode/index.php';
            }
            break;

          case 'jabatan':
            if ($action == "create") {
              include 'page/jabatan/create.php';
            } else if ($action == "edit") {
              include 'page/jabatan/edit.php';
            } else {
              include 'page/jabatan/index.php';
            }
            break;

          case 'print':
            include 'page/cetak/testprint.php';
            break;

          default:
            include 'page/dashboard.php'; //halaman ini localhost/php/ahp/index.php
            break;
        }

        ?>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- ./wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2023 <a href="https://wa.me/628179851011">AM-Dev</a>.</strong> All rights
    reserved.
  </footer>

  <!-- jQuery 2.2.3 -->
  <script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="assets/dist/js/demo.js"></script>
  <!-- page script -->
  <script>
    $(function() {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>

</body>

</html>