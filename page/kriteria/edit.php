<?php
$id = $_GET['id'];
$type = $_GET['type'];
//echo $id;
$tb_kriteria = 'tb_kriteria_'.(string)$type;
$idkrit = 'id_kriteria_'.(string)$type.'';
$tb_sub_kriteria = 'tb_sub_kriteria_'.(string)$type.'' ;
$id_kfk = 'id_kriteria_'.(string)$type.'_fk';
$namakriteriajenis = 'nama_kriteria_'.$type.'';
$namasubkriteriajenis = 'nama_sub_kriteria_'.$type.'';
$nilaisubkriteriajenis = 'nilai_sub_kriteria_'.$type.'';
$idsbk = 'id_sub_kriteria_'.$type.'';
$bobotkriteriajenis = 'bobot_'.$type;
$m1jenis = 'm1_'.$type;
$m2jenis = 'm2_'.$type;
$m3jenis = 'm3_'.$type;
$m4jenis = 'm4_'.$type;
$m5jenis = 'm5_'.$type;
$sqlkriteria = "SELECT * FROM $tb_kriteria WHERE $idkrit=$id";
$sqlsubkriteria = "SELECT * FROM $tb_sub_kriteria JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit WHERE $tb_sub_kriteria.$id_kfk = $id ";

$kriteriadetail = mysqli_query($con,$sqlkriteria);
$subkriteria = mysqli_query($con,$sqlsubkriteria);
$row = mysqli_fetch_array($kriteriadetail);
//var_dump($row);
if(isset($_POST['simpan'])){
  $idkriteria = $id;
  //$typekriteria = $type;
  $namakriteria = $_POST['nama_kriteria'];
  $bobotkriteria = $_POST['bobot_kriteria'];
  $namasubkriteria = $_POST['nama_sub_kriteria'];
  $nilaisubkriteria = $_POST['nilai_sub_kriteria'];
  $idsubkriteria = $_POST['id_sub_kriteria'];
  $sqleditkriteria = "UPDATE $tb_kriteria SET $namakriteriajenis = '$namakriteria', $bobotkriteriajenis=$bobotkriteria WHERE $idkrit=$idkriteria";
  mysqli_query($con,$sqleditkriteria);
  foreach($namasubkriteria as $index=>$val){
    $namasub = $namasubkriteria[$index];
    $nilaisub = $nilaisubkriteria[$index];
    $idsub = $idsubkriteria[$index];
    //$idkr = $idkriteria[$index]
    $sqledit = "UPDATE $tb_sub_kriteria SET $namasubkriteriajenis='$namasub', $nilaisubkriteriajenis = $nilaisub WHERE $idsbk=$idsub";
    mysqli_query($con,$sqledit);
  }
  echo '<script>window.location.href="index.php?p=criteria"</script>';
}

?>
<style>
   .row {
  display: flex;
}

.column {
  flex: 50%;
  margin-left: 3rem;
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
            <label for="kriteria">Kriteria</label>
            <input type="text" class="form-control" name="nama_kriteria" value="<?php echo $row[$namakriteriajenis]?>">
            <label for="bobot">Bobot</label>
            <input type="text" class="form-control" name="bobot_kriteria" value="<?= $row[$bobotkriteriajenis] ?>">
            <label for="">Sub Kriteria</label>
            <?php foreach($subkriteria as $sk):?>
              <input type="hidden" name="id_sub_kriteria[]" value="<?= $sk[$idsbk] ?>">
              <div class="row">
                <div class="column">
                    <input type="text" class="form-control form-sub" name="nama_sub_kriteria[]" value="<?=$sk[$namasubkriteriajenis]?>" required>
                </div>
                <div class="column">
                    <input type="hidden" class="form-control nilai-sub" name="nilai_sub_kriteria[]" placeholder="Nilai" min="1" max="10" value="<?= $sk[$nilaisubkriteriajenis]?>" required/>
                </div>
                <div class="col-md-5">
                <!-- <button type="button" class="btn btn-danger btn-sub"><i class="fa-solid fa-circle-xmark btn-icons-sub"></i></button></ -->
                </div>
              </div>
            <?php endforeach;?>
            <!--<div id="tampil-pilihan">
              
            </div>
            
            <label for="">Sub Kriteria</label>
            <div id="tampil-pilihan-sub">

            </div>
            <div class="sub-kriteria-edit" id="sub-kriteria-edit">
              
            </div>
            <div id="input-sub-kriteria" class="mb-3"></div>
            <div class="form-group mt-3">
             <button type="button" class="btn btn-danger" id="btn-plus"><b>Tambah Sub Kriteria</b></button> 
            </div> -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan" id="simpan">Simpan</button>
            <!--<button type="button" id="coba2">coba</button>-->
          </div>
        </form>
      </div>
      <!-- /.box -->

    </div>
    <script>
    $("#kategori_kriteria").change(function(){
      console.log(kategoriKriteria.value)
      $("#tampil-pilihan").load(`page/kriteria/ajax/kriteria_type.php?type=${$("#kategori_kriteria").val()}`)
    })
    $("#coba2").click(function(){
      var formSubArr = [];
      var nilaiSubArr = [];
      var idSubKritArr = [];
      var idKritArr = [];
      var namaSubArr = [];
      var krit = $("#kriteria-types").html();
      //var idkrit = $("#kriteria-types").val();

      var idkrit = document.querySelectorAll(".kriteria-types");
      var formSubclass = document.querySelectorAll(".form-sub");
      var namaSubKriteria = document.getElementsByName("nama_sub_kriteria")
      var kategori = document.getElementById("kategori_kriteria").value;
      var nilaiSub = document.getElementsByName("nilai_sub_kriteria");
      var idsubkrit = document.querySelectorAll(".idsubkriteria");
      formSubclass.forEach((v,i)=>{
        //console.log(v.value);
        //formSubArr.push(v.value);
        namaSubArr.push(formSubclass[i].value)
        //nilaiSubArr.push(nilaiSub[i].value)
        //idSubKritArr.push(idsubkrit[i].value)
        //idKritArr.push(idkrit[i].value)
      })
      console.log(namaSubArr);
      // $.ajax({
      //   method:"POST",
      //   url:"page/kriteria/ajax/hello.php",
      //   data:{
      //     types:krit,
      //     subkrit:namaSubArr,
      //     kategori:kategori,
      //     nilai:nilaiSubArr,
      //     idkrit:idKritArr
      //   },
      //   success:function(res){
      //     console.log(res);
      //   }
      // })
    })

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
      newSub.innerHTML += '<div class="col-md-6"><input type="text" class="form-control form-sub" name="nama_sub_kriteria[]"  required></div>'
      newSub.innerHTML += '<div><input type="hidden" class="form-control nilai-sub" name="nilai_sub_kriteria[]" placeholder="Nilai" value="1" required/></div>'
      newSub.innerHTML += '<div class="col-md-6"><button type="button" class="btn btn-danger btn-sub"><i class="fa-solid fa-circle-xmark btn-icons-sub"></i></button></div>'
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

    
    //var arrsub = [];
    // $("#simpan").click(function(){
    //   var formSub = $(".form-sub").val();
    //   var krit = $("#kriteria-types").val();
    //   arrsub.push(formSub);

    // })
  </script>