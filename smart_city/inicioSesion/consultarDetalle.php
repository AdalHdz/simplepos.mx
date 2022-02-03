<?php
    require("conexion.php");        

    $respuesta = array();
    $respuesta["adeudos"] = array();

    if(isset($_POST['idpredial'])){
        $uidpredial = $_POST['idpredial'];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT tb_historial_pago_predial.monto as cmonto, tb_historial_pago_predial.anho as canho, tb_status_pago.nombre as cstatuspago FROM tb_historial_pago_predial LEFT JOIN tb_status_pago ON tb_historial_pago_predial.idStatusPago = tb_status_pago.idStatusPago WHERE tb_historial_pago_predial.idStatusPago = '2' AND tb_historial_pago_predial.idPredial = '$id$uidpredial'";

        $resultado = mysqli_query($conexion, $query);
        
        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["cmonto"] = $row["cmonto"];            
            $tmp["canho"] = $row["canho"];            
            $tmp["cstatuspago"] = $row["cstatuspago"];            
            array_push($respuesta["adeudos"], $tmp);
        }

        echo json_encode($respuesta);            
        //while($row = mysqli_fetch_array($resultado)){
        //    $tmp = array();
        //    $tmp["monto"] = $row["monto"];            

        //    array_push($respuesta["adeudos"], $tmp);
        //}

        //echo json_encode($respuesta);
    
        //$data{'reporte'} = "1";
        //$data{'cdg_recuperacion'} = '';
        //$data{'var_seguimiento'} = "0";
        //echo json_encode( $respuesta, $data );
    }
?>