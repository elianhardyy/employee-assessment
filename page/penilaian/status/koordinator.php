<?php 

  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE from karyawan where id='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=karyawan'</script>";
    } else {
      echo mysqli_error($con);
    }
  }
  
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
<style>
  
</style>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Status Penilaian Koordinator </h3><h3 class="box-title pull-right">
          
            <!-- <a href="?p=karyawan&act=create" class="btn btn-success"><i class="fa fa-user"></i> Tambah Data karyawan</a> -->
            
          </h3>
        </div>
        <!-- /.box-header -->
         <?php
         
         ?>
        <div class="box-body">
        <?php if($_SESSION['logged'] == 1):?>
          <?php 
            $getjabatan = mysqli_query($con,"SELECT * FROM jabatan WHERE nama_jabatan LIKE '%staf%'");
            ?>
            <select name="" id="bagian" class="form-control">
              <option value="">- Pilih Bagian -</option>
              <?php foreach($getjabatan as $jab):?>
                <?php
                  $explodejabatan = explode(" ",$jab['nama_jabatan']);
                  $getnamejabatan = $explodejabatan[1];  
                ?>
              <option value="<?= $getnamejabatan ?>"><?= $getnamejabatan?></option>
              <?php endforeach;?>
            </select>
            <?php endif;?>
          <br>
          <?php
if($_SESSION['logged'] == 2){
  $sqlku = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Produksi%'";
  $karyawanku = mysqli_query($con,$sqlku);
  //var_dump($karyawanku);
}
if($_SESSION['logged'] == 3){
  $sqlku = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Gudang%'";
  $karyawanku = mysqli_query($con,$sqlku);
}
if($_SESSION['logged'] == 4){
  $sql = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Penjualan%'";
  $karyawanku = mysqli_query($con,$sqlku);
}
?>
        <div id="tampilin">
          
          <?php if($_SESSION['logged'] != 1):?>
          <table id="example1" class="table table-bordered table-striped table-jq">
            <thead>
            <tr>
                 <th>No</th>
                 <th>Nama karyawan</th>
                 <th>Jenis Kelamin</th>
                 <th>Nomor Hp</th>
                 <th>Jabatan</th>
                 <th>Status Penilaian Pemilik</th>
                 <th>Status Penilaian Koordinator</th>
                 <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
            <?php foreach($karyawanku as $row):?>
              <tr>
              <td><?php echo "1"?></td>
                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['jenis_kelamin'] ?></td>
                   <td><?= $row['no_hp'] ?></td>
                   <td><?= $row['jabatan'] ?></td>
                   
                   <td><span class="label <?php  $label = ($row['status_penilaian_pemilik'] == 'belum') ? 'label-danger' : (($row['status_penilaian_pemilik'] == 'proses') ? 'label-warning' : 'label-success'); echo $label; ?>"><?= $row['status_penilaian_pemilik']?></span></td>
                   <td><span class="label <?php  $label = ($row['status_penilaian_koordinator'] == 'belum') ? 'label-danger' : (($row['status_penilaian_koordinator'] == 'proses') ? 'label-warning' : 'label-success'); echo $label; ?>"><?= $row['status_penilaian_koordinator']?></span></td>
                   <td>

                     <a href="index.php?p=penilaian&act=nilai&sk=1&idk=<?= $row['id']?>&type=<?php
                     if($_SESSION['logged'] == 2){
                        echo "produksi";
                     }
                     if($_SESSION['logged'] == 3){
                        echo "gudang";
                     }
                     if($_SESSION['logged'] == 4){
                        echo "penjualan";
                     }
                     ?>" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                   </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <?php endif ?>
          </div>
          
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <input type="hidden" name="" id="year-id" value="<?php echo date("Y"); ?>">
    <input type="hidden" name="" id="month-id" value="<?php echo date("m"); ?>">
  <!-- /.row -->
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
<script>
  // $(function () {
  //   // $("#example1").DataTable();
  //   // $('#example2').DataTable({
  //   //   "paging": true,
  //   //   "lengthChange": true, //false
  //   //   "searching": true,//false
  //   //   "ordering": true,
  //   //   "info": true,
  //   //   "autoWidth": true//false
  //   // });
  //   $('.table-jq').DataTable({
  //     "paging": true,
  //     "lengthChange": true, //false
  //     "searching": true,//false
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": true
  //   })
  // });
  // var bagian = document.getElementById("bagian");
  // bagian.addEventListener("change",function () { 
  //   var bagian2 = document.getElementById("bagian")
  //   document.getElementById("bagian").value = bagian2.value
  //   var tampil = document.getElementById("tampil")
  //   tampil.onload = `page/penilaian/ajax/bagian.php?type=${bagian2.value}`;
  // })
  $("#bagian").change(function(){
    var bagian = $("#bagian").val();
    var year = $("#year-id").val();
    var month = $("#month-id").val();
    $("#bagian").val(bagian)
    $("#tampilin").load(`page/penilaian/status/ajax/bagian.php?type=${bagian}&year=${year}&month=${month}`)
  })

  
  // $(function () {
  //   $("#example1").DataTable();
  //   $('#example2').DataTable({
  //     "paging": true,
  //     "lengthChange": true, //false
  //     "searching": true,//false
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": true//false
  //   });
  //});
</script>