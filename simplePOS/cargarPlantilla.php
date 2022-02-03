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
        $objPHPExcel = PHPExcel_IOFactory::load($archivo); //funcion load de la libreria
        cargarTablaProductos($objPHPExcel, $mysqli, $idAdmin);
        cargarTablaCategorias($objPHPExcel, $mysqli, $idAdmin);
        cargarTablaSubCategorias($objPHPExcel, $mysqli, $idAdmin);
    }

    function cargarTablaProductos($objPHPExcel, $mysqli, $idAdmin)
    {
        $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); //rows //oja en la que se esta trabajando
        $date = date('Y-m-d');

        echo '<table>';
        echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Categoria</th>';
            echo '<th>Subcategoria</th>';
            echo '<th>Nombre</th>';
            echo '<th>Descripción</th>';
            echo '<th>Precio Venta</th>';
            echo '<th>Precio Compra</th>';
            echo '<th>Codigo de barras</th>';
            echo '<th>Existencias</th>';
        echo '</tr>';

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

            echo '<tr>';
            echo '<td>' . $id . '</td>';
            echo '<td>' . $idCategoria . '</td>';
            echo '<td>' . $idSubCategoria . '</td>';
            echo '<td>' . $nombre . '</td>';
            echo '<td>' . $descripcion . '</td>';
            echo '<td>' . $precioVenta . '</td>';
            echo '<td>' . $precioCompra . '</td>';
            echo '<td>' . $codigoBarras . '</td>';
            echo '<td>' . $existencias . '</td>';
            echo '</tr>';

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
        echo '</table>';
        echo '<br>';
    }

    function cargarTablaCategorias($objPHPExcel, $mysqli, $idAdmin)
    {
        $numRows = $objPHPExcel->setActiveSheetIndex(1)->getHighestRow(); //rows
    
        echo '<table>';
        echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Nombre</th>';
            echo '<th>Descripción</th>';
        echo '</tr>';

        for ($i = 2; $i <= $numRows; $i++) {

            $id = $objPHPExcel->setActiveSheetIndex(1)->getCell('A' . $i);
            $nombre = $objPHPExcel->setActiveSheetIndex(1)->getCell('B' . $i);
            $descripcion = $objPHPExcel->setActiveSheetIndex(1)->getCell('C' . $i);

            echo '<tr>';
            echo '<td>' . $id . '</td>';
            echo '<td>' . $nombre . '</td>';
            echo '<td>' . $descripcion . '</td>';
            echo '</tr>';

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
        echo '</table>';
        echo '<br>';
    }

    function cargarTablaSubCategorias($objPHPExcel, $mysqli, $idAdmin)
    {
        $numRows = $objPHPExcel->setActiveSheetIndex(2)->getHighestRow(); //rows
    
        echo '<table>';
        echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Categoria</th>';
            echo '<th>Nombre</th>';
            echo '<th>Descripcion</th>';
        echo '</tr>';

        for ($i = 2; $i <= $numRows; $i++) {

            $id = $objPHPExcel->setActiveSheetIndex(2)->getCell('A' . $i);
            $idCategoria = $objPHPExcel->setActiveSheetIndex(2)->getCell('B' . $i);
            $nombre = $objPHPExcel->setActiveSheetIndex(2)->getCell('C' . $i);
            $descripcion = $objPHPExcel->setActiveSheetIndex(2)->getCell('D' . $i);

            echo '<tr>';
            echo '<td>' . $id . '</td>';
            echo '<td>' . $idCategoria . '</td>';
            echo '<td>' . $nombre . '</td>';
            echo '<td>' . $descripcion . '</td>';
            echo '</tr>';

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
        echo '</table>';
        echo '<br>';
    }
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
                    
        <div class="tablausuarios">
            <div class="row">
                <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"> </div>
                <div class="col-xs-0 col-sm-0 col-md-8 col-lg-8">
                    
                    <div class="row">
                        <div class="col-lg-3"></div>
                        
                        <div class="col-lg-6 title-tbusuarios">
                            <h2>Cargar Plantilla</h2>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="row iconos-tbusuarios">
                                <div class="col-lg-4">
                                    <!--a href="nuevoUsuario.php" class="fa fa-user-plus fa-2x"></a-->
                                </div>
                                <div class="col-lg-4">
                                    <a href="menuadministrador.php" class="fa fa-reply-all fa-2x"></a>
                                </div>
                                <div class="col-lg-4">
                                    <!--a href="cerrarsesion.php" class="fa fa-unlock-alt fa-2x"></a-->
                                </div>                                    
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <form action="cargarPlantilla.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="archivo" />
                            <input type="submit" name="enviar">
                        </form>
                    </div>

                    <?php 
                        if($archivo != 1){
                            cargarExcel($archivo, $mysqli, $idAdmin);
                        }
                    ?>
                    
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
            
        </script>
              
    <script src="../js/vendor/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/holder.min.js"></script>
        
    </body>
</html>