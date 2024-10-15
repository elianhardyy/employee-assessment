<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1>Penilaian</h1>
            </div>
            <div class="box-body">
                <p>1 - Tidak</p>
                <p>2 - Jarang</p>
                <p>3 - Sering</p>
                <p>4 - Selalu</p>
                
                <div class="col-md-8">
                    <div class="col-md-4">
                    <label for="">Nama Karyawan</label>
                    <select name="" id="karyawan" class="form-control" onchange="karyawanOnChange()" required>
                        <option value="" selected>-- Pilih Karyawan --</option>
                    <?php 
                        $sql = "select * from karyawan";
                        $karyawan = mysqli_query($con, $sql);
                        foreach($karyawan as $k):
                    ?>
                        <option value="<?= $k['id']?>"><?= $k['nama']?></option>
                    <?php endforeach; ?>
                    </select>
                    <p id="karyawanName" hidden></p>
                    </div>
                    <div class="col-md-4">
                        <label for="">Jabatan</label>
                        <select name="" id="" class="form-control"></select>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Penilaian</th>
                            <th>Penilaian</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="post">
                        <?php
                            $kriteria = mysqli_query($con,"SELECT * FROM test_kriteria JOIN sub_kriteria ON test_kriteria.id_test_kriteria = sub_kriteria.id_test_kriteria_fk");
                            $namakriteria = "";
                            foreach($kriteria as $k):
                                if($k['nama_test_kriteria'] != $namakriteria){
                                    $name = $k['nama_test_kriteria'];
                                    $namakriteria = $name;
                                }else{
                                    $name = "";
                                }
                        ?>
                        <tr>
                            <td><?php echo $name;?></td>
                            <td><?= $k['nama_sub_kriteria']?></td>
                            <td><input type="radio" class="rad1" value="1"><p class="idr1" hidden><?= $k['id_sub_kriteria']?></p><p class="idkr1" hidden><?= $k['id_test_kriteria']?></p></td>
                            <td><input type="radio" class="rad2" value="2"><p class="idr2" hidden><?= $k['id_sub_kriteria']?></p><p class="idkr2" hidden><?= $k['id_test_kriteria']?></p></td>
                            <td><input type="radio" class="rad3" value="3"><p class="idr3" hidden><?= $k['id_sub_kriteria']?></p><p class="idkr3" hidden><?= $k['id_test_kriteria']?></p></td>
                            <td><input type="radio" class="rad4" value="4"><p class="idr4" hidden><?= $k['id_sub_kriteria']?></p><p class="idkr4" hidden><?= $k['id_test_kriteria']?></p></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
                <button type="submit" class="btn btn-primary" name="save" id="sbt">Submit</button>
            </form>
            </div>
        </div>
    </div>
    <script>
        var radio1 = document.querySelectorAll(".rad1");
        var radio2 = document.querySelectorAll(".rad2");
        var radio3 = document.querySelectorAll(".rad3");
        var radio4 = document.querySelectorAll(".rad4");

        var idr1 = document.querySelectorAll(".idr1");
        var idr2 = document.querySelectorAll(".idr2");
        var idr3 = document.querySelectorAll(".idr3");
        var idr4 = document.querySelectorAll(".idr4");

        var idkr1 = document.querySelectorAll(".idkr1");
        var idkr2 = document.querySelectorAll(".idkr2");
        var idkr3 = document.querySelectorAll(".idkr3");
        var idkr4 = document.querySelectorAll(".idkr4");
        
        const arr1 = [];
        const idrs = [];
        const idkrs = [];
        function karyawanOnChange(){
            var namaKaryawan = document.getElementById("karyawan").value;
            var KaryawanP = document.getElementById("karyawanName");
            KaryawanP.innerHTML = namaKaryawan;
        }
        radio1.forEach((v,i)=>{
            radio1[i].addEventListener("click",(event)=>{
                 arr1.push(event.target.value);
                 idrs.push(idr1[i].innerHTML)
                 idkrs.push(idkr1[i].innerHTML)
                 //console.log(idr1[i].innerHTML);
                 radio2[i].checked = false;
                 radio3[i].checked = false;
                 radio4[i].checked = false;
            })
            radio2[i].addEventListener("click",(event)=>{
                arr1.push(event.target.value) 
                idrs.push(idr2[i].innerHTML)
                idkrs.push(idkr2[i].innerHTML)
                radio1[i].checked = false;
                 radio3[i].checked = false;
                 radio4[i].checked = false;
            })
            radio3[i].addEventListener("click",(event)=>{
                arr1.push(event.target.value) 
                idrs.push(idr3[i].innerHTML)
                idkrs.push(idkr3[i].innerHTML)
                radio1[i].checked = false;
                 radio2[i].checked = false;
                 radio4[i].checked = false;
            })
            radio4[i].addEventListener("click",(event)=>{
                arr1.push(event.target.value)
                idrs.push(idr4[i].innerHTML) 
                idkrs.push(idkr4[i].innerHTML)
                radio1[i].checked = false;
                 radio2[i].checked = false;
                 radio3[i].checked = false;
            })
        });
        var sbt = document.getElementById("sbt");
        sbt.addEventListener('click',function(e){
            e.preventDefault();
            $.ajax({
                type:'POST',
                url:'functions/tambahPenilaian.php',
                data:{
                    b1: arr1,
                    skid:idrs,
                    kid:idkrs,
                    k:$('#karyawanName').html()
                },
                success:function(res){
                    console.log(res);
                    //window.location.href = 'index.php?p=periode&act=nilai'
                }
            })
        })
    </script>
</div>