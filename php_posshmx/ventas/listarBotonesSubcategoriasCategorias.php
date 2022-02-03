<?php
    require("../conexion.php");
    
    $respuesta = array();
    $respuesta["subcategorias"] = array();

    if(isset($_POST['idCat'])){
        $uidcat = $_POST['idCat'];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT idSubcategoriaProducto, nombreSubcategoria FROM tb_subcategoria_producto WHERE idCatProducto = '$uidcat'";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["idSubcategoriaProducto"] = $row["idSubcategoriaProducto"];
            $tmp["nombreSubcategoria"] = $row["nombreSubcategoria"];

            array_push($respuesta["subcategorias"], $tmp);
        }

        echo json_encode($respuesta);    
    }
?>