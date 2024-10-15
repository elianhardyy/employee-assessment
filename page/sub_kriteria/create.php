<?php
if($_POST['simpan']){

  $kriteria=$_POST['kriteria-types'];
  $nokriteria=$_POST['kriteria-types'];
  echo $nokriteria;
      $subkriteria=$_POST['nama_sub_kriteria'];
      $nilaikriteria=$_POST['nilai_sub_kriteria'];
      $kategorikriteria=$_POST['kategori_kriteria'];
      // $sql = "INSERT INTO test_kriteria VALUES (null,'$kriteria')";
      
      // $con->query($sql);
      // $reindex = "UPDATE test_kriteria SET id_test_kriteria = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)";
      // mysqli_query($con,$reindex);
      // //$insert_id = $con->insert_id;
      // $getkri = "SELECT * FROM test_kriteria ORDER BY id_test_kriteria DESC LIMIT 1";
      // $getkrit = mysqli_query($con,$getkri);
      // $arrkri = mysqli_fetch_array($getkrit);
      // $idkri = $arrkri['id_test_kriteria'];
      if($kategorikriteria == 'produksi'){
        //mysqli_query($con,"INSERT INTO tb_kriteria_produksi VALUES (null,'$kriteria')");
        mysqli_query($con,"UPDATE tb_kriteria_produksi SET id_kriteria_produksi = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)");
        //$getkriproduksi = mysqli_query($con,"SELECT * FROM tb_kriteria_produksi ORDER BY id_kriteria_produksi DESC LIMIT 1");
        //$arrprod = mysqli_fetch_array($getkriproduksi);
        $idprod = $nokriteria;
        foreach($subkriteria as $index => $sk){
          $subk = $sk;
          $nsk = $nilaikriteria[$index];
          $sqlloop = "INSERT INTO tb_sub_kriteria_produksi VALUES (null,'$subk','$nsk','$idprod')";
          mysqli_query($con,$sqlloop);
        }
      }
      if($kategorikriteria == 'gudang'){
        //mysqli_query($con,"INSERT INTO tb_kriteria_gudang VALUES (null,'$kriteria')");
        mysqli_query($con,"UPDATE tb_kriteria_gudang SET id_kriteria_gudang = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)");
        //$getkrigudang = mysqli_query($con,"SELECT * FROM tb_kriteria_gudang ORDER BY id_kriteria_gudang DESC LIMIT 1");
        //$arrgud = mysqli_fetch_array($getkrigudang);
        $idgud = $nokriteria;
        foreach($subkriteria as $index => $sk){
          $subk = $sk;
          $nsk = $nilaikriteria[$index];
          $sqlloop = "INSERT INTO tb_sub_kriteria_gudang VALUES (null,'$subk','$nsk','$idgud')";
          mysqli_query($con,$sqlloop);
        }
      }
      if($kategorikriteria == 'penjualan'){
        //mysqli_query($con,"INSERT INTO tb_kriteria_penjualan VALUES (null,'$kriteria')");
        mysqli_query($con,"UPDATE tb_kriteria_penjualan SET id_kriteria_penjualan = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)");
        //$getkripenjualan = mysqli_query($con,"SELECT * FROM tb_kriteria_penjualan ORDER BY id_kriteria_penjualan DESC LIMIT 1");
        //$arrpenj = mysqli_fetch_array($getkripenjualan);
        $idpenj = $nokriteria;
        foreach($subkriteria as $index => $sk){
          $subk = $sk;
          $nsk = $nilaikriteria[$index];
          $sqlloop = "INSERT INTO tb_sub_kriteria_penjualan VALUES (null,'$subk','$nsk','$idpenj')";
          mysqli_query($con,$sqlloop);
        }
      }
      //echo "<script>window.location.href='index.php?p=karyawan&act=kriteria'</script>";
}

?>
<style>
  .sub-kriteria-group{
    display: flex;
    /* flex-direction: column; */
    justify-content: flex-start;
    margin-bottom: 2rem;
}


