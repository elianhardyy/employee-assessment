<?php
session_start();
include '../../../config/connection.php';
$type = $_GET["type"];
$monthsin = $_GET["month"]; // 10
$yearsin = $_GET["year"]; // 2024
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

<?php
$month = mysqli_query($con, "SELECT * FROM periode_bulan");
$year = mysqli_query($con, "SELECT * FROM periode_tahun");

$monthsingle = mysqli_query($con, "SELECT * FROM periode_bulan WHERE id_periode_bulan = '$monthsin'");
$fetchMonth = mysqli_fetch_assoc($monthsingle);
$yearsingle = mysqli_query($con, "SELECT * FROM periode_tahun WHERE nama_tahun='$yearsin'");
$fetchYear = mysqli_fetch_assoc($yearsingle);
if (isset($_GET['types']) && isset($_GET['month']) && isset($_GET['year'])) {
  $type = $_GET["types"];
  $monthsin = $_GET["month"]; // 10
  $yearsin = $_GET["year"]; // 2024
  $month = mysqli_query($con, "SELECT * FROM periode_bulan");
  $year = mysqli_query($con, "SELECT * FROM periode_tahun");

  $monthsingle = mysqli_query($con, "SELECT * FROM periode_bulan WHERE id_periode_bulan = '$monthsin'");
  $fetchMonth = mysqli_fetch_assoc($monthsingle);
  $yearsingle = mysqli_query($con, "SELECT * FROM periode_tahun WHERE nama_tahun='$yearsin'");
  $fetchYear = mysqli_fetch_assoc($yearsingle);
}

