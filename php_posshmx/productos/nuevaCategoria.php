<?php
require("../conexion.php");

if(isset ($_POST['nombre']) && isset ($_POST['descripcion'])){
    $unombre=$_POST['nombre'];
    $udescripcion=$_POST['descripcion'];
        //$unombre="REFRESCO";
        //$udescripcion="TODO TIPO DE REFRESCO";
    
    $conexion=mysqli_connect($hostname,$username,$password,$database);
    
    $query = "SELECT nombreCategoria FROM tb_categoria_producto WHERE nombreCategoria = '$unombre'";
    $resultado = mysqli_query($conexion, $query) or die (mysqli_error());
    if(mysqli_fetch_array($resultado)){
        $data{'mensaje'} = "CATEGORÍA YA EXISTE";
        $data{'continua'} = "";
        echo json_encode ($data);
    }else{
        $consulta="INSERT INTO tb_categoria_producto(nombreCategoria, descripcion) VALUES ('$unombre','$udescripcion')";
        $result = mysqli_query($conexion, $consulta) or die (mysqli_error());
            if($result){
                $data{'mensaje'} = "CATEGORIA CREADA";
                $data{'continua'} = "1";
                echo json_encode ($data);
            }else{
                $data{'mensaje'} = "ERROR AL CREAR CATEGORIA";
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