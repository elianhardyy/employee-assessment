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
<?php

$monthsin = date('n');
$yearsin = date('Y');
?>
<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Ranking Karyawan </h3>
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

        <?php endif; ?>
        <?php
        $month = mysqli_query($con, "SELECT * FROM periode_bulan");
        $year = mysqli_query($con, "SELECT * FROM periode_tahun");
        ?>
        <label for="">Bulan</label>
        <select name="" id="month-option" class="form-control">
          <?php
          $bulankosong = "";
          ?>
          <?php foreach ($month as $i => $m): ?>
            <?php
            if ($monthsin == $m['id_periode_bulan']) { ?>

              <option value="<?= $m['id_periode_bulan'] ?>" selected><?= strtoupper($m['nama_bulan']) ?></option>
              <?php if (isset($_GET['year']) || isset($_GET['month'])): ?>

                <?php
                $idm = $_GET['month'];


                $monthsingle = mysqli_query($con, "SELECT * FROM periode_bulan WHERE id_periode_bulan='$idm'");
                $monthsinglefetch = mysqli_fetch_assoc($monthsingle)
                ?>
                <option value="<?= $monthsinglefetch['id_periode_bulan'] ?>" selected><?= strtoupper($monthsinglefetch['nama_bulan']) ?></option>

              <?php continue;
              endif; ?>
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
              <?php if (isset($_GET['year']) || isset($_GET['month'])): ?>
                <?php
                $idm = $_GET['year'];


                $monthsingle = mysqli_query($con, "SELECT * FROM periode_tahun WHERE nama_tahun='$idm'");
                $monthsinglefetch = mysqli_fetch_assoc($monthsingle)
                ?>
                <option value="<?= $monthsinglefetch['nama_tahun'] ?>" selected><?= strtoupper($monthsinglefetch['nama_tahun']) ?></option>

              <?php continue;
              endif; ?>
            <?php continue;
            } ?>
            <option value="<?= $y['nama_tahun'] ?>"><?= $y['nama_tahun'] ?></option>
          <?php endforeach; ?>
        </select>
        <script>
          var mitem = document.getElementById("month-filter");
          var months = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
          ]
          for (var m = 0; m < months.length; m++) {
            let optmth = document.createElement("option");
            optmth.innerText = months[m];
            optmth.value = m + 1;
            mitem.appendChild(optmth)
          }
        </script>
        <!--<select name="" id="year-filter" class="form-control">

            </select>-->
        <script>
          var yitem = document.getElementById("year-filter");
          var years = [
            "2024", "2023", "2022", "2021", "2020", "2019", "2018",
            "2017", "2016", "2015", "2014", "2013", "2012", "2011",
            "2010"
          ];
          for (var y = 0; y < years.length; y++) {
            let optyr = document.createElement("option");
            optyr.innerText = years[y];
            optyr.value = years[y];
            yitem.appendChild(optyr)
          }
        </script>
        <br>
        <?php
        if ($_SESSION['logged'] == 1) {
          //$karyawanku = mysqli_query($con,"SELECT * FROM penilaian_akhir_pemilik JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik = karyawan.id JOIN penilaian_akhir_koor_produksi ON karyawan.id = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi JOIN penilaian_akhir_koor_gudang ON karyawan.id = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang LEFT JOIN penilaian_akhir_koor_penjualan ON karyawan.id = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan WHERE penilaian_akhir_pemilik.id_periode_bulan_fk='$monthsin' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$yearsin' ORDER BY nilai_akhir_pemilik DESC");
          $karyawanku = mysqli_query($con, "SELECT 
    COALESCE(karyawan.id, 
             penilaian_akhir_pemilik.id_karyawan_fk_pemilik, 
             penilaian_akhir_koor_produksi.id_karyawan_fk_produksi, 
             penilaian_akhir_koor_gudang.id_karyawan_fk_gudang,
			 penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
) AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) AS nilai_pemilik,
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) AS nilai_produksi,
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) AS nilai_gudang,
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS nilai_penjualan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) +
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS seluruh_nilai_total,
    penilaian_akhir_pemilik.id_periode_bulan_fk AS bulan_pemilik,
    penilaian_akhir_pemilik.nama_periode_tahun_fk AS tahun_pemilik,
    penilaian_akhir_koor_produksi.id_periode_bulan_fk AS bulan_produksi,
    penilaian_akhir_koor_produksi.id_periode_tahun_fk AS tahun_produksi,
    penilaian_akhir_koor_gudang.id_periode_bulan_fk AS bulan_gudang,
    penilaian_akhir_koor_gudang.id_periode_tahun_fk AS tahun_gudang,
    penilaian_akhir_koor_penjualan.id_periode_bulan_fk AS bulan_penjualan,
    penilaian_akhir_koor_penjualan.id_periode_tahun_fk AS tahun_penjualan
