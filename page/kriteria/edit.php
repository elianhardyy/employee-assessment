<?php
$id = $_GET['id'];
$type = $_GET['type'];
//echo $id;
$tb_kriteria = 'tb_kriteria_' . (string)$type;
$idkrit = 'id_kriteria_' . (string)$type . '';
$tb_sub_kriteria = 'tb_sub_kriteria_' . (string)$type . '';
$id_kfk = 'id_kriteria_' . (string)$type . '_fk';
$namakriteriajenis = 'nama_kriteria_' . $type . '';
$namasubkriteriajenis = 'nama_sub_kriteria_' . $type . '';
$nilaisubkriteriajenis = 'nilai_sub_kriteria_' . $type . '';
$idsbk = 'id_sub_kriteria_' . $type . '';
$bobotkriteriajenis = 'bobot_' . $type;
$m1jenis = 'm1_' . $type;
$m2jenis = 'm2_' . $type;
$m3jenis = 'm3_' . $type;
$m4jenis = 'm4_' . $type;
$m5jenis = 'm5_' . $type;
$sqlkriteria = "SELECT * FROM $tb_kriteria WHERE $idkrit=$id";
$sqlsubkriteria = "SELECT * FROM $tb_sub_kriteria JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit WHERE $tb_sub_kriteria.$id_kfk = $id ";
$kriteriadetail = mysqli_query($con, $sqlkriteria);
$subkriteria = mysqli_query($con, $sqlsubkriteria);
$row = mysqli_fetch_array($kriteriadetail);
//var_dump($row);
if (isset($_POST['simpan'])) {
  $idkriteria = $id;
  //$typekriteria = $type;
  $namakriteria = $_POST['nama_kriteria'];
  $bobotkriteria = $_POST['bobot_kriteria'];
  $namasubkriteria = $_POST['nama_sub_kriteria'];
  $idsubkriteria = $_POST['id_sub_kriteria'];
  $sqleditkriteria = "UPDATE $tb_kriteria SET $namakriteriajenis = '$namakriteria', $bobotkriteriajenis=$bobotkriteria WHERE $idkrit=$idkriteria";
  mysqli_query($con, $sqleditkriteria);
  foreach ($namasubkriteria as $index => $val) {
    $namasub = $namasubkriteria[$index];
    $idsub = $idsubkriteria[$index];
    //$idkr = $idkriteria[$index]
    $sqledit = "UPDATE $tb_sub_kriteria SET $namasubkriteriajenis='$namasub'WHERE $idsbk=$idsub";
    mysqli_query($con, $sqledit);
  }
  echo '<script>window.location.href="index.php?p=criteria"</script>';
}

