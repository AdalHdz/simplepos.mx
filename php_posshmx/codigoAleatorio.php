<?php
 $fin='';
  mt_srand();
  for($i=1;$i<=4;$i++){
    $fin .= mt_rand (0, 9);  
  }
    
    $hoy = date('Y-m-d');

  echo $hoy;
    
?>