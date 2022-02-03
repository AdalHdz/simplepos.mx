<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["turismo"] = array();            
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT idTurismo, titulo, descripcion, latitud, longitud, rutaImagen FROM tb_turismo";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["idTurismo"] = $row["idTurismo"];
            $tmp["titulo"] = utf8_encode($row["titulo"]);
            $tmp["descripcion"] = utf8_encode($row["descripcion"]);
            $tmp["latitud"] = $row["latitud"];
            $tmp["longitud"] = $row["longitud"];
            $tmp["rutaImagen"] = $row["rutaImagen"];

            array_push($respuesta["turismo"], $tmp);
        }

        echo json_encode($respuesta);
        
?>