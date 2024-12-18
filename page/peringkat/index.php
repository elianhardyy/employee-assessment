<?php 
$period = mysqli_query($con, "SELECT * from periode order by label desc");
if (isset($_GET['ta'])) {

  $sql =  "UPDATE alternatif set lihat = '1' where periode = '" . $_GET['ta'] . "'";
  mysqli_query($con, $sql);

  $cr = mysqli_query($con, "SELECT count(*) as kuota from kriteria");
  $cri = mysqli_fetch_array($cr);
  $crit = $cri['kuota'];
  ?>

  <div class="row">
    <div class="col-xs-4">
      <button class="btn btn-primary no-print" onclick="javascript:window.print()">
        <i class="fa fa-print"></i> Print
      </button>
      <br>
      <br>
    </div>
    <div class="col-xs-4">
      <center>
        <h4 class="text-center">Periode <?php echo $_GET['ta'];?> </h4>
      </center>
    </div>
    <?php if (@$_SESSION['logged'] == 1): ?>
      <div class="col-xs-4 ">
        <a href="index.php?p=TRUNCATE&ta=<?php echo $_GET['ta']; ?>" class="no-print btn btn-danger pull-right"><i class="fa fa-trash"></i> Reset Data</a>
        <br>
        <br>
      </div>
    <?php endif; ?>

    <div class="col-xs-12">

      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"> Statement</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div>

        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <?php
              $sql = "select * from kriteria";
              $query = mysqli_query($con, $sql);
              ?>
              <tr>
                <th>No</th>
                <!-- <th>Nama</th> -->
                <th>NIP</th>
                <th>Nama</th>
                <?php while ($row = mysqli_fetch_array($query)) { ?>
                  <th><?php echo $row['kriteria']; ?></th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 0;
              $sql = "select * from alternatif where alternatif.periode = '" . $_GET['ta'] . "'";
              $query = mysqli_query($con, $sql);
              while ($row = mysqli_fetch_assoc($query)) {
                $no++;
                $nama = mysqli_query($con, "SELECT * from karyawan where NIP='$row[NIP]'");
                $nam = mysqli_fetch_array($nama);
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <?php 
                  if ($row['nama_karyawan'] == 'Tinkywinky') {
                    $style = "style='background: #551a8b;color:white;'";
                  } elseif ($row['nama_karyawan'] == 'Dipsy') {
                    $style = "style='background: #9DD744;color:white;'";
                  } elseif ($row['nama_karyawan'] == 'Lala') {
                    $style = "style='background: #f2eb0d;color:black;'";
                  } elseif ($row['nama_karyawan'] == 'Poo') {
                    $style = "style='background: #ef1026;color:white;'";
                  } else {
                    $style = "";
                  }
                  ?>
                  <td <?php echo $style; ?> ><?= $nam['NIP'] ?></td>
                  <td <?php echo $style; ?> ><?= $nam['nama_karyawan'] ?></td>
                  <?php
                  $sql2 = "select * from kriteria";
                  $query2 = mysqli_query($con, $sql2);
                  while ($row2 = mysqli_fetch_assoc($query2)) {
                    $sql3 = "SELECT * from nilai_alternatif where id_alternatif='$row[id_alternatif]' and id_kriteria='$row2[id_kriteria]' and periode='" . $_GET['ta'] . "'";
                    $query3 = $con->query($sql3);
                    $fetch = mysqli_fetch_array($query3);
                    echo "<td>$fetch[nilai]</td>";
                  }
                  ?>  
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <!--charts-->
          <?php //include 'page/peringkat/chart-ahp.php'; ?>
          <!--charts end-->

        </div>
      </div>

      <div class "box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Ranking Hasil AHP</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div>

        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <?php
              $sql = "select * from kriteria";
              $query = mysqli_query($con, $sql);
              $criteria_count = mysqli_num_rows($query);
              ?>
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                  echo "<th>" . $row['kriteria'] . "</th>";
                }
                ?>
                <th>Hasil AHP</th>
                <th>Index Lieker</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $ranking = 0;
              $nama = "";
              $no = 0;
              $sql = "select * from alternatif where periode = '" . $_GET['ta'] . "' order by NIP";
              $query = mysqli_query($con, $sql);
              while ($row = mysqli_fetch_assoc($query)) {
                $no++;
                $nama = mysqli_query($con, "SELECT * from karyawan where NIP='$row[NIP]'");
                $nam = mysqli_fetch_array($nama);
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td <?= $style; ?>><?= $nam['NIP'] ?></td>
                  <td <?= $style; ?>><?= $nam['nama_karyawan'] ?></td>
                  <?php
                  $total = 0;
                  $sql2 = "select * from kriteria";
                  $query2 = mysqli_query($con, $sql2);
                  while ($row2 = mysqli_fetch_assoc($query2)) {
                    $sql3 = "select * from nilai_alternatif where id_alternatif='" . $row['id_alternatif'] . "' and id_kriteria='" . $row2['id_kriteria'] . "' and periode = '" . $_GET['ta'] . "'";
                    $query3 = $con->query($sql3);
                    $fetch = mysqli_fetch_array($query3);
                    $nilai = $fetch['nilai'];
                    $total += $nilai;
                    echo "<td>" . $fetch['nilai'] . "</td>";
                  }

                  $hasil_ahp = $total; // Menggunakan total sebagai Hasil AHP

                  if ($hasil_ahp > $ranking) {
                    $ranking = $hasil_ahp;
                    $nama = $row['NIP'];
                  }

                  $sta = ""; // Status awal
                  $bad = ""; // Kelas CSS awal

                  if ($hasil_ahp >= 0 && $hasil_ahp <= 60) {
                    $sta = "Kinerja Kurang";
                    $bad = "class='badge btn-danger'";
                  } elseif ($hasil_ahp > 60 && $hasil_ahp <= 80) {
                    $sta = "Kinerja Cukup";
                    $bad = "class='badge btn-primary'";
                  } elseif ($hasil_ahp > 80 && $hasil_ahp <= 100) {
                    $sta = "Kinerja Baik";
                    $bad = "class='badge btn-success'";
                  }

                  $index_lieker = ""; // Anda perlu menghitungnya berdasarkan rumus yang sesuai.
                  echo "<td>$hasil_ahp</td>";
                  echo "<td $bad>$sta</td>";
                  echo "<td>$index_lieker</td>";
                  ?>
                </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <?php $reqord = mysqli_fetch_array(mysqli_query($con, "SELECT * from karyawan where NIP='$nama'")); ?>
              <tr>
                <td colspan="<?= $criteria_count + 2 ?>" class="text-center">Peringkat pertama diraih oleh <strong><?php echo $nama . " - " . $reqord["nama_karyawan"] ?></strong> dengan total <strong><?= $ranking ?></strong></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <?php
} else {
  echo '<div class="box box-primary">
  <div class="box-header with-border">
  <center>
  <h3 class="box-title">
  <form action="" method="">
  <input type="text" value="rank" name="p" hidden>
  <label>Periode Pengajaran: </label>
  <select class="custom-select" name="ta" required>';
  while ($per = mysqli_fetch_array($period)) {
    echo '<option  value="' . $per['periode'] . '" ';
    if ($_GET['ta'] == $per['periode']) {
      echo "selected";
    } else {
      echo "";
    }
    echo  '>' . $per['label'] . '</option>';
  }
  echo '            </select>
  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
  </form>
  </h3>
  </center>
  </div>
  </div>';
}
?>
<!-- /.row -->
