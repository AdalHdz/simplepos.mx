<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["directoriolist"] = array();      
    
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT nombre, cargo, telefono, correo, foto, idDependencia FROM tb_directorio";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["nombre"] = utf8_encode($row["nombre"]);
            $tmp["cargo"] = utf8_encode($row["cargo"]);
            $tmp["telefono"] = utf8_encode($row["telefono"]);
            $tmp["correo"] = utf8_encode($row["correo"]);
            $tmp["foto"] = utf8_encode($row["foto"]);
            $tmp["idDependencia"] = utf8_encode($row["idDependencia"]);            

            array_push($respuesta["directoriolist"], $tmp);
        }

        echo json_encode($respuesta);         
?>