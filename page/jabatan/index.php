
<?php 

  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE from jabatan where id='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=jabatan'</script>";
    } else {
      echo mysqli_error($con);
    }
  }

 ?>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">jabatan Penilaian</h3><h3 class="box-title pull-right"><a href="?p=jabatan&act=create" class="btn btn-success"><i class="fa fa-user"></i> Tambah Data jabatan</a></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <?php if(isset($_SESSION['status'])) {
            if($_SESSION['status'] == 'create'){
          ?>
            <div class="alert alert-success" role="alert">
              <p>Sukses menambah karyawan</p>
            </div>
        <?php 
            }if($_SESSION['status'] == 'edit'){ ?>
            <div class="alert alert-success" role="alert">
              <p>Sukses mengubah karyawan</p>
            </div>
       <?php
          }
          
        }
        unset($_SESSION['status']);
        ?>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nama Jabatan</th>
              <th>Job Description</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            	<?php 

            		$sql = "SELECT * from jabatan order by nama_jabatan";
            		$query = mysqli_query($con, $sql);
            		while ($row = mysqli_fetch_assoc($query)):
                  $idj=$row['id'];
                  if (strlen($row['job_desc']) > 119){

                    $str = substr($row['job_desc'], 0, 119) . '<a href="?p=jabatan&act=edit&id='.$idj.'&n"> .. Read more</a>';
                  }else{
                    $str=$row['job_desc'];
                  }
            	 ?>
            	 <tr>
            	 	<td width="40%"><?= $row['nama_jabatan'] ?></td>
                <td><?= $str ?></td>
                <td>
                  <a href="index.php?p=jabatan&act=edit&id=<?= $row['id'] ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                  <a href="index.php?p=jabatan&delete&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            	 </tr>
            	<?php endwhile; ?>
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