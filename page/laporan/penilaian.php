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
 ?>
<style>
  
</style>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Laporan Penilaian Karyawan </h3><h3 class="box-title pull-right">
          
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
            <!-- <label for="">Periode</label> -->
            <!--<select name="" id="month-filter" class="form-control">

            </select>-->
            <script>
              var mitem = document.getElementById("month-filter");
              var months = [
                  "Januari","Februari","Maret","April","Mei","Juni",
                  "Juli","Agustus","September","Oktober","November","Desember"
              ]
              for(var m=0; m<months.length; m++){
                let optmth = document.createElement("option");
                optmth.innerText = months[m];
                optmth.value = months[m];
                mitem.appendChild(optmth)
              }
            </script>
            <!--<select name="" id="year-filter" class="form-control">

            </select>-->
            <script>
              var yitem = document.getElementById("year-filter");
              var years = [
                  "2024","2023","2022","2021","2020","2019","2018",
                  "2017","2016","2015","2014","2013","2012","2011",
                  "2010"
              ];
              for(var y=0; y<years.length; y++){
                let optyr = document.createElement("option");
                optyr.innerText = years[y];
                optyr.value = years[y];
                yitem.appendChild(optyr)
              }
            </script>
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
    var month = $("#month-filter").val();
    var year = $("#year-filter").val();
    $("#bagian").val(bagian)
    //$("#month-filter").val()
    $("#tampilin").load(`page/laporan/ajax/bagian.php?type=${bagian}`);
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