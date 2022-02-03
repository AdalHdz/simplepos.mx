<?php
    session_start();
    require("conexion.php");

    $fila=0;
    $idAdmin = $_SESSION['idUsuario'];
    $con=mysqli_connect($host, $user, $pass, $db);
    $consulta="SELECT tb_productos.nombreProducto as nombreproducto, SUM(tb_detalle_venta.cantidad) as sumacantidad FROM tb_detalle_venta LEFT JOIN tb_productos ON tb_productos.idProducto = tb_detalle_venta.idProducto WHERE tb_detalle_venta.idAdmin = '$idAdmin' GROUP BY tb_productos.nombreProducto ORDER BY SUM(tb_detalle_venta.cantidad) DESC LIMIT 5";
    $result=mysqli_query($con,$consulta);

    $consultaAcumulado="SELECT SUM(totalVenta) as totalAcumulado FROM tb_ventas WHERE idAdmin = '$idAdmin'";
    $resultAcumulado=mysqli_query($con,$consultaAcumulado);
    $mostrarAcumulado = mysqli_fetch_array($resultAcumulado);

    $year = date("Y");
    $month = date("m");
    $consultaVentasDia="SELECT fechaVenta as fechaventa, SUM(totalVenta) as totalventa FROM tb_ventas WHERE idAdmin = '$idAdmin' AND fechaVenta LIKE '{$year}/{$month}/%' GROUP BY fechaVenta ORDER BY fechaVenta DESC";
    $resultVentasDia=mysqli_query($con,$consultaVentasDia);

    $consultaAcumuladoMES="SELECT SUM(totalVenta) as totalAcumulado FROM tb_ventas WHERE idAdmin = '$idAdmin' AND YEAR(fechaVenta) = '$year' AND MONTH(fechaVenta) = '$month'";
    $resultAcumuladoMES=mysqli_query($con,$consultaAcumuladoMES);
    $mostrarAcumuladoMES = mysqli_fetch_array($resultAcumuladoMES);

    $consultaVentasMensuales="SELECT month(fechaVenta) as mes, SUM(totalVenta) as totalventa FROM tb_ventas WHERE YEAR(fechaVenta) = '$year' AND idAdmin = '$idAdmin' GROUP BY mes ORDER BY mes";
    $resultVentasMensuales=mysqli_query($con,$consultaVentasMensuales);    
    $arrayMeses = array();
    $arrayVentas = array();
    $arrayAuxMeses = array();
    $arrayAuxVentas = array();
    $arrayYears = array();
    //array_push($arrayYears, 2019);
    array_push($arrayYears, 2020);
    array_push($arrayYears, 2021);

    $consultaStock="SELECT idProducto, nombreProducto, descripcion, stock FROM tb_productos WHERE idAdmin = '$idAdmin' AND idStatusProducto = 1";
    $resultStock=mysqli_query($con,$consultaStock);    
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
     <script src="../js/angular.js"></script>
    
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> <!--GRAFICAS Charts.js-->  
     <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

 
  </head>
    
    <body class="body-pantallas">
    
        <?php include("cabecera.html");?>
        
            <!--div class="row hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
                <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
                    <div class="col-lg-8 crm-menu">
                            <div class="title-menu">
                                <div class="row">
                                        <div class="col-xs-0 col-sm-0 col-md-12 col-lg-12 text-centro">
                                        <h2>Menú Administrador</h2><br>
                                    </div> 
                                </div>     
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <a href="productos.php" class="hi-icon hi-icon-usuarios">Productos</a>
                                    <p>Productos</p>
                                </div>                                
                                <div class="col-lg-4">
                                    <a href="reportes.php" class="hi-icon hi-icon-reportes">Reportes</a>
                                    <p>Reportes</p>
                                </div>
                                <div class="col-lg-4">
                                    <a href="configuracion.php" class="hi-icon hi-icon-config">Configuracion</a>
                                    <p>Configuración</p>
                                </div>
                            </div>
                    </div>
                <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
            </div-->
            <div id="content">
                <br>    
                <div class="row">
                
               <div class="col-sm-12">
                  <div class="row">
                     <div class="col-sm-12">
                         <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-style">
                            <div class="container-fluid">
                                <h3 class="text-color-white">ACUMULADO DE VENTAS: $<?php echo number_format($mostrarAcumulado['totalAcumulado'],2) ?></h3>
                            </div>
                        </nav>
                     </div>                
                  </div>
                  <br>
                   <div class="row">
                    <div class="col-sm-12 padding-bottom">
                        <div class="card-deck">
                         <div class="card bg-light-uno">
                           <div class="card-header">ACUMULADO DE VENTAS DEL MES: $<?php echo number_format($mostrarAcumuladoMES['totalAcumulado'],2) ?></div>
                           <div class="card-body tbody_fixed">                                                    
                             
                               <table class="table">
                                    <thead class="thead-light1">
                                        <tr>
                                            <th>DÍA</th>
                                            <th>TOTAL VENTA</th>
                                            <!--th>DETALLE</th-->                                            
                                        </tr>
                                    </thead>
                
                                    <tbody class="tabla-body">                                        
                                        <?php   
                                            while($mostrarVentaDia=mysqli_fetch_array($resultVentasDia)){
                                        ?>
                                            <tr>                             
                                                <td><?php echo $mostrarVentaDia['fechaventa'] ?></td>
                                                <td>$ <?php echo number_format($mostrarVentaDia['totalventa'],2) ?></td>                                                
                                            </tr>  
                                        <?php
                                            }
                                        ?>
                                     </tbody>
              
                                </table>  
                               <!--p class="card-text">Some text inside the first card</p-->
                           </div>
                         </div>
                         <div class="card bg-light-uno">
                           <div class="card-header">PRODUCTOS MÁS VENDIDOS</div>
                           <div class="card-body">
                             <table class="table">
                                    <thead class="thead-light1">
                                        <tr>
                                            <th></th>
                                            <th>PRODUCTOS</th>
                                            <th>CANTIDAD</th>                                            
                                        </tr>
                                    </thead>
                
                                    <tbody class="tabla-body">                                        
                                        <?php                                                                         
                                            while($mostrar=mysqli_fetch_array($result)){
                                            $fila = $fila + 1;
                                        ?>
                                            <tr>                             
                                                <td><?php echo $fila ?></td>
                                                <td><?php echo $mostrar['nombreproducto'] ?></td>
                                                <td><?php echo $mostrar['sumacantidad'] ?></td>                                               
                                            </tr>  
                                        <?php                                            
                                            }
                                        ?>
                                     </tbody>
              
                                </table>
                           </div>
                         </div>                    
                       </div>
                    </div>                              
                  </div>
                   
                   <br>
                   
                   <div class="row">
                    <div class="col-sm-12">
                        <div class="card-deck">
                         <div class="card bg-light-uno">
                           <div class="card-header">VENTAS MENSUALES</div>
                           <div class="card-body">
                            
                                        <?php                                                                         
                                            /*while($mostrarVentasMensuales=mysqli_fetch_array($resultVentasMensuales)){
                                            
                                            array_push($arrayMeses, nombreMes($mostrarVentasMensuales['mes']));
                                            array_push($arrayVentas, $mostrarVentasMensuales['totalventa']);
                                            }
                               
                                            function nombreMes($mes){
                                                $nomMes = "";
                                                switch($mes){
                                                    case 1:
                                                        $nomMes = "Enero";
                                                        break;
                                                        case 2:
                                                        $nomMes = "Febrero";
                                                        break;
                                                        case 3:
                                                        $nomMes = "Marzo";
                                                        break;
                                                        case 4:
                                                        $nomMes = "Abril";
                                                        break;
                                                        case 5:
                                                        $nomMes = "Mayo";
                                                        break;
                                                        case 6:
                                                        $nomMes = "Junio";
                                                        break;
                                                        case 7:
                                                        $nomMes = "Julio";
                                                        break;
                                                        case 8:
                                                        $nomMes = "Agosto";
                                                        break;
                                                        case 9:
                                                        $nomMes = "Septiembre";
                                                        break;
                                                        case 10:
                                                        $nomMes = "Octubre";
                                                        break;
                                                        case 11:
                                                        $nomMes = "Noviembre";
                                                        break;
                                                        case 12:
                                                        $nomMes = "Diciembre";
                                                        break;                                                    
                                                }
                                                return $nomMes;
                                            }*/
                                            while($mostrarVentasMensuales=mysqli_fetch_array($resultVentasMensuales)){
                                                array_push($arrayAuxMeses, $mostrarVentasMensuales['mes']);
                                                array_push($arrayAuxVentas, $mostrarVentasMensuales['totalventa']);
                                            }
                                            
                                            for($i=0; $i<12; $i++){
                                                //$x = 0;
                                                $position = 0;
                                                $flag = 0;
                                                for($x=0; $x<count($arrayAuxMeses); $x++){
                                                    if($arrayAuxMeses[$x] == ($i+1)){
                                                        $position = $x;
                                                        $flag = 1;
                                                    }
                                                }
                                                if($flag==1){
                                                        array_push($arrayMeses, $arrayAuxMeses[$position]);
                                                        array_push($arrayVentas, $arrayAuxVentas[$position]);
                                                    }else{
                                                        array_push($arrayMeses, ($i+1));
                                                        array_push($arrayVentas, 0);
                                                }                                        
                                            }
                                        ?>
                            <canvas id="myChart" style="width: 100"></canvas>                                    
                                  <div class="text-centro">
                                     <label for="customRange2" id="labelInpuRange"><?php echo $arrayYears[0]; ?></label>
                                      <input type="range" min="1" max="<?php echo sizeof($arrayYears); ?>" id="customRange2" value="<?php echo end($arrayYears); ?>">                                         
                                        <label for="customRange2" id="labelInpuRange"><?php echo end($arrayYears); ?></label>
                                  </div>
                                                                                             
                             <!--table class="table">
                                    <thead class="thead-light1">
                                        <tr>
                                            <th>EMPRESA</th>
                                            <th>TOTAL</th>
                                            <th>DETALLE</th>                                            
                                        </tr>
                                    </thead>
                
                                    <tbody>                                        
                                        
                                     </tbody>
              
                                </table-->
                           </div>
                         </div>
                         <div class="card bg-light-uno">
                           <div class="card-header">INVENTARIO</div>
                           <div class="card-body tbody_fixed">
                             <table class="table">
                                    <thead class="thead-light1">
                                        <tr>
                                            <th>ID</th>
                                            <th>PRODUCTO</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>EXISTENCIAS</th>                                            
                                        </tr>
                                    </thead>
                                     
                                    <tbody class="tabla-body">                                        
                                        <?php                                                                         
                                            while($mostrarStock=mysqli_fetch_array($resultStock)){                                            
                                        ?>
                                            <tr>                                                                             
                                                <td><?php echo $mostrarStock['idProducto'] ?></td>
                                                <td><?php echo $mostrarStock['nombreProducto'] ?></td>                                               
                                                <td><?php echo $mostrarStock['descripcion'] ?></td>
                                                <td><?php echo $mostrarStock['stock'] ?></td>                                                
                                            </tr>  
                                        <?php                                            
                                            }
                                        ?>
                                     </tbody>
              
                                </table>
                           </div>
                         </div>                    
                       </div>
                    </div>                                           
                       
                  </div>
               </div>                              
           </div>    
            </div>    
            
            
        
        <?php //echo($_SESSION['rol']); 
                //$_SESSION['idUsuario']?>

       <!--script>
           var xValues = <?php echo json_encode($arrayMeses);?>;
            var yValues = <?php echo json_encode($arrayVentas);?>;
            var barColors = "#438d8b";

            new Chart("myChart", {
              type: "bar",
              data: {
                labels: xValues,
                datasets: [{
                  backgroundColor: barColors,
                  data: yValues
                }]
              },
              options: {
                legend: {display: false},
                title: {
                  display: true,
                  text: <?php echo json_encode($year);?>
                },
               
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function (value) {
                                return numeral(value).format('$ 0,0')
                            }
                        }
                    }]
                },
                    
                tooltips: {
                      callbacks: {
                          label: function(tooltipItem, data) {
                              return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                          }
                      }
                }
                    
              }
            });
        </script-->
        
        <script>
           //var xValues = <?php echo json_encode($arrayMeses);?>;
           var xValues = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            var yValues = <?php echo json_encode($arrayVentas);?>;
            var barColors = "#23586D";

            new Chart("myChart", {
              type: "line",
              data: {
                labels: xValues,
                datasets: [{
                  borderColor: barColors,
                  data: yValues,
                    backgroundColor: "rgba(35,88,109,0.6)",
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    pointColor: barColors
                }]
              },
              options: {
                legend: {display: false},
                title: {
                  display: true,
                  text: <?php echo json_encode($year);?>
                },
               
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function (value) {
                                return numeral(value).format('$ 0,0')
                            }
                        }
                    }]
                },
                    
                tooltips: {
                      callbacks: {
                          label: function(tooltipItem, data) {
                              return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                          }
                      }
                }
                    
              }
            });
        </script>           
       
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