<?php
$sk = $_GET['sk'];
$idk =  $_GET['idk'];
$type = $_GET['type'];
$sql = "SELECT * FROM karyawan WHERE id='$idk'";
$query = mysqli_query($con,$sql);
$data = mysqli_fetch_array($query);
$idkar = $data['id'];

$tb_kriteria = 'tb_kriteria_'.(string)$type;
$idkrit = 'id_kriteria_'.(string)$type.'';
$tb_sub_kriteria = 'tb_sub_kriteria_'.(string)$type.'' ;
$id_kfk = 'id_kriteria_'.(string)$type.'_fk';
$namakriteriajenis = 'nama_kriteria_'.$type.'';
$namasubkriteriajenis = 'nama_sub_kriteria_'.$type.'';
$nilaisubkriteriajenis = 'nilai_sub_kriteria_'.$type.'';
$idsbk = 'id_sub_kriteria_'.$type.'';
//$subkr = mysqli_query($con,"SELECT * FROM sub_kriteria RIGHT JOIN test_kriteria ON sub_kriteria.id_test_kriteria_fk = test_kriteria.id_test_kriteria LEFT JOIN penilaian ON sub_kriteria.id_sub_kriteria = penilaian.id_sub_kriteria_fk WHERE sub_kriteria.id_test_kriteria_fk='$sk'");
//$data['id']
if($_SESSION['logged'] == 1){
    //$subkr = mysqli_query($con,"SELECT * FROM sub_kriteria RIGHT JOIN test_kriteria ON sub_kriteria.id_test_kriteria_fk = test_kriteria.id_test_kriteria LEFT JOIN penilaian_pemilik ON sub_kriteria.id_sub_kriteria = penilaian_pemilik.id_sub_kriteria_fk WHERE sub_kriteria.id_test_kriteria_fk='$sk'");
    //$pen = mysqli_query($con,"SELECT * FROM penilaian_pemilik");
    //$getsub = [];
    $subkr = mysqli_query($con,"SELECT * FROM $tb_sub_kriteria RIGHT JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit LEFT JOIN penilaian_pemilik ON $tb_sub_kriteria.$idsbk = penilaian_pemilik.id_sub_kriteria_fk WHERE $tb_sub_kriteria.$id_kfk='$sk'");
    // if(mysqli_num_rows($pen) <= 0){
    //     $getsub = mysqli_fetch_array($subkr);
    //     //array_push($getsub,$getsube);
    // }
    // echo $getsub['id_karyawan_fk'];
    // if($getsub['id_karyawan_fk']){
    //     $subkr = mysqli_query($con,"SELECT * FROM penilaian_pemilik JOIN sub_kriteria ON penilaian_pemilik.id_sub_kriteria_fk = sub_kriteria.id_sub_kriteria JOIN test_kriteria ON sub_kriteria.id_test_kriteria_fk = test_kriteria.id_test_kriteria WHERE penilaian_pemilik.id_karyawan_fk = '$idk' AND sub_kriteria.id_test_kriteria_fk='$sk'");
    // }
    //else{
    //     $subkr = mysqli_query($con,"SELECT * FROM penilaian_pemilik JOIN sub_kriteria ON penilaian_pemilik.id_sub_kriteria_fk = sub_kriteria.id_sub_kriteria JOIN test_kriteria ON sub_kriteria.id_test_kriteria_fk = test_kriteria.id_test_kriteria WHERE sub_kriteria.id_test_kriteria_fk='$sk'");
    // }
    
    
    $nilai = 'nilai_akhir_pemilik';
}
if($_SESSION['logged'] == 2){
    // $subkr = mysqli_query($con,"SELECT * FROM sub_kriteria RIGHT JOIN test_kriteria ON sub_kriteria.id_test_kriteria_fk = test_kriteria.id_test_kriteria LEFT JOIN penilaian_koor_produksi ON sub_kriteria.id_sub_kriteria = penilaian_koor_produksi.id_sub_kriteria_fk WHERE sub_kriteria.id_test_kriteria_fk='$sk'");
    $subkr = mysqli_query($con,"SELECT * FROM $tb_sub_kriteria RIGHT JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit LEFT JOIN penilaian_koor_produksi ON $tb_sub_kriteria.$idsbk = penilaian_produksi.id_sub_kriteria_fk WHERE $tb_sub_kriteria.$id_kfk='$sk'");
    $nilai = 'nilai_akhir_produksi';
}
if($_SESSION['logged'] == 3){
    $subkr = mysqli_query($con,"SELECT * FROM $tb_sub_kriteria RIGHT JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit LEFT JOIN penilaian_koor_gudang ON $tb_sub_kriteria.$idsbk = penilaian_gudang.id_sub_kriteria_fk WHERE $tb_sub_kriteria.$id_kfk='$sk'");
    $nilai = 'nilai_akhir_gudang';
}
if($_SESSION['logged'] == 4){
    $subkr = mysqli_query($con,"SELECT * FROM $tb_sub_kriteria RIGHT JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit LEFT JOIN penilaian_koor_penjualan ON $tb_sub_kriteria.$idsbk = penilaian_penjualan.id_sub_kriteria_fk WHERE $tb_sub_kriteria.$id_kfk='$sk'");
    $nilai = 'nilai_akhir_penjualan';
}
//$kriteria = mysqli_query($con,"SELECT $id_kfk FROM $tb_sub_kriteria GROUP BY `id_test_kriteria_fk`");
$kriteria = mysqli_query($con,"SELECT $id_kfk FROM $tb_sub_kriteria GROUP BY $id_kfk");
$dtkri = "SELECT * FROM $tb_sub_kriteria JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit WHERE $tb_sub_kriteria.$id_kfk='$sk' LIMIT 1";
$p = mysqli_query($con,$dtkri);
$kar = mysqli_fetch_array($p);
//SELECT `id_test_kriteria_fk` FROM `sub_kriteria` GROUP BY `id_test_kriteria_fk`
$checknilai = mysqli_query($con,"SELECT * FROM penilaian WHERE id_karyawan_fk='$idk' AND id_test_kriteria_fk='$sk'");
// if(mysqli_num_rows($checknilai) > 0){
//     require '../../methods/get/nilai.php';
// }
//echo mysqli_num_rows($checknilai);
//echo $getsub['id_karyawan_fk'];
echo $type;
echo mysqli_num_rows($subkr);
?>
 <?php //if($v['v1']==1 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}?>
 <?php //if($v['v1']==2 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}?>
 <?php //if($v['v1']==3 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}?>
 <?php //if($v['v1']==4 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}?>
 <?php //if($v['v1']==5 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <p>Nama Karyawan : <?= $data['nama'];?></p>
                <p>Kriteria : <?= $kar[$namakriteriajenis]?></p>
                <p>Bagian : <?= $type ?></p>
                <select name="jenis-kriteria" id="jenis-kriteria" class="form-control">
                    <?if($_SESSION['logged'] == 1 || $_SESSION['logged'] == 2 || $_SESSION['logged'] == 3 || $_SESSION['logged'] == 4):?>
                        <option disabled>-------------------</option>
                    <?endif;?>
                    <?if($_SESSION['logged'] == 1 || $_SESSION['logged'] == 2):?>
                    <option value="produksi">Produksi</option>
                    <?endif;?>
                    <?if($_SESSION['logged'] == 1 || $_SESSION['logged'] == 3):?>
                    <option value="gudang">Gudang</option>
                    <?endif;?>
                    <?if($_SESSION['logged'] == 1 || $_SESSION['logged'] == 4):?>
                    <option value="penjualan">Penjualan</option>
                    <?endif;?>
                </select>
                <div class="sub-kriteria">
                    <table class="table table-bordered table-striped" id="tb-kr">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Penjelasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $sql = "SELECT * FROM penilaian WHERE id_karyawan_fk='$idk' AND id_test_kriteria_fk='$sk'";
                                $hp = mysqli_query($con,$sql);
                                // $paok = [];
                                // while($row = mysqli_fetch_assoc($hp)){
                                //     //echo $row['id_sub_kriteria_fk'];
                                //     array_push($paok,$row['id_sub_kriteria_fk']);
                                // }
                            ?>
                        <?php $papa = "";  

                        ?>
                        <?php foreach($subkr as $key=>$v):?>
                            <?php //if($v["id_karyawan_fk"] == $idk):?>
                            <tr>
                                <td class="nsk active"><?= $v[$namasubkriteriajenis]?></td>
                                <!--<td><input type="radio" class="rad1" value="1" <?php if($v[$nilai]==1 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}else{echo " ";}?>><p class="idr1" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr1" hidden><?= $v['id_test_kriteria']?></p></td>
                                <td><input type="radio" class="rad2" value="2" <?php if($v[$nilai]==2 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}else{echo " ";}?>><p class="idr2" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr2" hidden><?= $v['id_test_kriteria']?></p></td>
                                <td><input type="radio" class="rad3" value="3" <?php if($v[$nilai]==3 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}else{echo " ";}?>><p class="idr3" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr3" hidden><?= $v['id_test_kriteria']?></p></td>
                                <td><input type="radio" class="rad4" value="4" <?php if($v[$nilai]==4 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}else{echo " ";}?>><p class="idr4" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr4" hidden><?= $v['id_test_kriteria']?></p></td>
                                <td><input type="radio" class="rad5" value="5" <?php if($v[$nilai]==5 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}else{echo " ";}?>><p class="idr5" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr5" hidden><?= $v['id_test_kriteria']?></p></td>-->
                            </tr>
                            <tr>
                                <td><span style="margin-bottom: 2px;">1</span>&nbsp;<input type="radio" class="rad1" value="1" <?php if($v[$nilai]==1 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}else{echo " ";}?>><p class="idr1" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr1" hidden><?= $v['id_test_kriteria']?></p></td>
                                <td><p class="matrix1"></p></td>
                            </tr>
                            <tr>
                                <td><span>2</span>&nbsp;<input type="radio" class="rad2" value="2" <?php if($v[$nilai]==2 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}else{echo " ";}?>><p class="idr2" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr2" hidden><?= $v['id_test_kriteria']?></p></td>
                                <td><p class="matrix2"></p></td>
                            </tr>
                            <tr>
                                <td><span>3</span>&nbsp;<input type="radio" class="rad3" value="3" <?php if($v[$nilai]==3 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}else{echo " ";}?>><p class="idr3" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr3" hidden><?= $v['id_test_kriteria']?></p></td>
                                <td><p class="matrix3"></p></td>
                            </tr>
                            <tr>
                                <td><span>4</span>&nbsp;<input type="radio" class="rad4" value="4" <?php if($v[$nilai]==4 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}else{echo " ";}?>><p class="idr4" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr4" hidden><?= $v['id_test_kriteria']?></p></td>
                                <td><p class="matrix4"></p></td>
                            </tr>
                            <tr>
                                <td><span>5</span>&nbsp;<input type="radio" class="rad5" value="5" <?php if($v[$nilai]==5 && $v['id_karyawan_fk'] == $idk && $v['id_sub_kriteria'] == $v['id_sub_kriteria_fk']){ echo "checked";}else{echo " ";}?>><p class="idr5" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr5" hidden><?= $v['id_test_kriteria']?></p></td>
                                <td><p class="matrix5"></p></td>
                            </tr>
                            <input type="hidden" value="<?= $data['id']?>" class="nama-karyawan">
                            <?php //endif;?>
                            <?php ?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary prev-btn" id="prev-kr">Previous</button>
                <button type="submit" class="btn btn-primary next-btn" id="next-kr">Next</button>
            </div>
        </div>
    </div>
