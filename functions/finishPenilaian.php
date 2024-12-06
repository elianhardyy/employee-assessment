<?php
session_start();
$kar = $_POST['kar'];
//$nilai = $_POST['nilai'];
$skid = $_POST['skid'];
$kid = $_POST['kid'];
$bagian = $_POST['bag'];
$bobot = $_POST['bobot'];
$yearName = $_POST['year'];
$monthName = $_POST['month'];
$comment = $_POST['comment'];
$jabatan = $_POST['jab'];
$nama = $_POST['nama'];
$jk = $_POST['jk'];
// echo $yearName;
// echo $monthName;
$period = date('Y-m-d H:i:s');
if($_SESSION['logged'] == 1){
    $nilai = 0;
    $subkrlen = count($skid);
    $penilaian = mysqli_query($con,"SELECT * FROM penilaian_kriteria_pemilik WHERE id_karyawan_fk = '$kar[0]' AND id_kriteria_bulan_pemilik = '$monthName' AND id_kriteria_tahun_pemilik = '$yearName'");
    foreach($penilaian as $pen){
        $nilai += $pen['nilai_kriteria_pemilik'];
    }
    mysqli_query($con,"INSERT INTO penilaian_akhir_pemilik VALUES (null, '$kar[0]','$nilai','$monthName','$yearName','$bagian[0]','$comment','$period','$period')");
}
if($_SESSION['logged'] == 2){
    $nilai = 0;
    $subkrlen = count($skid);
    $penilaian = mysqli_query($con,"SELECT * FROM penilaian_kriteria_koor_produksi WHERE id_karyawan_fk = '$kar[0]' AND id_kriteria_bulan_koor_produksi = '$monthName' AND id_kriteria_tahun_koor_produksi = '$yearName'");
    foreach($penilaian as $pen){
        $nilai += $pen['nilai_kriteria_koor_produksi'];
    }
    mysqli_query($con,"INSERT INTO penilaian_akhir_koor_produksi VALUES (null, '$kar[0]','$nilai','$monthName','$yearName','$comment','$period','$period')");
}
if($_SESSION['logged'] == 3){
    $nilai = 0;
    $subkrlen = count($skid);
    $penilaian = mysqli_query($con,"SELECT * FROM penilaian_kriteria_koor_gudang WHERE id_karyawan_fk = '$kar[0]' AND id_kriteria_bulan_koor_gudang = '$monthName' AND id_kriteria_tahun_koor_gudang = '$yearName'");
    foreach($penilaian as $pen){
        $nilai += $pen['nilai_kriteria_koor_gudang'];
    }
    mysqli_query($con,"INSERT INTO penilaian_akhir_koor_gudang VALUES (null, '$kar[0]','$nilai','$monthName','$yearName','$comment','$period','$period')");
}
if($_SESSION['logged'] == 4){
    $nilai = 0;
    $subkrlen = count($skid);
    $penilaian = mysqli_query($con,"SELECT * FROM penilaian_kriteria_koor_penjualan WHERE id_karyawan_fk = '$kar[0]' AND id_kriteria_bulan_koor_penjualan = '$monthName' AND id_kriteria_tahun_koor_penjualan = '$yearName'");
    foreach($penilaian as $pen){
        $nilai += $pen['nilai_kriteria_koor_penjualan'];
    }
    mysqli_query($con,"INSERT INTO penilaian_akhir_koor_penjualan VALUES (null, '$kar[0]','$nilai','$monthName','$yearName','$comment','$period','$period')");
} 
?>