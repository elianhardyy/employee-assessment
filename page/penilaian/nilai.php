<?php
$sk = $_GET['sk']; //kriteria
$idk =  $_GET['idk'];
$type = $_GET['type'];
$sql = "SELECT * FROM karyawan WHERE id='$idk'";
$query = mysqli_query($con, $sql);
$data = mysqli_fetch_array($query);
$idkar = $data['id'];

$yearsin = $_GET['year'];
$monthsin = $_GET['month'];

$tb_kriteria = 'tb_kriteria_' . (string)$type;
$idkrit = 'id_kriteria_' . (string)$type . '';
$tb_sub_kriteria = 'tb_sub_kriteria_' . (string)$type . '';
$id_kfk = 'id_kriteria_' . (string)$type . '_fk';
$namakriteriajenis = 'nama_kriteria_' . $type . '';
$namasubkriteriajenis = 'nama_sub_kriteria_' . $type . '';
$nilaisubkriteriajenis = 'nilai_sub_kriteria_' . $type . '';
$idsbk = 'id_sub_kriteria_' . $type . '';
$bulanfkbagian = 'id_bulan_fk_' . $type;
$tahunfkbagian = 'id_tahun_fk_' . $type;
$bobotkriteriajenis = 'bobot_' . $type;
$m1jenis = 'm1_' . $type;
$m2jenis = 'm2_' . $type;
$m3jenis = 'm3_' . $type;
$m4jenis = 'm4_' . $type;
$m5jenis = 'm5_' . $type;
$kriteriadata = mysqli_query($con, "SELECT * FROM $tb_kriteria WHERE $idkrit = '$sk'");
$fetchkriteria = mysqli_fetch_assoc($kriteriadata);

$papo = mysqli_query($con, "SELECT * FROM $tb_sub_kriteria RIGHT JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit WHERE $tb_sub_kriteria.$id_kfk='$sk'");
$papolen = mysqli_num_rows($papo);
if ($_SESSION['logged'] == 1) {
    $subkr = mysqli_query($con, "SELECT * FROM $tb_sub_kriteria RIGHT JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit LEFT JOIN penilaian_pemilik ON $tb_sub_kriteria.$idsbk = penilaian_pemilik.id_sub_kriteria_fk WHERE $tb_sub_kriteria.$id_kfk='$sk' AND penilaian_pemilik.id_karyawan_fk = $idkar AND penilaian_pemilik.id_bulan_fk_pemilik = $monthsin AND penilaian_pemilik.id_tahun_fk_pemilik = '$yearsin'");
    $nilai = 'nilai_akhir_pemilik';
}
if ($_SESSION['logged'] == 2) {
    // $subkr = mysqli_query($con,"SELECT * FROM sub_kriteria RIGHT JOIN test_kriteria ON sub_kriteria.id_test_kriteria_fk = test_kriteria.id_test_kriteria LEFT JOIN penilaian_koor_produksi ON sub_kriteria.id_sub_kriteria = penilaian_koor_produksi.id_sub_kriteria_fk WHERE sub_kriteria.id_test_kriteria_fk='$sk'");
    $subkr = mysqli_query($con, "SELECT * FROM $tb_sub_kriteria RIGHT JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit LEFT JOIN penilaian_koor_produksi ON $tb_sub_kriteria.$idsbk = penilaian_koor_produksi.id_sub_kriteria_fk WHERE $tb_sub_kriteria.$id_kfk='$sk' AND penilaian_koor_produksi.id_karyawan_fk = '$idkar' AND penilaian_koor_produksi.$bulanfkbagian = $monthsin AND penilaian_koor_produksi.$tahunfkbagian = '$yearsin'");
    $nilai = 'nilai_akhir_produksi';
}
if ($_SESSION['logged'] == 3) {
    $subkr = mysqli_query($con, "SELECT * FROM $tb_sub_kriteria RIGHT JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit LEFT JOIN penilaian_koor_gudang ON $tb_sub_kriteria.$idsbk = penilaian_koor_gudang.id_sub_kriteria_fk WHERE $tb_sub_kriteria.$id_kfk='$sk' AND penilaian_koor_gudang.id_karyawan_fk = $idkar AND penilaian_koor_gudang.$bulanfkbagian = $monthsin AND penilaian_koor_gudang.$tahunfkbagian = '$yearsin'");
    $nilai = 'nilai_akhir_gudang';
}
if ($_SESSION['logged'] == 4) {
    $subkr = mysqli_query($con, "SELECT * FROM $tb_sub_kriteria RIGHT JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit LEFT JOIN penilaian_koor_penjualan ON $tb_sub_kriteria.$idsbk = penilaian_koor_penjualan.id_sub_kriteria_fk WHERE $tb_sub_kriteria.$id_kfk='$sk' AND penilaian_koor_penjualan.id_karyawan_fk = $idkar AND penilaian_koor_penjualan.$bulanfkbagian = $monthsin AND penilaian_koor_penjualan.$tahunfkbagian = '$yearsin'");
    $nilai = 'nilai_akhir_penjualan';
}
$subkrlen = mysqli_num_rows($subkr);
$kriteria = mysqli_query($con, "SELECT $id_kfk FROM $tb_sub_kriteria GROUP BY $id_kfk");
$dtkri = "SELECT * FROM $tb_sub_kriteria JOIN $tb_kriteria ON $tb_sub_kriteria.$id_kfk = $tb_kriteria.$idkrit WHERE $tb_sub_kriteria.$id_kfk='$sk' LIMIT 1";
$p = mysqli_query($con, $dtkri);
$kar = mysqli_fetch_array($p);
$checknilai = mysqli_query($con, "SELECT * FROM penilaian WHERE id_karyawan_fk='$idk' AND id_test_kriteria_fk='$sk'");
?>

