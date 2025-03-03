<?php
$monthsin = date('n');
$yearsin = date('Y');
?>
<style>
  button:disabled {
    cursor: not-allowed;
  }
</style>

<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header">
        <?php if ($_SESSION['logged'] == 1): ?>
          <h3 class="box-title">Penilaian Pemilik </h3>
        <?php else: ?>
          <h3 class="box-title">Penilaian Koordinator </h3>
        <?php endif; ?>
        <h3 class="box-title pull-right">

          <!-- <a href="?p=karyawan&act=create" class="btn btn-success"><i class="fa fa-user"></i> Tambah Data karyawan</a> -->

        </h3>
      </div>
      <!-- /.box-header -->
      <?php
      ?>
      <div class="box-body">
        <?php if ($_SESSION['logged'] == 1): ?>
          <?php
          $getjabatan = mysqli_query($con, "SELECT * FROM jabatan WHERE nama_jabatan LIKE '%staf%'");
          ?>
          <label for="">Bagian</label>
          <select name="" id="bagian" class="form-control">
            <option value="">- Pilih Bagian -</option>
            <?php foreach ($getjabatan as $jab): ?>
              <?php
              $explodejabatan = explode(" ", $jab['nama_jabatan']);
              $getnamejabatan = $explodejabatan[1];
              ?>
              <option value="<?= $getnamejabatan ?>"><?= $getnamejabatan ?></option>
            <?php endforeach; ?>
          </select>
        <?php endif; ?>
        <br>
        <?php
        if ($_SESSION['logged'] == 2) {
          $sqlku = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Produksi%'";
          $karyawanku = mysqli_query($con, $sqlku);
          $type = 'produksi';
          //var_dump($karyawanku);
        }
        if ($_SESSION['logged'] == 3) {
          $sqlku = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Gudang%'";
          $karyawanku = mysqli_query($con, $sqlku);
          $type = 'gudang';
        }
        if ($_SESSION['logged'] == 4) {
          $sqlku = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Penjualan%'";
          $karyawanku = mysqli_query($con, $sqlku);
          $type = 'penjualan';
        }

        //for koordinator
        $month = mysqli_query($con, "SELECT * FROM periode_bulan");
        $year = mysqli_query($con, "SELECT * FROM periode_tahun");
        $monthsingle = mysqli_query($con, "SELECT * FROM periode_bulan WHERE id_periode_bulan = '$monthsin'");
        $fetchMonth = mysqli_fetch_assoc($monthsingle);
        $yearsingle = mysqli_query($con, "SELECT * FROM periode_tahun WHERE nama_tahun='$yearsin'");
        $fetchYear = mysqli_fetch_assoc($yearsingle);
        if (isset($_GET['year']) || isset($_GET['month'])) {
          session_start();
          $monthsin = $_GET['month'];
          $yearsin = $_GET['year'];
          $monthsingle = mysqli_query($con, "SELECT * FROM periode_bulan WHERE id_periode_bulan = '$monthsin'");
          $fetchMonth = mysqli_fetch_assoc($monthsingle);
          $yearsingle = mysqli_query($con, "SELECT * FROM periode_tahun WHERE nama_tahun='$yearsin'");
          $fetchYear = mysqli_fetch_assoc($yearsingle);
        }
        ?>
        <?php if ($_SESSION['logged'] != 1): ?>
          <label for="">Bulan</label>
          <select name="" id="month-option" class="form-control">
            <?php foreach ($month as $m): ?>
              <?php
              if ($monthsin == $m['id_periode_bulan']) { ?>

                <option value="<?= $m['id_periode_bulan'] ?>" selected><?= strtoupper($m['nama_bulan']) ?></option>

              <?php continue;
              }
              ?>
              <option value="<?= $m['id_periode_bulan'] ?>"><?= strtoupper($m['nama_bulan']) ?></option>
            <?php endforeach; ?>
          </select>
          <label for="">Tahun</label>
          <select name="" id="year-option" class="form-control">
            <?php foreach ($year as $y): ?>
              <?php if ($yearsin == $y['nama_tahun']) { ?>
                <option value="<?= $y['nama_tahun'] ?>" selected><?= $y['nama_tahun'] ?></option>
              <?php continue;
              } ?>
              <option value="<?= $y['nama_tahun'] ?>"><?= $y['nama_tahun'] ?></option>
            <?php endforeach; ?>
          </select>
        <?php endif; ?>
        <div id="tampilin">

          <?php if ($_SESSION['logged'] != 1): ?>
            <h3 style="font-weight: 700;">Penilaian Bagian <?= ucfirst($type) ?></h3>
            <table id="example1" class="table table-bordered table-striped table-jq">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama karyawan</th>
                  <th>Jenis Kelamin</th>
                  <th>Jabatan</th>
                  <th>Periode</th>
                  <th>Status</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php if ($fetchYear['aksi_tahun'] == "on" && $fetchMonth['aksi_bulan'] == "on") { ?>
                  <?php
                  if ($_SESSION['logged'] == 2) {
                    $type = 'produksi';
                  }
                  if ($_SESSION['logged'] == 3) {
                    $type = 'gudang';
                  }
                  if ($_SESSION['logged'] == 4) {
                    $type = 'penjualan';
                  } ?>
                  <?php

                  $penAkhirKoor = "penilaian_akhir_koor_" . $type;
                  $idKaryawanFk = "id_karyawan_fk_" . $type;
                  //AND karyawan.jabatan = '%Staf $type%'
                  $sqlgabungLeft = "SELECT * FROM $penAkhirKoor LEFT JOIN karyawan ON $penAkhirKoor.$idKaryawanFk=karyawan.id WHERE $penAkhirKoor.id_periode_bulan_fk='$monthsin' AND $penAkhirKoor.id_periode_tahun_fk='$yearsin'AND karyawan.jabatan = '%Staf $type%'";
                  $sqlgabungRight = "SELECT * FROM $penAkhirKoor RIGHT JOIN karyawan ON $penAkhirKoor.$idKaryawanFk=karyawan.id WHERE karyawan.jabatan = '%Staf $type%'";
                  $gabungAll = $sqlgabungLeft . " UNION " . $sqlgabungRight;
                  //coalesce menghandle nilai null
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
                  $no = 1;
                  $querygabungLen = mysqli_num_rows($query);
                  // jika querygabung 0 maka tampilkan tabel karyawan;
                  if ($querygabungLen == 0) {
                    $sql = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf $type%'";
                    $query = mysqli_query($con, $sql);
                  }

                  ?>
                  <?php foreach ($query as $row): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $row['nama_karyawan'] ?></td>
                      <td><?= $row['jk'] ?></td>
                      <td><?= $row['jabatan'] ?></td>
                      <td><?= $row['bulan_koor'] ?> - <?= $row['tahun_koor'] ?></td>
                      <?php
                      $idkaryawan = $row['id_karyawan'];
                      $kri = "SELECT * FROM penilaian_kriteria_pemilik WHERE id_karyawan_fk=$idkaryawan AND id_kriteria_bulan_pemilik=$monthsin AND id_kriteria_tahun_pemilik=$yearsin";
                      $queryKri = mysqli_query($con, $kri);
                      $kriLen = mysqli_num_rows($queryKri);
                      $penKoor = "penilaian_kriteria_koor_" . $type;
                      $idBulanKoor = "id_kriteria_bulan_koor_" . $type;
                      $idTahunKoor = "id_kriteria_tahun_koor_" . $type;
                      $kriKoor = "SELECT * FROM $penKoor WHERE id_karyawan_fk='$idkaryawan' AND $idBulanKoor=$monthsin AND $idTahunKoor=$yearsin";
                      $queryKriKoor = mysqli_query($con, $kriKoor);
                      $koorLen = mysqli_num_rows($queryKriKoor);
                      //echo $kriLen."ini krilen";

                      if ($koorLen == 0) {
                      ?>
                        <td><span class="label label-danger">belum</span></td>
                        <td><?= $row['nilai_koor'] ?></td>
                        <td>

                          <a href="index.php?p=penilaian&act=nilai&sk=1&idk=<?= $row['id_karyawan'] ?>&type=<?php
                                                                                                            if ($_SESSION['logged'] == 2) {
                                                                                                              echo "produksi";
                                                                                                            }
                                                                                                            if ($_SESSION['logged'] == 3) {
                                                                                                              echo "gudang";
                                                                                                            }
                                                                                                            if ($_SESSION['logged'] == 4) {
                                                                                                              echo "penjualan";
                                                                                                            }
                                                                                                            ?>&year=<?= $yearsin ?>&month=<?= $monthsin ?>" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>
                      <?php } else { ?>
                        <td><span class="label label-success">sudah</span></td>
                        <td><?= number_format($row['nilai_koor'], 2, ",") ?></td>
                        <td><button class="btn btn-danger disabled"><i class="glyphicon glyphicon-pencil"></i></button></td>
                      <?php } ?>
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
  <input type="hidden" name="" id="month-id" value="<?php echo date("n"); ?>">
</div>
<!-- /.row -->
<script>
  $(function() {
    $("#example1").DataTable();

  })
  //pindah ke ajax pemilik
  $("#bagian").change(function() {
    var bagian = $("#bagian").val();
    var year = $("#year-id").val();
    var month = $("#month-id").val();
    $("#bagian").val(bagian)
    $("#tampilin").load(`page/penilaian/ajax/bagian.php?type=${bagian}&year=${year}&month=${month}`);
  })

  $("#month-option").change(function() {
    var bagian = $("#bagian").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();

    $("#bagian").val(bagian)
    $("#year-option").val(year);
    window.location.href = `index.php?p=penilaian&year=${year}&month=${month}`;
    //$("#tampilin").load(`page/penilaian/index.php?year=${year}&month=${month}`);
  });
  $("#year-option").change(function() {
    var bagian = $("#bagian").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();

    $("#bagian").val(bagian)
    //$("#year-option").val(year);
    window.location.href = `index.php?p=penilaian&year=${year}&month=${month}`;
    //$("#tampilin").load(`page/penilaian/index.php?year=${year}&month=${month}`);
  });
</script>