<?php
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
$bobot = $_POST['bobot'];

$yearName = $_POST['year'];
$monthName = $_POST['month'];
echo $monthName."\n";
echo gettype($monthName);
//karyawan
//sub-kriteria
//kriteria
//periode
//nilai
//bagian
// $karimplode = implode(" ",$kar);
// echo $karimplode;
// echo $kar[0];

$awal = 0;
$subkrlen = count($skid);

foreach($skid as $index=>$value){
    $v1 = $nilai[$index];
    $subk = $skid[$index];
    $k = $kid[$index];
    $bag = $bagian[$index];
    $karyawan = $kar[$index];
    $pp = ((number_format($v1,1) / 5.0)*100.0);
    $awal += $pp;

    // $statuarr = $status[$index]; 
    if($_SESSION['logged'] == 1){
        mysqli_query($con,"INSERT INTO penilaian_pemilik VALUES (null,'$karyawan','$subk','$k','$period','$v1','$bag')");
        
    }
    if($_SESSION['logged'] == 2){
        mysqli_query($con,"INSERT INTO penilaian_koor_produksi VALUES (null,'$karyawan','$subk','$k','$period','$v1')");
    }
    if($_SESSION['logged'] == 3){
        mysqli_query($con,"INSERT INTO penilaian_koor_gudang VALUES (null,'$karyawan','$subk','$k','$period','$v1')");
    }
    if($_SESSION['logged'] == 4){
        mysqli_query($con,"INSERT INTO penilaian_koor_penjualan VALUES (null,'$karyawan','$subk','$k','$period','$v1')");
    }
    //mysqli_query($con,"INSERT INTO penilaian VALUES (null,'0','$v1','$karyawan','$subk','$kriteria')");
    
}
$kriterianext = $awal / $subkrlen;
$kriterianilai = $kriterianext * $bobot;
$getkaryawan = mysqli_query($con,"SELECT * FROM karyawan WHERE id='$kar[0]'");
$fetchkaryawan = mysqli_fetch_assoc($getkaryawan);


//$o = date('Y-m-d H:i:s');
if($_SESSION['logged'] == 1){
    //$pem = $fetchkaryawan['penilaian_pemilik'] + $kriterianilai;
    //echo $pem. "ini pem";
    //$pemilikBobot = $pem; //nilai murni
    //echo $pemilikBobot . "ini pemilik bobot";
    mysqli_query($con,"INSERT INTO penilaian_kriteria_pemilik VALUES (null,'$kar[0]','$kid[0]','$kriterianilai','$monthName','$yearName')");
}
if($_SESSION['logged'] == 2){
    mysqli_query($con,"INSERT INTO penilaian_kriteria_koor_produksi VALUES (null,'$kar[0]','$kid[0]','$kriterianilai','$monthName','$yearName')");
}
else{
    $koo = $fetchkaryawan['penilaian_koordinator'] + $kriterianilai;
    $koordinatorBobot = $koo; //nilai murni
    mysqli_query($con,"UPDATE karyawan SET status_penilaian_koordinator = '$status',penilaian_koordinator = '$koordinatorBobot' WHERE id='$kar[0]'");
    if($fetchkaryawan['nilai_total'] == null){
        $nilaiTotal =  (number_format($koordinatorBobot,1) * 0.6);
        mysqli_query($con,"UPDATE karyawan SET nilai_total='$nilaiTotal' WHERE id='$kar[0]'");
    }
    $nilaiTotal =  (number_format($koordinatorBobot,1) * 0.6) + $fetchkaryawan['nilai_total'];
    mysqli_query($con,"UPDATE karyawan SET nilai_total='$nilaiTotal' WHERE id='$kar[0]'");
} 

?>