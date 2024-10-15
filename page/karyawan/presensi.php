<?php
$karyawan = mysqli_query($con,"SELECT * FROM karyawan");


?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1>Presensi</h1>
            </div>
            <div class="box-body">
                <div class="col-md-12" id="form-kehadiran">
                    <div class="col-md-4">
                        <label for="karyawan">Nama Karyawan</label>
                        <select name="karyawan" id="karyawan" class="form-control" onchange="kehadiranFunction()">
                            <option disabled selected value="">-- Pilih Karyawan --</option>
                            <?php
                            foreach($karyawan as $k){
                            ?>
                            <option value="<?= $k['id'] ?>"><?= $k['nama']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="kehadiran">Kehadiran</label>
                        <select name="kehadiran" id="kehadiran" class="form-control" onchange="kehadiranFunction()">
                            <option disabled selected value>-- Pilih Kehadiran --</option>
                            <option value="m">Masuk</option>
                            <option value="i">Izin</option>
                        </select>
                    </div>
                </div>
                <button id="btn-presensi" class="btn btn-primary" disabled>Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
    var kehadiran = document.getElementById("kehadiran");
    var formKehadiran = document.getElementById("form-kehadiran");
    var karyawan = document.getElementById("karyawan");
    
    function kehadiranFunction(){
        var newKet = document.createElement("div");
        if(kehadiran.value == "i" && karyawan.value !== ""){
            newKet.innerHTML += '<div class="col-md-4" id="keterangan"><label for="keterangan">Keterangan</label><input class="form-control" name="keterangan" placeholder="Keterangan" id="input-ket"></div>'
            formKehadiran.appendChild(newKet);
            //var inputket = document.getElementById("input-ket");
            //document.getElementById("btn-presensi").removeAttribute("disabled");
            // if($("#karyawan").val() != "" && $("#input-ket") != ""){
            // }
            document.getElementById("btn-presensi").removeAttribute("disabled");
            // $("#input-ket").keyup(()=>{
            //     document.getElementById("btn-presensi").removeAttribute("disabled");
            // })
        }
        else if(kehadiran.value == "m" && karyawan.value !== ""){
            document.getElementById("btn-presensi").removeAttribute("disabled");
            if(formKehadiran.hasChildNodes()){
                formKehadiran.removeChild(formKehadiran.children[2])
            }
        }
        else{
            document.getElementById("btn-presensi").setAttribute("disabled","disabled");
            if(formKehadiran.hasChildNodes()){
                formKehadiran.removeChild(formKehadiran.children[2])
            }
        }
        // $("#input-ket").keyup(()=>{
        //     if($("#input-ket").val() == ""){
        //         document.getElementById("btn-presensi").setAttribute("disabled","disabled");
        //     }
        // })
        // var inputket = document.getElementById("input-ket");
        // console.log(inputket);
        
    }
    // $("#karyawan").change(()=>{
    //     var karyawan = $("#karyawan").val();
    //     if(karyawan){
    //         // document.getElementById("btn-presensi").removeAttribute("disabled");
    //     }
    // })
    $.ajax({

    })
</script>