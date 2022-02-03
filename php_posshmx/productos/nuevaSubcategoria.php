<?php
require("../conexion.php");

if(isset ($_POST['nombre']) && isset ($_POST['descripcion']) && isset($_POST['categoria'])){
    $unombre=$_POST['nombre'];
    $udescripcion=$_POST['descripcion'];
    $ucategoria=$_POST['categoria'];
    
    $conexion=mysqli_connect($hostname,$username,$password,$database);
    
    $fquery = "SELECT idCategoriaProducto FROM tb_categoria_producto WHERE nombreCategoria = '$ucategoria'";
    $fresult = mysqli_query($conexion, $fquery) or die (mysqli_error());
    $rowcat = mysqli_fetch_array($fresult);
    
    $query = "SELECT nombreSubcategoria FROM tb_subcategoria_producto WHERE nombreSubcategoria = '$unombre'";
    $resultado = mysqli_query($conexion, $query) or die (mysqli_error());
    if(mysqli_fetch_array($resultado)){
        $data{'mensaje'} = "SUBCATEGORÍA YA EXISTE";
        $data{'continua'} = "";
        echo json_encode ($data);
    }else{
        $tmpidcat = $rowcat["idCategoriaProducto"];
        $consulta="INSERT INTO tb_subcategoria_producto(nombreSubcategoria, descripcion, idCatProducto) VALUES ('$unombre','$udescripcion', '$tmpidcat')";
        $result = mysqli_query($conexion, $consulta) or die (mysqli_error());
            if($result){
                $data{'mensaje'} = "SUBCATEGORÍA CREADA";
                $data{'continua'} = "1";
                echo json_encode ($data);
            }else{
                $data{'mensaje'} = "ERROR AL CREAR SUBCATEGORIA";
                $data{'continua'} = "0";
                echo json_encode ($data);
            }     
    }
}else{
    $data{'mensaje'} = "NO HAY DATOS";
    $data{'continua'} = "";
    echo json_encode ($data);
}
?>