<?php
    require("conexion.php");        

    $respuesta = array();
    $respuesta["adeudos"] = array();

    if(isset($_POST['idpredial'])){
        $uidpredial = $_POST['idpredial'];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT monto FROM tb_historial_pago_predial WHERE idPredial = '$uidpredial' AND idStatusPago = '2'";

        $resultado = mysqli_query($conexion, $query);
        
        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["monto"] = $row["monto"];            
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