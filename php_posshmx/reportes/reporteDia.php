<?php
    require("../conexion.php");
    
    $hoy = date('Y-m-d');

    $respuesta = array();
    $respuesta["ventas"] = array();

    //if(isset($_POST['codigo'])){
        //$ufechaventa = "2020-01-16";
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT tb_ventas.idVentas as idVentas, tb_ventas.fechaVenta as fechaVenta, tb_ventas.horaVenta as horaVenta, tb_metodo_pago.nombre as metodopago, tb_ventas.totalVenta as totalVenta FROM tb_ventas LEFT JOIN tb_metodo_pago ON tb_ventas.idMetodoPago = tb_metodo_pago.idMetodoPago WHERE fechaVenta = '$hoy'";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["idVentas"] = $row["idVentas"];
            $tmp["fechaVenta"] = $row["fechaVenta"];
            $tmp["horaVenta"] = $row["horaVenta"];
            $tmp["totalVenta"] = $row["totalVenta"];
            $tmp["metodopago"] = $row["metodopago"];

            array_push($respuesta["ventas"], $tmp);
        }

        echo json_encode($respuesta);
    
        //$data{'reporte'} = "1";
        //$data{'cdg_recuperacion'} = '';
        //$data{'var_seguimiento'} = "0";
        //echo json_encode( $respuesta, $data );
    //}
?>