FROM karyawan
LEFT JOIN penilaian_akhir_pemilik 
    ON karyawan.id = penilaian_akhir_pemilik.id_karyawan_fk_pemilik
LEFT JOIN penilaian_akhir_koor_produksi 
    ON karyawan.id = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi
LEFT JOIN penilaian_akhir_koor_gudang 
    ON karyawan.id = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang
LEFT JOIN penilaian_akhir_koor_penjualan
	ON karyawan.id = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
WHERE penilaian_akhir_pemilik.id_periode_bulan_fk = '$monthsin' AND penilaian_akhir_pemilik.nama_periode_tahun_fk = '$yearsin'
   OR penilaian_akhir_koor_produksi.id_periode_bulan_fk = '$monthsin' AND penilaian_akhir_koor_produksi.id_periode_tahun_fk = '$yearsin'
   OR penilaian_akhir_koor_gudang.id_periode_bulan_fk = '$monthsin' AND penilaian_akhir_koor_gudang.id_periode_tahun_fk = '$yearsin'
   OR penilaian_akhir_koor_penjualan.id_periode_bulan_fk = '$monthsin' AND penilaian_akhir_koor_penjualan.id_periode_tahun_fk = '$yearsin'

UNION

SELECT 
    COALESCE(karyawan.id, 
             penilaian_akhir_pemilik.id_karyawan_fk_pemilik, 
             penilaian_akhir_koor_produksi.id_karyawan_fk_produksi, 
             penilaian_akhir_koor_gudang.id_karyawan_fk_gudang,
			 penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
) AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) AS nilai_pemilik,
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) AS nilai_produksi,
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) AS nilai_gudang,
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS nilai_penjualan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) +
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS seluruh_nilai_total,
    penilaian_akhir_pemilik.id_periode_bulan_fk AS bulan_pemilik,
    penilaian_akhir_pemilik.nama_periode_tahun_fk AS tahun_pemilik,
    penilaian_akhir_koor_produksi.id_periode_bulan_fk AS bulan_produksi,
    penilaian_akhir_koor_produksi.id_periode_tahun_fk AS tahun_produksi,
    penilaian_akhir_koor_gudang.id_periode_bulan_fk AS bulan_gudang,
    penilaian_akhir_koor_gudang.id_periode_tahun_fk AS tahun_gudang,
    penilaian_akhir_koor_penjualan.id_periode_bulan_fk AS bulan_penjualan,
    penilaian_akhir_koor_penjualan.id_periode_tahun_fk AS tahun_penjualan
FROM penilaian_akhir_pemilik
LEFT JOIN karyawan 
    ON karyawan.id = penilaian_akhir_pemilik.id_karyawan_fk_pemilik
LEFT JOIN penilaian_akhir_koor_produksi 
    ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi
LEFT JOIN penilaian_akhir_koor_gudang 
    ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang
LEFT JOIN penilaian_akhir_koor_penjualan 
    ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
WHERE penilaian_akhir_pemilik.id_periode_bulan_fk = '$monthsin' AND penilaian_akhir_pemilik.nama_periode_tahun_fk = '$yearsin'

UNION

