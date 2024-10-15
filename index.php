<?php 

@session_start();
error_reporting(0);
include 'config/connection.php';

	// if (@$_SESSION['logged'] == false) {
	// 	header('Location:login.php');
	// }
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
  <link rel="icon" type="image/x-icon" href="favicon.ico">
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
   <!--charts js-->
   <script src="https://kit.fontawesome.com/bd20a423ca.js" crossorigin="anonymous"></script>
   <script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
   <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
   <style type="text/css">
    body{

    }
    .atas{
      color: white;
    }

    /*footer{
      margin-top: -100px;
      width: 100%;
      position: relative;
    }*/
    .wrapper{
      height: 90%;
    }
  </style>
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
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

            <?php if (@$_SESSION['logged'] == 1): ?>
              <li><a class="dropdown-item" href="?p=karyawan">Data Karyawan</a></li>
              <!-- <li><a class="dropdown-item" href="?p=alternatif">Penilaian karyawan</a></li> -->
         <!--  <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRN9igcyo_jp2dYcTSY3qY-o-CY7u4Unb3yWtDJjS5Udj0uBswAZg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $_SESSION['name'] ?></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu" style="width: 100px">

              <a class="dropdown-item" href="#" style="margin: 10px;font-size: 20px">Identitas</a>
              <br>
              <a class="dropdown-item pull-right" href="?logout" style="color: red;margin: 10px;font-size: 20px"><i class="fa fa-circle-o text-red"></i> Logout</a>
              
              
              
            </div>
          </li> -->

        <?php endif ?>
        <?php if (@$_SESSION['logged'] == null):?>
          <li class="dropdown user user-menu">
            <a href="login.php" >
              <span class="hidden-xs">Login</span>
            </a>
          </li>
        <?php endif ?>
        <?php if (@$_SESSION['logged'] == 2 || @$_SESSION['logged'] == 1): ?>
          <li><a class="dropdown-item" href="?p=alternatif">Penilaian karyawan</a></li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu">
              <img src="assets/img/user.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $_SESSION['name'] ?></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenu" style="width: 100px">

              <!-- <a class="dropdown-item" href="#" style="margin: 10px;font-size: 20px">Identitas</a>
                <br> -->
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
        <li class="<?= (@$_GET['p']=='')?'active':'' ?>">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

          <!-- pemilik -->
          <?php if($_SESSION['logged'] == 1):?>
          <li class="treeview <?= (@$_GET['p']=='jabatan')?'active':'' ?>">
            <a href="#">
              <i class="fa fa-solid fa-user-nurse"></i> <span>Jabatan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <!-- <li><a href="?p=jabatan&act=create"><i class="fa fa-circle-o"></i> Data Jabatan </a></li> -->
              <li><a href="?p=jabatan"><i class="fa fa-circle-o"></i> Data Jabatan</a></li>
            </ul>
          </li> 
          <li class="treeview <?= (@$_GET['p']=='user')?'active':'' ?>">
            <a href="#">
              <i class="fa fa-user"></i> <span>User</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <!-- <li><a href="?p=user&act=create"><i class="fa fa-circle-o"></i> Buat User </a></li> -->
              <li><a href="?p=user"><i class="fa fa-circle-o"></i> Data User</a></li>
            </ul>
          </li>
          <li class="treeview <?= (@$_GET['p']=='karyawan')?'active':'' ?>">
            <a href="#">
              <i class="fa fa-user-secret"></i> <span>Karyawan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            
              <!-- <li><a href="?p=karyawan&act=create"><i class="fa fa-circle-o"></i> Tambah data Karyawan </a></li> -->
              <li><a href="?p=karyawan"><i class="fa fa-circle-o"></i> Data Karyawan</a></li>
              <!--<li><a href="?p=karyawan&act=presensi"><i class="fa fa-circle-o"></i> Presensi Karyawan</a></li>-->
              <!-- <li><a href="?p=karyawan&act=kriteria"><i class="fa fa-circle-o"></i> Kriteria dan Sub Kriteria</a></li> -->
              <!-- <li><a href="?p=karyawan&act=presensi"><i class="fa fa-circle-o"></i> Bobot Penilaian</a></li> -->
            </ul>
          </li>
          <?php endif; ?>
          
          <!-- <li class="treeview <?= (@$_GET['p']=='penilaian')?'active':'' ?>">
            <a href="#">
              <i class="fa fa-briefcase"></i> <span>Penilaian Kinerja</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if($_SESSION['logged'] == 1) :?>
                <li><a href="?p=penilaian"><i class="fa fa-circle-o"></i> Penilaian Pemilik </a></li>
              <?php endif; ?>
              <?php if($_SESSION['logged'] == 3 || $_SESSION['logged'] == 1):?>
              <li><a href="?p=penilaian&act=gudang"><i class="fa fa-circle-o"></i>Penilaian Koordinator Gudang</a></li>
              <?php endif;?>
              <?php if($_SESSION['logged'] == 2 || $_SESSION['logged'] == 1):?>
                <li><a href="?p=penilaian&act=produksi"><i class="fa fa-circle-o"></i>Penilaian Koordinator Produksi</a></li>
                <?php endif;?>
                <?php if($_SESSION['logged'] == 4 || $_SESSION['logged'] == 1):?>
                  <li><a href="?p=penilaian&act=penjualan"><i class="fa fa-circle-o"></i>Penilaian Koordinator Penjualan</a></li>
                  <?php endif;?>
            </ul>
          </li> -->
          <?php if($_SESSION['logged'] == 1):?>
          <!-- <li class="treeview <?= (@$_GET['p']=='laporan')?'active':'' ?>">
            <a href="#">
            <i class="fa fa-list"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?p=laporan&act=terbaik"><i class="fa fa-circle-o"></i> Karyawan Terbaik </a></li>
              <li><a href="?p=laporan&act=kinerja"><i class="fa fa-circle-o"></i> Kinerja Karyawan</a></li>
              <!--<li><a href="?p=karyawan&act=presensi"><i class="fa fa-circle-o"></i> Presensi Karyawan</a></li>-->
            <!--</ul>
          </li> -->
          <li class="treeview <?= (@$_GET['p']=='criteria')?'active':'' ?>">
            <a href="#">
            <i class="fa fa-list"></i> <span>Kriteria & Sub Kriteria</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <!-- <li><a href="?p=criteria&act=create"><i class="fa fa-circle-o"></i> Tambah Kriteria </a></li> -->
              <li><a href="?p=criteria"><i class="fa fa-circle-o"></i> Data Kriteria & Sub Kriteria</a></li>
              <!--<li><a href="?p=karyawan&act=presensi"><i class="fa fa-circle-o"></i> Presensi Karyawan</a></li>-->
            </ul>
          </li>
          <?php endif;?>
         
          <?php if(@$_SESSION['logged'] == 1):?>
          <li class="treeview <?= (@$_GET['p']=='penilaian')?'active':'' ?>">
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
          <li class="treeview <?= (@$_GET['p']=='periode')?'active':'' ?>">
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
          <?php endif; ?>
          <?php if(@$_SESSION['logged'] != 1):?>
          <li class="<?= (@$_GET['p'] == 'penilaian')?>">
            <a href="?p=penilaian"><i class="fa fa-clock-o"></i> Penilaian Koordinator </a>
          </li>
          <?php endif; ?>
          <?php if($_SESSION['logged'] == 1):?>
            <li class="treeview <?= (@$_GET['p']=='laporan')?'active':'' ?>">
            <a href="#">
            <i class="fa fa-list"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?p=laporan&act=penilaian"><i class="fa fa-circle-o"></i> Laporan Penilaian </a></li>
              <li><a href="?p=laporan&act=terbaik"><i class="fa fa-circle-o"></i> Laporan Karyawan Terbaik </a></li>
              <!-- <li><a href="?p=subkriteria&act=create"><i class="fa fa-circle-o"></i> Tambah Sub Kriteria</a></li> -->
              <!--<li><a href="?p=karyawan&act=presensi"><i class="fa fa-circle-o"></i> Presensi Karyawan</a></li>-->
            </ul>
          </li>
          <?php endif ?>
           <!--<li class="treeview <?= (@$_GET['p']=='criteria')?'active':'' ?>">
            <a href="#">
              <i class="fa fa-list"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?p=criteria&act=create"><i class="fa fa-circle-o"></i> Laporan Kinerja Karyawan</a></li>
              <li><a href="?p=criteria"><i class="fa fa-circle-o"></i> Laporan Karyawan Terbaik</a></li>
            </ul>
          </li>
          <li class="<?= (@$_GET['p']=='bobot')?'active':'' ?>">
            <a href="?p=bobot">
              <i class="fa fa-th"></i> <span>Bobot kriteria</span>
            </a>
          </li> -->
          <!-- <li class="<?= (@$_GET['p']=='tsukamoto')?'active':'' ?>">
            <a href="?p=fuzzy">
              <i class="fa fa-calculator"></i> <span>Hitung Fuzzy</span>
            </a>
          </li> -->
          <!--
          <li class="<?= (@$_GET['p']=='rank')?'active':'' ?>">
            <a href="?p=rank">
              <i class="fa fa-trophy"></i> <span>Ranking</span>
            </a>
          </li>
        -->
          <!-- <li class="<?= (@$_GET['p']=='report')?'active':'' ?>">
            <a href="?p=report">
              <i class="fa fa-file"></i> <span>Laporan</span>
            </a>
          </li> -->
        

        <?php if (@$_SESSION['logged'] == 2): ?>
          <!-- <li class="<?= (@$_GET['p']=='tsukamoto')?'active':'' ?>">
            <a href="?p=fuzzy">
              <i class="fa fa-calculator"></i> <span>Hitung Fuzzy</span>
            </a>
          </li> -->
          <!--
          <li class="<?= (@$_GET['p']=='alternatif')?'active':'' ?>">
            <a href="?p=alternatif">
              <i class="fa fa-list"></i> <span>Alternatif</span>
            </a>
          </li>
          <li class="<?= (@$_GET['p']=='rank')?'active':'' ?>">
            <a href="?p=rank">
              <i class="fa fa-trophy"></i> <span>Ranking</span>
            </a>
          </li>-->
        <?php endif; ?>
        
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
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section> -->

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
        if($action == "create"){
          include 'page/sub_kriteria/create.php';
        }else if($action == "edit"){
          
        }
        else{
          include 'page/sub_kriteria/index.php';
        }

        case 'create_skor':
        if ($action == "edit") {
          include 'page/pemberiannilai/edit.php';
        } else {
          include 'page/pemberiannilai/create.php';
        }
        break;

        case 'karyawan':
        if ($action == "create") {
          include 'page/karyawan/create.php';
        }else if ($action == "edit") {
          include 'page/karyawan/edit.php';
        }else if ($action == "upload") {
          include 'page/karyawan/upload.php';
        }else if($action == "penilaian"){
          include 'page/karyawan/penilaian.php'; 
        }else if($action == "presensi"){
          include 'page/karyawan/presensi.php';
        }else if($action == "detail"){
          include 'page/karyawan/detail.php';
        }else if($action == "kriteria" && $_SESSION['logged'] == 1){
          include 'page/karyawan/kriteria.php';
        }else if($action == "editKriteria"){
          include 'page/karyawan/editKriteria.php';
        }else if($action == "createkriteria"){
          include 'page/karyawan/createKriteria.php';
        }
        else {
          include 'page/karyawan/index.php';
        }
        break;

        case 'laporan':
          if($action == "penilaian"){
            include 'page/laporan/penilaian.php';
          }else if($action == "terbaik"){
            include 'page/laporan/terbaik.php';
          }else{
              include 'page/laporan/index.php';
          }
        break;
        case 'penilaian':
          if($action == "produksi"){
            include 'page/penilaian/produksi.php';
          }else if($action == "gudang"){
            include 'page/penilaian/gudang.php';
          }else if($action == "status-koordinator"){
            include 'page/penilaian/status/koordinator.php';
          }
          else if($action == "penjualan"){
            include 'page/penilaian/penjualan.php';
          }else if($action == "nilai"){
            include 'page/penilaian/nilai.php';
          }else{
            include 'page/penilaian/index.php';
          }
        break;

        case 'periode':
        if ($action == "create") {
          include 'page/periode/create.php';
        }else if ($action == "edit") {
          include 'page/periode/edit.php';
        }else if($action == "nilai"){
          include 'page/periode/nilai.php';
        }else if($action == "editKriteria"){
          include 'page/periode/editKriteria.php';
        }else if($action == "tahun"){
          include 'page/periode/tahun/index.php';
          if($method == "u"){
            include 'page/periode/tahun/edit.php';
          }
        }else if($method == "ctahun"){
          include 'page/periode/tahun/create.php';
        }else if($action == "bulan"){
          include 'page/periode/bulan/index.php';
          if($method == "u"){
            include 'page/periode/bulan/edit.php';
          }
        }elseif($method = "cbulan"){
          include 'page/periode/bulan/create.php';
        }else{
          include 'page/periode/index.php';
        }
        break;

        case 'jabatan':
        if ($action == "create") {
          include 'page/jabatan/create.php';
        }else if ($action == "edit") {
          include 'page/jabatan/edit.php';
        }else{
          include 'page/jabatan/index.php';
        }
        break;

        case 'bobot':
        if ($action == "edit") {
          include 'page/bobot/edit.php';
        } else {
          include 'page/bobot/index.php';
        }
        break;

        
        case 'TRUNCATE':
        include 'page/pus/del.php';
        break;
        case 'apus-import':
        include 'page/pus/imp.php';
        break;
        

        case 'alternatif':
        if(@$_GET['d']!="")
          include 'page/alternatif/index.php';
        else
                //include 'page/alternatif/pilihstatus.php';
          include 'page/alternatif/index.php';
        break;

        case 'report':
        include 'page/laporan/index.php';
        break;

        case 'rank':
        include 'page/peringkat/index.php';
        break;  

        case 'fuzzy':
        include 'page/fuzzy/index.php';
        break; 

        case 'fuzzy-upload':
        include 'page/fuzzy/upload.php';   
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
  $(function () {
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
