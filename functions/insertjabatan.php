<?php 
  
   $nama=$_POST['NJ'];
   $JD=$_POST['JD'];
     $cekagy=mysqli_query($con,"SELECT * from jabatan where nama_jabatan like '".$nama."'");
     if (mysqli_num_rows($cekagy) > 0) {
       echo "<script>alert('Data ".$nama." Sudah Tersedia!');window.location.href='index.php?p=jabatan'</script>";
     }else{
       $input=mysqli_query($con,"INSERT INTO jabatan values (null, '$nama','$JD')");
       if ($input == TRUE) {
         echo "<script>alert('Data ".$nama." Berhasil Ditambahkan!');window.location.href='index.php?p=jabatan'</script>";
       }else{
         echo "<script>alert('Data ".$nama." Gagal dieksekusi!');window.location.href='index.php?p=jabatan&act=create'</script>";
       }
     }
 

?>