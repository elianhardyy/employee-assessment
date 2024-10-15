<?php
$sk = $_GET['sk'];
$subkr = mysqli_query($con,"SELECT * FROM sub_kriteria JOIN test_kriteria ON sub_kriteria.id_test_kriteria_fk = test_kriteria.id_test_kriteria WHERE sub_kriteria.id_test_kriteria_fk='$sk'");
echo '
<table class="table table-bordered table-striped">
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
';
foreach($subkr as $v){
    echo '
    <tr>
        <td class="">'.$v['nama_sub_kriteria'].'</td>
        <td><input type="radio" class="rad1" value="1"><p class="idr1" hidden>'. $v['id_sub_kriteria'].'</p><p class="idkr1" hidden>'.$v['id_test_kriteria'].'</p>
        <td><input type="radio" class="rad2" value="2"><p class="idr2" hidden>'. $v['id_sub_kriteria'].'</p><p class="idkr2" hidden>'.$v['id_test_kriteria'].'</p>
        <td><input type="radio" class="rad3" value="3"><p class="idr3" hidden>'. $v['id_sub_kriteria'].'</p><p class="idkr3" hidden>'.$v['id_test_kriteria'].'</p>
        <td><input type="radio" class="rad4" value="4"><p class="idr4" hidden>'. $v['id_sub_kriteria'].'</p><p class="idkr4" hidden>'.$v['id_test_kriteria'].'</p>
    </tr>
    ';
}
echo '
</tbody>
                </table>
'
?>