SELECT 
    COALESCE(karyawan.id, 
             penilaian_akhir_pemilik.id_karyawan_fk_pemilik, 
             penilaian_akhir_koor_produksi.id_karyawan_fk_produksi, 
             penilaian_akhir_koor_gudang.id_karyawan_fk_gudang,
             penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
            ) AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) AS nilai_pemilik,
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) AS nilai_produksi,
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) AS nilai_gudang,
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS nilai_penjualan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) +
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS seluruh_nilai_total,
    penilaian_akhir_pemilik.id_periode_bulan_fk AS bulan_pemilik,
    penilaian_akhir_pemilik.nama_periode_tahun_fk AS tahun_pemilik,
    penilaian_akhir_koor_produksi.id_periode_bulan_fk AS bulan_produksi,
    penilaian_akhir_koor_produksi.id_periode_tahun_fk AS tahun_produksi,
    penilaian_akhir_koor_gudang.id_periode_bulan_fk AS bulan_gudang,
    penilaian_akhir_koor_gudang.id_periode_tahun_fk AS tahun_gudang,
    penilaian_akhir_koor_penjualan.id_periode_bulan_fk AS bulan_penjualan,
    penilaian_akhir_koor_penjualan.id_periode_tahun_fk AS tahun_penjualan
FROM penilaian_akhir_koor_produksi
LEFT JOIN karyawan 
    ON karyawan.id = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi
LEFT JOIN penilaian_akhir_pemilik 
    ON penilaian_akhir_koor_produksi.id_karyawan_fk_produksi = penilaian_akhir_pemilik.id_karyawan_fk_pemilik
LEFT JOIN penilaian_akhir_koor_gudang 
    ON penilaian_akhir_koor_produksi.id_karyawan_fk_produksi = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang
LEFT JOIN penilaian_akhir_koor_penjualan 
    ON penilaian_akhir_koor_produksi.id_karyawan_fk_produksi = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
WHERE penilaian_akhir_koor_produksi.id_periode_bulan_fk = '$monthsin' AND penilaian_akhir_koor_produksi.id_periode_tahun_fk = '$yearsin'

UNION

SELECT 
    COALESCE(karyawan.id, 
             penilaian_akhir_pemilik.id_karyawan_fk_pemilik, 
             penilaian_akhir_koor_produksi.id_karyawan_fk_produksi, 
             penilaian_akhir_koor_gudang.id_karyawan_fk_gudang,
             penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
            ) AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) AS nilai_pemilik,
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) AS nilai_produksi,
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) AS nilai_gudang,
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS nilai_penjualan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) +
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS seluruh_nilai_total,
    penilaian_akhir_pemilik.id_periode_bulan_fk AS bulan_pemilik,
    penilaian_akhir_pemilik.nama_periode_tahun_fk AS tahun_pemilik,
    penilaian_akhir_koor_produksi.id_periode_bulan_fk AS bulan_produksi,
    penilaian_akhir_koor_produksi.id_periode_tahun_fk AS tahun_produksi,
    penilaian_akhir_koor_gudang.id_periode_bulan_fk AS bulan_gudang,
    penilaian_akhir_koor_gudang.id_periode_tahun_fk AS tahun_gudang,
    penilaian_akhir_koor_penjualan.id_periode_bulan_fk AS bulan_penjualan,
    penilaian_akhir_koor_penjualan.id_periode_tahun_fk AS tahun_penjualan
FROM penilaian_akhir_koor_gudang
LEFT JOIN karyawan 
    ON karyawan.id = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang
LEFT JOIN penilaian_akhir_pemilik 
    ON penilaian_akhir_koor_gudang.id_karyawan_fk_gudang = penilaian_akhir_pemilik.id_karyawan_fk_pemilik
LEFT JOIN penilaian_akhir_koor_produksi 
    ON penilaian_akhir_koor_gudang.id_karyawan_fk_gudang = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi
LEFT JOIN penilaian_akhir_koor_penjualan 
    ON penilaian_akhir_koor_gudang.id_karyawan_fk_gudang = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
WHERE penilaian_akhir_koor_gudang.id_periode_bulan_fk = '$monthsin' AND penilaian_akhir_koor_gudang.id_periode_tahun_fk = '$yearsin'

UNION

