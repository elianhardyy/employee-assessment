<?php
$idsk = $_GET['idsk'];
mysqli_query($con,"DELETE FROM sub_kriteria WHERE id_sub_kriteria='$idsk'");
?>