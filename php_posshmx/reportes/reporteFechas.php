<?php
    require("../conexion.php");
    
    //$hoy = date('Y-m-d');
    $respuesta = array();
    $respuesta["ventas"] = array();

    if(isset($_POST['fechainicial']) && isset($_POST['fechafinal'])){
        $ufechainicial = $_POST['fechainicial'];
        $ufechafinal = $_POST['fechafinal'];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT tb_ventas.idVentas as idVentas, tb_ventas.fechaVenta as fechaVenta, tb_ventas.horaVenta as horaVenta, tb_metodo_pago.nombre as metodopago, tb_ventas.totalVenta as totalVenta FROM tb_ventas LEFT JOIN tb_metodo_pago ON tb_ventas.idMetodoPago = tb_metodo_pago.idMetodoPago WHERE fechaVenta BETWEEN '$ufechainicial' AND '$ufechafinal' ORDER BY idVentas ASC";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["idVentas"] = $row["idVentas"];
            $tmp["fechaVenta"] = $row["fechaVenta"];
            $tmp["horaVenta"] = $row["horaVenta"];
            $tmp["metodopago"] = $row["metodopago"];
            $tmp["totalVenta"] = $row["totalVenta"];

            array_push($respuesta["ventas"], $tmp);
        }

        echo json_encode($respuesta);
    }
?>