<?php
require("../conexion.php");

$hoy = date('Y-m-d');        

if(isset ($_POST['nombre']) && isset ($_POST['descripcion']) && isset ($_POST['categoria']) && isset ($_POST['subcategoria']) && isset($_POST['precio']) && isset($_POST['usuario']) && isset($_POST['barras'])){
    $unombre=$_POST['nombre'];
    $udescripcion=$_POST['descripcion'];
    $ucategoria=$_POST['categoria'];
    $usubcategoria=$_POST['subcategoria'];
    $uprecio=$_POST['precio'];
    $ubarras = $_POST['barras'];
    $uidUsuario = $_POST['usuario'];

    $conexion=mysqli_connect($hostname,$username,$password,$database);
        
    $queryidcategoria = "SELECT idCategoriaProducto FROM tb_categoria_producto WHERE nombreCategoria='$ucategoria'";
    $resultcat = mysqli_query($conexion, $queryidcategoria);
    $rowcat = mysqli_fetch_array($resultcat);
        
    $queryidsubcat = "SELECT idSubcategoriaProducto FROM tb_subcategoria_producto WHERE nombreSubcategoria = '$usubcategoria'";
    $resultsubcat = mysqli_query($conexion, $queryidsubcat);
    $rowsubcat = mysqli_fetch_array($resultsubcat);
        
    $tmpidcat = $rowcat["idCategoriaProducto"];
    $tmpidsubcat = $rowsubcat["idSubcategoriaProducto"];
        
    $consulta="INSERT INTO tb_productos(nombreProducto, descripcion, precioVenta, codigoBarras, idCatProducto, idSubCatProducto, idStatusProducto, fechaRegistro) VALUES ('$unombre','$udescripcion','$uprecio', '$ubarras', '$tmpidcat','$tmpidsubcat', '1', '$hoy')";
    $result = mysqli_query($conexion, $consulta) or die (mysqli_error());
    if($result){
        $querycodigo = "SELECT tb_productos.idProducto as id, tb_productos.nombreProducto as producto, tb_categoria_producto.nombreCategoria as categoria, tb_subcategoria_producto.nombreSubcategoria as subcategoria 
                        FROM tb_productos 
                        LEFT JOIN tb_subcategoria_producto ON tb_subcategoria_producto.idSubcategoriaProducto = tb_productos.idSubCatProducto 
                        LEFT JOIN tb_categoria_producto ON tb_categoria_producto.idCategoriaProducto = tb_subcategoria_producto.idCatProducto
                        WHERE tb_productos.nombreProducto = '$unombre'";

        $resultadocodigo = mysqli_query($conexion, $querycodigo);

        $row = mysqli_fetch_array($resultadocodigo);

        $tmpid = $row["id"];
        $tmpproducto = substr($row["producto"], 0, 2);
        $tmpcategoria = substr($row["categoria"], 0, 2);
        $tmpsubcategoria = substr($row["subcategoria"], 0, 2);

        $codigo = "P-$tmpproducto-$tmpcategoria-$tmpsubcategoria-$tmpid";
        
        $queryinsertarcodigo = "UPDATE tb_productos SET codigoProducto='$codigo' WHERE nombreProducto='$unombre'";
        mysqli_query($conexion, $queryinsertarcodigo) or die (mysqli_error());
        
        $consultaHistorial = "INSERT INTO tb_historial (idUsuario, idActividadHistorial, fechaRegistro) VALUES ('$uidUsuario', '1', '$hoy')";
        mysqli_query($conexion, $consultaHistorial) or die (mysql_error());
        
        $data{'mensaje'} = "PRODUCTO CREADO";
        $data{'continua'} = "1";
        echo json_encode ($data);
    }else{
        $data{'mensaje'} = "ERROR AL CREAR PRODUCTO";
        $data{'continua'} = "0";
        echo json_encode ($data);
    } 
}else{
    $data{'mensaje'} = "NO HAY DATOS";
    $data{'continua'} = "";
    echo json_encode ($data);
}
?>