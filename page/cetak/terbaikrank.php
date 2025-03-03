<?php
require '../../config/connection.php';
require_once __DIR__ . '../../../vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$month = $_POST['month'];
$year = $_POST['year'];
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
WHERE penilaian_akhir_pemilik.id_periode_bulan_fk = '$month' AND penilaian_akhir_pemilik.nama_periode_tahun_fk = '$year'
   OR penilaian_akhir_koor_produksi.id_periode_bulan_fk = '$month' AND penilaian_akhir_koor_produksi.id_periode_tahun_fk = '$year'
   OR penilaian_akhir_koor_gudang.id_periode_bulan_fk = '$month' AND penilaian_akhir_koor_gudang.id_periode_tahun_fk = '$year'
   OR penilaian_akhir_koor_penjualan.id_periode_bulan_fk = '$month' AND penilaian_akhir_koor_penjualan.id_periode_tahun_fk = '$year'

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
WHERE penilaian_akhir_pemilik.id_periode_bulan_fk = '$month' AND penilaian_akhir_pemilik.nama_periode_tahun_fk = '$year'

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
WHERE penilaian_akhir_koor_produksi.id_periode_bulan_fk = '$month' AND penilaian_akhir_koor_produksi.id_periode_tahun_fk = '$year'

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
WHERE penilaian_akhir_koor_gudang.id_periode_bulan_fk = '$month' AND penilaian_akhir_koor_gudang.id_periode_tahun_fk = '$year'

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
WHERE penilaian_akhir_koor_penjualan.id_periode_bulan_fk = '$month' AND penilaian_akhir_koor_penjualan.id_periode_tahun_fk = '$year'
ORDER BY seluruh_nilai_total DESC;");
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

$html = '';
$html .= '
<title>Cetak Karyawan Terbaik</title>
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

  <h2>Laporan Ranking Karyawan</h2>
  
  
  <div class="employee-info">
    <p><strong>Periode Penilaian : </strong>' . angkaKeBulan($month) . ' ' . $year . '</p>
  </div>';
$html .= '
  <table>
    <thead>
        <tr>
            <th>Peringkat</th>
                <th>Nama karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Periode Pemilik</th>
                <th>Periode Koordinator</th>
                <th>Nilai Akhir</th>
        </tr>
    </thead>
    <tbody>';
$no = 1;
while ($row = mysqli_fetch_assoc($karyawanku)) {
  if (($row['bulan_pemilik'] == $row['bulan_produksi'] || $row['bulan_pemilik'] == $row['bulan_penjualan'] || $row['bulan_pemilik'] == $row['bulan_gudang']) && ($row['tahun_pemilik'] == $row['tahun_produksi'] || $row['tahun_pemilik'] == $row['tahun_penjualan'] || $row['tahun_pemilik'] == $row['tahun_gudang'])) {
    $html .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . $row['nama_karyawan'] . '</td>
            <td>' . $row['jk'] . '</td>
            <td>' . $row['jabatan'] . '</td>';
    $html .= '<td>' . $row['bulan_pemilik'] . '-' . $row['tahun_pemilik'] . '</td>';
    if ($row['jabatan'] == 'Staf Produksi') {
      $html .= '<td>' . $row['bulan_produksi'] . '-' . $row['tahun_produksi'] . '</td>';
      $nilaiTotal = ($row['nilai_pemilik'] * 0.4) + ($row['nilai_produksi'] * 0.6);
    } else if ($row['jabatan'] == 'Staf Gudang') {
      $html .= '<td>' . $row['bulan_gudang'] . '-' . $row['tahun_gudang'] . '</td>';
      $nilaiTotal = ($row['nilai_pemilik'] * 0.4) + ($row['nilai_gudang'] * 0.6);
    } else if ($row['jabatan'] == 'Staf Penjualan') {
      $html .= '<td>' . $row['bulan_penjualan'] . '-' . $row['tahun_penjualan'] . '</td>';
      $nilaiTotal = ($row['nilai_pemilik'] * 0.4) + ($row['nilai_penjualan'] * 0.6);
    }
    $html .= '<td>' .
      number_format($nilaiTotal, 2, ",") . '</td>
        </tr>
        ';
  }
}
$html .= '</tbody>
  </table>
  ';
$html .= '
  </body>
  ';
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('Ranking Karyawan', array("Attachment" => false));
