<?php
session_start();
//array
$nilai = $_POST['nilai']; //[5,5,5,5,5]
$skid = $_POST['skid']; // [1,2,3,4,5]
$kid = $_POST['kid'];

//array
$kar = $_POST['kar'];
$bagian = $_POST['bag'];
$period = date('Y-m-d H:i:s');
//$date = date('Y-m-d');
$status = $_POST['status'];
$bobot = $_POST['bobot'];

$yearName = $_POST['year'];
$monthName = $_POST['month'];
$awal = 0;
$subkrlen = count($skid);

//MATRIX //SUB KRITERIA
foreach ($skid as $index => $value) {
    $v1 = $nilai[$index]; //[5,5,5,5,5] // 5
    $subk = $skid[$index];
    $k = $kid[$index];
    $bag = $bagian[$index];
    $karyawan = $kar[$index];
    $pp = ((number_format($v1, 1) / 5.0) * 100.0);
    $awal += $pp;

    // $statuarr = $status[$index]; 
    if ($_SESSION['logged'] == 1) {
        mysqli_query($con, "INSERT INTO penilaian_pemilik VALUES (null,'$karyawan','$subk','$k','$period','$v1','$bag','$monthName','$yearName')");
    }
    if ($_SESSION['logged'] == 2) {
        mysqli_query($con, "INSERT INTO penilaian_koor_produksi VALUES (null,'$karyawan','$subk','$k','$period','$v1','$monthName','$yearName')");
    }
    if ($_SESSION['logged'] == 3) {
        mysqli_query($con, "INSERT INTO penilaian_koor_gudang VALUES (null,'$karyawan','$subk','$k','$period','$v1','$monthName','$yearName')");
    }
    if ($_SESSION['logged'] == 4) {
        mysqli_query($con, "INSERT INTO penilaian_koor_penjualan VALUES (null,'$karyawan','$subk','$k','$period','$v1','$monthName','$yearName')");
    }
    //mysqli_query($con,"INSERT INTO penilaian VALUES (null,'0','$v1','$karyawan','$subk','$kriteria')");

}


//KRITERIA
$kriterianext = $awal / $subkrlen;
$kriterianilai = $kriterianext * $bobot;
$getkaryawan = mysqli_query($con, "SELECT * FROM karyawan WHERE id='$kar[0]'"); //[1,1,1,1,1]
$fetchkaryawan = mysqli_fetch_assoc($getkaryawan);


//$o = date('Y-m-d H:i:s');
if ($_SESSION['logged'] == 1) {

    mysqli_query($con, "INSERT INTO penilaian_kriteria_pemilik VALUES (null,'$kar[0]','$kid[0]','$kriterianilai','$monthName','$yearName')");
}
if ($_SESSION['logged'] == 2) {
    mysqli_query($con, "INSERT INTO penilaian_kriteria_koor_produksi VALUES (null,'$kar[0]','$kid[0]','$kriterianilai','$monthName','$yearName')");
}
if ($_SESSION['logged'] == 3) {
    mysqli_query($con, "INSERT INTO penilaian_kriteria_koor_gudang VALUES (null,'$kar[0]','$kid[0]','$kriterianilai','$monthName','$yearName')");
}
if ($_SESSION['logged'] == 4) {
    mysqli_query($con, "INSERT INTO penilaian_kriteria_koor_penjualan VALUES (null,'$kar[0]','$kid[0]','$kriterianilai','$monthName','$yearName')");
}
