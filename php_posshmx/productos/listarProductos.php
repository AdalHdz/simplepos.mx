<?php
    require("../conexion.php");
    
    $respuesta = array();
    $respuesta["productos"] = array();

    if(isset($_POST['imagen'])){
        
        $uimagen = $_POST['imagen'];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT nombreProducto, descripcion, precioVenta, imagen FROM tb_productos WHERE idStatusProducto = 1";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["nombreProducto"] = $row["nombreProducto"];
            $tmp["descripcion"] = $row["descripcion"];
            $tmp["precioVenta"] = $row["precioVenta"];
            $tmp["imagen"] = $row["imagen"];

            array_push($respuesta["productos"], $tmp);
        }

        echo json_encode($respuesta);
        
    }
    
?>