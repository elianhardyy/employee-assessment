<?php
$id=$_GET['id'];
$type = $_GET['type'];

$tb_kriteria = 'tb_kriteria_'.(string)$type;
$idk = 'id_kriteria_'.(string)$type.'';
$tb_sub_kriteria = 'tb_sub_kriteria_'.(string)$type.'' ;
$id_kfk = 'id_kriteria_'.(string)$type.'_fk';
$kriteria = mysqli_query($con,"SELECT * FROM $tb_kriteria WHERE $idk='$id'");

$k = mysqli_fetch_array($kriteria);
$subkriteria = mysqli_query($con,"SELECT * FROM $tb_sub_kriteria JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idk WHERE $id_kfk = '$id'");

//$kriteria = mysqli_query($con,"SELECT * FROM test_kriteria WHERE id_test_kriteria = '$id'");
//$k = mysqli_fetch_array($kriteria);
//$subkriteria = mysqli_query($con,"SELECT * FROM sub_kriteria JOIN test_kriteria ON sub_kriteria.id_test_kriteria_fk = test_kriteria.id_test_kriteria WHERE id_test_kriteria_fk = '$id'");
$namakriteriajenis = 'nama_kriteria_'.$type.'';
$namasubkriteriajenis = 'nama_sub_kriteria_'.$type.'';
$nilaisubkriteriajenis = 'nilai_sub_kriteria_'.$type.'';
$idsbk = 'id_sub_kriteria_'.$type.'';
if(isset($_POST['simpan'])){
    $insertKriteria = $id;
    $insertSubKriteria = $_POST['insert_nama_sub_kriteria'];
    $insertNilaiKriteria = $_POST['insert_nilai_sub_kriteria'];
    foreach($insertSubKriteria as $index => $sk){
        $subk = $sk;
        $nsk = $insertNilaiKriteria[$index];
        $sql = "INSERT INTO $tb_sub_kriteria VALUES (null,'$subk','$nsk','$insertKriteria')";
        mysqli_query($con,$sql);
    }
    $namaKriteria = $_POST['nama_kriteria'];
    $idSubKriteria = $_POST['id_sub_kriteria'];
    $subKriteria = $_POST['nama_sub_kriteria'];
    $nilaiSubKriteria = $_POST['nilai_sub_kriteria'];
    $sqlkriteria = "UPDATE $tb_kriteria SET $namakriteriajenis ='$namaKriteria' WHERE $idk='$id' ";
    mysqli_query($con,$sqlkriteria);
    foreach($subKriteria as $index => $sk){
        $SubK = $sk;
        $NSubK = $nilaiSubKriteria[$index];
        $idsk = $idSubKriteria[$index];
        $sqledit = "UPDATE $tb_sub_kriteria SET $namasubkriteriajenis='$SubK',$nilaisubkriteriajenis='$NSubK' WHERE $idsbk='$idsk'";
        mysqli_query($con,$sqledit); 
    }
    echo "<script>window.location.href='index.php?p=karyawan&act=editKriteria&id=".$id."&type=".$type."'</script>";
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
              <input type="text" class="form-control" placeholder="Masukan Kriteria" name="nama_kriteria" value="<?= $k['nama_kriteria_'.$type.'']?>"  required>
            </div>
            <?php foreach($subkriteria as $sk){?>
            <div id="input-sub-kriteria" class="col-md-12 mb-3">
                <input type="hidden" name="id_sub_kriteria[]" value="<?= $sk['id_sub_kriteria_'.$type.'']?>">
                <div class="col-md-4">
                    <input type="text" class="form-control form-sub" name="nama_sub_kriteria[]" placeholder="Nama Sub Kriteria" value="<?= $sk['nama_sub_kriteria_'.$type.'']?>" required>
                </div>
                <div class="col-md-4" hidden>
                    <input type="hidden" class="form-control" name="nilai_sub_kriteria[]" placeholder="Nilai" value="<?= $sk['nilai_sub_kriteria_'.$type.'']?>" required/>
                </div>
                <div class="col-md-4">
                    <button type="button" value="<?= $sk['id_sub_kriteria_'.$type.'']?>" class="btn btn-danger btn-sub"><i class="fa-solid fa-circle-xmark btn-icons-sub"></i></button>
                </div>
            </div>
                <?php } ?>
            <div id="input-edit-sub-kriteria" class="col-md-12"></div>
            <div class="form-group mt-3">
              <button type="button" class="btn btn-secondary" id="btn-plus"><b>Tambah Sub Kriteria</b></button>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            <button type="button" class="btn btn-danger" id="del-kriteria">Hapus Kriteria</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    <p id="idk-del" hidden><?php echo $id;?></p>
    <input type="hidden" name="" id="typeb" value="<?php echo $type?>">
    </div>
    <script>
        var idSubK = document.querySelectorAll(".btn-sub");
        var btnIconsSub = document.querySelectorAll(".btn-icons-sub");
        var addInput = document.getElementById("btn-plus");
        var subKriteria = document.getElementById("input-edit-sub-kriteria")
        addInput.addEventListener("click",()=>{
      var newSub = document.createElement("div")
      newSub.className += 'input-group'
      // for(let y=0; y< subKriteria.length; y++){
        
        // }
      newSub.innerHTML += '<div class="col-md-4"><input type="text" class="form-control form-sub" name="insert_nama_sub_kriteria[]" placeholder="Nama Sub Kriteria" required></div>'
      newSub.innerHTML += '<div class="col-md-4"><input type="hidden" class="form-control" name="insert_nilai_sub_kriteria[]" placeholder="Nilai" required/></div>'
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
        idSubK.forEach((v,i)=>{
            console.log(v.value);
            v.addEventListener("click",(event)=>{
                $.ajax({
                    type:"POST",
                    url:`functions/index.php?r=delSubKriteria&idsk=${v.value}`,
                    success:(res)=>{
                        console.log("sukses");
                    },
                    error:(res)=>{
                        console.log("error");
                    }
                })
                var removeBtn = event.target;
                removeBtn.parentElement.parentElement.remove();
            })
            btnIconsSub[i].addEventListener("click",(event)=>{
                var removeBtnIcons = event.target;
                removeBtnIcons.parentElement.parentElement.parentElement.remove();
            })
        })
    // $("#del-kriteria").click(function(){
    //     console.log($(this))
    //     swal({
    //         title: 'Peringatan!',
    //         type: 'error',
    //         text: 'Yakin ingin menghapus data?',
    //         html: true,
    //         confirmButtonColor: '#d9534f',
    //         showCancelButton: true,
    //     },function () {
           
    //     });
    //     return false;
    // })
    var idkdel = $('#idk-del').html();
    var typeb = document.getElementById('typeb').value;
    console.log(idkdel);
    $("#del-kriteria").click(function(e){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((del)=>{
            if(del){
                $.ajax({
                type:"POST",
                url:`functions/index.php?r=delKriteria&idk=${idkdel}&type=${typeb}`,
                success:function(res){
                    console.log(res);
                    window.location.href='index.php?p=karyawan&act=kriteria'
                    //console.log(res);
                },
                error:function(){

                }
        })
                swal("yee",{
                    icon:"success"
                })
            }else{
                swal("aman gak hapus")
            }
        })
        
    })
        
    </script>
