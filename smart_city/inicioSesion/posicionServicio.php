<?php
require("conexion.php");

if(isset ($_POST['latitud']) && isset ($_POST['longitud']) && isset ($_POST['idServicio'])){
    $ulatitud=$_POST['latitud'];
    $ulongitud=$_POST['longitud'];
    $uidServicio=$_POST['idServicio'];

    $conexion=mysqli_connect($hostname,$username,$password,$database);                

    $consulta="INSERT INTO tb_posicion(latitud, longitud, idServicio) VALUES ('$ulatitud','$ulongitud','$uidServicio')";
    $result = mysqli_query($conexion, $consulta) or die (mysqli_error());
        if($result){
            $data{'mensaje'} = "USUARIO CREADO";
            $data{'continua'} = "1";
            echo json_encode ($data);
        }else{
            $data{'mensaje'} = "ERROR";
            $data{'continua'} = "0";
            echo json_encode ($data);
        }         
        
}else{
    $data{'mensaje'} = "NO HAY DATOS";
    $data{'continua'} = "0"; 
    echo json_encode ($data);
}

mysqli_close($conexion);

?>
