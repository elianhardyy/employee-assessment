<?php
require '../../config/connection.php';
require_once __DIR__ . '../../../vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$year = $_POST['year'];
$month = $_POST['month'];
$idkaryawan = $_POST['karyawan'];
$bagian = strtolower($_POST['bagian']);
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

$penilaian = "SELECT * FROM penilaian_akhir_pemilik JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik=karyawan.id JOIN $penilaianakhirjenis ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik = $penilaianakhirjenis.$idkaryawanfkpenilaian WHERE penilaian_akhir_pemilik.id_karyawan_fk_pemilik='$idkaryawan' AND penilaian_akhir_pemilik.id_periode_bulan_fk='$month' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$year' LIMIT 1";
$kar = mysqli_query($con, $penilaian);
$karyawan = mysqli_fetch_assoc($kar);
echo $bagian;
$staf = 'Staf ' . ucfirst($bagian);
$sqls = "SELECT * FROM penilaian_pemilik JOIN $subkriteriajenis ON penilaian_pemilik.id_sub_kriteria_fk = $subkriteriajenis.$idsubkriteriajenis JOIN $kriteriajenis ON $subkriteriajenis.$idkriteriajenisfk = $kriteriajenis.$idkriteriajenis JOIN $penilaiankoorjenis ON penilaian_pemilik.id_sub_kriteria_fk = $penilaiankoorjenis.id_sub_kriteria_fk WHERE penilaian_pemilik.bagian = '$staf' AND penilaian_pemilik.id_karyawan_fk='$idkaryawan' AND penilaian_pemilik.id_bulan_fk_pemilik = '$month' AND penilaian_pemilik.id_tahun_fk_pemilik = '$year'";
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
<title>Penilaian_' . $karyawan['nama'] . '_' . angkaKeBulan($month) . '_' . $year . '</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/bd20a423ca.js" crossorigin="anonymous"></script>
<style>
body {
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0;
    padding: 20px;
  }
  
  h2 {
    margin-bottom: 20px;
    color: #333;
  }
  
  .employee-info {
    margin-bottom: 20px;
    text-align: left;
    width: 60%;
  }
  
  .employee-info p {
    margin: 5px 0;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
    margin-top: 10px;
  }
  
  th, td {
    border: 1px solid #ddd;
    padding: 5px;
  }
  
  th {
    background-color: #4CAF50;
    color: white;
  }
  
  td {
    color: #555;
  }
  
  tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  .total-criteria-row td {
    background-color: #f1f1f1;
    font-weight: bold;
    color: #333;
  }
  
  .total-row td {
    background-color: #e0e0e0;
    font-weight: bold;
    color: #333;
  }
  .container {
    position: relative;
    width: 100%;
    height: 100vh;
    text-align: center;
}

.header-content {
    display: inline-block;
    margin-top: 5px;
}

.logo {
    position: absolute;
    top: 5px;
    left: 5px;
}

.no-margin {
    margin-bottom: 0;
    margin-top: 0;
}
</style>
<body>';
$image = file_get_contents('../../purnama.jpg');
$imagedata = base64_encode($image);

$html .= '
<div class="container">
<img src="data:image/jpg;base64,' . $imagedata . '" width="100px" height="100px">
<div class="header-content">
<h2 class="no-margin">
STAR PURNAMA
</h2>

            <p class="no-margin">
            <strong>Konveksi Seragam Surabaya</strong><br>
            Jl. Bulak Banteng No. 28, Surabaya<br>
            Telp. 081 330 430 218
            </p>
            </div>
            </div>
            <hr style="border:0.5px solid black; margin:10px 5px 10px 5px;">
  <h2>Laporan Penilaian Karyawan</h2>
  
  <!-- Informasi Karyawan -->
  <div class="employee-info">
    <p><strong>Nama Karyawan : </strong>' . $karyawan['nama'] . '</p>
    <p><strong>Bagian : </strong>' . $karyawan['jabatan'] . '</p>
    <p><strong>Periode Penilaian : </strong>' . angkaKeBulan($month) . ' ' . $year . '</p>
    <p><strong>Predikat : </strong>' . $predikat . '</p>
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
          <td colspan="2"><strong>Total Nilai</strong></td>
          <td><strong>' . number_format($karyawan['nilai_akhir_pemilik'], 2, ",") . '</strong></td>
          <td><strong>' . number_format($karyawan['nilai_akhir'], 2, ",") . '</strong></td>
        </tr>
        <tr>
        <td colspan="2" class="text-center align-center"><strong>Nilai Akhir</strong></td>';
$html .= '<td colspan="2" class="text-center align-center"><strong>' . number_format($nilaiTotal, 2, ",") . '</strong></td>';
$html .= '</tr>
      </tbody>
  </table>
  <strong>Komentar Pemilik (Penilai 1) :</strong><p>' . $karyawan['komentar_pemilik'] . '</p>
  <strong>Komentar Koordinator (Penilai 2) :</strong><p>' . $karyawan[$komentarjenis] . '</p>
  ';
$html .= '
</body>
';
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$namakaryawan = 'Penilaian_' . $karyawan['nama'] . '_' . angkaKeBulan($month) . '_' . $year;
$dompdf->stream($namakaryawan, array("Attachment" => false));
