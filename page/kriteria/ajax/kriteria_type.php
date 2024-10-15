<?php
session_start();
include "../../../config/connection.php";
$type = $_GET['type'];

$tb_kriteria = 'tb_kriteria_'.(string)$type;
$idkrit = 'id_kriteria_'.(string)$type.'';
$tb_sub_kriteria = 'tb_sub_kriteria_'.(string)$type.'' ;
$id_kfk = 'id_kriteria_'.(string)$type.'_fk';
$namakriteriajenis = 'nama_kriteria_'.$type.'';
$namasubkriteriajenis = 'nama_sub_kriteria_'.$type.'';
$nilaisubkriteriajenis = 'nilai_sub_kriteria_'.$type.'';
$idsbk = 'id_sub_kriteria_'.$type.'';

$kriteria = mysqli_query($con,"SELECT * FROM $tb_kriteria");

?>
<label for="kriteria-type">Kriteria</label>
<select name="kriteria-types" id="kriteria-types" class="form-control kriteria-types">
   <?php foreach($kriteria as $kr):?>
   <option value="<?php echo $kr[$idkrit]?>"><?php echo $kr[$namakriteriajenis]?></option>
   <?php endforeach;?>
</select>
<br>
<script>
   $("#kriteria-types").change(function(){
      $("#tampil-pilihan-sub").load(`page/kriteria/ajax/sub_kriteria.php?typetb=${$("#kategori_kriteria").val()}&typekriteria=${$("#kriteria-types").val()}`);
    })
    $("#tampil-pilihan-sub").load(`page/kriteria/ajax/sub_kriteria.php?typetb=${$("#kategori_kriteria").val()}&typekriteria=${$("#kriteria-types").val()}`);
</script>