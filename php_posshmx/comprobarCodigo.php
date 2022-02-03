<?php
require("conexion.php");
$fin='';

    if(isset ($_POST['correo']) && isset ($_POST['codigo'])){
        $uCorreo = $_POST['correo'];
        $uCodigo = $_POST['codigo'];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database);
    
        $query = "SELECT mail FROM tb_usuario WHERE mail='$uCorreo' AND codRecuperacion = '$uCodigo'";

        $resultado = mysqli_query($conexion, $query) or die (mysqli_error());

        if(mysqli_fetch_array($resultado)){
            $data{'response_message'} = "CODIGO CORRECTO";
            $data{'var_seguimiento'} = "1";
            echo json_encode($data);
        }else{
            $data{'response_message'} = "VERIFIQUE CODIGO";
            $data{'var_seguimiento'} = "0";
            echo json_encode( $data );
        }
    }

mysqli_close($conexion);

?>