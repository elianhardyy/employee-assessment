<?php
session_start();
include '../../../config/connection.php';
$type = $_GET["type"];
$monthsin = $_GET["month"]; // 10
$yearsin = $_GET["year"]; // 2024
?>

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
                <th>Jabatan</th>
                <th>Status Penilaian Pemilik</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php if($fetchYear['aksi_tahun'] == "on" && $fetchMonth['aksi_bulan'] == "on" ){?>
                 <?php
                  //|| $yearsin == date('Y') xor $monthsin != date('m')
                  
                  $sqlgabungLeft = "SELECT * FROM penilaian_akhir_pemilik LEFT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $type%'";
                  $sqlgabungRight = "SELECT * FROM penilaian_akhir_pemilik RIGHT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $type%'";
                  $gabungAll = $sqlgabungLeft ." UNION ".$sqlgabungRight;
                  //$queryLen = mysqli_num_rows($query);
                  $query = mysqli_query($con,$gabungAll);
                  $no = 1;
                  $querygabungLen = mysqli_num_rows($query);
                  // jika querygabung 0 maka tampilkan tabel karyawan;
                    if($querygabungLen == 0){
                        $sql = "SELECT * FROM karyawan WHERE jabatan LIKE 'Staf $type'";
                        $query = mysqli_query($con, $sql);
                    }
                        foreach($query as $row):?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['jenis_kelamin'] ?></td>
                            <td><?= $row['jabatan'] ?></td>
                            <?php
                            $idkaryawan = $row['id'];
                            $kri = "SELECT * FROM penilaian_kriteria_pemilik WHERE id_karyawan_fk=$idkaryawan AND id_kriteria_bulan_pemilik=$monthsin AND id_kriteria_tahun_pemilik=$yearsin";
                            $queryKri = mysqli_query($con,$kri);
                            $kriLen = mysqli_num_rows($queryKri);
                            $penKoor = "penilaian_kriteria_koor_".$type;
                            $idBulanKoor = "id_kriteria_bulan_koor_".$type;
                            $idTahunKoor = "id_kriteria_tahun_koor_".$type;
                            $kriKoor = "SELECT * FROM $penKoor WHERE id_karyawan_fk=$idkaryawan AND $idBulanKoor=$monthsin AND $idTahunKoor=$yearsin";
                            $queryKriKoor = mysqli_query($con,$kriKoor);
                            $koorLen = mysqli_num_rows($queryKriKoor);
                            if($kriLen == 0 and $koorLen == 0){
                            ?>
                            <td><span class="label label-danger">belum</span></td>
                            <?php }else if($kriLen >= 1 xor $koorLen >= 1){?>
                              <td><span class="label label-warning">proses</span></td>
                            <?php }else if($kriLen >= 1 and $koorLen >= 1){ ?>
                              <td><span class="label label-success">sudah</span></td>
                            <?php }?>
                            <?php 
                            $idKar = $row["id"];
                            $akhir = "SELECT * FROM penilaian_akhir_pemilik WHERE id_karyawan_fk_pemilik=$idKar";
                            $queryAkhirKri = mysqli_query($con,$akhir);
                            $AkhirLen = mysqli_num_rows($queryAkhirKri);
                            ?>
                            <?php if(!$row['nilai_akhir_pemilik']){?>
                              <td>0</td>
                            <?php }else{ ?>
                              <td><?= $row['nilai_akhir_pemilik']?></td>
                            <?php } ?>
                            <td>
                              <a href="index.php?p=penilaian&act=nilai&sk=1&idk=<?= $row['id']?>&type=<?php echo strtolower($type) ?>&year=<?= $yearsin ?>&month=<?= $monthsin ?>" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                            </td>
                        </tr>
        
                    <?php endforeach;?>
                    <?php }?>
                  </tbody>
            </table>


<input type="hidden" name="" id="bagian" value="<?= $type; ?>">
<!-- page script -->
<script>
  
  $("#month-option").change(function(){
    var bagian = $("#bagian").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();

    $("#bagian").val(bagian)
    $("#year-option").val(year);
    $("#tampilin").load(`page/penilaian/ajax/bagian.php?type=${bagian}&year=${year}&month=${month}`);
  });
  $("#year-option").change(function(){
    var bagian = $("#bagian").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();

    $("#bagian").val(bagian)
    //$("#year-option").val(year);
    $("#tampilin").load(`page/penilaian/ajax/bagian.php?type=${bagian}&year=${year}&month=${month}`);
  });
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
    // $('.table-jq').DataTable({
    //   "paging": true,
    //   "lengthChange": true, //false
    //   "searching": true,//false
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": true
    // })
  });
</script>