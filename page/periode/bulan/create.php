<?php
if(isset($_POST['simpan'])){
    $namabulan = $_POST['nama_bulan'];
    mysqli_query($con,"INSERT INTO periode_bulan VALUES (null,'$namabulan','off')");
    echo "<script>window.location.href='index.php?p=periode&act=bulan'</script>";
}


?>
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form input bulan</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Bulan</label>
              <input type="text" id="nama_bulan" name="nama_bulan" class="form-control input-lg" placeholder="Nama Bulan">
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

  </div>