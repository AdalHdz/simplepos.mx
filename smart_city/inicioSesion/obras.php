<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["obras"] = array();            
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT idObras, titulo, descripcion, imagen, latitud, longitud FROM tb_obras";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["idObras"] = $row["idObras"];
            $tmp["titulo"] = utf8_encode($row["titulo"]);
            $tmp["descripcion"] = utf8_encode($row["descripcion"]);
            $tmp["imagen"] = $row["imagen"];
            $tmp["latitud"] = $row["latitud"];
            $tmp["longitud"] = $row["longitud"];

            array_push($respuesta["obras"], $tmp);
        }

        echo json_encode($respuesta);
        
?>