SELECT 
    COALESCE(karyawan.id, 
             penilaian_akhir_pemilik.id_karyawan_fk_pemilik, 
             penilaian_akhir_koor_produksi.id_karyawan_fk_produksi, 
             penilaian_akhir_koor_gudang.id_karyawan_fk_gudang,
             penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
            ) AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) AS nilai_pemilik,
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) AS nilai_produksi,
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) AS nilai_gudang,
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS nilai_penjualan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) +
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS seluruh_nilai_total,
    penilaian_akhir_pemilik.id_periode_bulan_fk AS bulan_pemilik,
    penilaian_akhir_pemilik.nama_periode_tahun_fk AS tahun_pemilik,
    penilaian_akhir_koor_produksi.id_periode_bulan_fk AS bulan_produksi,
    penilaian_akhir_koor_produksi.id_periode_tahun_fk AS tahun_produksi,
    penilaian_akhir_koor_gudang.id_periode_bulan_fk AS bulan_gudang,
    penilaian_akhir_koor_gudang.id_periode_tahun_fk AS tahun_gudang,
    penilaian_akhir_koor_penjualan.id_periode_bulan_fk AS bulan_penjualan,
    penilaian_akhir_koor_penjualan.id_periode_tahun_fk AS tahun_penjualan
FROM penilaian_akhir_koor_penjualan
LEFT JOIN karyawan 
    ON karyawan.id = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
LEFT JOIN penilaian_akhir_pemilik 
    ON penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan = penilaian_akhir_pemilik.id_karyawan_fk_pemilik
LEFT JOIN penilaian_akhir_koor_produksi 
    ON penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi
LEFT JOIN penilaian_akhir_koor_gudang 
    ON penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang
WHERE penilaian_akhir_koor_penjualan.id_periode_bulan_fk = '$monthsin' AND penilaian_akhir_koor_penjualan.id_periode_tahun_fk = '$yearsin'
ORDER BY seluruh_nilai_total DESC;");
          if (isset($_GET['year']) || isset($_GET['month'])) {
            $yearpick = $_GET['year'];
            $monthpick = $_GET['month'];
            $karyawanku = mysqli_query($con, "SELECT 
    COALESCE(karyawan.id, 
             penilaian_akhir_pemilik.id_karyawan_fk_pemilik, 
             penilaian_akhir_koor_produksi.id_karyawan_fk_produksi, 
             penilaian_akhir_koor_gudang.id_karyawan_fk_gudang,
			 penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
) AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) AS nilai_pemilik,
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) AS nilai_produksi,
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) AS nilai_gudang,
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS nilai_penjualan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) +
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS seluruh_nilai_total,
    penilaian_akhir_pemilik.id_periode_bulan_fk AS bulan_pemilik,
    penilaian_akhir_pemilik.nama_periode_tahun_fk AS tahun_pemilik,
    penilaian_akhir_koor_produksi.id_periode_bulan_fk AS bulan_produksi,
    penilaian_akhir_koor_produksi.id_periode_tahun_fk AS tahun_produksi,
    penilaian_akhir_koor_gudang.id_periode_bulan_fk AS bulan_gudang,
    penilaian_akhir_koor_gudang.id_periode_tahun_fk AS tahun_gudang,
    penilaian_akhir_koor_penjualan.id_periode_bulan_fk AS bulan_penjualan,
    penilaian_akhir_koor_penjualan.id_periode_tahun_fk AS tahun_penjualan
FROM karyawan
LEFT JOIN penilaian_akhir_pemilik 
    ON karyawan.id = penilaian_akhir_pemilik.id_karyawan_fk_pemilik
LEFT JOIN penilaian_akhir_koor_produksi 
    ON karyawan.id = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi
LEFT JOIN penilaian_akhir_koor_gudang 
    ON karyawan.id = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang
LEFT JOIN penilaian_akhir_koor_penjualan
	ON karyawan.id = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
WHERE penilaian_akhir_pemilik.id_periode_bulan_fk = '$monthpick' AND penilaian_akhir_pemilik.nama_periode_tahun_fk = '$yearpick'
   OR penilaian_akhir_koor_produksi.id_periode_bulan_fk = '$monthpick' AND penilaian_akhir_koor_produksi.id_periode_tahun_fk = '$yearpick'
   OR penilaian_akhir_koor_gudang.id_periode_bulan_fk = '$monthpick' AND penilaian_akhir_koor_gudang.id_periode_tahun_fk = '$yearpick'
   OR penilaian_akhir_koor_penjualan.id_periode_bulan_fk = '$monthpick' AND penilaian_akhir_koor_penjualan.id_periode_tahun_fk = '$yearpick'

