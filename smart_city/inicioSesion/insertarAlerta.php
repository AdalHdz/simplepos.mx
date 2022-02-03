<?php
require("conexion.php");

if(isset ($_POST['direccion']) && isset ($_POST['usuario']) && isset ($_POST['hora'])){
    $udireccion=$_POST['direccion'];
    $uusuario=$_POST['usuario'];
    $uhora=$_POST['hora'];
    
    //$ulatitud=$_POST['latitud'];
    //$ulongitud=$_POST['longitud'];

    $conexion=mysqli_connect($hostname,$username,$password,$database);
    
    $consulta="INSERT INTO tb_alerta(direccion, idUsuario, hora) VALUES ('$udireccion','$uusuario','$uhora')";
    $result = mysqli_query($conexion, $consulta) or die (mysqli_error());
    if($result){
        $data{'mensaje'} = "ALERTA INSERTADA";
        $data{'continua'} = "1";
        echo json_encode ($data);
    }else{
        $data{'mensaje'} = "FALLA AL INSERTAR ALERTA";
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