<?php
    require("conexion.php");
    
    if(isset($_POST["secureID"])){
        $usecureID=$_POST['secureID'];	    
        $shoy = date("Y-m-d");
        
        $conexion = mysqli_connect($hostname, $username, $password, $database) or die ("no se conecto a base de datos");

        $queryAddress = "SELECT secureID FROM tb_usuario WHERE secureID = '{$usecureID}' AND idStatusUsuario = '1'";
        $resultadoAddress = mysqli_query($conexion, $queryAddress);
        
        if($rowAddress = mysqli_fetch_array($resultadoAddress)){            
            $query = "SELECT fechaCaducidad FROM tb_usuario WHERE secureID = '{$usecureID}' AND idStatusUsuario = '1'";

            $resultado = mysqli_query($conexion, $query);

            if($row = mysqli_fetch_array($resultado)){            
                $fechaCaducidad = $row["fechaCaducidad"];                                   
            //$tmpnombre = $shoy;
            
                $data{'fechaCaducidad'} = $fechaCaducidad;
                $data{'hoy'} = $shoy;            
                $data{'continua'} = "1";

                echo json_encode($data);    
            }else{
                $data{'fechaCaducidad'} = "";
                $data{'hoy'} = $shoy;            
                $data{'continua'} = "0";
                echo json_encode($data);
            }
        }else{
            $data{'fechaCaducidad'} = "";
            $data{'hoy'} = $shoy;            
            $data{'continua'} = "2";
            echo json_encode($data);
        }                
    }
?>