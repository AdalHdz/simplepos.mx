<?php
    require("../../conexion.php");

    if(isset ($_POST["categoria"])){
        $respuesta = array();
        $respuesta["SubCategoriasProd"] = array();
        
        $categoria = $_POST["categoria"];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT idCategoriaProducto FROM tb_categoria_producto WHERE nombreCategoria = '$categoria'";

        $resultado = mysqli_query($conexion, $query);

            if($row = mysqli_fetch_array($resultado)){
                $tmpNombreCat = $row["idCategoriaProducto"];
                $queryDos = "SELECT idSubcategoriaProducto, nombreSubcategoria FROM tb_subcategoria_producto WHERE idCatProducto = '$tmpNombreCat'";
                $resultadoDos = mysqli_query($conexion, $queryDos);
                
                    while($rowDos = mysqli_fetch_array($resultadoDos)){
                        $tmp = array();
                        $tmp["idSubcategoriaProducto"] = $rowDos["idSubcategoriaProducto"];
                        $tmp["nombreSubcategoria"] = $rowDos["nombreSubcategoria"];

                        array_push($respuesta["SubCategoriasProd"], $tmp);
                    }
                
                $todos = array();
                $todos["nombreSubcategoria"] = "TODOS";
                array_unshift($respuesta["SubCategoriasProd"], $todos);
                
                echo json_encode($respuesta);        
            }
        
    }
    
    
?>