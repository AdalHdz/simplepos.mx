<?php
require("../conexion.php");

if(isset ($_POST['nombre']) && isset($_POST['usuario'])){
    $unombre=$_POST['nombre'];
    $uidUsuario = $_POST['usuario'];
    $hoy = date('Y-m-d');
        
    $conexion=mysqli_connect($hostname,$username,$password,$database);
    
    $query = "UPDATE tb_productos SET idStatusProducto = 2 WHERE nombreProducto='$unombre'";
    $resultado = mysqli_query($conexion, $query) or die (mysqli_error());
    if($resultado){
        $consultaHistorial = "INSERT INTO tb_historial (idUsuario, idActividadHistorial, fechaRegistro) VALUES ('$uidUsuario', '2', '$hoy')";
        mysqli_query($conexion, $consultaHistorial) or die (mysql_error());
        
        $data{'mensaje'} = "PRODUCTO ELIMINADO";
        $data{'continua'} = "1";
        echo json_encode ($data);
    }else{
        $data{'mensaje'} = "ERROR AL ELIMINAR PRODUCTO";
        $data{'continua'} = "0";
        echo json_encode ($data);
    }     
}else{
    $data{'mensaje'} = "NO HAY DATOS";
    $data{'continua'} = "";
    echo json_encode ($data);
}
?>