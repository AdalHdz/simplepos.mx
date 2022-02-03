<?php
require("conexion.php");

if(isset ($_POST['nombre']) && isset ($_POST['user']) && isset ($_POST['pwd']) && isset ($_POST['correo']) && isset ($_POST['mac'])){
    $unombre=$_POST['nombre'];
    $uuser=$_POST['user'];
    $upwd=$_POST['pwd'];
    $ucorreo=$_POST['correo'];
    $umac=$_POST['mac'];
    $ufecha = date("Y-m-d");
    $ucaducidad = date("Y-m-d", strtotime($ufecha."+ 45 days"));

    $conexion=mysqli_connect($hostname,$username,$password,$database);
    
    $query = "SELECT mail FROM tb_usuario WHERE mail='$ucorreo' AND idStatusUsuario = '1'";

        $resultado = mysqli_query($conexion, $query) or die (mysqli_error());

        if(mysqli_fetch_array($resultado)){
            $data{'mensaje'} = "ESTE CORREO YA HA SIDO USADO";
            $data{'continua'} = "0";
            echo json_encode($data);
        }else{
            $consulta="INSERT INTO tb_usuario(nombre, nombreUsuario, pass, mail, idStatusUsuario, fechaReg, macAddress, fechaCaducidad) VALUES ('$unombre','$uuser','$upwd','$ucorreo','1','$ufecha','$umac','$ucaducidad')";
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
        }
}else{
    $data{'mensaje'} = "NO HAY DATOS";
    $data{'continua'} = "0"; 
    echo json_encode ($data);
}

mysqli_close($conexion);

?>
