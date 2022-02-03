<?php
require("conexion.php");

$json=array();
	if(isset($_GET["user"]) && isset($_GET["pwd"])){
		$user=$_GET['user'];
		$pwd=$_GET['pwd'];
		
		$conexion=mysqli_connect($hostname,$username,$password,$database);
        
        //$conexion = mysqli_connect($hostname, $username, $password, $database);
		
		$consulta="SELECT idUsuario, nombre, nombreUsuario, pass, mail FROM tb_usuario WHERE nombreUsuario= '{$user}' AND pass = '{$pwd}' AND idStatusUsuario = '1'"; //PC
		$resultado=mysqli_query($conexion,$consulta);

		if($consulta){
		
			if($reg=mysqli_fetch_array($resultado)){
				$json['datos'][]=$reg;
			}
			echo json_encode($json);
		}else{
			$results["nombreUsuario"]='';
			$results["pwd"]='';
			$results["nombre"]='';
            $results["idUsuario"]='';
            $results["mail"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
		}
		
	}else{
		   	$results["nombreUsuario"]='';
			$results["pwd"]='';
			$results["nombre"]='';
            $results["idUsuario"]='';
            $results["mail"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
	}
?>