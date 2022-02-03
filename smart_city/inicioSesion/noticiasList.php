<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["noticiaslist"] = array();      
    
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT titulo, descripcion, fecha, foto FROM tb_noticias";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["titulo"] = utf8_encode($row["titulo"]);
            $tmp["descripcion"] = utf8_encode($row["descripcion"]);
            $tmp["fecha"] = utf8_encode($row["fecha"]);
            $tmp["foto"] = $row["foto"];

            array_push($respuesta["noticiaslist"], $tmp);
        }

        echo json_encode($respuesta);         
?>