UNION

SELECT 
    COALESCE(karyawan.id, 
             penilaian_akhir_pemilik.id_karyawan_fk_pemilik, 
             penilaian_akhir_koor_produksi.id_karyawan_fk_produksi, 
             penilaian_akhir_koor_gudang.id_karyawan_fk_gudang,
			 penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
) AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) AS nilai_pemilik,
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) AS nilai_produksi,
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) AS nilai_gudang,
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS nilai_penjualan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) +
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS seluruh_nilai_total,
    penilaian_akhir_pemilik.id_periode_bulan_fk AS bulan_pemilik,
    penilaian_akhir_pemilik.nama_periode_tahun_fk AS tahun_pemilik,
    penilaian_akhir_koor_produksi.id_periode_bulan_fk AS bulan_produksi,
    penilaian_akhir_koor_produksi.id_periode_tahun_fk AS tahun_produksi,
    penilaian_akhir_koor_gudang.id_periode_bulan_fk AS bulan_gudang,
    penilaian_akhir_koor_gudang.id_periode_tahun_fk AS tahun_gudang,
    penilaian_akhir_koor_penjualan.id_periode_bulan_fk AS bulan_penjualan,
    penilaian_akhir_koor_penjualan.id_periode_tahun_fk AS tahun_penjualan
FROM penilaian_akhir_pemilik
LEFT JOIN karyawan 
    ON karyawan.id = penilaian_akhir_pemilik.id_karyawan_fk_pemilik
LEFT JOIN penilaian_akhir_koor_produksi 
    ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi
LEFT JOIN penilaian_akhir_koor_gudang 
    ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang
LEFT JOIN penilaian_akhir_koor_penjualan 
    ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
WHERE penilaian_akhir_pemilik.id_periode_bulan_fk = '$monthpick' AND penilaian_akhir_pemilik.nama_periode_tahun_fk = '$yearpick'

UNION

SELECT 
    COALESCE(karyawan.id, 
             penilaian_akhir_pemilik.id_karyawan_fk_pemilik, 
             penilaian_akhir_koor_produksi.id_karyawan_fk_produksi, 
             penilaian_akhir_koor_gudang.id_karyawan_fk_gudang,
             penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
            ) AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) AS nilai_pemilik,
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) AS nilai_produksi,
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) AS nilai_gudang,
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS nilai_penjualan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) +
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS seluruh_nilai_total,
    penilaian_akhir_pemilik.id_periode_bulan_fk AS bulan_pemilik,
    penilaian_akhir_pemilik.nama_periode_tahun_fk AS tahun_pemilik,
    penilaian_akhir_koor_produksi.id_periode_bulan_fk AS bulan_produksi,
    penilaian_akhir_koor_produksi.id_periode_tahun_fk AS tahun_produksi,
    penilaian_akhir_koor_gudang.id_periode_bulan_fk AS bulan_gudang,
    penilaian_akhir_koor_gudang.id_periode_tahun_fk AS tahun_gudang,
    penilaian_akhir_koor_penjualan.id_periode_bulan_fk AS bulan_penjualan,
    penilaian_akhir_koor_penjualan.id_periode_tahun_fk AS tahun_penjualan
FROM penilaian_akhir_koor_produksi
LEFT JOIN karyawan 
    ON karyawan.id = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi
LEFT JOIN penilaian_akhir_pemilik 
    ON penilaian_akhir_koor_produksi.id_karyawan_fk_produksi = penilaian_akhir_pemilik.id_karyawan_fk_pemilik
LEFT JOIN penilaian_akhir_koor_gudang 
    ON penilaian_akhir_koor_produksi.id_karyawan_fk_produksi = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang
LEFT JOIN penilaian_akhir_koor_penjualan 
    ON penilaian_akhir_koor_produksi.id_karyawan_fk_produksi = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
