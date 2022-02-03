<?php
    require("conexion.php");
    
    $respuesta = array();
    $respuesta["reporteCiudadano"] = array();            
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT tb_reporte_ciudadano.idReporteCiudadano as sIdReporte, tb_reporte_ciudadano.direccion as sDireccion, tb_reporte_ciudadano.descripcion as sDescripcion, tb_reporte_ciudadano.rutaServidor as sRutaServidor, tb_tipo_reporte.nombreReporte as sNombreReporte, tb_reporte_ciudadano.latitud as sLatitud, tb_reporte_ciudadano.longitud as sLongitud, tb_status_reporte_ciudadano.nombre as sStatus FROM tb_reporte_ciudadano LEFT JOIN tb_tipo_reporte ON tb_reporte_ciudadano.idTipoRepote = tb_tipo_reporte.idTipoReporte LEFT JOIN tb_status_reporte_ciudadano on tb_reporte_ciudadano.idStatusReporteCiudadano = tb_status_reporte_ciudadano.idStatusReporteCiudadano";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["sIdReporte"] = $row["sIdReporte"];
            $tmp["sDireccion"] = utf8_encode($row["sDireccion"]);
            $tmp["sDescripcion"] = utf8_encode($row["sDescripcion"]);
            $tmp["sRutaServidor"] = $row["sRutaServidor"];
            $tmp["sNombreReporte"] = $row["sNombreReporte"];            
            $tmp["sLatitud"] = $row["sLatitud"];
            $tmp["sLongitud"] = $row["sLongitud"];            
            $tmp["sStatus"] = $row["sStatus"];            

            array_push($respuesta["reporteCiudadano"], $tmp);
        }

        echo json_encode($respuesta);
        
?>