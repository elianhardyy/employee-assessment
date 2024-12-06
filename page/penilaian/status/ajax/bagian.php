<?php
session_start();
include '../../../../config/connection.php';
$type = strtolower($_GET["type"]);
$monthsin = $_GET["month"]; // 10
$yearsin = $_GET["year"]; // 2024
?>
<head>
<link rel="stylesheet" href="../../../../assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../../assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="../../../../assets/dist/css/skins/_all-skins.min.css">
   <link rel="stylesheet" href="../../../../assets/css/style.css">
   <!--charts js-->
   <script src="https://kit.fontawesome.com/bd20a423ca.js" crossorigin="anonymous"></script>
   <script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
   <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<?php
    $month = mysqli_query($con,"SELECT * FROM periode_bulan");
    $year = mysqli_query($con,"SELECT * FROM periode_tahun");

    $monthsingle = mysqli_query($con,"SELECT * FROM periode_bulan WHERE id_periode_bulan = '$monthsin'");
    $fetchMonth = mysqli_fetch_assoc($monthsingle);
    $yearsingle = mysqli_query($con,"SELECT * FROM periode_tahun WHERE nama_tahun='$yearsin'");
    $fetchYear = mysqli_fetch_assoc($yearsingle);
    ?>
    <label for="">Bulan</label>
  <select name="" id="month-option" class="form-control">
    <?php foreach($month as $m):?>
      <?php
        if($monthsin == $m['id_periode_bulan']){ ?>
          
          <option value="<?= $m['id_periode_bulan']?>" selected><?= strtoupper($m['nama_bulan']) ?></option>

      <?php continue;  }  
      ?>
      <option value="<?= $m['id_periode_bulan']?>"><?= strtoupper($m['nama_bulan']) ?></option>
    <?php endforeach; ?>
  </select>
  <label for="">Tahun</label>
  <select name="" id="year-option" class="form-control">
  <?php foreach($year as $y):?>
    <?php if($yearsin == $y['nama_tahun']){ ?>
      <option value="<?= $y['nama_tahun']?>" selected><?= $y['nama_tahun'] ?></option>
    <?php continue; } ?>
      <option value="<?= $y['nama_tahun']?>"><?= $y['nama_tahun'] ?></option>
    <?php endforeach; ?>
  </select>
  <br>
  <table id="example2" class="table table-bordered table-striped table-jq">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama karyawan</th>
        <th>Jenis Kelamin</th>
        <th>Periode</th>
        <th>Jabatan</th>
        <th>Status Penilaian Koordinator</th>
      </tr>
    </thead>
    <tbody>
               <?php if($fetchYear['aksi_tahun'] == "on" && $fetchMonth['aksi_bulan'] == "on" ){?>
                  <?php ;
                  $penKoor = "penilaian_kriteria_koor_".strtolower($type);
                  $penAkhirKoor = "penilaian_akhir_koor_".strtolower($type);
                  $idBulanKoor = "id_kriteria_bulan_koor_".strtolower($type);
                  $idTahunKoor = "id_kriteria_tahun_koor_".strtolower($type);
                  $idKaryawanFk = "id_karyawan_fk_".strtolower($type);
                   $no = 1;
                   
                     $query = mysqli_query($con, "SELECT 
    karyawan.id AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE($penAkhirKoor.nilai_akhir, 0) AS nilai_koor,
    $penAkhirKoor.id_periode_bulan_fk AS bulan_koor,
    $penAkhirKoor.id_periode_tahun_fk AS tahun_koor
FROM karyawan
LEFT JOIN $penAkhirKoor 
    ON karyawan.id = $penAkhirKoor.$idKaryawanFk
    AND $penAkhirKoor.id_periode_bulan_fk = '$monthsin'
    AND $penAkhirKoor.id_periode_tahun_fk = '$yearsin'
WHERE karyawan.jabatan LIKE '%Staf $type%'

UNION

SELECT 
    $penAkhirKoor.$idKaryawanFk AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE($penAkhirKoor.nilai_akhir, 0) AS nilai_koor,
    $penAkhirKoor.id_periode_bulan_fk AS bulan_koor,
    $penAkhirKoor.id_periode_tahun_fk AS tahun_koor
FROM $penAkhirKoor
LEFT JOIN karyawan 
    ON $penAkhirKoor.$idKaryawanFk = karyawan.id
WHERE $penAkhirKoor.id_periode_bulan_fk = '$monthsin'
  AND $penAkhirKoor.id_periode_tahun_fk = '$yearsin'
  AND karyawan.jabatan LIKE '%Staf $type%'");
                     $nilai = 0;
                     $namakaryawan = "";
                     foreach ($query as $i=>$row):
                   ?>
                   
                   
                   <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $row['nama_karyawan'] ?></td>
                      <td><?= $row['jk'] ?></td>
                      <td><?= $row['bulan_koor'] ?> - <?= $row['tahun_koor']?></td>
                   <td><?= $row['jabatan'] ?></td>
                   
                   <?php
                   $idkaryawan = $row['id_karyawan'];
                   $kriKoor = "SELECT * FROM $penKoor WHERE id_karyawan_fk='$idkaryawan' AND $idBulanKoor=$monthsin AND $idTahunKoor=$yearsin";
                   $queryKriKoor = mysqli_query($con,$kriKoor);
                   $koorLen = mysqli_num_rows($queryKriKoor);
                   ?>
                   <?php
                   if($koorLen == 0){
                            ?>
                            <td><span class="label label-danger">belum</span></td>
                            <?php }else if($koorLen >= 1){ ?>
                              <td><span class="label label-success">sudah</span></td>
                            <?php }?>
                   </tr>
                  
                  <?php endforeach; ?>
                  <?php } ?>
               </tbody>
             </table>

<script src="../../../../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../../../assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../../../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../../assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../../assets/dist/js/demo.js"></script>
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
    $("#month-option").change(function(){
    var bagian = $("#bagian").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();

    $("#bagian").val(bagian)
    $("#year-option").val(year);
    $("#tampilin").load(`page/penilaian/status/ajax/bagian.php?type=${bagian}&year=${year}&month=${month}`);
  });
  $("#year-option").change(function(){
    var bagian = $("#bagian").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();

    $("#bagian").val(bagian)
    //$("#year-option").val(year);
    $("#tampilin").load(`page/penilaian/status/ajax/bagian.php?type=${bagian}&year=${year}&month=${month}`);
  });
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