WHERE penilaian_akhir_koor_produksi.id_periode_bulan_fk = '$monthpick' AND penilaian_akhir_koor_produksi.id_periode_tahun_fk = '$yearpick'

UNION

SELECT 
    COALESCE(karyawan.id, 
             penilaian_akhir_pemilik.id_karyawan_fk_pemilik, 
             penilaian_akhir_koor_produksi.id_karyawan_fk_produksi, 
             penilaian_akhir_koor_gudang.id_karyawan_fk_gudang,
             penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
            ) AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) AS nilai_pemilik,
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) AS nilai_produksi,
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) AS nilai_gudang,
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS nilai_penjualan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) +
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS seluruh_nilai_total,
    penilaian_akhir_pemilik.id_periode_bulan_fk AS bulan_pemilik,
    penilaian_akhir_pemilik.nama_periode_tahun_fk AS tahun_pemilik,
    penilaian_akhir_koor_produksi.id_periode_bulan_fk AS bulan_produksi,
    penilaian_akhir_koor_produksi.id_periode_tahun_fk AS tahun_produksi,
    penilaian_akhir_koor_gudang.id_periode_bulan_fk AS bulan_gudang,
    penilaian_akhir_koor_gudang.id_periode_tahun_fk AS tahun_gudang,
    penilaian_akhir_koor_penjualan.id_periode_bulan_fk AS bulan_penjualan,
    penilaian_akhir_koor_penjualan.id_periode_tahun_fk AS tahun_penjualan
FROM penilaian_akhir_koor_gudang
LEFT JOIN karyawan 
    ON karyawan.id = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang
LEFT JOIN penilaian_akhir_pemilik 
    ON penilaian_akhir_koor_gudang.id_karyawan_fk_gudang = penilaian_akhir_pemilik.id_karyawan_fk_pemilik
LEFT JOIN penilaian_akhir_koor_produksi 
    ON penilaian_akhir_koor_gudang.id_karyawan_fk_gudang = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi
LEFT JOIN penilaian_akhir_koor_penjualan 
    ON penilaian_akhir_koor_gudang.id_karyawan_fk_gudang = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
WHERE penilaian_akhir_koor_gudang.id_periode_bulan_fk = '$monthpick' AND penilaian_akhir_koor_gudang.id_periode_tahun_fk = '$yearpick'

UNION

SELECT 
    COALESCE(karyawan.id, 
             penilaian_akhir_pemilik.id_karyawan_fk_pemilik, 
             penilaian_akhir_koor_produksi.id_karyawan_fk_produksi, 
             penilaian_akhir_koor_gudang.id_karyawan_fk_gudang,
             penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
            ) AS id_karyawan,
    karyawan.nama AS nama_karyawan,
    karyawan.jenis_kelamin AS jk,
    karyawan.jabatan AS jabatan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) AS nilai_pemilik,
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) AS nilai_produksi,
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) AS nilai_gudang,
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS nilai_penjualan,
    COALESCE(penilaian_akhir_pemilik.nilai_akhir_pemilik, 0) +
    COALESCE(penilaian_akhir_koor_produksi.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_gudang.nilai_akhir, 0) +
    COALESCE(penilaian_akhir_koor_penjualan.nilai_akhir, 0) AS seluruh_nilai_total,
    penilaian_akhir_pemilik.id_periode_bulan_fk AS bulan_pemilik,
    penilaian_akhir_pemilik.nama_periode_tahun_fk AS tahun_pemilik,
    penilaian_akhir_koor_produksi.id_periode_bulan_fk AS bulan_produksi,
    penilaian_akhir_koor_produksi.id_periode_tahun_fk AS tahun_produksi,
    penilaian_akhir_koor_gudang.id_periode_bulan_fk AS bulan_gudang,
    penilaian_akhir_koor_gudang.id_periode_tahun_fk AS tahun_gudang,
    penilaian_akhir_koor_penjualan.id_periode_bulan_fk AS bulan_penjualan,
    penilaian_akhir_koor_penjualan.id_periode_tahun_fk AS tahun_penjualan
