<?php

if (isset($_GET['delete'])) {
  $id = $_GET['id'];
  $sql = "delete from periode where id_periode='$id'";
  $query = mysqli_query($con, $sql);
  if ($query) {
    echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=karyawan&act=kriteria'</script>";
  } else {
    echo mysqli_error($con);
  }
}

?>
<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Kriteria & Sub Kriteria</h3>
        <h3 class="box-title pull-right">
        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <select name="" id="kategori" class="form-control col-md-8">
          <option selected disabled>- Pilih Kriteria -</option>
          <?php
          $jabatan = mysqli_query($con, "SELECT * FROM jabatan WHERE nama_jabatan LIKE '%koordinator%'");
          foreach ($jabatan as $key => $row) {
            $explodenama = explode(" ", $row['nama_jabatan']);
            $namatolower = strtolower($explodenama[1]);
          ?>
            <option value="<?php echo $namatolower ?>"><?= $explodenama[1] ?></option>
          <?php  }
          ?>
        </select>
        <div id="tampil"></div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<script>
  $("#kategori").change(function() {
    var kategori = $("#kategori").val();
    console.log(kategori);
    $("#kategori").val(kategori);
    $("#tampil").load(`page/kriteria/ajax/kriteria.php?type=${kategori}`);
    //console.log(p);
  })
</script>