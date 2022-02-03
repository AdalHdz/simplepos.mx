<?php
    require("../conexion.php");

    $hoy = date('Y-m-d');

    if(isset($_POST['id']) && isset ($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['usuario'])){
        $uid = $_POST['id'];
        $unombre=$_POST['nombre'];
        $udescripcion = $_POST['descripcion'];
        $uprecio = $_POST['precio'];
        $uidUsuario = $_POST['usuario'];

        $conexion=mysqli_connect($hostname,$username,$password,$database);

        $query = "UPDATE tb_productos SET nombreProducto = '$unombre', descripcion = '$udescripcion', precioVenta = '$uprecio' WHERE idProducto ='$uid'";
        $resultado = mysqli_query($conexion, $query) or die (mysqli_error());
        if($resultado){
            $consultaHistorial = "INSERT INTO tb_historial (idUsuario, idActividadHistorial, fechaRegistro) VALUES ('$uidUsuario', '3', '$hoy')";
            mysqli_query($conexion, $consultaHistorial) or die (mysql_error());
            $data{'mensaje'} = "PRODUCTO EDITADO";
            $data{'continua'} = "1";
            echo json_encode ($data);
        }else{
            $data{'mensaje'} = "ERROR AL EDITAR PRODUCTO";
            $data{'continua'} = "0";
            echo json_encode ($data);
        }     
    }else{
        $data{'mensaje'} = "NO HAY DATOS";
        $data{'continua'} = "";
        echo json_encode ($data);
    }
?>