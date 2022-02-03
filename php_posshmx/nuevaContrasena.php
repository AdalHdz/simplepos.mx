<?php
require("conexion.php");
    if(isset ($_POST['correo']) && isset ($_POST['contrasena'])){
        $uCorreo = $_POST['correo'];
        $uContrasena = $_POST['contrasena'];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database);
    
        $query2 = "UPDATE tb_usuario SET pass='$uContrasena', codRecuperacion = NULL WHERE mail='$uCorreo'";
        $resultado2 = mysqli_query($conexion, $query2) or die (mysqli_error());

        if($resultado2){
            $data{'response_message'} = "CORRECTO";    
            echo json_encode($data);
        }else{
            $data{'response_message'} = "ERROR";
            echo json_encode( $data );
        }
    }

mysqli_close($conexion);
?>