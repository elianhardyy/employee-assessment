<?php 

  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "delete from periode where id_periode='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=periode'</script>";
    } else {
      echo mysqli_error($con);
    }
  }
  //$dataku = mysqli_query($conn,"SELECT * FROM test_kriteria JOIN sub_kriteria ON test_kriteria.id_test_kriteria = sub_kriteria.id_test_kriteria_fk");
  // $oaoa= mysqli_fetch_assoc($dataku);
  // var_dump($oaoa);
  //UPDATE test_kriteria SET id_test_kriteria = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)
 ?>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Periode Penilaian</h3><h3 class="box-title pull-right"><a href="?p=periode&act=create" class="btn btn-success"><i class="fa fa-user"></i> Tambah Data periode</a></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Periode Ajaran</th>
              <th>Periode Ajaran</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php 
                $dataku = mysqli_query($con,"SELECT * FROM test_kriteria JOIN sub_kriteria ON test_kriteria.id_test_kriteria = sub_kriteria.id_test_kriteria_fk");
                $datap = mysqli_query($con,"SELECT * FROM test_kriteria");
                $namakriteria = "";
                foreach ($dataku as $row):
                  if($row['nama_test_kriteria'] != $namakriteria){
                    $name = $row['nama_test_kriteria'];
                    $namakriteria = $name;
                  }else{
                    $name = "";
                  }
                ?>
                <tr>      
                  <td><h4><?php echo $name; ?></h4></td>
                  <td class="sk"><?= $row['nama_sub_kriteria']?></td>
                  <td>
                    <a href="index.php?p=periode&act=editKriteria&id=<?= $row['id_test_kriteria'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="index.php?p=periode&delete&id=<?= $row['id_test_kriteria'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
              </tr>
            <?php endforeach; ?>  
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <script>
  </script>