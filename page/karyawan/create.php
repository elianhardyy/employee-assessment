<?php 
  // error_reporting(0);
   // if ($_POST['Password']!=$_POST['CPassword']) {
   //     echo "<script>//alert('Password Berbeda, harap lakukan registrasi kembali');
   //     window.location.href='index.php?p=karyawan&act=create&s=dm&nip=".$_POST[NIP]."&nama=".$_POST[karyawan]."&JK=".$_POST[JK]."&uname=".$_POST[username]."&jabatan=".$_POST[jabatan]."&uname=".$_POST[username]."'</script>";
   //   }
   //   else{
      	
    //}
  if (isset($_POST['simpan'])) {
    //$sql = "insert into karyawan values(null,".$_POST['nama'].",".$_POST['JK'].",".$_POST['no_hp'].",".$_POST['jabatan'].")";
    $nama = $_POST['nama'];
    $jk = $_POST['JK'];
    $nohp = $_POST['no_hp'];
    $jabatan = $_POST['jabatan'];
    $sql = "INSERT INTO karyawan VALUES (null,'$nama','$jk','$nohp','$jabatan','belum','belum',null,null,null)";
    $query = mysqli_query($con, $sql);
    $namajson = json_encode($nama);
    if ($query) {
      //echo "<script>alert('Data berhasil ditambahkan!');window.location.href='index.php?p=karyawan'</script>";
      ?>
      <input type="hidden" id="namepost" value="<?= $nama ?>">
      <script>
        swal({
          title:"Apakah menambah karyawan",
          icon:"warning",
          buttons:true,

        }).then((yes)=>{
          if(yes){
            swal("Tambah karyawan sukses",{
              icon:"success"
            }).then((ok)=>{
              window.location.href='index.php?p=karyawan'
            })
          }else{
            swal("Karyawan tidak ditambahkan")
            $("#nama_karyawan").val($("#namepost").val());
            //$("#nama_karyawan")
          }
        })
      </script>
      <?php
    } else {
      echo "Error : " . mysqli_error($con);
    }
  }
 ?>
 <style>
 .dm{
    margin:5px;
    padding: 10px;
     background: #E65E4C;
      color: white;
      border-left: #ED2B12 solid 5px;
      font-weight:35px;
   } 
   </style>

<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form karyawan</h3>
          
        </div>
        <!-- <?php if($_GET['s']=="dm"){ echo "<div class='dm'>Password berbeda, coba lagi</div>";}else{echo"";}?> -->
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
          <div class="form-group">
              <label for="exampleInputEmail1">Nama Karyawan</label>
              <input type="text" class="form-control input-lg" id="namakaryawan" placeholder="Masukan Nama Karyawan" name="nama"  required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nomor HP</label>
              <input type="text" class="form-control input-lg" id="no_hp" placeholder="Masukan Nama karyawan" name="no_hp"required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Kelamin</label>
              <select class="form-control custom-select input-lg" name="JK" id="JK">
                <option disabled selected>-- Pilih Gender --</option>
                <option value="Laki - laki">Laki - laki</option>
                <option value="Wanita">Wanita</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jabatan</label>
             <select class="form-control input-lg" name="jabatan" id="jabatan" required>
              <?php
              $jabatan = mysqli_query($con,"SELECT * FROM jabatan")
              ?>
              <option selected disabled> -- Pilih Jabatan -- </option>
              <?php foreach($jabatan as $j):?>
                <option value="<?= $j['nama_jabatan'] ?>" ><?= $j['nama_jabatan'] ?></option>
              <?php endforeach; ?>
             </select>
            </div>
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="index.php?p=karyawan" class="btn btn-primary">Kembali</a>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </div>
    <!--/.col (left) -->
    <!-- <div class="col-md-4">
      <a href="?p=karyawan&act=upload&ta=<?php echo $_GET['ta'];?>" class="btn btn-primary"><i class="fa fa-upload"></i> Import Excel File </a>
  </div> -->

  </div>



  <!-- /.row -->
  <script>
//   var check = function() {
//   if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
//     document.getElementById('message').style.color = 'green';
//     document.getElementById('message').innerHTML = 'matching';
//   } else {
//     document.getElementById('message').style.color = 'red';
//     document.getElementById('message').innerHTML = 'not matching';
//   }
// }
var noHp = document.getElementById("no_hp")
    noHp.addEventListener("input",function(e){
      //console.log(e.target.value);
      const value = e.target.value;
      const notDigit = /\D/
      if(notDigit.test(value) === true){
        e.target.value = value.replace(/\D/g,"");
      }
      //console.log(value);
    })
  </script>
