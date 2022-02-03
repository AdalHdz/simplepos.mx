<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["turismolist"] = array();      
    
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT titulo, direccion FROM tb_turismo";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["titulo"] = utf8_encode($row["titulo"]);
            $tmp["direccion"] = utf8_encode($row["direccion"]);

            array_push($respuesta["turismolist"], $tmp);
        }

        echo json_encode($respuesta);         
?>