<?php
session_start();
include '../../../config/connection.php';
$type = $_GET['type'];
$tb_kriteria = 'tb_kriteria_'.(string)$type;
$idkrit = 'id_kriteria_'.(string)$type.'';
$tb_sub_kriteria = 'tb_sub_kriteria_'.(string)$type.'' ;
$id_kfk = 'id_kriteria_'.(string)$type.'_fk';
$namakriteriajenis = 'nama_kriteria_'.$type.'';
$bobotjenis = 'bobot_'.$type.'';
$namasubkriteriajenis = 'nama_sub_kriteria_'.$type.'';
$nilaisubkriteriajenis = 'nilai_sub_kriteria_'.$type.'';
$idsbk = 'id_sub_kriteria_'.$type.'';
?>
<table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Kriteria</th>
              <th>Bobot Kriteria</th>
              <th>Sub Kriteria <?= $type?></th>
              <th>Nilai Sub Kriteria <?= $type ?></th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php 
                $dataku = mysqli_query($con,"SELECT * FROM $tb_kriteria JOIN $tb_sub_kriteria ON $tb_kriteria.$idkrit = $tb_sub_kriteria.$id_kfk");
                $datap = mysqli_query($con,"SELECT * FROM $tb_kriteria");
                $namakriteria = "";
                $bobotkriteria = "";
                foreach ($dataku as $key=>$row):
                  if($row[$namakriteriajenis] != $namakriteria){
                    $name = $row[$namakriteriajenis];
                    $namakriteria = $name;
                  }else{
                    $name = "";
                  }
                  if($row[$bobotjenis] != $bobotkriteria){
                    $bobotk = $row[$bobotjenis];
                    $bobotkriteria = $bobotk;
                  }else{
                    $bobotk = "";
                  }
                ?>
                <tr>      
                  <td><h4><?php echo $name; ?></h4></td>
                  <td><?= $bobotk ?></td>
                  <td class="sk"><?= $row[$namasubkriteriajenis]?></td>
                  <td><?= $row[$nilaisubkriteriajenis]?></td>
                  <td>
                    <a href="index.php?p=criteria&act=edit&id=<?= $row[$idkrit] ?>&type=<?php echo $type?>" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="index.php?p=karyawan&delete&id=<?= $row[$idkrit] ?>&type=<?php echo $type?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
              </tr>
            <?php endforeach; ?>   
            </tbody>
          </table>

  <script>
    console.log("hello")
  </script>