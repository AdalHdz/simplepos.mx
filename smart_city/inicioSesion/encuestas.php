<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["encuestaslist"] = array();      
    
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT nombre, link FROM tb_encuestas";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["nombre"] = utf8_encode($row["nombre"]);
            $tmp["link"] = $row["link"];

            array_push($respuesta["encuestaslist"], $tmp);
        }

        echo json_encode($respuesta);         
?>