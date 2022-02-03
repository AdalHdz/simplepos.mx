<?php
    require("conexion.php");
    
    if(isset($_POST["nombre"]) && isset($_POST["cuenta"])){
        $unombre=$_POST['nombre'];
	    $ucuenta=$_POST['cuenta'];        
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $query = "SELECT idPredial, numeroCuenta, nombre, apellidoPaterno, apellidoMaterno, valorFiscal, valorContable, domicilio, rutaDomicilio FROM tb_predial WHERE nombre = '$unombre' AND numeroCuenta = '$ucuenta'";

        $resultado = mysqli_query($conexion, $query);

        if($row = mysqli_fetch_array($resultado)){
            $idPredial = $row["idPredial"];
            $numeroCuenta = $row["numeroCuenta"];
            $nombre = $row["nombre"];
            $apellidoPaterno = $row["apellidoPaterno"];
            $apellidoMaterno = $row["apellidoMaterno"];
            $valorFiscal = $row["valorFiscal"];
            $valorContable = $row["valorContable"];
            $domicilio = $row["domicilio"];            
            $rutaDomicilio = $row["rutaDomicilio"];            
            
            $data{'idPredial'} = $idPredial;
            $data{'numeroCuenta'} = $numeroCuenta;
            $data{'nombre'} = $nombre;
            $data{'apellidoPaterno'} = $apellidoPaterno;
            $data{'apellidoMaterno'} = $apellidoMaterno;
            $data{'valorFiscal'} = $valorFiscal;
            $data{'valorContable'} = $valorContable;            
            $data{'domicilio'} = $domicilio;
            $data{'rutaDomicilio'} = $rutaDomicilio;             
            $data{'continua'} = "1";             
            echo json_encode($data);    
        }else{
            $data{'idPredial'} = "";
            $data{'numeroCuenta'} = "";
            $data{'nombre'} = "";
            $data{'apellidoPaterno'} = "";
            $data{'apellidoMaterno'} = "";
            $data{'valorFiscal'} = "";
            $data{'valorContable'} = "";            
            $data{'domicilio'} = "";
            $data{'rutaDomicilio'} = "";          
            $data{'continua'} = "0";
            echo json_encode($data);
        }
    }
?>