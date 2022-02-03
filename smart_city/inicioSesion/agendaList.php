<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["agendalist"] = array();  
    $fecha_actual = strtotime(date("Y-m-d H:i:00",time()));
    
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT titulo, fecha FROM tb_agenda WHERE fecha > '$fecha_actual'";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["titulo"] = utf8_encode($row["titulo"]);
            $tmp["fecha"] = $row["fecha"];

            array_push($respuesta["agendalist"], $tmp);
        }

        echo json_encode($respuesta);         
?>