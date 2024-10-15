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
  //$sqli = "SELECT * FROM jabatan WHERE nama_jabatan LIKE ";
  
  //var_dump($getjabatan);

  //number kriteria and types
  //echo $_SESSION['logged'];
$monthsin = date('m');
$yearsin = date('Y');


?>
<style>
  
</style>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Penilaian Pemilik </h3><h3 class="box-title pull-right">
          
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
            <label for="">Bagian</label>
            <select name="" id="bagian" class="form-control">
              <option value="">- Pilih -</option>
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
  $type = 'produksi';
  //var_dump($karyawanku);
}
if($_SESSION['logged'] == 3){
  $sqlku = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Gudang%'";
  $karyawanku = mysqli_query($con,$sqlku);
  $type = 'gudang';
}
if($_SESSION['logged'] == 4){
  $sql = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Penjualan%'";
  $karyawanku = mysqli_query($con,$sqlku);
  $type = 'penjualan';
}
$month = mysqli_query($con,"SELECT * FROM periode_bulan");
$year = mysqli_query($con,"SELECT * FROM periode_tahun");
$monthsingle = mysqli_query($con,"SELECT * FROM periode_bulan WHERE id_periode_bulan = '$monthsin'");
$fetchMonth = mysqli_fetch_assoc($monthsingle);
$yearsingle = mysqli_query($con,"SELECT * FROM periode_tahun WHERE nama_tahun='$yearsin'");
$fetchYear = mysqli_fetch_assoc($yearsingle);
if(isset($_GET['year']) || isset($_GET['month'])){
  session_start();
  $monthsin = $_GET['month'];
  $yearsin = $_GET['year'];
  $monthsingle = mysqli_query($con,"SELECT * FROM periode_bulan WHERE id_periode_bulan = '$monthsin'");
  $fetchMonth = mysqli_fetch_assoc($monthsingle);
  $yearsingle = mysqli_query($con,"SELECT * FROM periode_tahun WHERE nama_tahun='$yearsin'");
  $fetchYear = mysqli_fetch_assoc($yearsingle);
}
?>
        <?php if($_SESSION['logged'] != 1 ):?>
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
        <?php endif;?>
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
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php if($fetchYear['aksi_tahun'] == "on" && $fetchMonth['aksi_bulan'] == "on" ){?>
            <?php $no=1; ?>
            <?php foreach($karyawanku as $row):?>
              <tr>
              <td><?= $no++ ?></td>
                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['jenis_kelamin'] ?></td>
                    <td><?= $row['no_hp'] ?></td>
                    <td><?= $row['jabatan'] ?></td>
                    <?php
                            $idkaryawan = $row['id'];
                            $kri = "SELECT * FROM penilaian_kriteria_pemilik WHERE id_karyawan_fk=$idkaryawan AND id_kriteria_bulan_pemilik=$monthsin AND id_kriteria_tahun_pemilik=$yearsin";
                            $queryKri = mysqli_query($con,$kri);
                            $kriLen = mysqli_num_rows($queryKri);
                            $penKoor = "penilaian_kriteria_koor_".$type;
                            $idBulanKoor = "id_kriteria_bulan_koor_".$type;
                            $idTahunKoor = "id_kriteria_tahun_koor_".$type;
                            $kriKoor = "SELECT * FROM $penKoor WHERE id_karyawan_fk='$idkaryawan' AND $idBulanKoor=$monthsin AND $idTahunKoor=$yearsin";
                            $queryKriKoor = mysqli_query($con,$kriKoor);
                            $koorLen = mysqli_num_rows($queryKriKoor);
                            //echo $kriLen."ini krilen";
                      
                            if($kriLen == 0 and $koorLen == 0){
                            ?>
                            <td><span class="label label-danger">belum</span></td>
                            <?php }else if($kriLen >= 1 xor $koorLen >= 1){?>
                              <td><span class="label label-warning">proses</span></td>
                            <?php }else if($kriLen >= 1 and $koorLen >= 1){ 
                              
                              ?>
                              <td><span class="label label-success">sudah</span></td>
                            <?php }?>
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
                      ?>&year=<?= $yearsin?>&month=<?= $monthsin?>" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td>
              </tr>
              <?php endforeach ?>
              <?php } ?>
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
    <input type="hidden" name="" id="year-id" value="<?php echo date("Y"); ?>">
    <input type="hidden" name="" id="month-id" value="<?php echo date("m"); ?>">
  </div>
  <!-- /.row -->
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
    $("#tampilin").load(`page/penilaian/ajax/bagian.php?type=${bagian}&year=${year}&month=${month}`);
  })

  $("#month-option").change(function(){
    var bagian = $("#bagian").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();

    $("#bagian").val(bagian)
    $("#year-option").val(year);
    window.location.href = `index.php?p=penilaian&year=${year}&month=${month}`;
    //$("#tampilin").load(`page/penilaian/index.php?year=${year}&month=${month}`);
  });
  $("#year-option").change(function(){
    var bagian = $("#bagian").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();

    $("#bagian").val(bagian)
    //$("#year-option").val(year);
    window.location.href = `index.php?p=penilaian&year=${year}&month=${month}`;
    //$("#tampilin").load(`page/penilaian/index.php?year=${year}&month=${month}`);
  });
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