</div>
<p id="idk" hidden><?php echo $_GET['idk']?></p>
<p id="krilen" hidden><?php echo mysqli_num_rows($kriteria);?></p>
<p id="subkrilen" hidden><?php echo mysqli_num_rows($subkr);?></p>
<p id="sk" hidden><?php echo $_GET['sk'];?></p>
<input type="hidden" name="" id="typeb" value="<?php echo $type ?>">
<div class="json-only" id="json-only"></div>
<script>
    var next = document.getElementById("next-kr");
    var prev = document.getElementById("prev-kr");
    var kriteria = document.querySelectorAll(".kriteria");
                    
    var prevBtn = document.querySelectorAll(".prev-btn");
    var nextBtn = document.querySelectorAll(".next-btn");
    var jenisKriteria = document.getElementById("jenis-kriteria");
    var nsk = document.querySelectorAll(".nsk");
   
    //update();
    var tbkr = document.getElementById("tb-kr");
    var radio1 = document.querySelectorAll(".rad1");
    var radio2 = document.querySelectorAll(".rad2");
    var radio3 = document.querySelectorAll(".rad3");
    var radio4 = document.querySelectorAll(".rad4");
    var radio5 = document.querySelectorAll(".rad5");

    var idr1 = document.querySelectorAll(".idr1");
    var idr2 = document.querySelectorAll(".idr2");
    var idr3 = document.querySelectorAll(".idr3");
    var idr4 = document.querySelectorAll(".idr4");
    var idr5 = document.querySelectorAll(".idr5");

    var idkr1 = document.querySelectorAll(".idkr1");
    var idkr2 = document.querySelectorAll(".idkr2");
    var idkr3 = document.querySelectorAll(".idkr3");
    var idkr4 = document.querySelectorAll(".idkr4");
    var idkr5 = document.querySelectorAll(".idkr5");

    var namkar = document.querySelectorAll(".nama-karyawan");

    let arr1 = [0];
    let arr2 = [0];
    let arr3 = [0];
    let arr4 = [0];
    let arr5 = [0];
    let idrs = [];
    const idkrs = [];
    const karyawan = [];

    radio1.forEach((v,i)=>{
            karyawan.push(namkar[i].value);
            radio1[i].addEventListener("click",(event)=>{
                arr1[i]=event.target.value;
                idrs.push(idr1[i].innerHTML)
                idkrs.push(idkr1[i].innerHTML)
                //console.log(radio1[i].value);
                //console.log(idr1[i].innerHTML);
                radio2[i].checked = false;
                radio3[i].checked = false;
                radio4[i].checked = false;
                radio5[i].checked = false;
                //console.log(arr1);
                //console.log(idkrs);
            })
            radio2[i].addEventListener("click",(event)=>{
                arr1[i]=event.target.value; 
                idrs.push(idr2[i].innerHTML)
                idkrs.push(idkr2[i].innerHTML)
                radio1[i].checked = false;
                radio3[i].checked = false;
                radio4[i].checked = false;
                radio5[i].checked = false;
            })
            radio3[i].addEventListener("click",(event)=>{
                arr1[i] = event.target.value 
                idrs.push(idr3[i].innerHTML)
                idkrs.push(idkr3[i].innerHTML)
                radio1[i].checked = false;
                radio2[i].checked = false;
                radio4[i].checked = false;
                radio5[i].checked = false;
            })
            radio4[i].addEventListener("click",(event)=>{
                arr1[i] = event.target.value;
                idrs.push(idr4[i].innerHTML) 
                idkrs.push(idkr4[i].innerHTML)
                radio1[i].checked = false;
                radio2[i].checked = false;
                radio3[i].checked = false;
                radio5[i].checked = false;
            })
            radio5[i].addEventListener("click",(event)=>{
                arr1[i] = event.target.value;
                idrs.push(idr5[i].innerHTML) 
                idkrs.push(idkr5[i].innerHTML)
                radio1[i].checked = false;
                radio2[i].checked = false;
                radio3[i].checked = false;
                radio4[i].checked = false;
            })
        });
    var currentActive = document.getElementById("sk").innerHTML;
    var kriteriaLength = document.getElementById("krilen").innerHTML;
    var idKaryawan = document.getElementById("idk").innerHTML;
    var typebb = document.getElementById("typeb").value;
    jenisKriteria.value = typebb;
    jenisKriteria.onchange = function(){
        var jk = document.getElementById("jenis-kriteria")
        console.log(jk.value)
        var jenis = jk.value;
        $.ajax({
            type:"GET",
            url:`index.php?p=karyawan&act=detail&sk=${currentActive}&idk=${idKaryawan}&type=${jenis}`,
            success:function(res){
                console.log("ini get")
                console.log(res)
                //document.getElementById("jenis-kriteria").value = jk.value
                window.location.href = `index.php?p=karyawan&act=detail&sk=${currentActive}&idk=${idKaryawan}&type=${jenis}`
                
            }
        })
    }
    var matrix1 = document.querySelectorAll(".matrix1");
    var matrix2 = document.querySelectorAll(".matrix2");
    var matrix3 = document.querySelectorAll(".matrix3");
    var matrix4 = document.querySelectorAll(".matrix4");
    var matrix5 = document.querySelectorAll(".matrix5");
   

    next.addEventListener("click",(e)=>{
        currentActive++;
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:`functions/index.php?r=addAssessment`,
            data:{
                nilai:arr1,
                skid:idrs,
                //kid:idkrs,
                kar:karyawan
            },
            success:function(res){
                console.log("ini post")
                console.log(res)
            },
            error:function(error){
                console.log("error")
            }
        })
        var typeb = document.getElementById("typeb").value;
        $.ajax({
            type:"GET",
            url:`index.php?p=karyawan&act=detail&sk=${currentActive}&idk=${idKaryawan}&type=${typeb}`,
            success:function(res){
                console.log("ini get")
                console.log(res)
                window.location.href = `index.php?p=karyawan&act=detail&sk=${currentActive}&idk=${idKaryawan}&type=${typeb}`
            }
        })
        
        //update();
    })
    console.log(currentActive);
    prev.addEventListener("click",(e)=>{
        currentActive--;
        e.preventDefault();
        var typeb = document.getElementById("typeb").value;
        $.ajax({
            type:"GET",
            url:`functions/index.php?p=karyawan&act=detail&sk=${currentActive}&idk=<?php echo $idk?>&type=${typeb}`,
            success:function(res){
                window.location.href = `index.php?p=karyawan&act=detail&sk=${currentActive}&idk=<?php echo $idk?>&type=${typeb}`
            }
        })
        //update();
    })
    //console.log(currentActive);
    console.log(kriteriaLength);
    if(currentActive == 1) prev.style.display = "none";
    if(currentActive == kriteriaLength) next.style.display="none";

    var MainProduksi = [
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ]

    ]
    //penjualan
    var MainPenjualan = [
        [
        "Sebulan 0 - 1 transaksi",
	"Sebulan 2 - 4  transaksi",
	"Sebulan 5 - 7 transaksi",
	"Sebulan 8- 10 transaksi",
	"Sebulan > 10 transaksi",
        ],
        [
        "0% - 20% sesuai target penjualan",
	"21% - 40% sesuai target penjualan",
	"41% - 60% sesuai target penjualan",
	"61% - 80% sesuai target penjualan",
	"81% - 100% sesuai target penjualan",
        ],
        [
        "Tidak ada pelanggan baru dalam 1  bulan",
	"1 pelanggan baru dalam 1 bulan",
	"2 pelanggan baru dalam 1 bulan",
	"3 pelanggan baru dalam 1 bulan",
	">3 pelanggan baru dalam 1 bulan",
        ],
        [
        "0% - 1 % dari target omset yang di tentukan",
	"2% - 4% dari target omset yang di tentukan",
	"5 % - 7% dari target omset yang di tentukan",
	"8% - 10% dari target omset yang di tentukan",
	">10% dari target omset yang di tentukan",
        ],
        [
        "Tidak paham dengan produk yang dijual",
	"Kurang paham dengan produk yang dijual",
	"Cukup paham dengan produk yang dijual",
	"Sering paham dengan produk yang dijual",
	"Sangat paham dengan produk yang dijual",
        ],
        [
        "Tidak Baik",
	"Kurang Baik",
	"Cukup Baik",
	"Baik",
	"Sangat baik",
        ],
        [
    	"Tidak Baik",
	"Kurang Baik",
	"Cukup Baik",
	"Baik",
	"Sangat baik",
        ],
        [
        "Tidak Menarik",
	"Kurang Menarik",
	"Cukup Menarik",
	"Menarik",
	"Sangat Menarik"
        ],
        [
        "0% - 20% pelanggan puas",
	"21% - 40% pelanggan puas",
	"41% - 60% pelanggan puas",
	"61% - 80% pelanggan puas",
	"81% - 100% pelanggan puas",
        ],
        [
        ">3 komplain dalam 1 bulan",
	"3 komplain dalam 1 bulan",
	"2 komplain dalam 1 bulan",
	"1 komplain dalam 1 bulan",
	"Tidak ada komplain sama sekali dalam 1 bulan",
        ]

    ]
    var tipeb = document.getElementById("typeb");
    var subkrilen = document.getElementById("subkrilen").innerHTML;
    console.log(subkrilen)
    console.log("kriteria")
    console.log(kriteriaLength);
    if(tipeb.value == 'penjualan'){
        for(var i = 0; i < subkrilen; i++){
            for(var j = 0; j < MainPenjualan[i].length; j++ ){
                // console.log(MainPenjualan[i][1]);
                matrix1.forEach((v,i)=>{
                    // jika setiap currentactive bertambah 1 maka i + 1;
                    // jika setiap currentactive berkurang 1 maka i - 1;
                    if(currentActive){

                    }
                    matrix1[i].innerHTML = MainPenjualan[i][0];
                    matrix2[i].innerHTML = MainPenjualan[i][1];
                    matrix3[i].innerHTML = MainPenjualan[i][2];
                    matrix4[i].innerHTML = MainPenjualan[i][3];
                    matrix5[i].innerHTML = MainPenjualan[i][4];
                })
            }
        }
    }
    //gudang
    var MainGudang = [
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ],
        [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
        ]

    ]
 
    //penjualan
    var penjualanSK1 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var penjualanSK2 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var penjualanSK3 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var penjualanSK4 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var penjualanSK5 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var penjualanSK6 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var penjualanSK7 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var penjualanSK8 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var penjualanSK9 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var penjualanSK10 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    //gudang
    var gudangSK1 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var gudangSK2 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var gudangSK3 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var gudangSK4 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var gudangSK5 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var gudangSK6 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var gudangSK7 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var gudangSK8 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var gudangSK9 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
    var gudangSK10 = [
        "81% - 100% produk cacat",
        "61% - 80% produk cacat",
        "41% - 60% produk cacat",
        "21% - 40% produk cacat",
        "0% - 20% produk cacat",
    ] 
</script>
