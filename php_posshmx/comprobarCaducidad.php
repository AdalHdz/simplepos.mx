<?php
    require("conexion.php");
    
    if(isset($_POST["user"]) && isset($_POST["pwd"])){
        $user=$_POST['user'];
	    $pwd=$_POST['pwd'];
        $shoy = date("Y-m-d");
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT idUsuario, nombre, nombreUsuario, pass, mail, macAddress, fechaCaducidad FROM tb_usuario WHERE nombreUsuario= '{$user}' AND pass = '{$pwd}' AND idStatusUsuario = '1'";

        $resultado = mysqli_query($conexion, $query);

        if($row = mysqli_fetch_array($resultado)){
            $idUsuario = $row["idUsuario"];
            $nombre = $row["nombre"];
            $nombreUsuario = $row["nombreUsuario"];
            $pass = $row["pass"];
            $mail = $row["mail"];
            $macAddress = $row["macAddress"];
            $fechaCaducidad = $row["fechaCaducidad"];                                   
            //$tmpnombre = $shoy;
            
            $data{'idUsuario'} = $idUsuario;
            $data{'nombre'} = $nombre;
            $data{'nombreUsuario'} = $nombreUsuario;
            $data{'pass'} = $pass;
            $data{'mail'} = $mail;
            $data{'macAddress'} = $macAddress;
            $data{'fechaCaducidad'} = $fechaCaducidad;
            $data{'hoy'} = $shoy;            
            $data{'continua'} = "1";

            echo json_encode($data);    
        }else{
            $data{'idUsuario'} = "";
            $data{'nombre'} = "";
            $data{'nombreUsuario'} = "";
            $data{'pass'} = "";
            $data{'mail'} = "";
            $data{'macAddress'} = "";
            $data{'fechaCaducidad'} = "";
            $data{'hoy'} = "";
            $data{'continua'} = "0";
            echo json_encode($data);
        }

    }
?>