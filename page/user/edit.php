<?php 

$id = $_GET['id'];
$sql = "select * from user where id_user='$id'";
$query = mysqli_query($con, $sql);
$data = mysqli_fetch_array($query);


if (isset($_POST['simpan'])) {

  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $level = $_POST['level'];
    // $peran = $_POST['peran'];

  $sql = "update user set nama='$nama', username='$username', password='$password', Level='$level' where id_user='$id'";
  $query = mysqli_query($con, $sql);
  if ($query) {
    echo "<script>alert('Data berhasil diubah!');window.location.href='index.php?p=user'</script>";
  } else {
    echo "Error : " . mysqli_error($con);
  }
}

?>

<div class="row">
  <!-- left column -->
  <div class="col-md-8">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Form User</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama" name="nama" required value="<?= $data['nama'] ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Username" name="username" required value="<?= $data['username'] ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Masukan Password" name="password" required value="<?= $data['password'] ?>">
          </div>
          <div class="form-group">
            <label>Level</label>
            <select name="Level" class="form-control custom-select">
              <option value="<?=$data['level']?>"><?= $data['level']?></option>
              <option disabled>-- Pilih Level --</option>
              <option value="pemilik">pemilik</option>
              <option value="produksi">produksi</option>
              <option value="gudang">gudang</option>
              <option value="penjualan">penjualan</option>
            </select>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <a href="index.php?p=user" class="btn btn-primary">Kembali</a>
          <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.box -->


  </div>
  <!--/.col (left) -->

</div>
  <!-- /.row -->