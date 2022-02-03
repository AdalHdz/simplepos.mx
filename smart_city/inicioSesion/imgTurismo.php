<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["imgTurismo"] = array();

    if(isset($_POST['idRegistro'])){
        $uidRegistro = $_POST['idRegistro'];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");
                
            $query = "SELECT ruta FROM tb_img_turismo WHERE idTurismo = '$uidRegistro'";

            $resultado = mysqli_query($conexion, $query);

            while($row = mysqli_fetch_array($resultado)){
                $tmp = array();
                $tmp["ruta"] = $row["ruta"];                

                array_push($respuesta["imgTurismo"], $tmp);
            }        

        echo json_encode($respuesta);    
    }
?>