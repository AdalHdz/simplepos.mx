<?php
require("conexion.php");

if(isset ($_POST['tipotramite']) && isset ($_POST['idusuario']) && isset ($_POST['correo']) && isset ($_POST['telefono']) && isset($_POST['rutaservidor'])){
    $utipotramite=$_POST['tipotramite'];
    $uidusuario=$_POST['idusuario'];
    $ucorreo=$_POST['correo'];
    $utelefono=$_POST['telefono'];
    $urutaservidor=$_POST['rutaservidor'];

    $conexion=mysqli_connect($hostname,$username,$password,$database);
    
    $consulta="INSERT INTO tb_tramites(idTipoTramite, idUsuario, correo, telefono, rutaServidor) VALUES ('$utipotramite','$uidusuario','$ucorreo','$utelefono','$urutaservidor')";
    $result = mysqli_query($conexion, $consulta) or die (mysqli_error());
    if($result){
        $data{'mensaje'} = "REPORTE INSERTADO";
        $data{'continua'} = "1";
        echo json_encode ($data);
    }else{
        $data{'mensaje'} = "FALLA AL INSERTAR REPORTE";
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