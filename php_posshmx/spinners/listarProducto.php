<?php
    require("../conexion.php");

    if(isset ($_POST["subcategoria"])){
        $respuesta = array();
        $respuesta["producto"] = array();
        
        $subcategoria = $_POST["subcategoria"];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT idSubcategoriaProducto FROM tb_subcategoria_producto WHERE nombreSubcategoria = '$subcategoria'";

        $resultado = mysqli_query($conexion, $query);

            if($row = mysqli_fetch_array($resultado)){
                $tmpNombreSubCat = $row["idSubcategoriaProducto"];
                $queryDos = "SELECT idProducto, nombreProducto FROM tb_productos WHERE idSubCatProducto = '$tmpNombreSubCat'";
                $resultadoDos = mysqli_query($conexion, $queryDos);
                
                    while($rowDos = mysqli_fetch_array($resultadoDos)){
                        $tmp = array();
                        $tmp["idProducto"] = $rowDos["idProducto"];
                        $tmp["nombreProducto"] = $rowDos["nombreProducto"];

                        array_push($respuesta["producto"], $tmp);
                    }
                
                echo json_encode($respuesta);        
            }
        
    }
?>