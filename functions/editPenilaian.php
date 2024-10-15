<?php
//karyawan
//sub-kriteria
//kriteria

session_start();
//array
$nilai = $_POST['nilai'];
$skid = $_POST['skid'];
$kid = $_POST['kid'];

//array
$kar = $_POST['kar'];
$bagian = $_POST['bag'];
$period = date('Y-m-d H:i:s');
//$date = date('Y-m-d');
$status = $_POST['status'];
//karyawan
//sub-kriteria
//kriteria
//periode
//nilai
//bagian
foreach($skid as $index=>$value){
    $v1 = $nilai[$index];
    $subk = $skid[$index];
    $k = $kid[$index];
    $bag = $bagian[$index];
    $karyawan = $kar[$index]; 
    if($_SESSION['logged'] == 1){
        $sqledit = "UPDATE penilaian_pemilik SET nilai_akhir_pemilik = '$v1', periode_penilaian_pemilik = '$period' WHERE id_karyawan_fk = '$karyawan' AND id_sub_kriteria_fk = '$subk' AND id_kriteria_fk_penilaian_pemilik = '$k'";
        mysqli_query($con,$sqledit);
        mysqli_query($con,"UPDATE karyawan SET status_penilaian_pemilik = '$status' WHERE id='$kar'");
    }
    if($_SESSION['logged'] == 2){
        mysqli_query($con,"UPDATE penilaian_produksi SET nilai_akhir_produksi = '$v1', periode_penilaian_produksi = '$period' WHERE id_karyawan_fk = '$karyawan' AND id_sub_kriteria_fk = '$subk' AND id_kriteria_fk_penilaian_produksi = '$k'");
        mysqli_query($con,"UPDATE karyawan SET status_penilaian_koordinator = '$status' WHERE id='$kar'");
    }
    if($_SESSION['logged'] == 3){
        mysqli_query($con,"UPDATE penilaian_gudang SET nilai_akhir_gudang = '$v1', periode_penilaian_gudang = '$period' WHERE id_karyawan_fk = '$karyawan' AND id_sub_kriteria_fk = '$subk' AND id_kriteria_fk_penilaian_gudang = '$k'");
        mysqli_query($con,"UPDATE karyawan SET status_penilaian_koordinator = '$status' WHERE id='$kar'");
    }
    if($_SESSION['logged'] == 4){
        mysqli_query($con,"UPDATE penilaian_penjualan SET nilai_akhir_penjualan = '$v1', periode_penilaian_penjualan = '$period' WHERE id_karyawan_fk = '$karyawan' AND id_sub_kriteria_fk = '$subk' AND id_kriteria_fk_penilaian_penjualan = '$k'");
        mysqli_query($con,"UPDATE karyawan SET status_penilaian_koordinator = '$status' WHERE id='$kar'");
    }
    //mysqli_query($con,"INSERT INTO penilaian VALUES (null,'0','$v1','$karyawan','$subk','$kriteria')");
}
?>
