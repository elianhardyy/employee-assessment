<?php

$id = $_POST['id'];
$aksi = $_POST['aksi'];
mysqli_query($con,"UPDATE periode_tahun SET aksi_tahun='$aksi' WHERE id_periode_tahun = $id");
echo $aksi;

?>