<?php
if(isset($_POST['simpan'])){
    $namatahun = $_POST['nama_tahun'];
    mysqli_query($con,"INSERT INTO periode_tahun VALUES (null,$namatahun,'off')");
    echo "<script>window.location.href='index.php?p=periode&act=tahun'</script>";
}


?>

<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form karyawan</h3>
          
        </div>

        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="tahun">Nama Tahun</label>
              <input type="text" class="form-control input-lg" id="tahun" placeholder="Masukkan Tahun" name="nama_tahun"  required>
            </div>
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
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
