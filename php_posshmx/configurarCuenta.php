<?php
require("conexion.php");

if(isset($_POST['nombre']) && isset ($_POST['nombreusuario']) && isset($_POST['correo']) && isset($_POST['idusuario'])){
    $uid = $_POST['idusuario'];
    $unombre=$_POST['nombre'];
    $uusuario = $_POST['nombreusuario'];
    $ucorreo = $_POST['correo'];

    $conexion=mysqli_connect($hostname,$username,$password,$database);

    $queryComprobarCorreo ="SELECT mail FROM tb_usuario WHERE mail = '$ucorreo' AND idStatusUsuario = '1' AND idUsuario != '$uid'";
    $resultadoComprobar = mysqli_query($conexion, $queryComprobarCorreo) or die (mysqli_error());
    
    if(mysqli_fetch_array($resultadoComprobar)){
        $data{'mensaje'} = "CORREO YA HA SIDO UTILIZADO";
        $data{'continua'} = "0";
        echo json_encode ($data);
    }else{
        $query = "UPDATE tb_usuario SET nombre = '$unombre', nombreUsuario = '$uusuario', mail = '$ucorreo' WHERE idUsuario ='$uid'";
        $resultado = mysqli_query($conexion, $query) or die (mysqli_error());
        if($resultado){
            $data{'mensaje'} = "USUARIO MODIFICADO";
            $data{'continua'} = "1";
            echo json_encode ($data);
        }else{
            $data{'mensaje'} = "ERROR AL MODIFICAR USUARIO";
            $data{'continua'} = "0";
            echo json_encode ($data);
        }     
    }
    }else{
        $data{'mensaje'} = "NO HAY DATOS";
        $data{'continua'} = "";
        echo json_encode ($data);
    }
?>