<style>
    input[type="radio"] {
        width: 30px;
        height: 30px;
        border-radius: 15px;
        border: 2px solid #1FBED6;
        background-color: white;
        -webkit-appearance: none;
        /*to disable the default appearance of radio button*/
        -moz-appearance: none;
    }

    input[type="radio"]:focus {
        /*no need, if you don't disable default appearance*/
        outline: none;
        /*to remove the square border on focus*/
    }

    input[type="radio"]:checked {
        /*no need, if you don't disable default appearance*/
        background-color: #1FBED6;
    }

    input[type="radio"]:checked~span:first-of-type {
        color: white;
    }

    label span:first-of-type {
        position: relative;
        left: -20px;
        font-size: 15px;
        color: #1FBED6;
    }

    label span {
        position: relative;
        top: -12px;
    }

    /* Custom CSS for Toastify to match Bootstrap styling */
    .bootstrap-toast .toastify {
        border-radius: 0.375rem;
        /* Match Bootstrap's border-radius */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.15);
        /* Light shadow */
        color: #ffffff;
        padding: 10px 20px;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <p>Nama Karyawan : <?= $data['nama']; ?></p>
                <p>Kriteria : <?= $kar[$namakriteriajenis] ?></p>
                <p>Bagian : <?= $type ?></p>

                <div class="sub-kriteria">
                    <table class="table table-bordered table-striped" id="tb-kr">
                        <thead>
                            <tr>
                                <th>Penilaian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($subkrlen == 0): ?>
                                <?php foreach ($papo as $key => $v): ?>
                                    <div class="penilaian">
                                        <tr>
                                            <td class="nsk active"><?= $v[$namasubkriteriajenis] ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    <input type="radio" class="rad1" value="1">
                                                    <p class="idr1" hidden><?= $v[$idsbk] ?></p>
                                                    <p class="idkr1" hidden><?= $v[$idkrit] ?></p>
                                                    <span>1</span><span><?= $v[$m1jenis] ?></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">
                                                    <input type="radio" class="rad2" value="2">
                                                    <p class="idr2" hidden><?= $v[$idsbk] ?></p>
                                                    <p class="idkr2" hidden><?= $v[$idkrit] ?></p>
                                                    <span>2</span><span><?= $v[$m2jenis] ?></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">
                                                    <input type="radio" class="rad3" value="3">
                                                    <p class="idr3" hidden><?= $v[$idsbk] ?></p>
                                                    <p class="idkr3" hidden><?= $v[$idkrit] ?></p>
                                                    <span>3</span><span><?= $v[$m3jenis] ?></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">
                                                    <input type="radio" class="rad4" value="4">
                                                    <p class="idr4" hidden><?= $v[$idsbk] ?></p>
                                                    <p class="idkr4" hidden><?= $v[$idkrit] ?></p>
                                                    <span>4</span><span><?= $v[$m4jenis] ?></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">
                                                    <input type="radio" class="rad5" value="5">
                                                    <p class="idr5" hidden><?= $v[$idsbk] ?></p>
                                                    <p class="idkr5" hidden><?= $v[$idkrit] ?></p>
                                                    <span>5</span><span><?= $v[$m5jenis] ?></span>
                                                </label>
                                            </td>
                                        </tr>
                                    </div>
                                    <input type="hidden" value="<?= $data['id'] ?>" class="id-karyawan">
                                    <input type="hidden" value="<?= $data['nama'] ?>" class="nama-karyawan">
                                    <input type="hidden" value="<?= $data['jabatan'] ?>" class="jabatan-karyawan">
                                    <input type="hidden" value="<?= $data['jenis_kelamin'] ?>" class="jk-karyawan">
                                    <?php //endif;
                                    ?>
                                <?php endforeach; ?>
                                <?php
                                $_SESSION['penilaian'] = [];

                                ?>
                                <!-- Modal Structure -->
                                <div id="modal" class="modal">
                                    <div class="modal-content">
                                        <span class="close-btn">&times;</span>
                                        <h2>Modal Title</h2>
                                        <p>This is a simple modal example.</p>
                                        <button id="closeModalBtn">Close</button>
                                    </div>
                                </div>
                            <?php else: ?>


                                <?php foreach ($subkr as $key => $v): ?>
                                    <?php
                                    $awal = 0.0;
                                    //$awalFormat = number_format($awal,1);
                                    //$total = $v[$nilaisubkriteriajenis] * $v[$nilai];
                                    $pp = ((number_format($v[$nilai], 1) / 5.0) * 100.0) / $subkrlen;
                                    $kk = $pp * $v[$bobotkriteriajenis];
                                    $awal += $kk;
                                    // echo $awal;
                                    ?>
                                    <tr>
                                        <td class="nsk active"><?= $v[$namasubkriteriajenis] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="radio" class="radUpdate1" value="1" <?php if ($v[$nilai] == 1 && $v['id_karyawan_fk'] == $idk && $v[$idsbk] == $v['id_sub_kriteria_fk']) {
                                                                                                        echo "checked";
                                                                                                    } else {
                                                                                                        echo " ";
                                                                                                    } ?>>
                                                <p class="idr1" hidden><?= $v[$idsbk] ?></p>
                                                <p class="idkr1" hidden><?= $v[$idkrit] ?></p>
                                                <span>1</span><span><?= $v[$m1jenis] ?></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">
                                                <input type="radio" class="radUpdate2" value="2" <?php if ($v[$nilai] == 2 && $v['id_karyawan_fk'] == $idk && $v[$idsbk] == $v['id_sub_kriteria_fk']) {
                                                                                                        echo "checked";
                                                                                                    } else {
                                                                                                        echo " ";
                                                                                                    } ?>>
                                                <p class="idr2" hidden><?= $v[$idsbk] ?></p>
                                                <p class="idkr2" hidden><?= $v[$idkrit] ?></p>
                                                <span>2</span><span><?= $v[$m2jenis] ?></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">
                                                <input type="radio" class="radUpdate3" value="3" <?php if ($v[$nilai] == 3 && $v['id_karyawan_fk'] == $idk && $v[$idsbk] == $v['id_sub_kriteria_fk']) {
                                                                                                        echo "checked";
                                                                                                    } else {
                                                                                                        echo " ";
                                                                                                    } ?>>
                                                <p class="idr3" hidden><?= $v[$idsbk] ?></p>
                                                <p class="idkr3" hidden><?= $v[$idkrit] ?></p>
                                                <span>3</span><span><?= $v[$m3jenis] ?></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">
                                                <input type="radio" class="radUpdate4" value="4" <?php if ($v[$nilai] == 4 && $v['id_karyawan_fk'] == $idk && $v[$idsbk] == $v['id_sub_kriteria_fk']) {
                                                                                                        echo "checked";
                                                                                                    } else {
                                                                                                        echo " ";
                                                                                                    } ?>>
                                                <p class="idr4" hidden><?= $v[$idsbk] ?></p>
                                                <p class="idkr4" hidden><?= $v[$idkrit] ?></p>
                                                <span>4</span><span><?= $v[$m4jenis] ?></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">
                                                <input type="radio" class="radUpdate5" value="5" <?php if ($v[$nilai] == 5 && $v['id_karyawan_fk'] == $idk && $v[$idsbk] == $v['id_sub_kriteria_fk']) {
                                                                                                        echo "checked";
                                                                                                    } else {
                                                                                                        echo " ";
                                                                                                    } ?>>
                                                <p class="idr5" hidden><?= $v[$idsbk] ?></p>
                                                <p class="idkr5" hidden><?= $v[$idkrit] ?></p>
                                                <span>5</span><span><?= $v[$m5jenis] ?></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <input type="hidden" value="<?= $data['id'] ?>" class="nama-karyawan">
                                    <input type="hidden" value="<?= $data['jabatan'] ?>" class="jabatan-karyawan">
                                    <?php //endif;
                                    ?>
                                    <?php ?>
                                <?php endforeach; ?>
                                <?php echo $awal; ?>
                                <input type="hidden" id="nilaiSemua" value="<?= $awal ?>">
                                <input type="hidden" id="penilaian-length" name="" value="<?= $subkrlen ?>">
                            <?php endif ?>
                        </tbody>
                        <input type="hidden" id="subkriteria-length" name="" value="<?php echo $papolen ?>">
                    </table>
                    <div id="opinion">

                    </div>
                    <br>
                </div>
                <p id="idk" hidden><?php echo $_GET['idk'] ?></p>
                <p id="krilen" hidden><?php echo mysqli_num_rows($kriteria); ?></p>
                <p id="subkrilen" hidden><?php echo mysqli_num_rows($subkr); ?></p>
                <input type="hidden" name="" id="kriteriabobot" value="<?php echo $fetchkriteria[$bobotkriteriajenis]; ?>">
                <p id="sk" hidden><?php echo $_GET['sk']; ?></p>
                <input type="hidden" name="" id="typeb" value="<?php echo $type ?>">
                <div class="json-only" id="json-only"></div>
                <input type="hidden" name="" id="month-single" value="<?= $monthsin ?>">
                <input type="hidden" name="" id="year-single" value="<?= $yearsin ?>">
                <script>
                    var penilaianLen = document.getElementById("penilaian-length");
                    var subKriteriaLen = document.getElementById("subkriteria-length");

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

                    var kriteria = document.querySelectorAll(".kriteria");
                    var prevBtn = document.querySelectorAll(".prev-btn");
                    var nextBtn = document.querySelectorAll(".next-btn");
                    var finishBtn = document.querySelectorAll(".finish-btn");
                    var jenisKriteria = document.getElementById("jenis-kriteria");
                    var nsk = document.querySelectorAll(".nsk");

                    //update();
                    var tbkr = document.getElementById("tb-kr");
                    var radio1 = document.querySelectorAll(".rad1");
                    var radio2 = document.querySelectorAll(".rad2");
                    var radio3 = document.querySelectorAll(".rad3");
                    var radio4 = document.querySelectorAll(".rad4");
                    var radio5 = document.querySelectorAll(".rad5");
                    var namkar = document.querySelectorAll(".id-karyawan");
                    var namakaryawans = document.querySelectorAll(".nama-karyawan");
                    var jkkaryawan = document.querySelectorAll(".jk-karyawan");
                    var jabkar = document.querySelectorAll(".jabatan-karyawan");

                    let arr1 = [0];

                    let idrs = [];
                    const idkrs = [];
                    const karyawan = [];
                    const jabatan = [];
                    const namakaryawansarr = [];
                    const jk = [];
                    const bagian = [];
                    // jika iki 5 maka checked
                    // jika localstorage index 0 is 5 == radio5 maka checked

                    radio1.forEach((v, i) => {
                        karyawan.push(namkar[i].value);
                        bagian.push(jabkar[i].value.split(" ")[1].toLowerCase());
                        jk.push(jkkaryawan[i].value);
                        jabatan.push(jabkar[i].value);
                        namakaryawansarr.push(namakaryawans[i].value)
                        radio1[i].addEventListener("click", (event) => {
                            arr1[i] = event.target.value;
                            idrs.push(idr1[i].innerHTML)
                            idkrs.push(idkr1[i].innerHTML)
                            radio2[i].checked = false;
                            radio3[i].checked = false;
                            radio4[i].checked = false;
                            radio5[i].checked = false;

                        })
                        radio2[i].addEventListener("click", (event) => {
                            arr1[i] = event.target.value;
                            idrs.push(idr2[i].innerHTML)
                            idkrs.push(idkr2[i].innerHTML)
                            radio1[i].checked = false;
                            radio3[i].checked = false;
                            radio4[i].checked = false;
                            radio5[i].checked = false;
                        })
                        radio3[i].addEventListener("click", (event) => {
                            arr1[i] = event.target.value
                            idrs.push(idr3[i].innerHTML)
                            idkrs.push(idkr3[i].innerHTML)
                            radio1[i].checked = false;
                            radio2[i].checked = false;
                            radio4[i].checked = false;
                            radio5[i].checked = false;
                        })
                        radio4[i].addEventListener("click", (event) => {
                            arr1[i] = event.target.value;
                            idrs.push(idr4[i].innerHTML)
                            idkrs.push(idkr4[i].innerHTML)
                            radio1[i].checked = false;
                            radio2[i].checked = false;
                            radio3[i].checked = false;
                            radio5[i].checked = false;
                        })
                        radio5[i].addEventListener("click", (event) => {
                            arr1[i] = event.target.value;
                            idrs.push(idr5[i].innerHTML)
                            idkrs.push(idkr5[i].innerHTML)
                            radio1[i].checked = false;
                            radio2[i].checked = false;
                            radio3[i].checked = false;
                            radio4[i].checked = false;

                        })
                    });
                    //[5,5,5,5,5] NILAI
                    //[1,2,3,4,5] SUB KRITERIA
                    //[1,1,1,1,1] KRITERIA
                    //[1,1,1,1,1] KARYAWAN
                    var currentActive = document.getElementById("sk").innerHTML;
                    var kriteriaLength = document.getElementById("krilen").innerHTML;
                    var idKaryawan = document.getElementById("idk").innerHTML;
                    var typebb = document.getElementById("typeb").value;
                </script>
                <?php if ($subkrlen == 0): ?>
                    <a class="btn btn-primary prev-btn" href="index.php?p=penilaian" id="back-kr">Kembali</a>
                    <button type="submit" class="btn btn-primary next-btn" id="next-kr">Selanjutnya</button>
                    <button type="submit" class="btn btn-primary finish-btn" id="finish-kr">Selesai</button>
                    <script>
                        var kriteriabobot = document.getElementById("kriteriabobot");
                        var back = document.getElementById("back-kr");
                        var next = document.getElementById("next-kr");
                        var prev = document.getElementById("prev-kr");
                        var finish = document.getElementById("finish-kr");
                        var monthSin = document.getElementById("month-single");
                        var yearSin = document.getElementById("year-single");
                        const penilaians = document.querySelectorAll('.penilaian');
                        let allFilled = true;


                        if (currentActive != 1) back.style.display = "none";
                        // ini diubah
                        //if(currentActive != 1) prev.style.display = "none";
                        // itu diubah
                        if (currentActive == kriteriaLength) next.style.display = "none";
                        if (currentActive != kriteriaLength) finish.style.display = "none";
                        if (currentActive == kriteriaLength) {
                            var opinion = document.getElementById("opinion");
                            var newSub = document.createElement("div");
                            newSub.innerHTML += '<label class="form-label">Komentar</label><textarea class="form-control" name="saran" placeholder="Komentar..." id="komentar"></textarea>'
                            opinion.appendChild(newSub);
                        }
                        var comment = document.getElementById("komentar");

                        finish.addEventListener("click", (e) => {
                            e.preventDefault();
                            if (arr1.length != Number(subKriteriaLen.value)) {
                                alert("masih ada penilaian yang kosong")
                                return
                            } else {
                                swal({
                                    title: "Apakah anda yakin sudah menilai?",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true
                                }).then((yes) => {
                                    if (yes) {
                                        $.ajax({
                                            type: "POST",
                                            url: `functions/index.php?r=addAssessment`,
                                            data: {
                                                nilai: arr1,
                                                skid: idrs,
                                                kid: idkrs,
                                                kar: karyawan,
                                                bag: bagian,
                                                bobot: kriteriabobot.value,
                                                year: yearSin.value,
                                                month: monthSin.value,

                                            },
                                            success: function(res) {
                                                $.ajax({
                                                    type: "POST",
                                                    url: `functions/index.php?r=insertFinishPenilaian`,
                                                    data: {
                                                        skid: idrs,
                                                        kid: idkrs,
                                                        kar: karyawan,
                                                        bag: bagian,
                                                        jab: jabatan,
                                                        comment: comment.value,
                                                        nama: namakaryawansarr,
                                                        jk: jk,
                                                        bobot: kriteriabobot.value,
                                                        year: yearSin.value,
                                                        month: monthSin.value,
                                                    },
                                                    success: (res) => {


                                                    },
                                                    error: (err) => {
                                                        console.log(err);
                                                    }
                                                })
                                            },
                                            error: function(error) {
                                                console.log("error")
                                            }
                                        })
                                        swal("Penilaian diproses", {
                                            icon: "success"
                                        }).then((ok) => {
                                            window.location.href = `index.php?p=penilaian`;
                                        })
                                    } else {
                                        swal("Gagal diproses")
                                    }
                                })
                            }

                        })
                        //$subkriteriat = mysqli_query($con,"SELECT * FROM penilaian_pemilik JOIN $tb_sub_kriteria ON penilaian_pemilik.id_sub_kriteria_fk = $tb_sub_kriteria.$idsbk WHERE $tb_sub_kriteria.$id_kfk = '$sk'");
                        next.addEventListener("click", (e) => {
                            currentActive++;

                            if (arr1.length != Number(subKriteriaLen.value)) {
                                alert("masih ada penilaian yang kosong")
                                currentActive -= 1
                                return
                            } else {
                                swal({
                                    title: "Apakah anda yakin ke penilaian selanjutnya?",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true
                                }).then((yes) => {
                                    if (yes) {
                                        $.ajax({
                                            type: "POST",
                                            url: `functions/index.php?r=addAssessment`,
                                            data: {
                                                nilai: arr1,
                                                skid: idrs,
                                                kid: idkrs,
                                                kar: karyawan,
                                                bag: bagian,
                                                bobot: kriteriabobot.value,
                                                year: yearSin.value,
                                                month: monthSin.value,
                                            },
                                            success: function(res) {


                                            },
                                            error: function(error) {
                                                console.log("error")
                                            }
                                        })
                                        var typeb = document.getElementById("typeb").value;

                                        swal("Penilaian diproses", {
                                            icon: "success"
                                        }).then((ok) => {
                                            window.location.href = `index.php?p=penilaian&act=nilai&sk=${currentActive}&idk=${idKaryawan}&type=${typeb}&year=${yearSin.value}&month=${monthSin.value}`

                                        })
                                    } else {
                                        swal("Gagal diproses")
                                    }
                                })

                            }

                        })

                        console.log(currentActive);
                        prev.addEventListener("click", (e) => {
                            currentActive--;
                            e.preventDefault();
                            var typeb = document.getElementById("typeb").value;
                            $.ajax({
                                type: "GET",
                                url: `index.php?p=penilaian&act=nilai&sk=${currentActive}&idk=<?php echo $idk ?>&type=${typeb}&year=${yearSin.value}&month=${monthSin.value}`,
                                success: function(res) {
                                    window.location.href = `index.php?p=penilaian&act=nilai&sk=${currentActive}&idk=<?php echo $idk ?>&type=${typeb}&year=${yearSin.value}&month=${monthSin.value}`
                                }
                            })

                        })
                    </script>
                <?php else: ?>
                    <a class="btn btn-primary prev-btn" href="index.php?p=penilaian" id="back-kr-after">Kembali</a>
                    <button class="btn btn-primary prev-btn" id="prev-kr-after">Sebelumnya</button>
                    <button type="submit" class="btn btn-primary next-btn" id="next-kr-after">Selanjutnya</button>
                    <button type="submit" class="btn btn-primary finish-btn" id="finish-kr-after">Selesai</button>
                    <script>
                        var radioUpdate1 = document.querySelectorAll(".radUpdate1");
                        var radioUpdate2 = document.querySelectorAll(".radUpdate2");
                        var radioUpdate3 = document.querySelectorAll(".radUpdate3");
                        var radioUpdate4 = document.querySelectorAll(".radUpdate4");
                        var radioUpdate5 = document.querySelectorAll(".radUpdate5");
                        var backAfter = document.getElementById("back-kr-after");
                        var nextAfter = document.getElementById("next-kr-after");
                        var prevAfter = document.getElementById("prev-kr-after");
                        var finishAfter = document.getElementById("finish-kr-after");
                        var kriteriabobot = document.getElementById("kriteriabobot");
                        var monthSin = document.getElementById("month-single");
                        var yearSin = document.getElementById("year-single");
                        let arrUpdate1 = [];
                        radioUpdate1.forEach((v, i) => {
                            karyawan.push(namkar[i].value);
                            jabatan.push(jabkar[i].value);
                            radioUpdate1[i].addEventListener("click", (event) => {
                                arrUpdate1.push(event.target.value);
                                console.log(event.target.value);
                                idrs.push(idr1[i].innerHTML)
                                idkrs.push(idkr1[i].innerHTML)
                                radioUpdate2[i].checked = false;
                                radioUpdate3[i].checked = false;
                                radioUpdate4[i].checked = false;
                                radioUpdate5[i].checked = false;
                            })
                            radioUpdate2[i].addEventListener("click", (event) => {
                                arrUpdate1.push(event.target.value);
                                idrs.push(idr2[i].innerHTML)
                                idkrs.push(idkr2[i].innerHTML)
                                radioUpdate1[i].checked = false;
                                radioUpdate3[i].checked = false;
                                radioUpdate4[i].checked = false;
                                radioUpdate5[i].checked = false;
                            })
                            radioUpdate3[i].addEventListener("click", (event) => {
                                arrUpdate1.push(event.target.value);
                                idrs.push(idr3[i].innerHTML)
                                idkrs.push(idkr3[i].innerHTML)
                                radioUpdate1[i].checked = false;
                                radioUpdate2[i].checked = false;
                                radioUpdate4[i].checked = false;
                                radioUpdate5[i].checked = false;
                            })
                            radioUpdate4[i].addEventListener("click", (event) => {
                                arrUpdate1.push(event.target.value);
                                idrs.push(idr4[i].innerHTML)
                                idkrs.push(idkr4[i].innerHTML)
                                radioUpdate1[i].checked = false;
                                radioUpdate2[i].checked = false;
                                radioUpdate3[i].checked = false;
                                radioUpdate5[i].checked = false;
                            })
                            radioUpdate5[i].addEventListener("click", (event) => {
                                arrUpdate1.push(event.target.value);
                                idrs.push(idr5[i].innerHTML)
                                idkrs.push(idkr5[i].innerHTML)
                                radioUpdate1[i].checked = false;
                                radioUpdate2[i].checked = false;
                                radioUpdate3[i].checked = false;
                                radioUpdate4[i].checked = false;
                                console.log(arrUpdate1);
                            })
                        });
                        var penilaianLen = document.getElementById("penilaian-length");
                        var subKriteriaLen = document.getElementById("subkriteria-length");
                        finishAfter.addEventListener("click", (e) => {
                            e.preventDefault();
                            console.log(arr1);
                            console.log(idrs);
                            console.log(idkrs);
                            console.log(karyawan);
                            $.ajax({
                                type: "POST",
                                url: `functions/index.php?r=updateAssessment`,
                                data: {
                                    nilai: arrUpdate1,
                                    skid: idrs,
                                    kid: idkrs,
                                    kar: karyawan,
                                    bag: jabatan,
                                    status: 'selesai',
                                },
                                success: function(res) {
                                    console.log("ini post")
                                    console.log(res)
                                    window.location.href = 'index.php?p=penilaian';
                                },
                                error: function(error) {
                                    console.log("error")
                                }
                            })
                        })
                        nextAfter.addEventListener("click", (e) => {
                            currentActive++;
                            e.preventDefault();
                            var status = "";
                            if (penilaianLen == 10) {
                                status = "sudah"
                            } else {
                                status = "proses"
                            }
                            $.ajax({
                                type: "POST",
                                url: `functions/index.php?r=updateAssessment`,
                                data: {
                                    nilai: arrUpdate1,
                                    skid: idrs,
                                    kid: idkrs,
                                    kar: karyawan,
                                    bag: jabatan,
                                    status: status,
                                },
                                success: function(res) {
                                    console.log("ini post")
                                    console.log(res)
                                    console.log(arr1);
                                },
                                error: function(error) {
                                    console.log("error")
                                }
                            })
                            var typeb = document.getElementById("typeb").value;
                            $.ajax({
                                type: "GET",
                                url: `index.php?p=penilaian&act=nilai&sk=${currentActive}&idk=${idKaryawan}&type=${typeb}&year=${yearSin.value}&month=${monthSin.value}`,
                                success: function(res) {
                                    console.log("ini get")
                                    console.log(res)
                                    window.location.href = `index.php?p=penilaian&act=nilai&sk=${currentActive}&idk=${idKaryawan}&type=${typeb}&year=${yearSin.value}&month=${monthSin.value}`
                                }
                            })
                        })

                        prevAfter.addEventListener("click", (e) => {
                            currentActive--;
                            e.preventDefault();
                            var typeb = document.getElementById("typeb").value;
                            $.ajax({
                                type: "GET",
                                url: `index.php?p=penilaian&act=nilai&sk=${currentActive}&idk=<?php echo $idk ?>&type=${typeb}&year=${yearSin.value}&month=${monthSin.value}`,
                                success: function(res) {
                                    window.location.href = `index.php?p=penilaian&act=nilai&sk=${currentActive}&idk=<?php echo $idk ?>&type=${typeb}&year=${yearSin.value}&month=${monthSin.value}`
                                }
                            })
                            //update();
                        })
                        if (currentActive != 1) backAfter.style.display = "none";
                        if (currentActive == 1) prevAfter.style.display = "none";
                        if (currentActive == kriteriaLength) nextAfter.style.display = "none";
                        if (currentActive != kriteriaLength) finishAfter.style.display = "none";
                    </script>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>

<script>
    jenisKriteria.value = typebb;
    jenisKriteria.onchange = function() {
        console.log("okesdsk")
        var jk = document.getElementById("jenis-kriteria")
        console.log(jk.value)
        var jenis = jk.value;
        $.ajax({
            type: "GET",
            url: `index.php?p=penilaian&act=nilai&sk=${currentActive}&idk=${idKaryawan}&type=${jenis}`,
            success: function(res) {
                console.log("ini get")
                console.log(res)
                //document.getElementById("jenis-kriteria").value = jk.value
                window.location.href = `index.php?p=penilaian&act=nilai&sk=${currentActive}&idk=${idKaryawan}&type=${jenis}`

            }
        })
    }
</script>