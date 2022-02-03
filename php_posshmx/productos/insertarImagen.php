<?php
    require("../conexion.php");
    
    if(isset($_POST["imagenproducto"]) && isset($_POST["nombreproducto"])){
        $uimagen = $_POST["imagenproducto"];
        $unombre = $_POST["nombreproducto"];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT nombreProducto FROM tb_productos WHERE nombreProducto = '$unombre' AND idStatusProducto = '1'";

        $resultado = mysqli_query($conexion, $query);

        if($row = mysqli_fetch_array($resultado)){
            $queryi = "UPDATE tb_productos SET imagen = '$uimagen' WHERE nombreProducto = '$unombre' AND idStatusProducto = '1'";
            $resultadoi = mysqli_query($conexion, $queryi);
            
            $data{'mensaje'} = "IMAGEN INSERTADA";

            echo json_encode($data);    
        }

    }
?>