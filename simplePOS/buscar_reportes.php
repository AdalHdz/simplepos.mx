<?php
    $respuesta["ventas"] = array();
    require("conexion.php");
    $fila=0;   
    $idAdmin = $_SESSION['idUsuario'];
    $con=mysqli_connect($host, $user, $pass, $db);   
	
    
    if(isset($_POST['search'])){
		$date1 = date("Y/m/d", strtotime($_POST['date1']));
		$date2 = date("Y/m/d", strtotime($_POST['date2']));
		$query=mysqli_query($con, "SELECT fechaVenta as fechaventa, SUM(totalVenta) as totalventa FROM tb_ventas WHERE idAdmin = '$idAdmin' AND fechaVenta BETWEEN '$date1' AND '$date2' GROUP BY fechaVenta ORDER BY fechaVenta DESC") or die(mysqli_error());    
		$row=mysqli_num_rows($query);
		if($row>0){
			?>
			
                        <?php
                        while($fetch=mysqli_fetch_array($query)){
                            $tmp = array();
                        $tmp= $fetch["totalventa"];
                        array_push($respuesta["ventas"],$tmp);		
                        ?>

            <tr>
                <td><?php echo $fetch['fechaventa']?></td>
                    <!--td><?php //echo $fetch['horaVenta']?></td-->
                    <!--td><?php echo $fetch['totalVenta']?></td-->
                    <td>$<?php echo number_format($fetch['totalventa'],2)?></td>
                    <td>
                        <div class="container">
                          <!--h2>Modal Example</h2-->
                          <!-- Trigger the modal with a button -->
                          <!--button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button-->
                          <a data-toggle="modal" data-target="#myModal<?php echo $fetch["fechaventa"]; ?>">DETALLES</a>

                          <!-- Modal -->
                          <div class="modal fade" id="myModal<?php echo $fetch["fechaventa"]; ?>" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <!--h4 class="modal-title">Modal Header</h4-->
                                </div>
                                <div class="modal-body">  
                                  <h3><?php echo $fechaid = $fetch["fechaventa"]; ?></h3>
                                   <table class="table table-striped">
                                        <thead class="thead-light1">
                                          <tr>                                
                                            <th>Hora Venta</th>
                                            <th>Método Pago</th>
                                            <th>Total Venta</th>
                                            <th>Detalles</th>
                                          </tr>
                                        </thead>
                                        <tbody class="tabla-body" id="tbodydetalles">
                                           <?php
                                                $totalPorDia = 0;
                                                $queryDetalles = mysqli_query($con, "SELECT tb_ventas.horaVenta as hora, tb_metodo_pago.nombre as metodo, tb_ventas.totalVenta as total FROM tb_ventas LEFT JOIN tb_metodo_pago on tb_metodo_pago.idMetodoPago = tb_ventas.idMetodoPago WHERE tb_ventas.idAdmin = '$idAdmin' AND tb_ventas.fechaVenta = '$fechaid' ORDER BY tb_ventas.horaVenta DESC");
                                                while($fetchDetalles = mysqli_fetch_array($queryDetalles)){
                                            ?>
                                                <tr>
                                                    <td><?php echo $fetchDetalles['hora']; ?></td>
                                                    <td><?php echo $fetchDetalles['metodo']; ?></td>
                                                    <td>$<?php echo number_format($fetchDetalles['total'], 2)?></td>
                                                </tr>    
                                            <?php
                                                $totalPorDia += $fetchDetalles['total'];
                                                }
                                                $format_number2 = number_format($totalPorDia, 2);
                                            ?>
                                       </tbody>

                                      </table>
                                      <p>Total de Venta: $<?php echo $format_number2; ?></p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>

                            </div>
                          </div>

                        </div>       	
                    </td>
                </tr>
                <?php
                        }
                        $taman=count($respuesta["ventas"]);
                    $a=0;
                    $r=0;

                    for($i=0;$i<$taman;$i++){    
                        $r+= $respuesta["ventas"][$i];
                                            }
                    $format_number1 = number_format($r, 2);
		
		}else{
			echo '
			<tr>
				<td colspan = "4"><center>No hay datos</center></td>
			</tr>';
			$format_number1 = 0.00;
		}
		
	}else{
		//$query=mysqli_query($con, "SELECT tb_ventas.fechaVenta, tb_ventas.horaVenta, tb_metodo_pago.nombre, tb_ventas.totalVenta FROM tb_ventas LEFT JOIN tb_metodo_pago on tb_metodo_pago.idMetodoPago = tb_ventas.idMetodoPago WHERE tb_ventas.idAdmin = '$idAdmin' ORDER BY tb_ventas.fechaVenta DESC") or die(mysqli_error());        
        $year = date("Y");
        $month = date("m");
        $r = 0;
        $query=mysqli_query($con, "SELECT fechaVenta, SUM(totalVenta) as totalventa FROM tb_ventas WHERE idAdmin = '$idAdmin' AND fechaVenta LIKE '{$year}/{$month}/%' GROUP BY fechaVenta ORDER BY fechaVenta DESC") or die(mysqli_error());
        $fetch=array();
		while($fetch=mysqli_fetch_array($query)){
			$tmp = array();
            $tmp= $fetch["fechaVenta"];
            array_push($respuesta["ventas"],$tmp);	
    ?>    
    <tr>
		<td><?php echo $fetch['fechaVenta']?></td>
		<!--td><?php //echo $fetch['horaVenta']?></td-->
		<!--td><?php //echo $fetch['totalVenta']?></td-->
		<td>$<?php echo number_format($fetch['totalventa'],2)?></td>
		<!--td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button></td-->		
		<td>
		    <div class="container">
              <!--h2>Modal Example</h2-->
              <!-- Trigger the modal with a button -->
              <!--button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button-->
              <a data-toggle="modal" data-target="#myModal<?php echo $fetch["fechaVenta"]; ?>">DETALLES</a>

              <!-- Modal -->
              <div class="modal fade" id="myModal<?php echo $fetch["fechaVenta"]; ?>" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <!--h4 class="modal-title">Modal Header</h4-->
                    </div>
                    <div class="modal-body">  
                      <h3><?php echo $fechaid = $fetch["fechaVenta"]; ?></h3>
                       <table class="table table-striped">
                            <thead class="thead-light1">
                              <tr>                                
                                <th>Hora Venta</th>
                                <th>Método Pago</th>
                                <th>Total Venta</th>
                              </tr>
                            </thead>
                            <tbody class="tabla-body" id="tbodydetalles">
                               <?php
                                    $totalPorDia = 0;
                                    $queryDetalles = mysqli_query($con, "SELECT tb_ventas.horaVenta as hora, tb_metodo_pago.nombre as metodo, tb_ventas.totalVenta as total FROM tb_ventas LEFT JOIN tb_metodo_pago on tb_metodo_pago.idMetodoPago = tb_ventas.idMetodoPago WHERE tb_ventas.idAdmin = '$idAdmin' AND tb_ventas.fechaVenta = '$fechaid' ORDER BY tb_ventas.horaVenta DESC");
                                    while($fetchDetalles = mysqli_fetch_array($queryDetalles)){
                                ?>
                                    <tr>
                                        <td><?php echo $fetchDetalles['hora']; ?></td>
                                        <td><?php echo $fetchDetalles['metodo']; ?></td>
                                        <td>$<?php echo number_format($fetchDetalles['total'], 2)?></td>
                                    </tr>    
                                <?php
                                    $totalPorDia += $fetchDetalles['total'];
                                    }
                                    $format_number2 = number_format($totalPorDia, 2);
                                ?>
                           </tbody>
                               
                          </table>
                          <p>Total de Venta: $<?php echo $format_number2; ?></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>

                </div>
              </div>

            </div>       	
		</td>
	</tr>                       

    <?php
        
        $r += $fetch["totalventa"];
		}
		//$taman=count($respuesta["ventas"]);
        //$a=0;
        //$r=0;
		 
        //for($i=0;$i<$taman;$i++){    
        //    $r += $respuesta["ventas"][$i];
        //                        }
        $format_number1 = number_format($r, 2);	                
                        
	}
    ?>       
    
    
        
    
    