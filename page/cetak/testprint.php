<?php
$year = $_GET['year'];
$month = $_GET['month'];
$idkaryawan = $_GET['karyawan'];
$bagian = strtolower($_GET['bagian']);
$subkriteriajenis = 'tb_sub_kriteria_' . $bagian;
$kriteriajenis = 'tb_kriteria_' . $bagian;
$idsubkriteriajenis = 'id_sub_kriteria_' . $bagian;
$idkriteriajenis = 'id_kriteria_' . $bagian;
$idkriteriajenisfk = 'id_kriteria_' . $bagian . '_fk';
$namasubkriteriajenis = 'nama_sub_kriteria_' . $bagian;
$namakriteriajenis = 'nama_kriteria_' . $bagian;
$penilaiankoorjenis = 'penilaian_koor_' . $bagian;
$idkaryawanfkpenilaian = 'id_karyawan_fk_' . $bagian;
$nilaimatrixjenis = 'nilai_akhir_' . $bagian;
$idbulanfkjenis = 'id_bulan_fk_' . $bagian;
$idtahunfkjenis = 'id_tahun_fk_' . $bagian;
$penilaianakhirjenis = 'penilaian_akhir_koor_' . $bagian;
$komentarjenis = 'komentar_' . $bagian;

$penilaian = "SELECT * FROM penilaian_akhir_pemilik JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id JOIN $penilaianakhirjenis ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik = $penilaianakhirjenis.$idkaryawanfkpenilaian WHERE penilaian_akhir_pemilik.id_karyawan_fk_pemilik='$idkaryawan' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$month' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$year' AND $penilaianakhirjenis.$idkaryawanfkpenilaian='$idkaryawan' AND $penilaianakhirjenis.id_periode_bulan_fk='$month' AND $penilaianakhirjenis.id_periode_tahun_fk='$year' LIMIT 1";
$kar = mysqli_query($con, $penilaian);
$karyawan = mysqli_fetch_assoc($kar);
$staf = 'Staf ' . ucfirst($bagian);
$subkriteriat = mysqli_query($con, "SELECT * FROM penilaian_pemilik JOIN $subkriteriajenis ON penilaian_pemilik.id_sub_kriteria_fk = $subkriteriajenis.$idsubkriteriajenis JOIN $kriteriajenis ON $subkriteriajenis.$idkriteriajenisfk = $kriteriajenis.$idkriteriajenis JOIN $penilaiankoorjenis ON $penilaiankoorjenis.id_sub_kriteria_fk=$subkriteriajenis.$idsubkriteriajenis WHERE penilaian_pemilik.bagian = '$bagian' AND penilaian_pemilik.id_karyawan_fk='$idkaryawan' AND penilaian_pemilik.id_bulan_fk_pemilik = '$month' AND penilaian_pemilik.id_tahun_fk_pemilik = '$year' AND $penilaiankoorjenis.$idbulanfkjenis='$month' AND $penilaiankoorjenis.$idtahunfkjenis='$year' AND $penilaiankoorjenis.id_karyawan_fk='$idkaryawan'");
function angkaKeBulan($angka)
{
  $bulan = [
    1 => "Januari",
    2 => "Februari",
    3 => "Maret",
    4 => "April",
    5 => "Mei",
    6 => "Juni",
    7 => "Juli",
    8 => "Agustus",
    9 => "September",
    10 => "Oktober",
    11 => "November",
    12 => "Desember"
  ];

  return $bulan[$angka] ?? "Bulan tidak valid";
}
//echo mysqli_num_rows($subkriteriat);
$nilaiTotal = ($karyawan['nilai_akhir_pemilik'] * 0.4) + ($karyawan['nilai_akhir'] * 0.6);
if ($nilaiTotal < 20.0) {
  $predikat = "Tidak Memuaskan";
} else if ($nilaiTotal < 40) {
  $predikat = "Kurang Memuaskan";
} else if ($nilaiTotal <= 60) {
  $predikat = "Cukup Memuaskan";
} else if ($nilaiTotal <= 80) {
  $predikat = "Memuaskan";
} else {
  $predikat = "Sangat Memuaskan";
}
$html = '
<body>
  <h2>Laporan Penilaian Karyawan</h2>
  
  <!-- Informasi Karyawan -->
  <div class="employee-info">
    <p><strong>Nama Karyawan : </strong>' . $karyawan['nama'] . '</p>
    <p><strong>Bagian : </strong> Staf Produksi</p>
    <p><strong>Periode Penilaian : </strong>' . angkaKeBulan($month) . ' ' . $year . '</p>
    <p><strong>Predikat : </strong>' . $predikat . '</p>
    <strong><i class="fa fa-circle-info"></i> Note: </strong>
    <strong style="color:#E4080A;">Nilai akhir didapatkan dari 40% penilaian pemilik + 60% penilaian koordinator</strong>
  </div>

  <!-- Tabel Penilaian -->';

