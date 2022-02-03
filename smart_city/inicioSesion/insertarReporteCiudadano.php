<?php
require("conexion.php");

if(isset ($_POST['direccion']) && isset ($_POST['descripcion']) && isset ($_POST['rutaLocal']) && isset ($_POST['rutaServidor']) && isset($_POST['tipoReporte']) && isset($_POST['latitud']) && isset($_POST['longitud']) && isset($_POST['usuario'])){
    $udireccion=$_POST['direccion'];
    $udescripcion=$_POST['descripcion'];
    $urutaLocal=$_POST['rutaLocal'];
    $urutaServidor=$_POST['rutaServidor'];
    $utipoReporte=$_POST['tipoReporte'];
    $ulatitud=$_POST['latitud'];
    $ulongitud=$_POST['longitud'];
    $uusuario=$_POST['usuario'];

    $conexion=mysqli_connect($hostname,$username,$password,$database);
    
    $consulta="INSERT INTO tb_reporte_ciudadano(direccion, descripcion, rutaLocal, rutaServidor, idTipoRepote, idStatusReporteCiudadano, latitud, longitud, idUsuario) VALUES ('$udireccion','$udescripcion','$urutaLocal','$urutaServidor','$utipoReporte', '1','$ulatitud', '$ulongitud', '$uusuario')";
    $result = mysqli_query($conexion, $consulta) or die (mysqli_error());
    if($result){
        $data{'mensaje'} = "REPORTE INSERTADO";
        $data{'continua'} = "1";
        echo json_encode ($data);
    }else{
        $data{'mensaje'} = "FALLA AL INSERTAR REPORTE";
        $data{'continua'} = "0";
        echo json_encode ($data);
    }             
}else{
    $data{'mensaje'} = "NO HAY DATOS";
    $data{'continua'} = "0"; 
    echo json_encode ($data);
}

mysqli_close($conexion);

?>