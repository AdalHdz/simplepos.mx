<?php
    require("../conexion.php");
    
    $respuesta = array();
    $respuesta["categorias"] = array();

    $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

    $query = "SELECT idCategoriaProducto, nombreCategoria FROM tb_categoria_producto";

    $resultado = mysqli_query($conexion, $query);

    while($row = mysqli_fetch_array($resultado)){
        $tmp = array();
        $tmp["idCategoriaProducto"] = $row["idCategoriaProducto"];
        $tmp["nombreCategoria"] = $row["nombreCategoria"];
        
        array_push($respuesta["categorias"], $tmp);
    }
    
    //$todos = array();
    //$todos["nombreCategoria"] = "TODOS";
    //array_push($respuesta["categorias"], $todos);

    echo json_encode($respuesta);

?>