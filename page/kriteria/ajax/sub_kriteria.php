<?php
session_start();
include "../../../config/connection.php";
$type = $_GET['typetb'];
$typekrit = $_GET['typekriteria']; //id
$tb_kriteria = 'tb_kriteria_'.(string)$type;
$idkrit = 'id_kriteria_'.(string)$type.'';
$tb_sub_kriteria = 'tb_sub_kriteria_'.(string)$type.'' ;
$id_kfk = 'id_kriteria_'.(string)$type.'_fk';
$namakriteriajenis = 'nama_kriteria_'.$type.'';
$namasubkriteriajenis = 'nama_sub_kriteria_'.$type.'';
$nilaisubkriteriajenis = 'nilai_sub_kriteria_'.$type.'';
$idsbk = 'id_sub_kriteria_'.$type.'';
$subkriteria = mysqli_query($con,"SELECT * FROM $tb_sub_kriteria WHERE $id_kfk=$typekrit");
?>
<style>
   .row {
  display: flex;
}

.column {
  flex: 50%;
  margin-left: 3rem;
}
</style>
<?php foreach($subkriteria as $sk):?>
<div class="row">
   
   <div class="column">
      <input type="text" class="form-control form-sub" name="nama_sub_kriteria" value="<?=$sk[$namasubkriteriajenis]?>" required>
   </div>
   <div class="column">
      <input type="number" class="form-control nilai-sub" name="nilai_sub_kriteria" placeholder="Nilai" min="1" max="10" value="<?= $sk[$nilaisubkriteriajenis]?>" required/>
   </div>
   <div class="col-md-5">
   <!-- <button type="button" class="btn btn-danger btn-sub"><i class="fa-solid fa-circle-xmark btn-icons-sub"></i></button></ -->
   </div>
</div>
<?php endforeach;?>
<script>
   
</script>