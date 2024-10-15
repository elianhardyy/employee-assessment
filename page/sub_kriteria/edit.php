<?php


?>

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
            <div class="sub-kriteria-edit" id="sub-kriteria-edit">
              
            </div>
            <div id="input-sub-kriteria" class="mb-3"></div>
            <div class="form-group mt-3">
              <button type="button" class="btn btn-danger" id="btn-plus"><b>Tambah Sub Kriteria</b></button>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan" id="simpan">Simpan</button>
            <button type="button" id="coba2">coba</button>
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