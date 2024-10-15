<?php 

  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE from karyawan where id='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=karyawan'</script>";
    } else {
      echo mysqli_error($con);
    }
  }

 ?>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data karyawan </h3><h3 class="box-title pull-right">
          <?php if($_SESSION['logged'] == 1):?>
            <a href="?p=karyawan&act=create" class="btn btn-success"><i class="fa fa-user"></i> Tambah Data karyawan</a>
            <?php endif;?>
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama karyawan</th>
              <th>Jenis Kelamin</th>
              <th>Nomor Hp</th>
              <th>Jabatan</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            	<?php 
                $no = 1;
                if($_SESSION['logged'] == 1){
                  $sql = "select * from karyawan";
                }
                if($_SESSION['logged'] == 2){
                  $sql = "SELECT * FROM `karyawan` WHERE `jabatan` in ('Staf Produksi','Koordinator Produksi');";
                }
                if($_SESSION['logged'] == 3){
                  $sql = "SELECT * FROM `karyawan` WHERE `jabatan` IN ('Staf Gudang', 'Koordinator Gudang')";
                }
                if($_SESSION['logged'] == 4){
                  $sql = "SELECT * FROM karyawan WHERE jabatan IN ('Staf Penjualan', 'Koordinator Penjualan')";
                }
            		$query = mysqli_query($con, $sql);
            		while ($row = mysqli_fetch_assoc($query)):
                  $jabat=mysqli_query($con,"SELECT * from jabatan where id='$row[Jabatan]'");
                  $jab=mysqli_fetch_array($jabat);
            	 ?>
            	 <tr>
            	 	<td><?= $no++ ?></td>
            	 	<td><?= $row['nama'] ?></td>
            	 	<td><?= $row['jenis_kelamin'] ?></td>
                <td><?= $row['no_hp'] ?></td>
                <td><?= $row['jabatan'] ?></td>
                <td>
                  <a href="index.php?p=karyawan&act=detail&sk=1&idk=<?= $row['id']?>&type=produksi" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a href="index.php?p=karyawan&act=edit&id=<?= $row['id'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                  <a href="index.php?p=karyawan&delete&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            	 </tr>
            	<?php endwhile; ?>
            </tbody>
            <tfoot>
            <tr>
              <th colspan="3">Index karyawan May Various</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
