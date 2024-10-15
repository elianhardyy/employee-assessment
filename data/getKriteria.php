<?php
  $file_path = 'kriteria.json';
  $jsonString = file_get_contents($file_path);
  $jsonLen = json_decode($jsonString,true);

  foreach($jsonLen as $jl){
    echo '<h1>'.$jl['nama_kriteria'].'</h1>';
  }


?>