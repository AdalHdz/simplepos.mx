<?php
 
define('UPLOAD_DIR', '../docsTramites/');
$path_server = 'http://simplepos.mx/smart_city/docsTramites/';
$filename = $_POST['nombre']; 
if (move_uploaded_file($_FILES["documento"]["tmp_name"], UPLOAD_DIR.$filename)) {
    $results["mensaje"]='success';
    $results["path_server"]=$path_server.$filename;
  $json['datos'][]=$results;
  echo json_encode($json);
} else {
  $results["mensaje"]='fail';
  $results["path_server"]='N/A';
  $json['datos'][]=$results;
  echo json_encode($json);
}


?>