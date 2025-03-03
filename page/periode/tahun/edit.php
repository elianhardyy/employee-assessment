<?php
$id = $_GET['id'];
if(isset($_POST['simpan'])){
    $namatahun = $_POST['nama_tahun'];
    mysqli_query($con,"UPDATE periode_tahun SET nama_tahun='$namatahun' WHERE id_periode_tahun=$id");
    echo "<script>window.location.href='index.php?p=periode&act=tahun'</script>";
}
$tahun = mysqli_query($con,"SELECT * FROM periode_tahun WHERE id_periode_tahun='$id'");
$getsingletahun = mysqli_fetch_assoc($tahun);
?>

<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Periode Tahun</h3>
          
        </div>

        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="tahun">Nama Tahun</label>
              <input type="text" class="form-control input-lg" id="tahun" placeholder="Masukkan Tahun" name="nama_tahun" value="<?= $getsingletahun['nama_tahun']?>"  required>
            </div>
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="index.php?p=periode&act=tahun" class="btn btn-primary">Kembali</a>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
    <!-- <div class="col-md-4">
      <a href="?p=karyawan&act=upload&ta=<?php echo $_GET['ta'];?>" class="btn btn-primary"><i class="fa fa-upload"></i> Import Excel File </a>
  </div> -->

  </div>
