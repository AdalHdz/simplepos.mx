<?php
    require("../conexion.php");
    
    $respuesta = array();
    $respuesta["detalleventas"] = array();

    if(isset($_POST['id'])){
        $uid = $_POST['id'];
        //$uid = "32";
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT tb_detalle_venta.idDetalleVenta as iddetalleventa, tb_productos.nombreProducto as nombreproducto, tb_detalle_venta.cantidad as cantidad FROM tb_detalle_venta LEFT JOIN tb_productos ON tb_detalle_venta.idProducto = tb_productos.idProducto WHERE tb_detalle_venta.idVentas = '$uid'";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["iddetalleventa"] = $row["iddetalleventa"];
            $tmp["nombreproducto"] = $row["nombreproducto"];
            $tmp["cantidad"] = $row["cantidad"];

            array_push($respuesta["detalleventas"], $tmp);
        }

        echo json_encode($respuesta);
    }
?>