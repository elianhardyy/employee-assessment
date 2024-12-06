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
$penilaian = "SELECT * FROM penilaian_akhir_pemilik JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id WHERE penilaian_akhir_pemilik.id_karyawan_fk_pemilik='$idkaryawan' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$month' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$year' LIMIT 1";
$kar = mysqli_query($con, $penilaian);
$karyawan = mysqli_fetch_assoc($kar);
$staf = 'Staf ' . ucfirst($bagian);
$sqls = "SELECT * FROM penilaian_pemilik JOIN $subkriteriajenis ON penilaian_pemilik.id_sub_kriteria_fk = $subkriteriajenis.$idsubkriteriajenis JOIN $kriteriajenis ON $subkriteriajenis.$idkriteriajenisfk = $kriteriajenis.$idkriteriajenis  WHERE penilaian_pemilik.bagian = '$staf' AND penilaian_pemilik.id_karyawan_fk='$idkaryawan' AND penilaian_pemilik.id_bulan_fk_pemilik = '$month' AND penilaian_pemilik.id_tahun_fk_pemilik = '$year'";
$subkriteriat = mysqli_query($con, $sqls);
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
$html = '
<body>
  <h2>Laporan Penilaian Karyawan</h2>
  
  <!-- Informasi Karyawan -->
  <div class="employee-info">
    <p><strong>Nama Karyawan:</strong>' . $karyawan['nama'] . '</p>
    <p><strong>Bagian:</strong> Staf Produksi</p>
    <p><strong>Periode Penilaian:</strong>' . angkaKeBulan($month) . ' ' . $year . '</p>
  </div>

  <!-- Tabel Penilaian -->';

$html .= '
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Kriteria</th>
        <th>Subkriteria</th>
        <th>Nilai</th>
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
        <td>' . $sk[$namasubkriteriajenis] . '</td>
        <td>' . $sk['nilai_akhir_pemilik'] . '</td>
      </tr>
      ';
}
$html .= '
        <tr>
          <td colspan="2" class="text-center align-center"><strong>Total Nilai</strong></td>';
if (!$karyawan['nilai_akhir_pemilik']) {
  $html .= '<td><strong>0</strong></td>';
}
$html .= '<td><strong>' . $karyawan['nilai_akhir_pemilik'] . '</strong></td>
        </tr>
      </tbody>
  </table>
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
    <form action="/php/ahp/page/cetak/laporan.php" method="post" target="_blank">
      <input type="hidden" name="karyawan" value="<?= $idkaryawan ?>">
      <input type="hidden" name="month" value="<?= $month ?>">
      <input type="hidden" name="year" value="<?= $year ?>">
      <input type="hidden" name="bagian" value="<?= $bagian ?>">
      <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Cetak </button>
    </form>
  </div>
</div>

