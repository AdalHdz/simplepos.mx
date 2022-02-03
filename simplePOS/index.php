<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../img/logo_app.png">

    <title>Simple POS | Las ventas nunca fueron tan simples.</title>

    <!-- CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">    
    <link href="../css/style.css" rel="stylesheet">
<!--Stylelogin-->
            <link rel="stylesheet" type="text/css" href="../css/stylelogin.css">
      
        <link rel="stylesheet" type="text/css" href="../css/component.css">
        <link rel="stylesheet" type="text/css" href="../font-awesome/css/all.min.css"/>    
<!-- FIN -->  
      
     <script src="../js/owl/jquery.min.js"></script>
    <script src="../js/owl/owl.carousel.js"></script>
    <script src="../js/modernizr.custom.js"></script>
      
 
  </head>
    
    <body class="body-login">
    
        <?php //include("cabecera.html");?>
        
        <div class="container">
                <div class="card card-login mx-auto text-center">
                    <div class="login card-header mx-auto">
                        <span> <img src="../img/logo.png" class="w-100" alt="Logo"> </span><br/>
                                    <!--span class="logo_title mt-5"> Login Dashboard </span-->
            <!--            <h1>--><?php //echo $message?><!--</h1>-->

                    </div>
                    <div class="card-body">
                        <form action="acceso.php" method="post">
                            <div class="form-label-group">
                                <!--div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div-->
                                <input type="text" name="usuario" id="nombreusuario" class="form-control" placeholder="" required autofocus>
                                <label for="nombreusuario">USUARIO</label>
                            </div>

                            <div class="form-label-group">
                                <!--div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div-->
                                <input type="password" name="pass" id="passusuario" class="form-control" placeholder="" required autofocus>
                                <label for="passusuario">CONTRASEÑA</label>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="btn" value="Iniciar Sesión" class="btn btn-outline-danger float-right login_btn">
                            </div>

                        </form>
                        <br><br>
                        <p>Versión 2.0</p>
                        <p>06 de Octubre de 2021</p>
                    </div>
                </div>
            </div>
        

        <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../js/vendor/jquery-slim.min.js"><\/script>')</script>
              
    <script src="../js/vendor/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/holder.min.js"></script>
        
    </body>
</html>