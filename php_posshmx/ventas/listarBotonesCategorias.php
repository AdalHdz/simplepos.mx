<?php
    require("../conexion.php");
    
    $respuesta = array();
    $respuesta["categoria"] = array();

    $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

    $query = "SELECT idCategoriaProducto, nombreCategoria FROM tb_categoria_producto";

    $resultado = mysqli_query($conexion, $query);

    while($row = mysqli_fetch_array($resultado)){
        $tmp = array();
        $tmp["idCategoriaProducto"] = $row["idCategoriaProducto"];
        $tmp["nombreCategoria"] = $row["nombreCategoria"];
                
        array_push($respuesta["categoria"], $tmp);
    }

    echo json_encode($respuesta);
?>