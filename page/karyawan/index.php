<?php

if (isset($_GET['delete'])) {
  $id = $_GET['id'];
  $type = (string)$_GET['type'];
  $findKaryawan = mysqli_query($con, "SELECT * FROM karyawan WHERE id='$id' LIMIT 1");
  $fetchKaryawan = mysqli_fetch_assoc($findKaryawan);
  
  $penAkhirPemilik = mysqli_query($con, "SELECT * FROM penilaian_akhir_pemilik WHERE id_karyawan_fk_pemilik='$id'");
  $penKriteriaPemilik=mysqli_query($con, "SELECT * FROM penilaian_kriteria_pemilik WHERE id_karyawan_fk='$id'");
  $penPemilik=mysqli_query($con, "SELECT * FROM penilaian_pemilik WHERE id_karyawan_fk='$id'");

  $pen_akhir_pemilik = mysqli_num_rows($penAkhirPemilik);
  $pen_kriteria_pemilik = mysqli_num_rows($penKriteriaPemilik);
  $pen_matrix_pemilik = mysqli_num_rows($penPemilik);
  if($pen_akhir_pemilik >= 1 || $pen_kriteria_pemilik >= 1 || $pen_matrix_pemilik >= 1){
    mysqli_query($con, "DELETE FROM penilaian_akhir_pemilik WHERE id_karyawan_fk_pemilik='$id'");
    mysqli_query($con, "DELETE FROM penilaian_kriteria_pemilik WHERE id_karyawan_fk='$id'");
    mysqli_query($con, "DELETE FROM penilaian_pemilik WHERE id_karyawan_fk='$id'");
    $query = mysqli_query($con, "DELETE from karyawan WHERE id='$id'");
  }

  //
  $penilaianakhirjenis = "penilaian_akhir_koor_".$type;
  $penilaiankriteriajenis = "penilaian_kriteria_koor_".$type;
  $penilaianmatrixjenis = "penilaian_koor_".$type;
  $idkaryawanfkjenis = "id_karyawan_fk_".$type;
  //
  $penAkhirKoorJenis = mysqli_query($con, "SELECT * FROM $penilaianakhirjenis WHERE $idkaryawanfkjenis ='$id'");
  $penKriteriaKoorJenis = mysqli_query($con, "SELECT * FROM $penilaiankriteriajenis WHERE id_karyawan_fk='$id'");
  $penMatrixKoorJenis = mysqli_query($con, "SELECT * FROM $penilaianmatrixjenis WHERE id_karyawan_fk='$id'");

  //
  $pen_akhir_koor_jenis = mysqli_num_rows($penAkhirKoorJenis);
  $pen_kriteria_koor_jenis = mysqli_num_rows($penKriteriaKoorJenis);
  $pen_matrix_koor_jenis = mysqli_num_rows($penMatrixKoorJenis);
  if($pen_akhir_koor_jenis >= 1 || $pen_kriteria_koor_jenis >= 1 || $pen_matrix_koor_jenis >= 1){
    mysqli_query($con, "DELETE FROM $penilaianakhirjenis WHERE $idkaryawanfkjenis ='$id'");
    mysqli_query($con, "DELETE FROM $penilaiankriteriajenis WHERE id_karyawan_fk='$id'");
    mysqli_query($con, "DELETE FROM $penilaianmatrixjenis WHERE id_karyawan_fk='$id'");
    $query = mysqli_query($con, "DELETE from karyawan WHERE id='$id'");

  }
  //
  $query = mysqli_query($con, "DELETE from karyawan WHERE id='$id'");
  
  if ($query) {
    $_SESSION['status'] = 'delete';
    echo "<script>window.location.href='index.php?p=karyawan'</script>";
  } else {
    echo mysqli_error($con);
  }
}

