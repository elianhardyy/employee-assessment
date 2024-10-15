<?php
session_start();
include '../../../config/connection.php';
$type = $_GET["type"];
echo $type;
?>
<head>
<link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="../../../assets/dist/css/skins/_all-skins.min.css">
   <link rel="stylesheet" href="../../../assets/css/style.css">
   <!--charts js-->
   <script src="https://kit.fontawesome.com/bd20a423ca.js" crossorigin="anonymous"></script>
   <script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
   <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>


   <table id="example2" class="table table-bordered table-striped table-jq">
               <thead>
               <tr>
                 <th>No</th>
                 <th>Nama karyawan</th>
                 <th>Nomor hp</th>
                 <th>Jenis Kelamin</th>
                 <th>Jabatan</th>
                 <th>Penilaian Pemilik</th>
                 <th>Penilaian Koordinator</th>
                 <th>Penilaian Akhir</th>
               </tr>
               </thead>
               <tbody>
                  <?php 
                   $no = 1;
                   $sql = "SELECT * FROM karyawan WHERE jabatan LIKE 'Staf $type' ORDER BY nilai_total DESC";
                     $query = mysqli_query($con, $sql);
                     $nilai = 0;
                     foreach ($query as $i=>$row):
                   ?>
                   <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['jenis_kelamin'] ?></td>
                      <td><?= $row['no_hp'] ?></td>
                   <td><?= $row['jabatan'] ?></td>
                   <td><?= $row['penilaian_pemilik'] ?></td>
                   <td><?= $row['penilaian_koordinator'] ?></td>
                   <td><?= $row['nilai_total'] ?></td>
                   </tr>
                  <?php endforeach; ?>
               </tbody>
             </table>

<script src="../../../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../../assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    // $("#example1").DataTable();
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": true, //false
    //   "searching": true,//false
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": true//false
    // });
    $('.table-jq').DataTable({
      "paging": true,
      "lengthChange": true, //false
      "searching": true,//false
      "ordering": true,
      "info": true,
      "autoWidth": true
    })
  });
</script>