<?php
    require("../conexion.php");

    //$hoy = date('Y-m-d');        

    //$hora = date('H:i:s');
    
    if(isset($_POST['idproducto']) && isset($_POST['nombreproducto']) && isset($_POST['descripcion']) && isset($_POST['precioventa']) && isset($_POST['codigoproducto']) && isset($_POST['codigobarras']) && isset($_POST['idcatproducto']) && isset($_POST['idsubcatproducto']) && isset($_POST['idstatusproducto']) && isset($_POST['fecharegistro']) && isset($_POST['admin'])){
        //tb_productos
        $idproducto = $_POST['idproducto'];
        $nombreproducto = $_POST['nombreproducto'];
        $descripcion = $_POST['descripcion'];
        $precioventa = $_POST['precioventa'];
        $codigoproducto = $_POST['codigoproducto'];
        $codigobarras = $_POST['codigobarras'];
        $idcatproducto = $_POST['idcatproducto'];
        $idsubcatproducto = $_POST['idsubcatproducto'];
        $idstatusproducto = $_POST['idstatusproducto'];
        $fecharegistro = $_POST['fecharegistro'];
        $preciocompra = $_POST['preciocompra'];
        $stock = $_POST['stock'];
        //tb_subcategoria
        $sidsubcategoria = $_POST['sidsubcategoria'];
        $snombresubcategoria = $_POST['snombresubcategoria'];
        $sdescripcion = $_POST['sdescripcion'];
        $sidcatproducto = $_POST['sidcatproducto'];
        //tb_categoria
        $cidcategoria = $_POST['cidcategoria'];
        $cnombrecategoria = $_POST['cnombrecategoria'];
        $cdescripcion = $_POST['cdescripcion'];
        //tb_ventas
        $vidventas = $_POST['vidventas'];
        $vfchaventa = $_POST['vfchaventa'];
        $vhoraventa = $_POST['vhoraventa'];
        $vidmetodopago = $_POST['vidmetodopago'];
        $vtotalventa = $_POST['vtotalventa'];
        //tb_detalle_venta
        $dviddetalleventa = $_POST['dviddetalleventa'];
        $dvidproducto = $_POST['dvidproducto'];
        $dvcantidad = $_POST['dvcantidad'];
        $dvidventas = $_POST['dvidventas'];
        //tb_compras
        $cidcompras = $_POST['cidcompras'];
        $cfecharegistro = $_POST['cfecharegistro'];
        $cidproveedores = $_POST['cidproveedores'];
        $ctotalcompra = $_POST['ctotalcompra'];
        //tb_detalle_compra
        $dciddetallecompra = $_POST['dciddetallecompra'];
        $dcidproducto = $_POST['dcidproducto'];
        $dcpreciocompra = $_POST['dcpreciocompra'];
        $dcidcompras = $_POST['dcidcompras'];
        
        $admin = $_POST['admin'];
        
        //************************NUEVOS ARREGLOS*******************************//
        //tb_productos
        $new_idproducto= json_decode($idproducto, true);
        $new_nombreproducto= json_decode($nombreproducto, true);
        $new_descripcion= json_decode($descripcion, true);
        $new_precioventa= json_decode($precioventa, true);
        $new_codigoproducto= json_decode($codigoproducto, true);
        $new_codigobarras= json_decode($codigobarras, true);
        $new_idcatproducto= json_decode($idcatproducto, true);
        $new_idsubcatproducto= json_decode($idsubcatproducto, true);
        $new_idstatusproducto= json_decode($idstatusproducto, true);
        $new_fecharegistro= json_decode($fecharegistro, true);
        $new_preciocompra= json_decode($preciocompra, true);
        $new_stock= json_decode($stock, true);
        //tb_subcategoria
        $new_sidsubcategoria= json_decode($sidsubcategoria, true);
        $new_snombresubcategoria= json_decode($snombresubcategoria, true);
        $new_sdescripcion= json_decode($sdescripcion, true);
        $new_sidcatproducto= json_decode($sidcatproducto, true);
        //tb_categoria
        $new_cidcategoria= json_decode($cidcategoria, true);
        $new_cnombrecategoria= json_decode($cnombrecategoria, true);
        $new_cdescripcion= json_decode($cdescripcion, true);
        //tb_ventas
        $new_vidventas= json_decode($vidventas, true);
        $new_vfchaventa= json_decode($vfchaventa, true);
        $new_vhoraventa= json_decode($vhoraventa, true);
        $new_vidmetodopago= json_decode($vidmetodopago, true);
        $new_vtotalventa= json_decode($vtotalventa, true);
        //tb_detalle_venta
        $new_dviddetalleventa= json_decode($dviddetalleventa, true);
        $new_dvidproducto= json_decode($dvidproducto, true);
        $new_dvcantidad= json_decode($dvcantidad, true);
        $new_dvidventas= json_decode($dvidventas, true);
        //tb_compras
        $new_cidcompras= json_decode($cidcompras, true);
        $new_cfecharegistro= json_decode($cfecharegistro, true);
        $new_cidproveedores= json_decode($cidproveedores, true);
        $new_ctotalcompra= json_decode($ctotalcompra, true);
        //tb_detalle_compra
        $new_dciddetallecompra= json_decode($dciddetallecompra, true);
        $new_dcidproducto= json_decode($dcidproducto, true);
        $new_dcpreciocompra= json_decode($dcpreciocompra, true);
        $new_dcidcompras= json_decode($dcidcompras, true);
        
        $conexion = mysqli_connect($hostname, $username, $password, $database);
        
        //query tb_productos
        $query = "SELECT idProducto FROM tb_productos WHERE idAdmin = '$admin'";
        
        $resultado = mysqli_query($conexion, $query) or die (mysqli_error());
        
        if(mysqli_fetch_array($resultado)){
            $querydelete = "DELETE FROM tb_productos WHERE idAdmin = '$admin'";
            mysqli_query($conexion, $querydelete) or die (mysqli_error());
            
            for($i = 0; $i < sizeof($new_idproducto); $i++){
                $queryDetalleVenta = "INSERT INTO tb_productos(idProducto, nombreProducto, descripcion, precioVenta, codigoProducto, codigoBarras, idCatProducto, idSubCatProducto, idStatusProducto, fechaRegistro, precioCompra, stock, idAdmin) VALUES('$new_idproducto[$i]', '$new_nombreproducto[$i]', '$new_descripcion[$i]', '$new_precioventa[$i]', '$new_codigoproducto[$i]', '$new_codigobarras[$i]', '$new_idcatproducto[$i]', '$new_idsubcatproducto[$i]', '$new_idstatusproducto[$i]', '$new_fecharegistro[$i]', '$new_preciocompra[$i]', '$new_stock[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }else{
            for($i = 0; $i < sizeof($new_idproducto); $i++){
            $queryDetalleVenta = "INSERT INTO tb_productos(idProducto, nombreProducto, descripcion, precioVenta, codigoProducto, codigoBarras, idCatProducto, idSubCatProducto, idStatusProducto, fechaRegistro, precioCompra, stock, idAdmin) VALUES('$new_idproducto[$i]', '$new_nombreproducto[$i]', '$new_descripcion[$i]', '$new_precioventa[$i]', '$new_codigoproducto[$i]', '$new_codigobarras[$i]', '$new_idcatproducto[$i]', '$new_idsubcatproducto[$i]', '$new_idstatusproducto[$i]', '$new_fecharegistro[$i]', '$new_preciocompra[$i]', '$new_stock[$i]', $admin)";
            mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }
        
        //query tb_subcategorias
        $querys = "SELECT idSubcategoriaProducto FROM tb_subcategoria_producto WHERE idAdmin = '$admin'";
        
        $resultados = mysqli_query($conexion, $querys) or die (mysqli_error());
        
        if(mysqli_fetch_array($resultados)){
            $querydelete = "DELETE FROM tb_subcategoria_producto WHERE idAdmin = '$admin'";
            mysqli_query($conexion, $querydelete) or die (mysqli_error());
            
            for($i = 0; $i < sizeof($new_sidsubcategoria); $i++){
                $queryDetalleVenta = "INSERT INTO tb_subcategoria_producto(idSubcategoriaProducto, nombreSubcategoria, descripcion, idCatProducto, idAdmin) VALUES('$new_sidsubcategoria[$i]', '$new_snombresubcategoria[$i]', '$new_sdescripcion[$i]', '$new_sidcatproducto[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }else{
            for($i = 0; $i < sizeof($new_sidsubcategoria); $i++){
            $queryDetalleVenta = "INSERT INTO tb_subcategoria_producto(idSubcategoriaProducto, nombreSubcategoria, descripcion, idCatProducto, idAdmin) VALUES('$new_sidsubcategoria[$i]', '$new_snombresubcategoria[$i]', '$new_sdescripcion[$i]', '$new_sidcatproducto[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }
        
        //query tb_categoria
        $querycat = "SELECT idCategoriaProducto FROM tb_categoria_producto WHERE idAdmin = '$admin'";
        
        $resultadocat = mysqli_query($conexion, $querycat) or die (mysqli_error());
        
        if(mysqli_fetch_array($resultadocat)){
            $querydelete = "DELETE FROM tb_categoria_producto WHERE idAdmin = '$admin'";
            mysqli_query($conexion, $querydelete) or die (mysqli_error());
            
            for($i = 0; $i < sizeof($new_cidcategoria); $i++){
                $queryDetalleVenta = "INSERT INTO tb_categoria_producto(idCategoriaProducto, nombreCategoria, descripcion, idAdmin) VALUES('$new_cidcategoria[$i]', '$new_cnombrecategoria[$i]', '$new_cdescripcion[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }else{
            for($i = 0; $i < sizeof($new_cidcategoria); $i++){
            $queryDetalleVenta = "INSERT INTO tb_categoria_producto(idCategoriaProducto, nombreCategoria, descripcion, idAdmin) VALUES('$new_cidcategoria[$i]', '$new_cnombrecategoria[$i]', '$new_cdescripcion[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }
        
        //query tb_ventas
        $queryv = "SELECT idVentas FROM tb_ventas WHERE idAdmin = '$admin'";
        
        $resultado = mysqli_query($conexion, $queryv) or die (mysqli_error());
        
        if(mysqli_fetch_array($resultado)){
            $querydelete = "DELETE FROM tb_ventas WHERE idAdmin = '$admin'";
            mysqli_query($conexion, $querydelete) or die (mysqli_error());
            
            for($i = 0; $i < sizeof($new_vidventas); $i++){
                $queryDetalleVenta = "INSERT INTO tb_ventas(idVentas, fechaVenta, horaVenta, idMetodoPago, totalVenta, idAdmin) VALUES('$new_vidventas[$i]', '$new_vfchaventa[$i]', '$new_vhoraventa[$i]', '$new_vidmetodopago[$i]', '$new_vtotalventa[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }else{
            for($i = 0; $i < sizeof($new_vidventas); $i++){
                $queryDetalleVenta = "INSERT INTO tb_ventas(idVentas, fechaVenta, horaVenta, idMetodoPago, totalVenta, idAdmin) VALUES('$new_vidventas[$i]', '$new_vfchaventa[$i]', '$new_vhoraventa[$i]', '$new_vidmetodopago[$i]', '$new_vtotalventa[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }
        
        //query tb_detalle_venta
        $querydv = "SELECT idDetalleVenta FROM tb_detalle_venta WHERE idAdmin = '$admin'";
        
        $resultadodv = mysqli_query($conexion, $querydv) or die (mysqli_error());
        
        if(mysqli_fetch_array($resultadodv)){
            $querydelete = "DELETE FROM tb_detalle_venta WHERE idAdmin = '$admin'";
            mysqli_query($conexion, $querydelete) or die (mysqli_error());
            
            for($i = 0; $i < sizeof($new_dviddetalleventa); $i++){
                $queryDetalleVenta = "INSERT INTO tb_detalle_venta(idDetalleVenta, idProducto, cantidad, idVentas, idAdmin) VALUES('$new_dviddetalleventa[$i]', '$new_dvidproducto[$i]', '$new_dvcantidad[$i]', '$new_dvidventas[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }else{
            for($i = 0; $i < sizeof($new_dviddetalleventa); $i++){
                $queryDetalleVenta = "INSERT INTO tb_detalle_venta(idDetalleVenta, idProducto, cantidad, idVentas, idAdmin) VALUES('$new_dviddetalleventa[$i]', '$new_dvidproducto[$i]', '$new_dvcantidad[$i]', '$new_dvidventas[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }
        
        //query tb_compras
        $querycompras = "SELECT idCompras FROM tb_compras WHERE idAdmin = '$admin'";
        
        $resultadocompras = mysqli_query($conexion, $querycompras) or die (mysqli_error());
        
        if(mysqli_fetch_array($resultadocompras)){
            $querydelete = "DELETE FROM tb_compras WHERE idAdmin = '$admin'";
            mysqli_query($conexion, $querydelete) or die (mysqli_error());
            
            for($i = 0; $i < sizeof($new_cidcompras); $i++){
                $queryDetalleVenta = "INSERT INTO tb_compras(idCompras, fechaRegistro, idProveedores, totalCompra, idAdmin) VALUES('$new_cidcompras[$i]', '$new_cfecharegistro[$i]', '$new_cidproveedores[$i]', '$new_ctotalcompra[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }else{
            for($i = 0; $i < sizeof($new_cidcompras); $i++){
                $queryDetalleVenta = "INSERT INTO tb_compras(idCompras, fechaRegistro, idProveedores, totalCompra, idAdmin) VALUES('$new_cidcompras[$i]', '$new_cfecharegistro[$i]', '$new_cidproveedores[$i]', '$new_ctotalcompra[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }
        
        //query tb_detalle_compra
        $querydetallecompra = "SELECT idDetalleCompra FROM tb_detalle_compra WHERE idAdmin = '$admin'";
        
        $resultadodetallecompra = mysqli_query($conexion, $querydetallecompra) or die (mysqli_error());
        
        if(mysqli_fetch_array($resultadodetallecompra)){
            $querydelete = "DELETE FROM tb_detalle_compra WHERE idAdmin = '$admin'";
            mysqli_query($conexion, $querydelete) or die (mysqli_error());
            
            for($i = 0; $i < sizeof($new_dciddetallecompra); $i++){
                $queryDetalleVenta = "INSERT INTO tb_detalle_compra(idDetalleCompra, idProducto, precioCompra, idCompras, idAdmin) VALUES('$new_dciddetallecompra[$i]', '$new_dcidproducto[$i]', '$new_dcpreciocompra[$i]', '$new_dcidcompras[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }else{
            for($i = 0; $i < sizeof($new_dciddetallecompra); $i++){
                $queryDetalleVenta = "INSERT INTO tb_detalle_compra(idDetalleCompra, idProducto, precioCompra, idCompras, idAdmin) VALUES('$new_dciddetallecompra[$i]', '$new_dcidproducto[$i]', '$new_dcpreciocompra[$i]', '$new_dcidcompras[$i]', $admin)";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "SINCRONIZACIÓN TERMINADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }
        
    }else{
        $data{'mensaje'} = "NO SE RECIBIERON ARREGLOS";
        $data{'continua'} = "0";
        echo json_encode($data);
    }
?>