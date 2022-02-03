<?php
    require("../conexion.php");
    
    $respuesta = array();
    $respuesta["productos"] = array();

    //if(isset($_POST['idSubCat'])){
        //$uid = $_POST['idSubCat'];
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT idProducto, nombreProducto FROM tb_productos WHERE idStatusProducto = 1";

        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_array($resultado)){
            $tmp = array();
            $tmp["idProducto"] = $row["idProducto"];
            $tmp["nombreProducto"] = $row["nombreProducto"];

            array_push($respuesta["productos"], $tmp);
        }

        echo json_encode($respuesta);    
    //}
?>