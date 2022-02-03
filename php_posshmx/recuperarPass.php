 <?php
require("conexion.php");
$fin='';

    if(isset ($_POST['correo'])){
        $uCorreo = $_POST['correo'];    
        
        $conexion = mysqli_connect($hostname, $username, $password, $database);
    
        $query = "SELECT mail FROM tb_usuario WHERE mail='$uCorreo'";

        $resultado = mysqli_query($conexion, $query) or die (mysqli_error());

        if(mysqli_fetch_array($resultado)){
            
              mt_srand();
              for($i=1;$i<=4;$i++){
                $fin .= mt_rand (0, 9);  
              }
            
            $query2 = "UPDATE tb_usuario SET codRecuperacion='$fin' WHERE mail='$uCorreo'";
            $resultado2 = mysqli_query($conexion, $query2) or die (mysqli_error());
            
            $data{'response_message'} = "CODIGO ENVIADO A CORREO";
            $data{'cdg_recuperacion'} = $fin;
            $data{'var_seguimiento'} = "1";
            echo json_encode($data);
        }else{
            $data{'response_message'} = "CORREO NO REGISTRADO";
            $data{'cdg_recuperacion'} = '';
            $data{'var_seguimiento'} = "0";
            echo json_encode( $data );
        }
    }

mysqli_close($conexion);

?>