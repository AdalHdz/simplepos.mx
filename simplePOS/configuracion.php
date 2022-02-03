<?php
    session_start();
?>

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
    
    <body>
    
        <?php include("cabecera.html");?>
        
            <div class="row hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
                <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
                    <div class="col-lg-8 crm-menu">
                            <div class="title-menu">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                        
                                    <div class="col-lg-6 title-tbusuarios">
                                        <h2>Productos</h2>
                                    </div>                      
                        
                                    <div class="col-lg-3">
                                        <div class="row iconos-tbusuarios">
                                            <div class="col-lg-4">
                                                <a href="menuadministrador.php" class="fa fa-reply-all fa-2x"></a>
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                <a href="cargarPlantilla.php" class="hi-icon hi-icon-config">Cargar Plantilla</a>
                                    <p>Cargar Plantilla</p>
                                </div>
                            </div>
                    </div>
                <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
            </div>    
        
        <?php //echo($_SESSION['rol']); 
                //$_SESSION['idUsuario']?>

        <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../js/vendor/jquery-slim.min.js"><\/script>')</script>
      
      <!--Script menu-->
        <script src="../js/jquery.min.js"></script>    
        <script id="rendered-js">
            $(".toggle-menu").click(function () {
            $(this).toggleClass("active");
            $("#menu").toggleClass("open");
            });
            
            //cerrar menu
            $('#menu ul li a').click (function(){
                $("#menu").removeClass("open");
                $(".toggle-menu").removeClass("active");
            });		
        </script>
              
    <script src="../js/vendor/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/holder.min.js"></script>
        
    </body>
</html>