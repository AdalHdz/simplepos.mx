<?php
    require("../librerias/Classes/PHPExcel/IOFactory.php");

    session_start();
    require("conexion.php");

    $archivo = 1;

    if (isset($_POST["enviar"])) {
        $archivo = $_FILES["archivo"]["tmp_name"]; //archivo
    }

    $fila=0;
    $idAdmin = $_SESSION['idUsuario'];
    $mysqli=mysqli_connect($host, $user, $pass, $db);

    function cargarExcel($archivo, $mysqli, $idAdmin)
    {
        $sqlDelete = "DELETE FROM tb_categoria_producto WHERE idAdmin = '$idAdmin'";
        $resultDelete = $mysqli->query($sqlDelete);
        $sqlDelete = "DELETE FROM tb_compras WHERE idAdmin = '$idAdmin'";
        $resultDelete = $mysqli->query($sqlDelete);
        $sqlDelete = "DELETE FROM tb_detalle_compra WHERE idAdmin = '$idAdmin'";
        $resultDelete = $mysqli->query($sqlDelete);
        $sqlDelete = "DELETE FROM tb_detalle_venta WHERE idAdmin = '$idAdmin'";
        $resultDelete = $mysqli->query($sqlDelete);
        $sqlDelete = "DELETE FROM tb_productos WHERE idAdmin = '$idAdmin'";
        $resultDelete = $mysqli->query($sqlDelete);
        $sqlDelete = "DELETE FROM tb_subcategoria_producto WHERE idAdmin = '$idAdmin'";
        $resultDelete = $mysqli->query($sqlDelete);
        $sqlDelete = "DELETE FROM tb_ventas WHERE idAdmin = '$idAdmin'";
        $resultDelete = $mysqli->query($sqlDelete);        
        
        $objPHPExcel = PHPExcel_IOFactory::load($archivo); //funcion load de la libreria
        cargarTablaProductos($objPHPExcel, $mysqli, $idAdmin);
        cargarTablaCategorias($objPHPExcel, $mysqli, $idAdmin);
        cargarTablaSubCategorias($objPHPExcel, $mysqli, $idAdmin);
    }

    function cargarTablaProductos($objPHPExcel, $mysqli, $idAdmin)
    {
        $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); //rows //oja en la que se esta trabajando
        $date = date('Y-m-d');

        for ($i = 2; $i <= $numRows; $i++) {

            $id = $objPHPExcel->setActiveSheetIndex(0)->getCell('A' . $i);
            $idCategoria = $objPHPExcel->setActiveSheetIndex(0)->getCell('B' . $i);
            $idSubCategoria = $objPHPExcel->setActiveSheetIndex(0)->getCell('C' . $i);
            $nombre = $objPHPExcel->setActiveSheetIndex(0)->getCell('D' . $i);
            $descripcion = $objPHPExcel->setActiveSheetIndex(0)->getCell('E' . $i);
            $precioVenta = $objPHPExcel->setActiveSheetIndex(0)->getCell('F' . $i);
            $precioCompra = $objPHPExcel->setActiveSheetIndex(0)->getCell('G' . $i);
            $codigoBarras = $objPHPExcel->setActiveSheetIndex(0)->getCell('H' . $i);
            $existencias = $objPHPExcel->setActiveSheetIndex(0)->getCell('I' . $i);

            $sqlInsertar = "INSERT INTO tb_productos (
                idProducto, 
                nombreProducto, 
                descripcion, 
                precioVenta, 
                codigoProducto, 
                codigoBarras, 
                idCatProducto, 
                idSubCatProducto, 
                idStatusProducto, 
                fechaRegistro, 
                precioCompra, 
                stock, 
                idAdmin) 
                VALUES (
                '".$id."',
                '".$nombre."',
                '".$descripcion."',
                '".$precioVenta."',
                '123',
                '".$codigoBarras."',
                '".$idCategoria."',
                '".$idSubCategoria."',
                '1',
                '".$date."',
                '".$precioCompra."',
                '".$existencias."',
                '".$idAdmin."')";

            $result = $mysqli->query($sqlInsertar);
        }
    }

    function cargarTablaCategorias($objPHPExcel, $mysqli, $idAdmin)
    {
        $numRows = $objPHPExcel->setActiveSheetIndex(1)->getHighestRow(); //rows

        for ($i = 2; $i <= $numRows; $i++) {

            $id = $objPHPExcel->setActiveSheetIndex(1)->getCell('A' . $i);
            $nombre = $objPHPExcel->setActiveSheetIndex(1)->getCell('B' . $i);
            $descripcion = $objPHPExcel->setActiveSheetIndex(1)->getCell('C' . $i);

            $sqlInsertar = "INSERT INTO tb_categoria_producto (
                idCategoriaProducto, 
                nombreCategoria, 
                descripcion, 
                idAdmin) 
                VALUES (
                '".$id."',
                '".$nombre."',
                '".$descripcion."',
                '".$idAdmin."')";

            $result = $mysqli->query($sqlInsertar);
        }
    }

    function cargarTablaSubCategorias($objPHPExcel, $mysqli, $idAdmin)
    {
        $numRows = $objPHPExcel->setActiveSheetIndex(2)->getHighestRow(); //rows

        for ($i = 2; $i <= $numRows; $i++) {

            $id = $objPHPExcel->setActiveSheetIndex(2)->getCell('A' . $i);
            $idCategoria = $objPHPExcel->setActiveSheetIndex(2)->getCell('B' . $i);
            $nombre = $objPHPExcel->setActiveSheetIndex(2)->getCell('C' . $i);
            $descripcion = $objPHPExcel->setActiveSheetIndex(2)->getCell('D' . $i);

            $sqlInsertar = "INSERT INTO tb_subcategoria_producto (
                idSubcategoriaProducto, 
                nombreSubcategoria, 
                descripcion, 
                idCatProducto,
                idAdmin) 
                VALUES (
                '".$id."',
                '".$nombre."',
                '".$descripcion."',
                '".$idCategoria."',
                '".$idAdmin."')";

            $result = $mysqli->query($sqlInsertar);
        }
    }

    if($archivo != 1){
        cargarExcel($archivo, $mysqli, $idAdmin);
    }

    require("conexion.php");
    $fila=0;
    $idAdmin = $_SESSION['idUsuario'];
    $con=mysqli_connect($host, $user, $pass, $db);
    $consulta="SELECT idProducto, nombreProducto, precioVenta, codigoBarras, precioCompra, stock FROM tb_productos WHERE idStatusProducto = '1' AND idAdmin = '$idAdmin'";
    $result=mysqli_query($con,$consulta);
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
    
    <body class="body-pantallas">
    
        <?php include("cabecera.html");?>                                                
                                                        
        <div class="tablausuarios">
            <div class="row">
                <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
                <div class="col-xs-0 col-sm-0 col-md-8 col-lg-8">
                    <div class="card-deck">
                         <div class="card bg-light-uno">
                           <div class="card-header"><h3>PRODUCTOS</h3></div>
                               <?php 
                                    if($archivo != 1){
                                        echo '<br>';
                                        echo '<div class="row" style="justify-content:center">';
                                        echo '<img src="../img/logo_simple_pos.png" width="30" height="30">';
                                        echo '<p style="margin-left: 10px">Archivo cargado</p>';
                                        echo '</div>';
                                    }
                                    else{
                                        echo '<br>';
                                        echo '<div class="row" style="padding: 0rem 2rem 0rem 2rem">';
                                        echo '<form action="productos.php" method="POST" enctype="multipart/form-data">';
                                        echo '<div class="custom-file">
                                        <!--input type="file" class="custom-file-input" id="inputGroupFile04" name="archivo"-->
                                        <input type="file" id="xlsFile" name="archivo" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                        <!--label class="custom-file-label" for="inputGroupFile04">Choose file</label-->
                                        </div>';
                                        echo '<input type="hidden" name="enviar" id="btnEnviar">';
                                        echo '</form>';
                                        echo '<a href="descargas/plantillaProductos.xlsx" style="margin-left: auto"><img src="img/excel.png" width="50" alt="Descargar Plantilla"></a>';
                                        echo '</div>';                                                        
                                    }                                
                                ?>
                                
                           <div class="card-body tbody_fixed_productos">                                                    
                             
                               <table class="table">
                                    <thead class="thead-light1">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Precio Venta</th>
                                            <th>Precio Compra</th>
                                            <th>Código Barras</th>                            
                                            <th>Existencias</th>
                                        </tr>                       
                                    </thead>
                
                                    <tbody class="tabla-body">                                        
                                        <?php                             
                                            while($mostrar=mysqli_fetch_array($result)){
                                                //$fila += 1;
                                        ?>
                                            <tr>                             
                                                <td><p><?php echo $mostrar['idProducto'] ?></p></td>
                                                <td><p><?php echo $mostrar['nombreProducto'] ?></p></td>
                                                <td><p>$<?php echo number_format($mostrar['precioVenta'],2) ?></p></td>
                                                <td><p>$<?php echo number_format($mostrar['precioCompra'],2) ?></p></td>
                                                <td><p><?php echo $mostrar['codigoBarras'] ?></p></td>
                                                <td><p><?php echo $mostrar['stock'] ?></p></td>      
                                            </tr>  
                                        <?php
                                            }
                                        ?>
                                     </tbody>
              
                                </table>  
                               <!--p class="card-text">Some text inside the first card</p-->
                           </div>
                         </div>                         
                    </div>                                                                            

                    
                
                   
                    
                </div>
                <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
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
        
        <!--Script identificar ID-->
        <script>  
            $('#xlsFile').on("change", function(){ 
                elemento = document.getElementById("btnEnviar");
                elemento.type = 'submit';
            });
        </script>
              
    <script src="../js/vendor/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/holder.min.js"></script>
        
    
        
    </body>
</html>