FROM penilaian_akhir_koor_penjualan
LEFT JOIN karyawan 
    ON karyawan.id = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan
LEFT JOIN penilaian_akhir_pemilik 
    ON penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan = penilaian_akhir_pemilik.id_karyawan_fk_pemilik
LEFT JOIN penilaian_akhir_koor_produksi 
    ON penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi
LEFT JOIN penilaian_akhir_koor_gudang 
    ON penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang
WHERE penilaian_akhir_koor_penjualan.id_periode_bulan_fk = '$monthpick' AND penilaian_akhir_koor_penjualan.id_periode_tahun_fk = '$yearpick'
ORDER BY seluruh_nilai_total DESC;");
          }
        }
        if ($_SESSION['logged'] == 2) {
          $sqlku = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Produksi%'";
          $karyawanku = mysqli_query($con, $sqlku);
          //var_dump($karyawanku);
        }
        if ($_SESSION['logged'] == 3) {
          $sqlku = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Gudang%'";
          $karyawanku = mysqli_query($con, $sqlku);
        }
        if ($_SESSION['logged'] == 4) {
          $sql = "SELECT * FROM karyawan WHERE jabatan LIKE '%Staf Penjualan%'";
          $karyawanku = mysqli_query($con, $sqlku);
        }
        ?>
        <strong><i class="fa fa-circle-info"></i> Note: </strong>
        <strong style="color:#E4080A;">Nilai akhir didapatkan dari 40% penilaian pemilik + 60% penilaian koordinator</strong>
        <div id="tampilin">
          <table id="example1" class="table table-bordered table-striped table-jq">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Periode Pemilik</th>
                <th>Periode Koordinator</th>
                <th>Nilai Akhir</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($karyawanku as $row): ?>
                <?php if (($row['bulan_pemilik'] == $row['bulan_produksi'] || $row['bulan_pemilik'] == $row['bulan_penjualan'] || $row['bulan_pemilik'] == $row['bulan_gudang']) && ($row['tahun_pemilik'] == $row['tahun_produksi'] || $row['tahun_pemilik'] == $row['tahun_penjualan'] || $row['tahun_pemilik'] == $row['tahun_gudang'])): ?>
                  <tr>

                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_karyawan'] ?></td>
                    <td><?= $row['jk'] ?></td>
                    <td><?= $row['jabatan'] ?></td>
                    <td><?= $row['bulan_pemilik'] ?> - <?= $row['tahun_pemilik'] ?></td>
                    <?php if ($row['jabatan'] == 'Staf Produksi') { ?>
                      <td><?= $row['bulan_produksi'] ?> - <?= $row['tahun_produksi'] ?></td>
                    <?php } else if ($row['jabatan'] == 'Staf Gudang') { ?>
                      <td><?= $row['bulan_gudang'] ?> - <?= $row['tahun_gudang'] ?></td>
                    <?php } else if ($row['jabatan'] == 'Staf Penjualan') { ?>
                      <td><?= $row['bulan_penjualan'] ?> - <?= $row['tahun_penjualan'] ?></td>
                    <?php } ?>
                    <?php if ($row['jabatan'] == 'Staf Produksi') {
                      $nilaiTotal = ($row['nilai_pemilik'] * 0.4) + ($row['nilai_produksi'] * 0.6);
                    } else if ($row['jabatan'] == 'Staf Gudang') {
                      $nilaiTotal = ($row['nilai_pemilik'] * 0.4) + ($row['nilai_gudang'] * 0.6);
                    } else if ($row['jabatan'] == 'Staf Penjualan') {
                      $nilaiTotal = ($row['nilai_pemilik'] * 0.4) + ($row['nilai_penjualan'] * 0.6);
                    }
                    ?>
                    <td><?php echo number_format($nilaiTotal, 2, ","); ?></td>

                  </tr>
                <?php endif; ?>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <form id="form-print" action="/php/ahp/page/cetak/terbaikrank.php" method="post" target="_blank" onsubmit="return confirmSubmit(event)">
          <input type="hidden" name="month" value="<?= $monthsin ?>">
          <input type="hidden" name="year" value="<?= $yearsin ?>">
          <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Cetak</button>
        </form>
        <?php if (isset($_GET['year']) || isset($_GET['month'])): ?>
          <form id="form-prints" action="/php/ahp/page/cetak/terbaiktest.php" method="post" target="_blank" onsubmit="return confirmSubmits(event)">
            <input type="hidden" name="month" value="<?php echo $_GET['month'] ?>">
            <input type="hidden" name="year" value="<?php echo $_GET['year'] ?>">
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Cetak</button>
          </form>
        <?php endif; ?>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<?php if (isset($_GET['month']) || isset($_GET['year'])): ?>
  <input type="hidden" name="" id="years-id" value="<?php echo $_GET['year']; ?>">
  <input type="hidden" name="" id="months-id" value="<?php echo $_GET['month']; ?>">
  <script>
    $("#month-option").change(function() {
      var year = $("#year-option").val();
      var month = $("#month-option").val();
      //var bagian = $("#bagian").val();
      // var month = $("#months-id").val();
      // var year = $("#years-id").val();
      //$("#month-filter").val()
      window.location.href = `index.php?p=laporan&act=terbaik&year=${year}&month=${month}`;
      //$("#tampilin").load(`page/laporan/ajax/bagian.php?type=${bagian}&year=${year}&month=${month}`);
    })
    $("#year-option").change(function() {
      //var bagian = $("#bagian").val();
      var year = $("#year-option").val();
      var month = $("#month-option").val();
      // var month = $("#months-id").val();
      // var year = $("#years-id").val();
      //$("#month-filter").val()
      window.location.href = `index.php?p=laporan&act=terbaik&year=${year}&month=${month}`;
      //$("#tampilin").load(`page/laporan/ajax/bagian.php?type=${bagian}&year=${year}&month=${month}`);
    })
    const formSubmit = document.getElementById("form-print");
    formSubmit.setAttribute("hidden", "hidden")

    function confirmSubmits(e) {
      e.preventDefault();
      swal({
        title: "Apakah Anda yakin ingin mencetak",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then((yes) => {
        if (yes) {
          swal({
            title: "Cetak dalam prosess",
            icon: "success"
          }).then((ok) => {
            document.getElementById("form-prints").submit()
          })
        } else {
          swal({
            title: "Cetak dibatalkan",
            icon: "success"
          })
        }
      })
    }
  </script>
<?php endif; ?>
<script>
  $("#month-option").change(function() {
    //var type = $("#typeb").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();
    //$("#bagian").val(type)
    //$("#typeb").val(type)
    $("#year-option").val(year);
    $("#month-option").val(month);
    window.location.href = `index.php?p=laporan&act=terbaik&year=${year}&month=${month}`;
    //$("#tampilin").load(`page/laporan/ajax/bagian.php?type=${type}&year=${year}&month=${month}`);
  });
  $("#year-option").change(function() {
    //var type = $("#typeb").val();
    var year = $("#year-option").val();
    var month = $("#month-option").val();

    //$("#typeb").val(type)
    $("#year-option").val(year);
    $("#month-option").val(month);
    window.location.href = `index.php?p=laporan&act=terbaik&year=${year}&month=${month}`;
    //$("#tampilin").load(`page/laporan/ajax/bagian.php?type=${type}&year=${year}&month=${month}`);
  });

  function confirmSubmit(e) {
    e.preventDefault();
    swal({
      title: "Apakah Anda yakin ingin mencetak",
      icon: "warning",
      buttons: true,
      dangerMode: true
    }).then((yes) => {
      if (yes) {
        swal({
          title: "Cetak dalam prosess",
          icon: "success"
        }).then((ok) => {
          document.getElementById("form-print").submit()
        })
      } else {
        swal({
          title: "Cetak dibatalkan",
          icon: "success"
        })
      }
    })
  }
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
  $("#bagian").change(function() {
    var bagian = $("#bagian").val();
    var month = $("#month-filter").val();
    var year = $("#year-filter").val();
    $("#bagian").val(bagian)
    //$("#month-filter").val()
    $("#tampilin").load(`page/laporan/ajax/terbaik.php?type=${bagian}`);
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