if (isset($_GET['edit'])) {
  $m1 = $_POST['mat1'];
  $m2 = $_POST['mat2'];
  $m3 = $_POST['mat3'];
  $m4 = $_POST['mat4'];
  $m5 = $_POST['mat5'];
  $jenisbagian = $_GET['type'];
  $tbsubkriteriajenis = 'tb_sub_kriteria_' . $jenisbagian;
  $idsbkjenis = 'id_sub_kriteria_' . $jenisbagian;
  $idsub = $_GET['idsub'];
  mysqli_query($con, "UPDATE $tbsubkriteriajenis SET $m1jenis='$m1',$m2jenis='$m2',$m3jenis='$m3',$m4jenis='$m4',$m5jenis='$m5' WHERE $idsbkjenis='$idsub'");
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
          <input type="text" class="form-control" name="nama_kriteria" value="<?php echo $row[$namakriteriajenis] ?>">
          <label for="bobot">Bobot</label>
          <input type="text" class="form-control" name="bobot_kriteria" value="<?= $row[$bobotkriteriajenis] ?>">
          <label for="">Sub Kriteria</label>
          <?php foreach ($subkriteria as $sk): ?>
            <input type="hidden" name="id_sub_kriteria[]" class="idsbk" value="<?= $sk[$idsbk] ?>">
            <div class="row">
              <div class="column">
                <input type="text" class="form-control form-sub" name="nama_sub_kriteria[]" value="<?= $sk[$namasubkriteriajenis] ?>" required>
              </div>

              <div class="col-md-5">
                <button type="button" class="btn btn-primary edit-matrix" data-toggle="modal" data-target="#myModal<?= $sk[$idsbk] ?>" data-placement="top" title="Edit Matriks"><i class="glyphicon glyphicon-edit"></i></button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="index.php?p=criteria" class="btn btn-primary">Kembali</a>
          <button type="submit" class="btn btn-primary" name="simpan" id="simpan">Simpan</button>
        </div>
      </form>
    </div>
    <input type="hidden" id="typebag" value="<?= $type ?>">
    <input type="hidden" id="idbag" value="<?= $id ?>">
    <?php foreach ($subkriteria as $sk): ?>
      <div class="modal fade idsbkm" id="myModal<?= $sk[$idsbk] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title titlem" id="myModalLabel"></h4>
            </div>

            <div class="modal-body">
              <label for="">Matriks 1</label>
              <input type="text" class="form-control m1" value="<?= $sk[$m1jenis] ?>">
              <label for="">Matriks 2</label>
              <input type="text" class="form-control m2" value="<?= $sk[$m2jenis] ?>">
              <label for="">Matriks 3</label>
              <input type="text" class="form-control m3" value="<?= $sk[$m3jenis] ?>">
              <label for="">Matriks 4</label>
              <input type="text" class="form-control m4" value="<?= $sk[$m4jenis] ?>">
              <label for="">Matriks 5</label>
              <input type="text" class="form-control m5" value="<?= $sk[$m5jenis] ?>">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary save-matrix" id="modal-matrix">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <!-- /.box -->
  </div>
  <script>
    var addInput = document.getElementById("btn-plus");
    var subKriteria = document.getElementById("input-sub-kriteria")
    var kategoriKriteria = document.getElementById("kategori_kriteria");
    var formSubempty = 1

    var formSub = document.querySelectorAll(".form-sub");
    var idSbk = document.querySelectorAll(".idsbk");
    var editMatrix = document.querySelectorAll(".edit-matrix");
    var saveMatrix = document.querySelectorAll(".save-matrix");
    var titleModal = document.querySelectorAll(".titlem");
    var typeBagian = document.getElementById("typebag");
    var idBagian = document.getElementById("idbag");
    editMatrix.forEach((v, i) => {
      editMatrix[i].addEventListener("click", (e) => {
        e.preventDefault();
        var contentSub = formSub[i].value;
        var idSub = idSbk[i].value;
        titleModal[i].innerHTML = contentSub;
      })
    })
    var m1 = document.querySelectorAll(".m1");
    var m2 = document.querySelectorAll(".m2");
    var m3 = document.querySelectorAll(".m3");
    var m4 = document.querySelectorAll(".m4");
    var m5 = document.querySelectorAll(".m5");
    var modalMatrix = document.getElementById("modal-matrix")
    saveMatrix.forEach((v, i) => {
      saveMatrix[i].addEventListener("click", (e) => {
        swal({
          title: "Apakah Anda yakin mengubah keterangan matriks",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((yes) => {
          if (yes) {
            var idSubPost = idSbk[i].value;
            var bagian = typeBagian.value;
            var idSub = idBagian.value;
            $.ajax({
              type: "POST",
              url: `index.php?p=criteria&act=edit&id=${idSub.toString()}&type=${bagian.toString()}&edit&idsub=${idSubPost.toString()}`,
              data: {
                mat1: m1[i].value,
                mat2: m2[i].value,
                mat3: m3[i].value,
                mat4: m4[i].value,
                mat5: m5[i].value,
              },
              success: (res) => {
                saveMatrix[i].setAttribute("data-dismiss", "modal");
              }
            })
            swal("Perubahan diproses", {
              icon: "success"
            }).then((ok) => {
              window.location.href = `index.php?p=criteria&act=edit&id=${idSub.toString()}&type=${bagian.toString()}`;
            })
          } else {
            swal("Gagal diproses")
          }
        })
      })
    })
  </script>