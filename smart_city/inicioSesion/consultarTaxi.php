<?php
    require("conexion.php");
    
    if(isset($_POST["qr"])){
        $uqr=$_POST['qr'];	   
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT nombre, placa, foto FROM tb_taxis WHERE qr= '{$uqr}'";

        $resultado = mysqli_query($conexion, $query);

        if($row = mysqli_fetch_array($resultado)){
            $nombre = $row["nombre"];
            $placa = $row["placa"];
            $foto = $row["foto"];        
            //$tmpnombre = $shoy;
            
            $data{'nombre'} = $nombre;
            $data{'placa'} = $placa;
            $data{'foto'} = $foto;            
            $data{'continua'} = "1";

            echo json_encode($data);    
        }else{
            $data{'nombre'} = "";
            $data{'placa'} = "";
            $data{'foto'} = "";            
            $data{'continua'} = "0";
            echo json_encode($data);
        }

    }
?>