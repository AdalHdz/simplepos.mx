<?php
    session_start();
    
    require("conexion.php");
    
    //if ($_POST['usuario']) //Si llego un Usuario via el formulario lo grabamos en la Sesion
//{
//	$_SESSION['rol'] = $_POST['usuario']; //Usuario Grabado
//}
//if ($_SESSION['rol']) //Si hay un nickname en la sesion actual, creamos una variable que será mostrada
//{
//	$grabado=$_SESSION['rol'];
//}

    
    
    $usuario = $_POST['usuario'];
    $contrasenha = $_POST['pass'];
    

    /* AQUÍ HACES LA COMPROBACIÓN */ 
        if(!isset($_SESSION['intentos'])) //Si no se ha creado "intentos" es que aún no ha hecho                                        ningún intento, por tanto la creamos. 
            $_SESSION['intentos'] = 0; 
        else if($_SESSION['intentos'] >= 3) { //Si existe "intentos" y ya hecho 3 comprobaciones                                         devolvemos el mensaje de error.
        //echo 'Límite de intentos excedido';
            $_SESSION['intentos']=0;
            $con=mysqli_connect($host, $user, $pass, $db);
            
            if($con){            
                $query = "UPDATE tb_usuario SET idStatusUsuario = '2' WHERE nombreUsuario = '$usuario'";      
                $resultado = mysqli_query($con,$query);
                echo "<script>alert('Límite de intentos excedido');location.href ='javascript:history.back()';</script>";
                exit();
            }
        } 
    /* FIN COMPROBACIÓN INTENTOS */ 

    //$con=mysqli_connect($host, $user, $pass, $db);

    if(isset($usuario) && !empty($usuario) &&
      isset($contrasenha) && !empty($contrasenha)){         
        
        $con=mysqli_connect($host, $user, $pass, $db);      
        
        if($con){
            $consulta = mysqli_query($con,("SELECT idUsuario, nombreUsuario FROM tb_usuario WHERE nombreUsuario = '$usuario' AND pass = '$contrasenha' AND idStatusUsuario = '1'"));
                if(!$consulta){
                    echo "error de usuario";
                }
            
                $rows = mysqli_num_rows($consulta);
		
                if($rows > 0) {
                    $row = mysqli_fetch_assoc($consulta);
                        $_SESSION['intentos']=0;
                        $_SESSION['idUsuario'] = $row['idUsuario'];
                        $_SESSION['nombreUsuario'] = $row['nombreUsuario'];

                        header("location: menuadministrador.php");
                } else {
                        $_SESSION['intentos']+=1;
                        echo "<script>alert('Usuario o Contraseña Incorrectos');location.href ='javascript:history.back()';</script>";
                    //
                }
        }else{
            echo "Error de Conexion a Base de Datos";
        }

    }else{
        echo "<script>alert('Campos obligatorios');location.href ='javascript:history.back()';</script>";
    }

?>