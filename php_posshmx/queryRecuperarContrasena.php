<?php

require("conexion.php");
    $uCorreo = $_POST['Correo'];
    $nContrasena = $_POST['Contrasena'];

    $conexion = mysqli_connect($hostname, $username, $password, $database);
    
    $query = "SELECT mail FROM tb_usuario WHERE mail='$uCorreo'";

    $resultado = mysqli_query($conexion, $query);

    if(mysqli_fetch_array($resultado)){
        $query2 =  "UPDATE tb_usuario SET pass='$nContrasena' WHERE mail='$uCorreo'";
        $resultado2 = mysqli_query($conexion, $query2);
        echo "<script type='text/javascript'>alert('Se añadió nueva contraseña');history.back();</script>";
    }else{
        echo "<script type='text/javascript'>alert('Correo Incorrecto');history.back();</script>";
    }
    
    //echo $correo, $nContrasena;
?>