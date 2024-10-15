<?php
$id = $_GET['id'];
$sql = "SELECT * FROM karyawan WHERE id='$id'";
$query = mysqli_query($con,$sql);
$data = mysqli_fetch_array($query);
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">

            </div>
            <div class="box-body">
                <p>Nama Karyawan : <?= $data['nama']?></p>
                <p>Nama Jabatan : <?= $data['jabatan']?></p>
                <?php
                    $kriteria = mysqli_query($con,"SELECT * FROM test_kriteria");
                    $n = 1;
                    
                    foreach($kriteria as $i=>$val):
                        if($i == 0):
                ?>
                        <p class="kriteria active"><?= $val['nama_test_kriteria']?></p>
                        
                    <?php
                    continue; 
                    endif; ?>
                        <p class="kriteria"><?= $val['nama_test_kriteria']?></p>
                <?php endforeach;?>
                <?php  
                    $subk = mysqli_query($con,"SELECT * FROM sub_kriteria JOIN test_kriteria ON sub_kriteria.id_test_kriteria_fk = test_kriteria.id_test_kriteria WHERE sub_kriteria.id_test_kriteria_fk='$n'");
                            // $y = mysqli_num_rows($subk);
                            // echo $y;

                        
                    ?>
                    <div class="sub-kriteria">
                        <table class="table table-bordered table-striped" id="tb-kr">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($subk as $sk=>$v):?>
                                <tr>
                                    <td class="nsk active"><?= $v['nama_sub_kriteria']?></td>
                                    <td><input type="radio" class="rad1" value="1"><p class="idr1" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr1" hidden><?= $v['id_test_kriteria']?></p></td>
                                    <td><input type="radio" class="rad2" value="2"><p class="idr2" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr2" hidden><?= $v['id_test_kriteria']?></p></td>
                                    <td><input type="radio" class="rad3" value="3"><p class="idr3" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr3" hidden><?= $v['id_test_kriteria']?></p></td>
                                    <td><input type="radio" class="rad4" value="4"><p class="idr4" hidden><?= $v['id_sub_kriteria']?></p><p class="idkr4" hidden><?= $v['id_test_kriteria']?></p></td>
                                </tr>
                                <input type="hidden" value="<?= $data['id']?>" class="nama-karyawan">
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="sub-k">
                        <!-- php url -->
                    </div>
                    <button class="btn btn-primary prev-btn" id="prev-kr">Previous</button>
                    <button type="submit" class="btn btn-primary next-btn" id="next-kr">Next</button>
                    
            </div>
        </div>
    </div>
</div>
<script lang="ts">
    var next = document.getElementById("next-kr");
    var prev = document.getElementById("prev-kr");
    var kriteria = document.querySelectorAll(".kriteria");
                    
    var prevBtn = document.querySelectorAll(".prev-btn");
    var nextBtn = document.querySelectorAll(".next-btn");
    
    var nsk = document.querySelectorAll(".nsk");
    var currentActive = 0;
    //update();
    var tbkr = document.getElementById("tb-kr");
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

    var namkar = document.querySelectorAll(".nama-karyawan");
    
    let arr1 = [0];
    let arr2 = [0];
    let arr3 = [0];
    let arr4 = [0];
    let idrs = [];
    const idkrs = [];
    const karyawan = [];
    radio1.forEach((v,i)=>{
            //karyawan.push(namkar[i].value);
            radio1[i].addEventListener("click",(event)=>{
                 arr1[i]=event.target.value;
                 idrs.push(idr1[i].innerHTML)
                 idkrs.push(idkr1[i].innerHTML)
                 
                 //console.log(idr1[i].innerHTML);
                 radio2[i].checked = false;
                 radio3[i].checked = false;
                 radio4[i].checked = false;
            })
            radio2[i].addEventListener("click",(event)=>{
                arr2[i]=event.target.value; 
                idrs.push(idr2[i].innerHTML)
                idkrs.push(idkr2[i].innerHTML)
                radio1[i].checked = false;
                 radio3[i].checked = false;
                 radio4[i].checked = false;
            })
            radio3[i].addEventListener("click",(event)=>{
                arr3[i] = event.target.value 
                idrs.push(idr3[i].innerHTML)
                idkrs.push(idkr3[i].innerHTML)
                radio1[i].checked = false;
                 radio2[i].checked = false;
                 radio4[i].checked = false;
            })
            radio4[i].addEventListener("click",(event)=>{
                arr4[i] = event.target.value;
                idrs.push(idr4[i].innerHTML) 
                idkrs.push(idkr4[i].innerHTML)
                radio1[i].checked = false;
                 radio2[i].checked = false;
                 radio3[i].checked = false;
            })
        });
    
    next.addEventListener("click",(e)=>{
        
        currentActive++;
        e.preventDefault(); 
        $.ajax({
            type:"GET",
            url:`index.php?p=karyawan&act=detail&sk=${currentActive+1}&idk=<?php echo $id;?>`,
            success:function(res){
                //$(".sub-k").html(res);
                //console.log(res);
                window.location.href = `index.php?p=karyawan&act=detail&sk=${currentActive+1}&idk=<?php echo $id;?>`;
            },
            error:function(){
                console.log("error");
            }
        })
        $.ajax({
            type:"POST",
            url:'functions/index.php?r=addAssessment',
            data:{
                v1:arr1,
                v2:arr2,
                v3:arr3,
                v4:arr4,
                skid:idrs,
                kid:idkrs,
                kar:karyawan
            },
            success:function(res){
                console.log(res);
            }
        })
        //console.log(currentActive);
        update();
    })
    prev.addEventListener("click",(e)=>{
        currentActive--;
        e.preventDefault();
        $.ajax({
            type:"GET",
            url:`functions/index.php?r=getSubK&sk=${currentActive + 1}`,
            success:function(res){
                if(currentActive == 0){
                    $(".sub-k").html("<p hidden></p>");
                   
                }
                if(currentActive > 0){
                    $(".sub-k").html(res);
                }
            }
        });
        update();
    })
    prev.style.display = "none";
    function delsubKriteria(){
        for(var i = 0; i<nsk.length; i++){
            nsk[i].classList.remove("active");
        }
    }
    function addsubKriteria(){
        for(var i = 0; i<nsk.length; i++){
            nsk[i].classList.add("active");
        }
    }
    function update(){
        if(currentActive >= 1){
            delsubKriteria();
            tbkr.setAttribute("hidden","hidden")
        }
        if(currentActive == 0){
            addsubKriteria();
            tbkr.removeAttribute("hidden");
        }
        kriteria.forEach((v,i)=>{
            if(i === currentActive){ 
                v.classList.add("active");
                //addsubKriteria();
            }
            else{
                prev.style.display = "inline";
                v.classList.remove("active");
            } 
        })
        if(currentActive+1 == kriteria.length) next.style.display = "none";
        else next.style.display = "inline";
        if(currentActive == 0) prev.style.display = "none";
    }
</script>