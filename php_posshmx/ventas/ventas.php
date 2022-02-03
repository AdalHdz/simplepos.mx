<?php
    require("../conexion.php");

    $hoy = date('Y-m-d');        

    $hora = date('H:i:s');
    
    if(isset ($_POST['arrayid']) && isset ($_POST['arraycantidad']) && isset($_POST['metodopago']) && isset($_POST['total'])){
        $arrayID = $_POST['arrayid'];
        $arrayCantidad = $_POST['arraycantidad'];
        $uidmetpago = $_POST['metodopago'];
        $utotal = $_POST['total'];
        
        $new_array_ID= json_decode($arrayID, true);
        $new_array_cantidad= json_decode($arrayCantidad, true);
        
        $conexion = mysqli_connect($hostname, $username, $password, $database);
    
        $query = "INSERT INTO tb_ventas(fechaVenta, horaVenta, idMetodoPago,totalVenta) VALUES('$hoy', '$hora', '$uidmetpago', '$utotal')";

        $resultado = mysqli_query($conexion, $query) or die (mysqli_error());

        if($resultado){
            $queryID = "SELECT MAX(idVentas) as ultimoId FROM tb_ventas";
            $resultadoID = mysqli_query($conexion, $queryID);
            $id = mysqli_fetch_array($resultadoID);
            $tmpID = $id['ultimoId'];
            
            for($i = 0; $i < sizeof($new_array_ID); $i++){
                $queryDetalleVenta = "INSERT INTO tb_detalle_venta(idProducto, cantidad, idVentas) VALUES('$new_array_ID[$i]', '$new_array_cantidad[$i]', '$tmpID')";
                mysqli_query($conexion, $queryDetalleVenta) or die (mysqli_error());
            }
            //$data{'prueba'} = $new_array_nombre;            
            $data{'mensaje'} = "VENTA REALIZADA";
            $data{'continua'} = "1";
            echo json_encode($data);
        }else{
            $data{'mensaje'} = "ERROR EN LA VENTA";
            $data{'continua'} = "0";
            echo json_encode( $data );    
        }
    }else{
        $data{'mensaje'} = "NO SE RECIBIERON ARREGLOS";
        $data{'continua'} = "0";
        echo json_encode($data);
    }
?>