?>
<?php if(isset($_SESSION['status'])) {
            if($_SESSION['status'] == 'create'){
          ?>
            <div class="alert alert-success" role="alert">
              <p>Sukses menambah karyawan</p>
            </div>
        <?php 
            }if($_SESSION['status'] == 'edit'){ ?>
            <div id="notification">
              <p style="margin-left: 3vh;">Sukses mengubah</p>
              <div id="progress-bar"></div>
            </div>
       <?php
          }
          if($_SESSION['status'] == 'delete'){ ?>
            <div class="alert alert-success" role="alert">
              <p>Sukses menghapus karyawan</p>
            </div>
         <?php }
          
        }
        unset($_SESSION['status']);
        ?>
<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data karyawan </h3>
        <h3 class="box-title pull-right">
          <?php if ($_SESSION['logged'] == 1): ?>
            <a href="?p=karyawan&act=create" class="btn btn-success"><i class="fa fa-user"></i> Tambah Data karyawan</a>
          <?php endif; ?>
        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama karyawan</th>
              <th>Jenis Kelamin</th>
              <th>Nomor Hp</th>
              <th>Jabatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if ($_SESSION['logged'] == 1) {
              $sql = "select * from karyawan";
            }
            if ($_SESSION['logged'] == 2) {
              $sql = "SELECT * FROM `karyawan` WHERE `jabatan` in ('Staf Produksi','Koordinator Produksi');";
            }
            if ($_SESSION['logged'] == 3) {
              $sql = "SELECT * FROM `karyawan` WHERE `jabatan` IN ('Staf Gudang', 'Koordinator Gudang')";
            }
            if ($_SESSION['logged'] == 4) {
              $sql = "SELECT * FROM karyawan WHERE jabatan IN ('Staf Penjualan', 'Koordinator Penjualan')";
            }
            $query = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($query)):
              $jabat = mysqli_query($con, "SELECT * from jabatan where id='$row[Jabatan]'");
              $jab = mysqli_fetch_array($jabat);
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['jenis_kelamin'] ?></td>
                <td><?= $row['no_hp'] ?></td>
                <td><?= $row['jabatan'] ?></td>
                <td>
                  <a href="index.php?p=karyawan&act=edit&id=<?= $row['id'] ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                  <button value="<?= $row['id']." ".$row['jabatan'] ?>" class="btn btn-danger karyawandel"><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Hapus"></i></button>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3">Index karyawan May Various</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<script>
  const notification = document.getElementById("notification");
    const progressBar = document.getElementById("progress-bar");
    const duration = 2000; // Waktu dalam milidetik (5 detik)

    // Jika notifikasi memiliki teks, tampilkan
    if (notification.textContent.trim() !== "") {
        notification.classList.add("show");

        // Atur durasi untuk progress bar
        let startTime = Date.now();
        let interval = setInterval(() => {
            let elapsedTime = Date.now() - startTime;
            let percentage = Math.max(0, 100 - (elapsedTime / duration) * 100);
            progressBar.style.width = percentage + "%";

            if (elapsedTime >= duration) {
                clearInterval(interval);
                notification.classList.remove("show");
                notification.classList.add("hidden");
            }
        }, 100); // Perbarui progress bar setiap 100ms
    };

    //
  
  const idKaryawan = document.querySelectorAll(".karyawandel");
  idKaryawan.forEach((v, i) => {
    console.log(v);
    idKaryawan[i].addEventListener("click", (e) => {
      var iDBagian = e.target.value; // 
      var idSplitbagian = iDBagian.split(" "); // [1,"Staf","Produksi"];
      var bagianLower = idSplitbagian[2].toLowerCase();
      swal({
        title: "Apakah Anda yakin mengahpus karyawan",
        text: "Jika menghapus maka karyawan akan hilang",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then((yes) => {
        if (yes) {
          swal("Hapus karyawan sukses", {
            icon: "success"
          }).then((ok) => {
            $.ajax({
              url: `index.php?p=karyawan&delete&id=${idSplitbagian[0]}&type=${bagianLower}`,
              method: "GET",
              success: (res) => {
                //console.log(res)
                window.location.href = `index.php?p=karyawan`
                //console.log("success")
              },
              error: () => {
                console.log("error")
              }
            })
          })
        } else {
          swal("Hapus karyawan dibatalkan")
        }
      })
    })
  })
</script>