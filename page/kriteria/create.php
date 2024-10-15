<?php 
  $file_path = 'data/kriteria.json';
  $jsonString = file_get_contents($file_path);
  $jsonLen = json_decode($jsonString,true);
  //echo sizeof($jsonData);
  //echo "sd";
  if (isset($_POST['simpan'])) {
    $kriteria=$_POST['nama_test_kriteria'];
    $kategorikriteria=$_POST['kategori_kriteria'];
    $bobot = $_POST['bobot'];
    // $sql = "INSERT INTO test_kriteria VALUES (null,'$kriteria')";
    
    // $con->query($sql);
    // $reindex = "UPDATE test_kriteria SET id_test_kriteria = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)";
    // mysqli_query($con,$reindex);
    // //$insert_id = $con->insert_id;
    
    // $getkri = "SELECT * FROM test_kriteria ORDER BY id_test_kriteria DESC LIMIT 1";
    // $getkrit = mysqli_query($con,$getkri);
    // $arrkri = mysqli_fetch_array($getkrit);
    // $idkri = $arrkri['id_test_kriteria'];
    $bagi = $bobot / 100.0;
    if($kategorikriteria == 'produksi'){
      mysqli_query($con,"INSERT INTO tb_kriteria_produksi VALUES (null,'$kriteria',$bagi)");
    }
    if($kategorikriteria == 'gudang'){
      mysqli_query($con,"INSERT INTO tb_kriteria_gudang VALUES (null,'$kriteria',$bagi)");
    }
    if($kategorikriteria == 'penjualan'){
      mysqli_query($con,"INSERT INTO tb_kriteria_penjualan VALUES (null,'$kriteria',$bagi)");
    }
    echo "<script>window.location.href='index.php?p=criteria'</script>";
    // if(file_exists($file_path)){
    //   $jsonData = 
    //     [
    //       "id"=>sizeof($jsonLen) + 1,
    //       "nama_kriteria"=>$kriteria
    //     ]
    //   ;
    //   array_push($jsonLen,$jsonData);
    //   $jsonDecode = json_encode($jsonLen,JSON_PRETTY_PRINT);
    //   $fp = fopen($file_path,'w');
    //   fwrite($fp,$jsonDecode);
    //   fclose($fp);
    // }

    // foreach($subkriteria as $index => $sk){
    //   $subk = $sk;
    //   $nsk = $nilaikriteria[$index];
    //   $sqlloop = "INSERT INTO sub_kriteria VALUES (null,'$subk','$nsk','$idkri')";
    //   mysqli_query($con,$sqlloop);
    // }
    // echo "<script>window.location.href='index.php?p=karyawan&act=kriteria'</script>";
  }
  //$jabatan = mysqli_query($con,"SELECT * FROM jabatan");
 ?>
 
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Kriteria</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post">
          <div class="box-body">
          <div class="form-group">
              <label for="nama_kriteria">Kriteria</label>
              <input type="text" class="form-control" placeholder="Masukan Kriteria" name="nama_test_kriteria"  required>
            </div>
            <label for="">Bagian</label>
            <div class="form-group mt-3">
              <?php $jabatankosong = "";?>
              <select name="kategori_kriteria" id="kategori_kriteria" class="form-control">
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
              
            </div>
            <div class="form-group">
              <label for="bobot">Nilai Kriteria</label>
              <input type="number" name="bobot" id="" class="form-control">
            </div>
            <div id="input-sub-kriteria" class="mb-3"></div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </div>
    <script>
  </script>
  </div>
  
