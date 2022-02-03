<?php
    session_start();
    require("conexion.php");
    $fila=0;
    $idAdmin = $_SESSION['idUsuario'];    
    $con=mysqli_connect($host, $user, $pass, $db);                        
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
    <link href="../css/st.css" rel="stylesheet">
<!--Stylelogin-->
            <link rel="stylesheet" type="text/css" href="../css/stylelogin.css">
      
        <link rel="stylesheet" type="text/css" href="../css/component.css">
        <link rel="stylesheet" type="text/css" href="../font-awesome/css/all.min.css"/>    
<!-- FIN -->  
      
     <script src="../js/owl/jquery.min.js"></script>
    <script src="../js/owl/owl.carousel.js"></script>
    <script src="../js/modernizr.custom.js"></script>
  
  
   <!-- mio -->  
   <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <!-- mio -->  
  </head>
    
    <body class="body-pantallas">
    <?php include("cabecera.html");?>
        <div class="tablausuarios">
            <div class="row">
                <div class="col-xs-0 col-sm-0        col-md-2 col-lg-2"> 
                </div>
                    <div class="col-xs-0 col-sm-0 col-md-8 col-lg-8">
                        
                        <div class="card-deck">
                         <div class="card bg-light-uno">
                           <div class="card-header"><h3>REPORTES</h3></div>                               
                               <div class="card-body tbody_fixed_productos">                                                    
                                            <from  class="form-inline" hidden>
                                                <?php $fcha = date("Y/m/d");?>
                                                <p id="texto-ayuda">Fecha de hoy:  <?php echo $fcha;?></p>
                                            </from>
                                            <form class="form-inline" method="POST" action="">
                                                    <!--label id="texto-ayuda">Tipo de reporte :</label-->
                                                    <label>Reporte por fechas desde :</label>
			                                        <input type="date" class="form-control" placeholder="Start"  name="date1"/>
			                                        <label>  Hasta:  </label>
			                                        <input type="date" class="form-control" placeholder="End"  name="date2"/>
			                                        <button class="btn btn-primary" name="search"><span class=""></span>Buscar </button>
                                                <a href="reportes.php" type="button" class="btn btn-success">Limpiar<span class = ""></span></a>
		                                    </form>
                                   <table class="table">
                                        <thead class="thead-light1">
                                            <tr>
                                                <th>Fecha venta</th>
                                                <!--th>Hora venta</th-->
                                                <th>Total venta</th>
                                                <th>Detalles</th>
                                            </tr>                       
                                        </thead>

                                        <tbody class="tabla-body">                                        
                                            <?php include'buscar_reportes.php'?>
                                         </tbody>

                                    </table>  
                                   <p id="texto-ayuda">Total Venta:  $<?php  echo $format_number1;?></p>
                               </div>
                         </div>                         
                    </div>                                                                                                               
                </div>                             
            </div> 
                 
        </div>
                

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