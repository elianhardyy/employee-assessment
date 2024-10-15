<?php
$idk = $_GET['idk'];
$previd = $idk - 1;
$type = $_GET['type'];
//$nextid = $idk + 1;
// having > $previd
// untuk setiap id_test_kkriteria_fk - 1
$tb_kriteria = 'tb_kriteria_'.(string)$type;
$idkrit = 'id_kriteria_'.(string)$type.'';
$tb_sub_kriteria = 'tb_sub_kriteria_'.(string)$type.'' ;
$id_kfk = 'id_kriteria_'.(string)$type.'_fk';
$namakriteriajenis = 'nama_kriteria_'.$type.'';
$namasubkriteriajenis = 'nama_sub_kriteria_'.$type.'';
$nilaisubkriteriajenis = 'nilai_sub_kriteria_'.$type.'';
$idsbk = 'id_sub_kriteria_'.$type.'';

$havemore = "SELECT * FROM $tb_sub_kriteria HAVING $id_kfk > '$idk'";
$gethave = mysqli_query($con,$havemore);
//$havenext = "SELECT * FROM $tb_sub_kriteria WHERE";
$empty = array();
mysqli_query($con,"DELETE FROM $tb_sub_kriteria WHERE $id_kfk='$idk'");

foreach($gethave as $i => $val){
    $idkfk = number_format($val[$id_kfk]);
    //$min = $idkfk - 1;
    array_push($empty,$idkfk);
    $min = number_format($empty[$i]) - 1;
    //  " === ini array === ";
    //var_dump($empty);
    $edit = "UPDATE $tb_sub_kriteria SET $id_kfk='$min' WHERE $id_kfk ='$idkfk'";
    mysqli_query($con,$edit);
}
mysqli_query($con,"DELETE FROM $tb_kriteria WHERE $idkrit='$idk'");
$reindex = "UPDATE $tb_kriteria SET $idkrit = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)";
mysqli_query($con,$reindex);
?>