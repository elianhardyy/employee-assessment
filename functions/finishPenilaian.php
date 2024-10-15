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

echo $yearName;
echo $monthName;

$period = date('Y-m-d H:i:s');
if($_SESSION['logged'] == 1){
    $nilai = 0;
    $subkrlen = count($skid);
    $penilaian = mysqli_query($con,"SELECT * FROM penilaian_kriteria_pemilik WHERE id_karyawan_fk = '$kar[0]'");
    foreach($penilaian as $pen){
        $nilai += $pen['nilai_kriteria_pemilik'];
    }
    // $kriterianext = $nilai / $subkrlen;
    // // $bobot = 0.35
    // $kriterianilai = $kriterianext * $bobot;
    // $nilaiTotal = $kriterianilai;
    // echo $nilaiTotal;
    mysqli_query($con,"INSERT INTO penilaian_akhir_pemilik VALUES (null, '$kar[0]','$nilai','$monthName','$yearName','$period','$period')");
    //$nilai;
}
if($_SESSION['logged'] == 2){
    $nilai = 0;
    $subkrlen = count($skid);
    $penilaian = mysqli_query($con,"SELECT * FROM penilaian_kriteria_koor_produksi WHERE id_karyawan_fk = '$kar[0]'");
    foreach($penilaian as $pen){
        $nilai += $pen['nilai_kriteria_koor_produksi'];
    }
    mysqli_query($con,"INSERT INTO penilaian_akhir_koor_produksi VALUES (null, '$kar[0]','$nilai','$monthName','$yearName','$period','$period')");
}



?>