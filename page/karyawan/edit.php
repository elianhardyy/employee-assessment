<?php 
  
  $id = $_GET['id'];
  $sql = "SELECT * from karyawan where id='$id'";
  $query = mysqli_query($con, $sql);
  $data = mysqli_fetch_array($query);

  
	if (isset($_POST['simpan'])) {
		$sql = "UPDATE karyawan set nama='".$_POST['nama']."', no_hp='".$_POST['no_hp']."', jenis_kelamin='".$_POST['jenis_kelamin']."', jabatan='".$_POST['jabatan']."' where id='$id'";
		$query = mysqli_query($con, $sql);
  
		if ($query) {
			?>
      <input type="hidden" id="nameedit" value="<?= $_POST['nama']?>">
      <script>
        swal({
          title:"Apakah mengubah karyawan",
          icon:"warning",
          buttons:true,

        }).then((yes)=>{
          if(yes){
            var name = $("#nameedit").val()
            swal(`Mengubah karyawan sukses`,{
              icon:"success"
            }).then((ok)=>{
              window.location.href='index.php?p=karyawan'
            })
          }else{
            swal("Karyawan tidak ditambahkan")
            //$("#nama_karyawan")
          }
        })
      </script>

      <?php 
      $_SESSION['nameedit'] = $_POST['nama'];
      $_SESSION['status'] = 'edit';
		} else {
			echo "Error : " . mysqli_error($con);
		}
	}
  
?>

<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form karyawan</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Karyawan</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan Nama Karyawan" name="nama" value="<?php echo $data['nama']; ?>" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nomor HP</label>
              <input type="text" class="form-control input-lg" id="no_hp" placeholder="Masukan Nama karyawan" name="no_hp" value="<?php echo $data['no_hp']; ?>"required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Kelamin</label>
              <select class="form-control custom-select input-lg" name="jenis_kelamin">
                <option disabled selected>-- Masukan Gender --</option>
                <option value="Laki - laki" <?php if($data['jenis_kelamin']=="Laki - laki"){echo"selected";}else{echo "";} ?>>Laki - laki</option>
                <option value="Perempuan" <?php if($data['jenis_kelamin']=="Perempuan"){echo"selected";}else{echo "";} ?>>Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jabatan</label>
              <select class="form-control input-lg" name="jabatan" required>
                <option disabled selected>-- Pilih Jabatan --</option>
                <?php $jabat=mysqli_query($con,"SELECT nama_jabatan from jabatan order by nama_jabatan");
                while ($jab=mysqli_fetch_array($jabat)) {
                  echo "<option value='$jab[nama_jabatan]' ";
                  if ($data["jabatan"]==$jab["nama_jabatan"]) {
                    echo "selected";
                  }
                  echo ">".$jab["nama_jabatan"]."</option>";
                }
                ?>
                
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
    
  </div>
  <script>
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
  <!-- /.row -->