?>
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
<br>
<strong><i class="fa fa-circle-info"></i> Note: </strong>
<strong style="color:#E4080A;">Nilai akhir didapatkan dari 40% penilaian pemilik + 60% penilaian koordinator</strong>
<h3 style="font-weight: 700;">Penilaian Bagian <?= ucfirst($type) ?></h3>
<?php
if (isset($_GET['year']) && isset($_GET['month']) && isset($_GET['types'])) { ?>
  <h3 style="font-weight: 700;">Penilaian Bagian <?= ucfirst($_GET['types']) ?></h3>
<?php }
?>
<table id="example2" class="table table-bordered table-striped table-jq">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama karyawan</th>
      <th>Jenis Kelamin</th>
      <th>Periode</th>
      <th>Jabatan</th>
      <th>Penilaian Pemilik</th>
      <th>Penilaian Koordinator</th>
      <th>Nilai Akhir</th>
      <th>Predikat</th>
      <th>Cetak Nilai</th>
    </tr>
  </thead>
  <tbody>

    <?php

    $no = 1;

    $penilaianAkhir = "penilaian_akhir_koor_" . strtolower($type);
    $idKaryawanFk = "id_karyawan_fk_" . strtolower($type);
    $sqlgabungLeft = "SELECT * FROM penilaian_akhir_pemilik LEFT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $type%' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$monthsin' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$yearsin'";
    $sqlgabungRight = "SELECT * FROM penilaian_akhir_pemilik RIGHT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $type%' ";

    $sqlKoorLeft = "SELECT * FROM $penilaianAkhir INNER JOIN karyawan ON $penilaianAkhir.$idKaryawanFk=karyawan.id WHERE $penilaianAkhir.id_periode_bulan_fk='$monthsin' AND $penilaianAkhir.id_periode_tahun_fk='$yearsin'";
    $sqlKoorRight = "SELECT * FROM $penilaianAkhir RIGHT JOIN karyawan ON $penilaianAkhir.$idKaryawanFk=karyawan.id";

    $sqlOther = "SELECT * FROM penilaian_akhir_pemilik LEFT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id RIGHT JOIN $penilaianAkhir ON $penilaianAkhir.$idKaryawanFk=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $type%' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$monthsin' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$yearsin' AND $penilaianAkhir.id_periode_bulan_fk='$monthsin' AND $penilaianAkhir.id_periode_tahun_fk='$yearsin' ";
    $sqlOtherR = "SELECT * FROM penilaian_akhir_pemilik RIGHT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id LEFT JOIN $penilaianAkhir ON $penilaianAkhir.$idKaryawanFk=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $type%' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$monthsin' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$yearsin' AND $penilaianAkhir.id_periode_bulan_fk='$monthsin' AND $penilaianAkhir.id_periode_tahun_fk='$yearsin' ";
    $gabungKoor = $sqlgabungLeft . " UNION " . $sqlKoorRight;    //" UNION " .$sqlgabungRight;
    $cobdadulu = $sqlOther . " UNION " . $sqlOtherR;
    $query = mysqli_query($con, $cobdadulu);
    if (isset($_GET['year']) && isset($_GET['month']) && isset($_GET['types'])) {
      $typeku = $_GET['types']; // ini yang berubah
      $monthpick = $_GET['month'];
      $yearpick = $_GET['year'];
      $penilaianAkhir = "penilaian_akhir_koor_" . strtolower($typeku);
      $idKaryawanFk = "id_karyawan_fk_" . strtolower($typeku);
      $sqlgabungLeft = "SELECT * FROM penilaian_akhir_pemilik LEFT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $typeku%' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$monthpick' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$yearpick'";
      $sqlgabungRight = "SELECT * FROM penilaian_akhir_pemilik RIGHT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $typeku%' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$monthpick' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$yearpick' ";

      $sqlKoorLeft = "SELECT * FROM $penilaianAkhir INNER JOIN karyawan ON $penilaianAkhir.$idKaryawanFk=karyawan.id WHERE $penilaianAkhir.id_periode_bulan_fk='$monthpick' AND $penilaianAkhir.id_periode_tahun_fk='$yearpick'";
      $sqlKoorRight = "SELECT * FROM $penilaianAkhir RIGHT JOIN karyawan ON $penilaianAkhir.$idKaryawanFk=karyawan.id";

      $sqlOther = "SELECT * FROM penilaian_akhir_pemilik LEFT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id RIGHT JOIN $penilaianAkhir ON $penilaianAkhir.$idKaryawanFk=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $typeku%' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$monthpick' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$yearpick'";
      $sqlOtherR = "SELECT * FROM penilaian_akhir_pemilik RIGHT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id LEFT JOIN $penilaianAkhir ON $penilaianAkhir.$idKaryawanFk=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $typeku%' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$monthpick' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$yearpick' ";
      $gabungKoor = $sqlgabungLeft . " UNION " . $sqlKoorRight;    //" UNION " .$sqlgabungRight;

      $sqlOther = "SELECT * FROM penilaian_akhir_pemilik LEFT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id RIGHT JOIN $penilaianAkhir ON $penilaianAkhir.$idKaryawanFk=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $typeku%' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$monthpick' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$yearpick' AND $penilaianAkhir.id_periode_bulan_fk='$monthpick' AND $penilaianAkhir.id_periode_tahun_fk='$yearpick' ";
      $sqlOtherR = "SELECT * FROM penilaian_akhir_pemilik RIGHT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id LEFT JOIN $penilaianAkhir ON $penilaianAkhir.$idKaryawanFk=karyawan.id WHERE karyawan.jabatan LIKE '%Staf $typeku%' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$monthpick' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$yearpick' AND $penilaianAkhir.id_periode_bulan_fk='$monthpick' AND $penilaianAkhir.id_periode_tahun_fk='$yearpick'";

      $cobdadulu = $sqlOther . " UNION " . $sqlOtherR;
      $query = mysqli_query($con, $cobdadulu);
    }
    $nilaiTotal = 0;
    foreach ($query as $row):
    ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['jenis_kelamin'] ?></td>
        <td><?= $row['id_periode_bulan_fk'] ?> - <?= $row['nama_periode_tahun_fk'] ?></td>
        <td><?= $row['jabatan'] ?></td>
        <?php if (!$row['nilai_akhir_pemilik']) { ?>
          <td>0</td>
        <?php } else { ?>
          <td><?= number_format($row['nilai_akhir_pemilik'], 2, ",") ?></td>
        <?php } ?>
        <?php if (!$row['nilai_akhir']) { ?>
          <td>0</td>
        <?php } else { ?>
          <td><?= number_format($row['nilai_akhir'], 2, ",") ?></td>
        <?php } ?>
        <td><?= $nilaiTotal = number_format(($row['nilai_akhir_pemilik'] * 0.4) + ($row['nilai_akhir'] * 0.6), 2, ",") ?></td>
        <?php $nilaiAkhir = number_format(($row['nilai_akhir_pemilik'] * 0.4) + ($row['nilai_akhir'] * 0.6)) ?>
        <?php if ($nilaiAkhir < 20.0) { ?>
          <td>Tidak Memuaskan</td>
        <?php } else if ($nilaiAkhir < 40) { ?>
          <td>Kurang Memuaskan</td>
        <?php } else if ($nilaiAkhir <= 60) { ?>
          <td>Cukup Memuaskan</td>
        <?php } else if ($nilaiAkhir <= 80) { ?>
          <td>Memuaskan</td>
        <?php } else { ?>
          <td>Sangat Memuaskan</td>
        <?php } ?>

        <td><a href="index.php?p=print&karyawan=<?= $row['id'] ?>&month=<?= $monthsin ?>&year=<?= $yearsin ?>&bagian=<?= strtolower($type) ?>" class="btn btn-warning">Preview</a></td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>
