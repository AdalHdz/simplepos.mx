<?php
    require("../conexion.php");
    
    $respuesta = array();
    $respuesta["tb_categoria_producto"] = array();
    $respuesta["tb_subcategoria_producto"] = array();
    $respuesta["tb_productos"] = array();
    $respuesta["tb_ventas"] = array();
    $respuesta["tb_detalle_venta"] = array();

    if(isset($_POST['admin'])){
        $idAdmin = $_POST['admin'];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");
        
        //queryCategorias
        $query = "SELECT nombreCategoria, descripcion FROM tb_categoria_producto WHERE idAdmin = '$idAdmin'";
        $resultado = mysqli_query($conexion, $query);
        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["nombreCategoria"] = $row["nombreCategoria"];
            $tmp["descripcion"] = $row["descripcion"];
            array_push($respuesta["tb_categoria_producto"], $tmp);
        }
        
        //querySubcategorias
        $querySubcategorias = "SELECT nombreSubcategoria, descripcion, idCatProducto FROM tb_subcategoria_producto WHERE idAdmin = '$idAdmin'";
        $resultadoSubcategorias = mysqli_query($conexion, $querySubcategorias);
        while($row = mysqli_fetch_array($resultadoSubcategorias)){
            $tmp = array();
            $tmp["nombreSubcategoria"] = $row["nombreSubcategoria"];
            $tmp["descripcion"] = $row["descripcion"];
            $tmp["idCatProducto"] = $row["idCatProducto"];
            array_push($respuesta["tb_subcategoria_producto"], $tmp);
        }
        
        //queryProductos
        $queryProductos = "SELECT nombreProducto, descripcion, precioVenta, codigoProducto, codigoBarras, idCatProducto, idSubCatProducto, idStatusProducto, fechaRegistro, precioCompra, stock FROM tb_productos WHERE idAdmin = '$idAdmin'";
        $resultadoProductos = mysqli_query($conexion, $queryProductos);
        while($row = mysqli_fetch_array($resultadoProductos)){
            $tmp = array();
            $tmp["nombreProducto"] = $row["nombreProducto"];
            $tmp["descripcion"] = $row["descripcion"];
            $tmp["precioVenta"] = $row["precioVenta"];
            $tmp["codigoProducto"] = $row["codigoProducto"];
            $tmp["codigoBarras"] = $row["codigoBarras"];
            $tmp["idCatProducto"] = $row["idCatProducto"];
            $tmp["idSubCatProducto"] = $row["idSubCatProducto"];
            $tmp["idStatusProducto"] = $row["idStatusProducto"];
            $tmp["fechaRegistro"] = $row["fechaRegistro"];
            $tmp["precioCompra"] = $row["precioCompra"];
            $tmp["stock"] = $row["stock"];
            array_push($respuesta["tb_productos"], $tmp);
        }
        
        //queryVentas
        $queryVentas = "SELECT fechaVenta, horaVenta, idMetodoPago, totalVenta FROM tb_ventas WHERE idAdmin = '$idAdmin'";
        $resultadoVentas = mysqli_query($conexion, $queryVentas);
        while($row = mysqli_fetch_array($resultadoVentas)){
            $tmp = array();
            $tmp["fechaVenta"] = $row["fechaVenta"];
            $tmp["horaVenta"] = $row["horaVenta"];
            $tmp["idMetodoPago"] = $row["idMetodoPago"];
            $tmp["totalVenta"] = $row["totalVenta"];
            array_push($respuesta["tb_ventas"], $tmp);
        }
        
        //queryDetalleVenta
        $queryDetalleVentas = "SELECT idProducto, cantidad, idVentas FROM tb_detalle_venta WHERE idAdmin = '$idAdmin'";
        $resultadoDetalleVentas = mysqli_query($conexion, $queryDetalleVentas);
        while($row = mysqli_fetch_array($resultadoDetalleVentas)){
            $tmp = array();
            $tmp["idProducto"] = $row["idProducto"];
            $tmp["cantidad"] = $row["cantidad"];
            $tmp["idVentas"] = $row["idVentas"];
            array_push($respuesta["tb_detalle_venta"], $tmp);
        }
    }
    echo json_encode($respuesta);
?>