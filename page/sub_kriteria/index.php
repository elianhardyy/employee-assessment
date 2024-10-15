<?php



?>
<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Kriteria</h3><h3 class="box-title pull-right">
            <?php if($_SESSION['logged'] == 1):?>
            <a href="?p=subkriteria&act=create" class="btn btn-success"><i class="fa fa-user"></i> Tambah Sub Kriteria</a>
            <?php endif;?>
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <select name="" id="kategori" class="form-control col-md-8">
            <option selected disabled>Pilih Jabatan</option>
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
          <!-- jabatan  -->
          
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
      $("#tampil").load(`page/karyawan/ajax/kriteria.php?type=${kategori}`);
      //console.log(p);
    })
  </script>