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
  //$dataku = mysqli_query($conn,"SELECT * FROM test_kriteria JOIN sub_kriteria ON test_kriteria.id_test_kriteria = sub_kriteria.id_test_kriteria_fk");
  // $oaoa= mysqli_fetch_assoc($dataku);
  // var_dump($oaoa);
  //UPDATE test_kriteria SET id_test_kriteria = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)
 ?>
<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Kriteria</h3><h3 class="box-title pull-right">
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <select name="" id="kategori" class="form-control col-md-8">
            <option selected disabled>- Pilih Jabatan -</option>
            <?php
            $jabatan = mysqli_query($con,"SELECT * FROM jabatan WHERE nama_jabatan LIKE '%koordinator%'");
            foreach ($jabatan as $key => $row) {
              $explodenama = explode(" ",$row['nama_jabatan']);
              $namatolower = strtolower($explodenama[1]);
              ?>
              <option value="<?php echo $namatolower ?>"><?= $explodenama[1]?></option>
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
    $("#kategori").change(function(){
      var kategori = $("#kategori").val();
      console.log(kategori);
      $("#kategori").val(kategori);
      // http://localhost/php/ahp/index.php?p=karyawan&act=kriteria
      // $.ajax({
      //   url:`page/karyawan/ajax/kriteria.php?type=${kategori}`,
      //   method:"GET",
      //   success:function(res){
      //     console.log(res);
      //   }
      // })
      $("#tampil").load(`page/kriteria/ajax/kriteria.php?type=${kategori}`);
      //console.log(p);
    })
  </script>