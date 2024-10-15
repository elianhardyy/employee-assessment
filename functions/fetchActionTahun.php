<?php
$id = $_GET['id'];
$periodeTahun = mysqli_query($con,"SELECT * FROM periode_tahun WHERE id_periode_tahun='$id'");
$fetchTahun = mysqli_fetch_assoc($periodeTahun);
echo $fetchTahun['aksi_tahun']

?>