<?php if (isset($_GET['types'])) { ?>
  <input type="hidden" name="" id="types-id" value="<?php echo strtolower($_GET['types']); ?>">
  <script>
    $("#month-option").change(function() {
      var type = $("#types-id").val();
      var year = $("#year-option").val();
      var month = $("#month-option").val();
      $("#bagian").val(type)
      //$("#typeb").val(type)
      $("#year-option").val(year);
      $("#month-option").val(month);
      window.location.href = `index.php?p=laporan&act=penilaian&types=${type}&year=${year}&month=${month}`;
      //$("#tampilin").load(`page/laporan/ajax/bagian.php?type=${type}&year=${year}&month=${month}`);
    });
    $("#year-option").change(function() {
      var type = $("#types-id").val();
      var year = $("#year-option").val();
      var month = $("#month-option").val();
      $("#bagian").val(type)
      //$("#typeb").val(type)
      $("#year-option").val(year);
      $("#month-option").val(month);
      window.location.href = `index.php?p=laporan&act=penilaian&types=${type}&year=${year}&month=${month}`;
      //$("#tampilin").load(`page/laporan/ajax/bagian.php?type=${type}&year=${year}&month=${month}`);
    });
  </script>
<?php } ?>
<input type="hidden" name="" id="typeb" value="<?php echo strtolower($_GET['type']); ?>">
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
  $("#month-option").change(function() {
    var type = $("#typeb").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();
    //$("#bagian").val(type)
    //$("#typeb").val(type)
    $("#year-option").val(year);
    $("#month-option").val(month);
    window.location.href = `index.php?p=laporan&act=penilaian&types=${type.toLowerCase()}&year=${year}&month=${month}`;
    //$("#tampilin").load(`page/laporan/ajax/bagian.php?type=${type}&year=${year}&month=${month}`);
  });
  $("#year-option").change(function() {
    var type = $("#typeb").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();

    //$("#typeb").val(type)
    $("#year-option").val(year);
    $("#month-option").val(month);
    window.location.href = `index.php?p=laporan&act=penilaian&types=${type.toLowerCase()}&year=${year}&month=${month}`;
    //$("#tampilin").load(`page/laporan/ajax/bagian.php?type=${type}&year=${year}&month=${month}`);
  });
  const idKaryawan = document.querySelectorAll(".karyawan");
  const monthOption = document.getElementById("month-option");
  const yearOption = document.getElementById("year-option");
  idKaryawan.forEach((v, i) => {
    idKaryawan[i].addEventListener("click", (event) => {
      $.ajax({
        type: "POST",
        url: `/php/ahp/page/cetak/laporan.php`,
        data: {
          karyawan: event.target.value,
          month: monthOption.value,
          year: yearOption.value
        },
        success: function(res) {

          //const url = window.URL.createObjectURL(res);
          // var a = document.createElement("a");
          // var url = window.URL.createObjectURL(res)
          // a.href = url
          // a.download = 'penilaian.pdf'
          // document.body.append(a);
          // a.click();
          // a.remove();
          // window.URL.revokeObjectURL(url)
          window.location.href = '/php/ahp/page/cetak/laporan.php'
          // const a = document.createElement("a")
          // a.href = url;
          // document.body.appendChild(a)
          // a.click();
          // a.remove();
          // window.URL.revokeObjectURL(url)
        },
        error: function() {
          alert("Gagal menghasilkan PDF");
        }
      })
    })
  })
  $(function() {
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
      "searching": true, //false
      "ordering": true,
      "info": true,
      "autoWidth": true
    })
  });
</script>