$html .= '
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Kriteria</th>
        <th>Subkriteria</th>
        <th>Penilai 1</th>
        <th>Penilai 2</th>
      </tr>
    </thead>
    <tbody>';
$namakriteria = "";
foreach ($subkriteriat as $sk) {
  if ($sk[$namakriteriajenis] != $namakriteria) {
    $name = $sk[$namakriteriajenis];
    $namakriteria = $name;
  } else {
    $name = "";
  }
  $html .= '
      <tr>
        <td>' . $name . '</td>
        <td>' . $sk[$namasubkriteriajenis] . '</td>';
  if (!$sk['nilai_akhir_pemilik']) {

    $html .= '<td>0</td>';
  } else {
    $html .= '<td>' . $sk['nilai_akhir_pemilik'] . '</td>';
  }
  if (!$sk[$nilaimatrixjenis]) {
    $html .= '<td>0</td>';
  } else {
    $html .= '<td>' . $sk[$nilaimatrixjenis] . '</td>';
  }
  $html .= '</tr>
      ';
}
$html .= '
        <tr>
          <td colspan="2" class="text-center align-center"><strong>Total Nilai</strong></td>';
if (!$karyawan['nilai_akhir_pemilik']) {
  $html .= '<td><strong>0</strong></td>';
}
$html .= '<td><strong>' . number_format($karyawan['nilai_akhir_pemilik'], 2, ",") . '</strong></td>';
$html .= '<td><strong>' . number_format($karyawan['nilai_akhir'], 2, ",") . '</strong></td>
        </tr>
        <tr>
          <td colspan="2" class="text-center align-center"><strong>Nilai Akhir</strong></td>';
$html .= '<td colspan="2" class="text-center align-center"><strong>' . number_format(($karyawan['nilai_akhir_pemilik'] * 0.4) + ($karyawan['nilai_akhir'] * 0.6), 2, ",") . '</strong></td>';
$html .= '</tr>
      </tbody>
  </table>

  <strong>Komentar Pemilik (Penilai 1) :</strong><p>' . $karyawan['komentar_pemilik'] . '</p>
  <strong>Komentar Koordinator (Penilai 2):</strong><p>' . $karyawan[$komentarjenis] . '</p>
  ';
$html .= '
</body>
';
echo $html;
?>
<div class="row">
  <div class="col-md-1">
    <a href="index.php?p=laporan&act=penilaian" class="btn btn-primary">Kembali</a>
  </div>
  <div class="col-md-1">
    <form id="form-print" action="/php/ahp/page/cetak/laporan.php" method="post" target="_blank" onsubmit="return confirmSubmit(event)">
      <input type="hidden" name="karyawan" value="<?= $idkaryawan ?>">
      <input type="hidden" name="month" value="<?= $month ?>">
      <input type="hidden" name="year" value="<?= $year ?>">
      <input type="hidden" name="bagian" value="<?= $bagian ?>">
      <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Cetak </button>
    </form>
  </div>
</div>
<script>
  function confirmSubmit(e) {
    e.preventDefault()
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
</script>