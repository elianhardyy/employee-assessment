<?php
$matrix = $_POST['nilai'];
$subkriteria = $_POST['subk'];

?>
<style>
    .tb-modal{
        position: absolute;
    }
</style>
<table class="tb-modal">
    <thead>
        <tr>
            <th>No</th>
            <th>Sub Kriteria</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;?>
        <?php foreach($subkriteria as $i=>$sk):?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $sk[$i] ?></td>
                <td><?= $matrix[$i] ?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<script>
    
</script>