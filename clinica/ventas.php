<?php require "header.php";
require('global.php');
$link = bases();

?> 
      <div class="container-fluid">
        <!--  Row 1 -->

        <div class="row">
          <div class="col-12 frase mb-4">
              <p>Frase del dia: <b style="font-size: 15px;">
            <?php
          $url = "https://frasedeldia.azurewebsites.net/api/phrase";
          $json = file_get_contents($url);
          $json_data = json_decode($json, true);

          // Corregir la sintaxis para acceder al elemento "phrase" del array
          echo $json_data['phrase'];
          ?>
          </b></p> 
          </div>

           <!-- Button trigger modal -->
           <button type="button" class="btn boton-ayuda" data-toggle="modal" data-target="#exampleModal" style="text-align: right;">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Página de ventas</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <b>Módulo de ventas:</b> En esta sección se pueden ver todas las ventas que ha tenido el año a manera de texto, tambien se visualiza una grafica con el número de mes y el monto obtenido en cada mes<br> <br>
                 <b>Secciones de desgloce:</b>Se visualizan secciones de los movimientos recientes de manera detallada, se muestra el total de ingresos y egresos de manera detallada
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body p-3">
                <div class="chart">
                    <?php
                    // Realiza la consulta para obtener la suma de monto por fecha_pagado por mes
                    $sql = "SELECT MONTH(fecha_pagado) as mes, SUM(monto) as total_pagado 
                            FROM pago_paciente 
                            GROUP BY MONTH(fecha_pagado)";

                    $result = $link->query($sql);

                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }

                    // Convierte el array PHP a JSON
                    $json_data = json_encode($data);
                    ?>

                    <canvas id="grafica"></canvas>
                </div>
            </div>

            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
                <!-- Yearly Breakup -->
                <?php
                  // Realiza la consulta para obtener la suma de monto por fecha_pagado por año
                  $sqlYearlySales = "SELECT YEAR(fecha_pagado) as anio, SUM(monto) as total_ventas 
                                     FROM pago_paciente 
                                     GROUP BY YEAR(fecha_pagado)
                                     ORDER BY anio DESC LIMIT 1";

                  $resultYearlySales = $link->query($sqlYearlySales);

                  if ($resultYearlySales && $resultYearlySales->num_rows > 0) {
                      $rowYearlySales = $resultYearlySales->fetch_assoc();
                      $anio = $rowYearlySales['anio'];
                      $totalVentas = $rowYearlySales['total_ventas'];
                      $porcentajeCrecimiento = 9; // Puedes ajustar esto según tus datos reales
                      $ultimoAnio = date("Y") - 1; // Para calcular el porcentaje de crecimiento respecto al año anterior
                      $crecimientoAnual = (($totalVentas / $ultimoAnio) - 1) * 100; // Cálculo del porcentaje de crecimiento
                  } else {
                      // Si no hay datos, establecer valores predeterminados
                      $anio = date("Y");
                      $totalVentas = 0;
                      $porcentajeCrecimiento = 0;
                      $crecimientoAnual = 0;
                  }
                  ?>

                  <div class="card overflow-hidden">
                      <div class="card-body p-4">
                          <h5 class="card-title mb-9 fw-semibold">Ventas del año <?php echo $anio; ?></h5>
                          <div class="row align-items-center">
                              <div class="col-8">
                                  <h4 class="fw-semibold mb-3">$<?php echo number_format($totalVentas, 2); ?></h4>
                                  <div class="d-flex align-items-center mb-3">
                                      <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                          <i class="ti ti-arrow-up-left text-success"></i>
                                      </span>
                                      <p class="text-dark me-1 fs-3 mb-0">+<?php echo $porcentajeCrecimiento; ?>%</p>
                                      <p class="fs-3 mb-0">este año</p>
                                  </div>
                              </div>
                              <div class="col-4">
                                  <div class="d-flex justify-content-center">
                                      <div id="breakup"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                </div>
              </div>
              


            <?php
            // Realiza la consulta para obtener la suma de montos de pagos por fecha_pagado por mes
            $sqlMonthlyPayments = "SELECT MONTH(fecha_pagado) as mes, SUM(monto) as total_pagos 
                                  FROM pago_paciente 
                                  GROUP BY MONTH(fecha_pagado)
                                  ORDER BY mes DESC LIMIT 1";

            $resultMonthlyPayments = $link->query($sqlMonthlyPayments);

            if ($resultMonthlyPayments && $resultMonthlyPayments->num_rows > 0) {
                $rowMonthlyPayments = $resultMonthlyPayments->fetch_assoc();
                $mes = $rowMonthlyPayments['mes'];
                $totalPagos = $rowMonthlyPayments['total_pagos'];
                $porcentajeAumento = 9; // Puedes ajustar esto según tus datos reales
                $mesAnterior = date("n") - 1; // Para calcular el porcentaje de aumento respecto al mes anterior

                // Evitar la división por cero
                $aumentoMensual = ($mesAnterior != 0) ? (($totalPagos / $mesAnterior) - 1) * 100 : 0;
            } else {
                // Si no hay datos, establecer valores predeterminados
                $mes = date("n");
                $totalPagos = 0;
                $porcentajeAumento = 0;
                $aumentoMensual = 0;
            }
            ?>

            <div class="col-lg-12">
                <!-- Monthly Payments -->
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Ventas mensuales</h5>
                                <h4 class="fw-semibold mb-3">$<?php echo number_format($totalPagos, 2); ?></h4>
                                <div class="d-flex align-items-center pb-1">
                                    <?php
                                    if ($aumentoMensual > 0) {
                                        // Si el porcentaje es positivo, mostrar el icono de aumento
                                        echo '<span class="me-2 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-arrow-up-left text-success"></i>
                                              </span>';
                                        echo '<p class="text-dark me-1 fs-3 mb-0">' . $aumentoMensual . '%</p>';
                                    } else {
                                        // Si el porcentaje es negativo o cero, mostrar el icono de disminución
                                        echo '<span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-arrow-down-right text-danger"></i>
                                              </span>';
                                        echo '<p class="text-dark me-1 fs-3 mb-0">' . abs($aumentoMensual) . '%</p>';
                                    }
                                    ?>
                                    <p class="fs-3 mb-0">este mes</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-currency-dollar fs-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="payment"></div>
                </div>
            </div>






            </div>
          </div>
      






        <div class="row container mt-5">



        <div class="mb-5 mb-sm-0 mt-3 text-center">
            <h1 class="card-title fw-semibold">Desgloce del mes actual</h1>
        </div>



        <div class="col-12 mt-4">
          <div class="card mb-4 px-3">
            <div class="card-header pb-0">
              <h6>Todas las ventas</h6>
            </div>



         


 
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Paciente</th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Total</th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Accciones</th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    
                    <?php
                      // Obtener el primer y último día del mes actual
                      $primerDiaMes = date('Y-m-01');
                      $ultimoDiaMes = date('Y-m-t');

                      // Consulta SQL para obtener los registros del mes actual de pago_paciente y unir con pacientes
                      $sql = "SELECT pago_paciente.*, pacientes.nombre, pacientes.aPaterno, pacientes.aMaterno
                              FROM pago_paciente
                              INNER JOIN pacientes ON pago_paciente.id_paciente = pacientes.id_paciente
                              WHERE fecha_pagado BETWEEN '$primerDiaMes' AND '$ultimoDiaMes'
                              LIMIT 50"; // Ajusta el límite según tus necesidades

                      $result = $link->query($sql);

                      if ($result && $result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                              echo '<tr>';
                              echo '<td>
                                      <div class="d-flex px-2 py-1">
                                        <div>
                                          <i class="fa fa-user me-3"></i>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                          <h6 class="mb-0 text-sm">' . $row['nombre'] . ' ' . $row['aPaterno'] . ' ' . $row['aMaterno'] . '</h6>
                                        </div>
                                      </div>
                                    </td>';
                              echo '<td class="align-middle text-sm">
                                      <span class="text-xs font-weight-bold">' . date('d/m/Y', strtotime($row['fecha_pagado'])) . '</span>
                                    </td>';
                              echo '<td class="align-middle text-sm">
                                      <span class="text-xs font-weight-bold">$' . number_format($row['total'], 2) . '</span>
                                    </td>';
                              echo '<td class="align-middle ">
                                      <span class="text-secondary text-xs font-weight-bold">
                                        <a href="perfil.php?id_paciente=' . $row['id_paciente'] . '">Ver perfil</a>
                                      </span>
                                    </td>';
                              echo '</tr>';
                          }
                      } else {
                          // No se encontraron registros
                          echo '<tr><td colspan="4" class="text-center">No hay registros para el mes actual.</td></tr>';
                      }
                      ?>


    


                  </tbody>
                </table>
              </div>
            </div>
            <!-- CIERRA CONTENIDO DE TABLA -->
          </div>



          
        </div>







          </div>
        </div>


        

         <?php
          // Obtener el primer y último día del mes actual
          $primerDiaMes = date('Y-m-01');
          $ultimoDiaMes = date('Y-m-t');

          // Consulta SQL para obtener el total de ingresos del mes
          $sqlTotalIngresosMes = "SELECT COUNT(*) as total_registros, SUM(total) as total_ingresos
                                  FROM pago_paciente
                                  WHERE fecha_pagado BETWEEN '$primerDiaMes' AND '$ultimoDiaMes'";

          $resultTotalIngresosMes = $link->query($sqlTotalIngresosMes);

          if ($resultTotalIngresosMes && $resultTotalIngresosMes->num_rows > 0) {
              $rowTotalIngresosMes = $resultTotalIngresosMes->fetch_assoc();
              $totalRegistros = $rowTotalIngresosMes['total_registros'];
              $totalIngresos = $rowTotalIngresosMes['total_ingresos'];
          } else {
              // Si no hay datos, establecer valores predeterminados
              $totalRegistros = 0;
              $totalIngresos = 0;
          }
          ?>

          <!-- Luego, incorpora este fragmento de código en tu HTML -->

          <div class="card mb-4 px-3">
              <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                          <thead>
                              <tr>
                                  <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Total de ingresos del mes</th>
                                  <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Total</th>

                                  <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Acciones</th>

                                  <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7"></th>
                                  <th class="text-secondary opacity-7"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                      <div class="d-flex px-2 py-1">
                                          <div class="d-flex flex-column justify-content-center">
                                              <h6 class="mb-0 text-sm"><?php echo $totalRegistros; ?></h6>
                                          </div>
                                      </div>
                                  </td>

                                  <td class="text-sm">
                                      <span class="text-xs font-weight-bold">$<?php echo number_format($totalIngresos, 2); ?></span>
                                  </td>

                                  <td class="align-middle text-center">
                                      <a href="pagos.php" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                          data-original-title="Ver todos los pagos">
                                          Ver todos los pagos
                                      </a>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>





                   <?php
          // Obtener el primer y último día del mes actual
          $primerDiaMes = date('Y-m-01');
          $ultimoDiaMes = date('Y-m-t');

          // Consulta SQL para obtener el total de egresos del mes
          $sqlTotalEgresosMes = "SELECT COUNT(*) as total_registros, SUM(monto) as total_egresos
                                 FROM compras
                                 WHERE fecha_aplicacion BETWEEN '$primerDiaMes' AND '$ultimoDiaMes'
                                   AND estatus = 'Pagada'";

          $resultTotalEgresosMes = $link->query($sqlTotalEgresosMes);

          if ($resultTotalEgresosMes && $resultTotalEgresosMes->num_rows > 0) {
              $rowTotalEgresosMes = $resultTotalEgresosMes->fetch_assoc();
              $totalRegistrosEgresos = $rowTotalEgresosMes['total_registros'];
              $totalEgresos = $rowTotalEgresosMes['total_egresos'];
          } else {
              // Si no hay datos, establecer valores predeterminados
              $totalRegistrosEgresos = 0;
              $totalEgresos = 0;
          }
          ?>

          <!-- Luego, incorpora este fragmento de código en tu HTML -->

          <div class="card mb-4 px-3">
              <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                          <thead>
                              <tr>
                                  <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Total de egresos del mes</th>
                                  <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Total</th>

                                  <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Acciones</th>

                                  <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7"></th>
                                  <th class="text-secondary opacity-7"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                      <div class="d-flex px-2 py-1">
                                          <div class="d-flex flex-column justify-content-center">
                                              <h6 class="mb-0 text-sm"><?php echo $totalRegistrosEgresos; ?></h6>
                                          </div>
                                      </div>
                                  </td>

                                  <td class="text-sm">
                                      <span class="text-xs font-weight-bold">$<?php echo number_format($totalEgresos, 2); ?></span>
                                  </td>

                                  <td class="align-middle text-center">
                                      <a href="compras.php" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                          data-original-title="Ver todas las compras">
                                          Ver todas las compras
                                      </a>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>




          <div class="card mb-4 px-3">
              <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Total de ganancias del mes</th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Total</th>
              
                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Accciones</th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">total</h6>
                          </div>
                        </div>
                      </td>
                      
                      <td class="text-sm">
                       <span class="text-xs font-weight-bold">
                         <?php $ganancias = $totalIngresos - $totalEgresos;
                         echo $ganancias; ?>
                       </span>
                      </td>
                      
                      <td class="align-middle text-center">
                        <a href="pagos.php" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Ver todos los pagos
                        </a>
                      </td>
                    </tr>


                  </tbody>
                </table>
              </div>
            </div>
         </div> 


<!--
         <div class="col-4 text-center mb-5">
           <a href="#" class="btn btn-primary">Ver mes anterior</a>
         </div>

         <div class="col-4 text-center mb-5">
           <a href="" class="btn btn-primary">Ver reportes anuales</a>
         </div>


         <div class="col-4 text-center mb-5">
           <a href="cartera-vencida.html" class="btn btn-warning">Ver Cartera vencida</a>
         </div>

  -->

  </div>
<script>
    // Parsea el JSON generado en PHP
    var jsonData = <?php echo $json_data; ?>;

    // Prepara los datos para la gráfica
    var meses = [];
    var montosPagados = [];

    jsonData.forEach(function (item) {
        meses.push("Mes " + item.mes);
        montosPagados.push(item.total_pagado);
    });

    // Crea la gráfica utilizando Chart.js
    var ctx = document.getElementById('grafica').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Monto Pagado por Mes',
                data: montosPagados,
                backgroundColor: '#5D87FF'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<?php 
$link->close();
require "footer.php";?> 
