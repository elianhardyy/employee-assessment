<?php
include "../../../config/connection.php";
//$kriteria=$_POST['kriteria-types'];
$nokriteria=$_POST['types'];
//echo $nokriteria;
    $subkriteria=$_POST['subkrit'];
    $nilaikriteria=$_POST['nilai'];
    $kategorikriteria=$_POST['kategori'];
    // $sql = "INSERT INTO test_kriteria VALUES (null,'$kriteria')";
    $idkriteria=$_POST['idkrit'];
    // $con->query($sql);
    // $reindex = "UPDATE test_kriteria SET id_test_kriteria = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)";
    // mysqli_query($con,$reindex);
    // //$insert_id = $con->insert_id;
    // $getkri = "SELECT * FROM test_kriteria ORDER BY id_test_kriteria DESC LIMIT 1";
    // $getkrit = mysqli_query($con,$getkri);
    // $arrkri = mysqli_fetch_array($getkrit);
    // $idkri = $arrkri['id_test_kriteria'];
    if($kategorikriteria == 'produksi'){
      //mysqli_query($con,"INSERT INTO tb_kriteria_produksi VALUES (null,'$kriteria')");
      //mysqli_query($con,"UPDATE tb_kriteria_produksi SET id_kriteria_produksi = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)");
      //$getkriproduksi = mysqli_query($con,"SELECT * FROM tb_kriteria_produksi ORDER BY id_kriteria_produksi DESC LIMIT 1");
      //$arrprod = mysqli_fetch_array($getkriproduksi);
      $idprod = $nokriteria;
      foreach($subkriteria as $index => $sk){
        $subk = $sk;
        $nsk = $nilaikriteria[$index];
        $idkr = $idkriteria[$index];
        //$sqlloop = "INSERT INTO tb_sub_kriteria_produksi VALUES (null,'$subk','$nsk','$idprod')";
        $sqledit = "UPDATE tb_sub_kriteria_produksi SET nama_sub_kriteria_produksi='$subk', nilai_sub_kriteria_produksi='$nsk' WHERE id_kriteria_produksi_fk = $idkr";
        mysqli_query($con,$sqledit);
      }
    }
    if($kategorikriteria == 'gudang'){
      //mysqli_query($con,"INSERT INTO tb_kriteria_gudang VALUES (null,'$kriteria')");
      //mysqli_query($con,"UPDATE tb_kriteria_gudang SET id_kriteria_gudang = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)");
      //$getkrigudang = mysqli_query($con,"SELECT * FROM tb_kriteria_gudang ORDER BY id_kriteria_gudang DESC LIMIT 1");
      //$arrgud = mysqli_fetch_array($getkrigudang);
      $idgud = $nokriteria;
      foreach($subkriteria as $index => $sk){
        $subk = $sk;
        $nsk = $nilaikriteria[$index];
        $idkr = $idkriteria[$index];
        //$sqlloop = "INSERT INTO tb_sub_kriteria_gudang VALUES (null,'$subk','$nsk','$idgud')";
        $sqledit = "UPDATE tb_sub_kriteria_gudang SET nama_sub_kriteria_gudang='$subk', nilai_sub_kriteria_gudang='$nsk' WHERE id_kriteria_gudang_fk = $idkr";
        mysqli_query($con,$sqledit);
      }
    }
    if($kategorikriteria == 'penjualan'){
      //mysqli_query($con,"INSERT INTO tb_kriteria_penjualan VALUES (null,'$kriteria')");
      //mysqli_query($con,"UPDATE tb_kriteria_penjualan SET id_kriteria_penjualan = (SELECT (@rownum := @rownum + 1) FROM (SELECT @rownum := 0) r)");
      //$getkripenjualan = mysqli_query($con,"SELECT * FROM tb_kriteria_penjualan ORDER BY id_kriteria_penjualan DESC LIMIT 1");
      //$arrpenj = mysqli_fetch_array($getkripenjualan);
      $idpenj = $nokriteria;
      foreach($subkriteria as $index => $sk){
        $subk = $sk;
        $nsk = $nilaikriteria[$index];
        $idkr = $idkriteria[$index];
        //$sqlloop = "INSERT INTO tb_sub_kriteria_penjualan VALUES (null,'$subk','$nsk','$idpenj')";
        $sqledit = "UPDATE tb_sub_kriteria_penjualan SET nama_sub_kriteria_penjualan='$subk', nilai_sub_kriteria_penjualan='$nsk' WHERE id_kriteria_penjualan_fk = $idkr";
        mysqli_query($con,$sqledit);
      }
    }
    echo "<script>window.location.href='index.php?p=criteria'</script>";
?>