<?php
$bulan = mysqli_query($con,"SELECT * FROM periode_bulan");

?>
<style>
    /* Gaya tombol umum */
#toggleBtn {
  width: 60px;
  height: 30px;
  font-size: 16px;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.4s;
}

/* Warna untuk kondisi OFF */
.btn-off {
  background-color: red;
}

/* Warna untuk kondisi ON */
.btn-on {
  background-color: green;
}

</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Periode bulan</h3>
                <div class="pull-right">
                    <a href="index.php?p=periode&m=cbulan" class="btn btn-success"><i class="fa fa-user"></i> Tambah bulan</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Aksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        <?php foreach($bulan as $t):?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $t['nama_bulan']?></td>
                                <td><button id="toggleBtn" class="<?php $label = $t['aksi_bulan'] == 'off' ? 'btn-off' : 'btn-on'; echo $label ?> periode_aksi"><?= strtoupper($t['aksi_bulan'])?></button></td>
                                <td><a href="index.php?p=periode&m=ebulan&id=<?= $t['id_periode_bulan'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a></td>
                            </tr>
                            <input type="hidden" name="" class="id_periode_tahun" value="<?= $t['id_periode_bulan']?>">
                            <input type="hidden" name="" class="aksi_tahun" value="<?= $t['aksi_bulan']?>">
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    const toggleBtn = document.getElementById('toggleBtn');
    const idPeriodeTahun = document.querySelectorAll('.id_periode_tahun');
    const aksiTahun = document.querySelectorAll('.aksi_tahun');
    const periodeAksi = document.querySelectorAll('.periode_aksi');
    idPeriodeTahun.forEach((v,i)=>{
        //console.log(v.value);
        console.log(aksiTahun[i].value)
        
        // $(document).ready(function(){
        //     loadAksi()
        // });
        console.log(periodeAksi[i].innerHTML);
        if(aksiTahun[i].value == "off"){
            periodeAksi[i].addEventListener('click',function(){
                $.ajax({
                    type:"POST",
                    url:`functions/index.php?r=updateActionBulan`,
                    data:{
                        id:v.value,
                        aksi:'on'
                    },
                    success:(res)=>{
                       window.location.href = 'index.php?p=periode&act=bulan'
                    }
                })
            })
        }else if(aksiTahun[i].value == "on"){
            periodeAksi[i].addEventListener('click',function(){
                $.ajax({
                    type:"POST",
                    url:`functions/index.php?r=updateActionBulan`,
                    data:{
                        id:v.value,
                        aksi:'off'
                    },
                    success:(res)=>{
                        window.location.href = 'index.php?p=periode&act=bulan'
                    }
                })
            })
        }

    })
</script>