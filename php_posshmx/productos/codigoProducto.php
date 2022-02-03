<?php
    require("../conexion.php");

    $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");
    
    $query = "SELECT tb_productos.idProducto as id, tb_productos.nombreProducto as producto, tb_categoria_producto.nombreCategoria as categoria, tb_subcategoria_producto.nombreSubcategoria as subcategoria 
                        FROM tb_productos 
                        LEFT JOIN tb_subcategoria_producto ON tb_subcategoria_producto.idSubcategoriaProducto = tb_productos.idSubCatProducto 
                        LEFT JOIN tb_categoria_producto ON tb_categoria_producto.idCategoriaProducto = tb_subcategoria_producto.idCatProducto
                        WHERE tb_productos.nombreProducto = 'MANTECADAS'";

    $resultado = mysqli_query($conexion, $query);

    $row = mysqli_fetch_array($resultado);
    
    $tmpid = $row["id"];
    $tmpproducto = substr($row["producto"], 0, 2);
    $tmpcategoria = substr($row["categoria"], 0, 2);
    $tmpsubcategoria = substr($row["subcategoria"], 0, 2);

    //echo $tmpproducto;
    //echo $tmpcategoria;
    //echo $tmpsubcategoria;
    
    $codigo = "P-$tmpproducto-$tmpcategoria-$tmpsubcategoria-$tmpid";

    echo $codigo;    
    
?>