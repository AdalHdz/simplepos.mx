<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["agenda"] = array();  
    $fecha_actual = strtotime(date("Y-m-d H:i:00",time()));
    
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT titulo, descripcion, fecha, hora, lugar, rutaImagen FROM tb_agenda WHERE fecha >= '$fecha_actual'";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["titulo"] = utf8_encode($row["titulo"]);
            $tmp["descripcion"] = utf8_encode($row["descripcion"]);
            $tmp["fecha"] = $row["fecha"];
            $tmp["hora"] = $row["hora"];
            $tmp["lugar"] = utf8_encode($row["lugar"]);
            $tmp["rutaImagen"] = $row["rutaImagen"];

            array_push($respuesta["agenda"], $tmp);
        }

        echo json_encode($respuesta);         
?>