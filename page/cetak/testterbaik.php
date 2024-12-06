<?php
require '../../config/connection.php';
require_once __DIR__.'../../../vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$month = $_POST['month'];
$year = $_POST['year'];
$karyawanku = mysqli_query($con,"SELECT * FROM penilaian_akhir_pemilik LEFT JOIN karyawan ON penilaian_akhir_pemilik.id_karyawan_fk_pemilik = karyawan.id LEFT JOIN penilaian_akhir_koor_produksi ON karyawan.id = penilaian_akhir_koor_produksi.id_karyawan_fk_produksi LEFT JOIN penilaian_akhir_koor_gudang ON karyawan.id = penilaian_akhir_koor_gudang.id_karyawan_fk_gudang LEFT JOIN penilaian_akhir_koor_penjualan ON karyawan.id = penilaian_akhir_koor_penjualan.id_karyawan_fk_penjualan WHERE penilaian_akhir_pemilik.id_periode_bulan_fk='$month' AND penilaian_akhir_pemilik.nama_periode_tahun_fk='$year' ORDER BY nilai_akhir_pemilik DESC");
function angkaKeBulan($angka) {
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
$html = '
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
  
</style>
<body>
  <h2>Laporan Penilaian Karyawan</h2>
  
  <!-- Informasi Karyawan -->
  <div class="employee-info">
    <p><strong>Periode Penilaian:</strong>'. angkaKeBulan($month) .' '. $year .'</p>
  </div>

  <!-- Tabel Penilaian -->';
  $html .= '
  <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Nilai Akhir Pemilik</th>
            <th>Nilai Akhir Koordinator</th>
        </tr>
    </thead>
    <tbody>';
    $no = 0;
    foreach($karyawanku as $row){
        $html .= '
        <tr>
            <td>'.$no++.'</td>
            <td>'.$row['nama'].'</td>
            <td>'.$row['jenis_kelamin'].'</td>
            <td>'.$row['jabatan'].'</td>
            <td>'.$row['nilai_akhir_pemilik'].'</td>
            <td>'.$row['nilai_akhir'].'</td>
        </tr>
        ';
    }
    $html .= '</tbody>
  </table>
  ';
  $html.='
  </body>
  ';
echo $html;
?>