<?php
    require("../conexion.php");
    
    //$hoy = date('Y-m-d');
    $respuesta = array();
    $respuesta["ventas"] = array();

    if(isset($_POST['nombreproduct']) && isset($_POST['nombrecat']) && isset($_POST['nombresubcat'])){
        $unombrecategoria = $_POST['nombrecat'];
        $unombresubcategoria = $_POST['nombresubcat'];
        $unombreproducto = $_POST['nombreproduct'];
        
        $comp = "TODOS";
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");
        
        if($unombrecategoria == $comp){
            $query = "SELECT tb_productos.nombreProducto as nombreproducto, tb_productos.precioVenta as precioventa, tb_detalle_venta.cantidad as cantidad, tb_ventas.fechaVenta as fechaventa FROM tb_detalle_venta LEFT JOIN tb_productos ON tb_detalle_venta.idProducto = tb_productos.idProducto LEFT JOIN tb_ventas ON tb_detalle_venta.idVentas = tb_ventas.idVentas ORDER BY tb_productos.nombreProducto";

            $resultado = mysqli_query($conexion, $query);

            while($row = mysqli_fetch_array($resultado)){
                $tmp = array();
                $tmp["nombreproducto"] = $row["nombreproducto"];
                $tmp["precioventa"] = $row["precioventa"];
                $tmp["cantidad"] = $row["cantidad"];
                $tmp["fechaventa"] = $row["fechaventa"];

                array_push($respuesta["ventas"], $tmp);
            }
        }else if($unombresubcategoria == $comp){
            $queryid="SELECT idCategoriaProducto FROM tb_categoria_producto WHERE nombreCategoria = '$unombrecategoria'";
            $resultadoid = mysqli_query($conexion, $queryid);
            $rowid = mysqli_fetch_array($resultadoid);
            $tmpid = $rowid["idCategoriaProducto"];
            
            $query = "SELECT tb_productos.nombreProducto as nombreproducto, tb_productos.precioVenta as precioventa, tb_detalle_venta.cantidad as cantidad, tb_ventas.fechaVenta as fechaventa FROM tb_detalle_venta LEFT JOIN tb_productos ON tb_detalle_venta.idProducto = tb_productos.idProducto LEFT JOIN tb_ventas ON tb_detalle_venta.idVentas = tb_ventas.idVentas WHERE tb_productos.idCatProducto = '$tmpid' ORDER BY tb_productos.nombreProducto";

            $resultado = mysqli_query($conexion, $query);

            while($row = mysqli_fetch_array($resultado)){
                $tmp = array();
                $tmp["nombreproducto"] = $row["nombreproducto"];
                $tmp["precioventa"] = $row["precioventa"];
                $tmp["cantidad"] = $row["cantidad"];
                $tmp["fechaventa"] = $row["fechaventa"];

                array_push($respuesta["ventas"], $tmp);
            }
        }else if($unombreproducto == $comp){
            $queryid="SELECT idSubcategoriaProducto FROM tb_subcategoria_producto WHERE nombreSubcategoria = '$unombresubcategoria'";
            $resultadoid = mysqli_query($conexion, $queryid);
            $rowid = mysqli_fetch_array($resultadoid);
            $tmpid = $rowid["idSubcategoriaProducto"];
            
            $query = "SELECT tb_productos.nombreProducto as nombreproducto, tb_productos.precioVenta as precioventa, tb_detalle_venta.cantidad as cantidad, tb_ventas.fechaVenta as fechaventa FROM tb_detalle_venta LEFT JOIN tb_productos ON tb_detalle_venta.idProducto = tb_productos.idProducto LEFT JOIN tb_ventas ON tb_detalle_venta.idVentas = tb_ventas.idVentas WHERE tb_productos.idSubCatProducto = '$tmpid' ORDER BY tb_productos.nombreProducto";

            $resultado = mysqli_query($conexion, $query);

            while($row = mysqli_fetch_array($resultado)){
                $tmp = array();
                $tmp["nombreproducto"] = $row["nombreproducto"];
                $tmp["precioventa"] = $row["precioventa"];
                $tmp["cantidad"] = $row["cantidad"];
                $tmp["fechaventa"] = $row["fechaventa"];

                array_push($respuesta["ventas"], $tmp);
            }
        }else{
            $query = "SELECT tb_productos.nombreProducto as nombreproducto, tb_productos.precioVenta as precioventa, tb_detalle_venta.cantidad as cantidad, tb_ventas.fechaVenta as fechaventa FROM tb_detalle_venta LEFT JOIN tb_productos ON tb_detalle_venta.idProducto = tb_productos.idProducto LEFT JOIN tb_ventas ON tb_detalle_venta.idVentas = tb_ventas.idVentas WHERE tb_productos.nombreProducto = '$unombreproducto'";

            $resultado = mysqli_query($conexion, $query);

            while($row = mysqli_fetch_array($resultado)){
                $tmp = array();
                $tmp["nombreproducto"] = $row["nombreproducto"];
                $tmp["precioventa"] = $row["precioventa"];
                $tmp["cantidad"] = $row["cantidad"];
                $tmp["fechaventa"] = $row["fechaventa"];

                array_push($respuesta["ventas"], $tmp);
            }
        }

        echo json_encode($respuesta);    
    }
?>