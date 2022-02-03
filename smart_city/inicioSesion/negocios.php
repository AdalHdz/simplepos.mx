<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["negocios"] = array();            
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT idNegocios, nombre, descripcion, latitud, longitud, rutaImagen, rutaLogo FROM tb_negocios";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["idNegocios"] = $row["idNegocios"];
            $tmp["nombre"] = utf8_encode($row["nombre"]);
            $tmp["descripcion"] = utf8_encode($row["descripcion"]);
            $tmp["latitud"] = $row["latitud"];
            $tmp["longitud"] = $row["longitud"];
            $tmp["rutaImagen"] = $row["rutaImagen"];
            $tmp["rutaLogo"] = $row["rutaLogo"];

            array_push($respuesta["negocios"], $tmp);
        }

        echo json_encode($respuesta);
        
?>