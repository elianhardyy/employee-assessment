<?php 
  $file_path = 'data/kriteria.json';
  $jsonString = file_get_contents($file_path);
  $jsonLen = json_decode($jsonString,true);
  //echo sizeof($jsonData);
  //echo "sd";
  if (isset($_POST['simpan'])) {
    $kriteria=$_POST['nama_test_kriteria'];
    $subkriteria=$_POST['nama_sub_kriteria'];
    $nilaikriteria=$_POST['nilai_sub_kriteria'];
    $sql = "INSERT INTO test_kriteria VALUES (null,'$kriteria')";
    
    $con->query($sql);
    $reindex = "UPDATE test_kriteria SET id_test_kriteria = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)";
    mysqli_query($con,$reindex);
    //$insert_id = $con->insert_id;
    
    $getkri = "SELECT * FROM test_kriteria ORDER BY id_test_kriteria DESC LIMIT 1";
    $getkrit = mysqli_query($con,$getkri);
    $arrkri = mysqli_fetch_array($getkrit);
    $idkri = $arrkri['id_test_kriteria'];

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

    foreach($subkriteria as $index => $sk){
      $subk = $sk;
      $nsk = $nilaikriteria[$index];
      $sqlloop = "INSERT INTO sub_kriteria VALUES (null,'$subk','$nsk','$idkri')";
      mysqli_query($con,$sqlloop);
    }
    
    echo "<script>window.location.href='index.php?p=periode'</script>";
  }
  
 ?>
 
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form input Periode</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post">
          <div class="box-body">
          <div class="form-group">
              <label for="nama_kriteria">Kriteria</label>
              <input type="text" class="form-control" placeholder="Masukan Kriteria" name="nama_test_kriteria"  required>
            </div>
            <div id="input-sub-kriteria" class="col-md-12 mb-3"></div>
            
            <div class="form-group mt-3">
              <button type="button" class="btn btn-danger" id="btn-plus"><b>Tambah Sub Kriteria</b></button>
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
    <script>
    var addInput = document.getElementById("btn-plus");
    var subKriteria = document.getElementById("input-sub-kriteria")
    var formSubempty = 1
    addInput.addEventListener("click",()=>{
      var newSub = document.createElement("div")
      newSub.className += 'input-group'
      // for(let y=0; y< subKriteria.length; y++){
        
        // }
      newSub.innerHTML += '<div class="col-md-4"><input type="text" class="form-control form-sub" name="nama_sub_kriteria[]" placeholder="Nama Sub Kriteria" required></div>'
      newSub.innerHTML += '<div class="col-md-4"><input type="number" class="form-control" name="nilai_sub_kriteria[]" placeholder="Nilai" required/></div>'
      newSub.innerHTML += '<div class="col-md-4"><button type="button" class="btn btn-danger btn-sub"><i class="fa-solid fa-circle-xmark btn-icons-sub"></i></button></div>'
      newSub.innerHTML += '<br>'
      subKriteria.appendChild(newSub)
      var formSub = document.querySelector(".form-sub");
      var btnSub = document.querySelectorAll(".btn-sub")
      var btnIconsSub = document.querySelectorAll(".btn-icons-sub")
      //console.log(btnSub.length)
      for (let i = 0; i < btnSub.length; i++) {
        const btnSubClose = btnSub[i];
        //console.log(btnSubClose);
        btnSubClose.addEventListener("click",(event)=>{
          var removeBtn = event.target;
          console.log(removeBtn);
          removeBtn.parentElement.parentElement.remove();
        })
        btnIconsSub[i].addEventListener("click",(event)=>{
          var removeBtnIcons = event.target;
          console.log(removeBtnIcons);
          removeBtnIcons.parentElement.parentElement.parentElement.remove();
        })
      }
      //console.log(formSubempty);
    })
  </script>
  </div>
  
