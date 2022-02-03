<?php
    require("../conexion.php");
    
    if(isset($_POST["nombre"])){
        $unombre = $_POST["nombre"];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT idProducto, nombreProducto, descripcion, precioVenta FROM tb_productos WHERE nombreProducto = '$unombre'";

        $resultado = mysqli_query($conexion, $query);

        if($row = mysqli_fetch_array($resultado)){
            $tmpidproducto = $row["idProducto"];
            $tmpnombre = $row["nombreProducto"];
            $tmpdesc = $row["descripcion"];
            $tmpprecio = $row["precioVenta"];
            
            $data{'idProducto'} = $tmpidproducto;
            $data{'nombreProducto'} = $tmpnombre;
            $data{'descripcion'} = $tmpdesc;
            $data{'precioVenta'} = $tmpprecio;
            $data{'continua'} = "1";

            echo json_encode($data);    
        }

    }
?>