</style>
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Sub Kriteria</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post">
          <div class="box-body">
          <div class="form-group">
              <label for="nama_kriteria">Jabatan</label>
              <select name="kategori_kriteria" id="kategori_kriteria" class="form-control">
              <option selected disabled>----Pilih Jabatan-----</option>
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
              <!-- <input type="text" class="form-control" placeholder="Masukan Kriteria" name="nama_test_kriteria"  required> -->
            </div>
            <div id="tampil-pilihan">
              
            </div>
            <label for="">Sub Kriteria</label>
            <div class="form-group mt-3">
              
            </div>
            <div id="input-sub-kriteria" class="mb-3"></div>
            <div class="form-group mt-3">
              <button type="button" class="btn btn-danger" id="btn-plus"><b>Tambah Sub Kriteria</b></button>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="button" class="btn btn-primary" name="simpan" id="coba2">Simpan</button>
            <!-- <button type="button" id="coba2">coba</button> -->
          </div>
        </form>
      </div>
      <!-- /.box -->

    </div>
    <script>
    var addInput = document.getElementById("btn-plus");
    var subKriteria = document.getElementById("input-sub-kriteria")
    var kategoriKriteria = document.getElementById("kategori_kriteria");
    var formSubempty = 1
    
    addInput.addEventListener("click",()=>{
      var newSub = document.createElement("div")
      newSub.className += 'sub-kriteria-group';
      // for(let y=0; y< subKriteria.length; y++){
        
        // }
      //newSub.innerHTML += `<label class="label-sub">df</label>`
      newSub.innerHTML += '<div class=""><input type="text" class="form-control form-sub" name="nama_sub_kriteria[]"  required></div>'
      newSub.innerHTML += '<div><input type="hidden" class="form-control nilai-sub" name="nilai_sub_kriteria[]" placeholder="Nilai" value="1" required/></div>'
      newSub.innerHTML += '<div class=""><button type="button" class="btn btn-danger btn-sub"><i class="fa-solid fa-circle-xmark btn-icons-sub"></i></button></div>'
      newSub.innerHTML += '<br>'
      subKriteria.appendChild(newSub)
      var formSub = document.querySelectorAll(".form-sub");
      var btnSub = document.querySelectorAll(".btn-sub")
      var btnIconsSub = document.querySelectorAll(".btn-icons-sub")
      
      //console.log(btnSub.length)
      var labelSub = document.querySelectorAll(".label-sub")

      for (let i = 0; i < btnSub.length; i++) {
        const btnSubClose = btnSub[i];
        //console.log(btnSubClose);
        //labelSub[i].innerHTML = `sub kriteria ${i + 1}`;
        formSub[i].placeholder = `sub kriteria ${i + 1}`
       
        btnSubClose.addEventListener("click",(event)=>{
          var removeBtn = event.target;
          formSub[i].placeholder = `sub kriteria ${i}`
          removeBtn.parentElement.parentElement.remove();
        })
        btnIconsSub[i].addEventListener("click",(event)=>{
          var removeBtnIcons = event.target;
          formSub[i].placeholder = `sub kriteria ${i}`
          removeBtnIcons.parentElement.parentElement.parentElement.remove();
        })
      }
      //console.log(formSubempty);
    })
    
    // kategoriKriteria.addEventListener("change",function(){
    //   var tampilPilihan = document.getElementById("tampil-pilihan");
    //   var kategoriChange = document.getElementById("kategori_kriteria")
    //   console.log(kategoriChange.value)
    //   tampilPilihan.onload = `page/sub_kriteria/ajax/kriteria_type.php?type=${kategoriChange.value}`
    // })

    $("#coba2").click(function(){
      var formSubArr = [];
      var nilaiSubArr = []
      var krit = $("#kriteria-types").val();
      var formSubclass = document.querySelectorAll(".form-sub");
      var kategori = document.getElementById("kategori_kriteria").value;
      var nilaiSub = document.querySelectorAll(".nilai-sub");
      formSubclass.forEach((v,i)=>{
        //console.log(v.value);
        formSubArr.push(v.value);
        nilaiSubArr.push(nilaiSub[i].value)
      })
      console.log(kategori)
      $.ajax({
        method:"POST",
        url:"page/sub_kriteria/ajax/hello.php",
        data:{
          types:krit,
          subkrit:formSubArr,
          kategori:kategori,
          nilai:nilaiSubArr
        },
        success:function(res){
          console.log(res);
        }
      })
    })
    $("#kategori_kriteria").change(function(){
      console.log(kategoriKriteria.value)
      $("#tampil-pilihan").load(`page/sub_kriteria/ajax/kriteria_type.php?type=${$("#kategori_kriteria").val()}`)
    })
    
  </script>
