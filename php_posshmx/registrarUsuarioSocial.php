<?php
require("conexion.php");

if(isset ($_POST['loginmail']) && isset ($_POST['nombre_usuario'])){
    $umail=$_POST['loginmail'];
    $uuser=$_POST['nombre_usuario'];

    $conexion=mysqli_connect($hostname,$username,$password,$database);
    
    $query = "SELECT idUsuario, nombre, mail FROM tb_usuario WHERE mail='$umail' AND idStatusUsuario = '1'";

        $resultado = mysqli_query($conexion, $query) or die (mysqli_error());

        if($ereg = mysqli_fetch_array($resultado)){
            $data{'idUsuario'}=$ereg['idUsuario'];
            $data{'nombre'}=$ereg['nombre'];
            $data{'mail'}=$ereg['mail'];
            $data{'mensaje'} = "USUARIO EXISTENTE";
            $data{'continua'} = "1";
            echo json_encode ($data);
        }else{
            $consulta="INSERT INTO tb_usuario(nombre, nombreUsuario, mail, idStatusUsuario) VALUES ('$uuser','$uuser','$umail','1')";
            $result = mysqli_query($conexion, $consulta) or die (mysqli_error());
            if($result){
                $nConsulta = "SELECT idUsuario, nombre, mail FROM tb_usuario WHERE mail='$umail' AND idStatusUsuario = '1'";
                $nResult = mysqli_query($conexion, $nConsulta) or die (mysqli_error());
                
                if($reg=mysqli_fetch_array($nResult)){
                    $data{'idUsuario'}=$reg['idUsuario'];
                    $data{'nombre'}=$reg['nombre'];
                    $data{'mail'}=$reg['mail'];
                    $data{'mensaje'} = "USUARIO CREADO";
                    $data{'continua'} = "1";
                    echo json_encode ($data);
                }else{
                    $data{'mensaje'} = "error de usuario";
                    $data{'continua'} = "0";
                    echo json_encode ($data);    
                }
            }else{
                $data{'mensaje'} = "ERROR";
                $data{'continua'} = "0";
                echo json_encode ($data);
            }         
        }
}else{
    $data{'mensaje'} = "NO HAY DATOS";
    $data{'continua'} = "0"; 
    echo json_encode ($data);
}

mysqli_close($conexion);
?>