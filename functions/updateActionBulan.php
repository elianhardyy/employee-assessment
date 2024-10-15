<?php

$id = $_POST['id'];
$aksi = $_POST['aksi'];
mysqli_query($con,"UPDATE periode_bulan SET aksi_bulan='$aksi' WHERE id_periode_bulan = $id");
echo $aksi;

?>