<?php 
session_start();


// Función para obtener los últimos ingresos limitados de pacientes
    function obtenerUltimosIngresos($link, $limit)
          {
                // Realiza la consulta para obtener los últimos ingresos limitados de pacientes
                $sql = "SELECT id_paciente, nombre, aPaterno, aMaterno, fechaIngreso FROM pacientes WHERE archivado = 'No' ORDER BY fechaIngreso DESC LIMIT $limit";

                // Ejecuta la consulta y obtén los datos
                $result = $link->query($sql);

                if ($result && $result->num_rows > 0) {
                    $data = [];
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    return $data;
                } else {
                    return [];
                }

            }


            // Función para obtener las últimas operaciones de la tabla agenda limitadas
              // Función para obtener las últimas operaciones de la tabla agenda limitadas
              function obtenerUltimasOperacionesAgenda($link, $limit)
              {
                  // Realiza la consulta para obtener las últimas operaciones de la tabla agenda limitadas
                  $sql = "SELECT fecha, id_paciente, observaciones FROM agenda ORDER BY fecha DESC LIMIT $limit";

                  // Ejecuta la consulta y obtén los datos
                  $result = $link->query($sql);

                  // Verifica si la consulta fue exitosa y devuelve los datos
                  if ($result && $result->num_rows > 0) {
                      $data = [];
                      while ($row = $result->fetch_assoc()) {
                          $data[] = $row;
                      }
                      return $data;
                  } else {
                      return [];
                  }
              }


// Función para obtener los últimos pagos limitados
                   // Función para obtener los últimos pagos limitados
                function obtenerUltimosPagos($link, $limit)
                {
                    // Realiza la consulta para obtener los últimos pagos limitados
                    $sql = "SELECT fecha_pagado, id_paciente, monto FROM pago_paciente WHERE archivado ='no' ORDER BY fecha_pagado DESC LIMIT $limit";
                
                    // Ejecuta la consulta y obtén los datos
                    $result = $link->query($sql);
                
                    // Verifica si la consulta fue exitosa y devuelve los datos
                    if ($result && $result->num_rows > 0) {
                        $data = [];
                        while ($row = $result->fetch_assoc()) {
                            $data[] = $row;
                        }
                        return $data;
                    } else {
                        return [];
                    }
                }

                    // Función para obtener el nombre del paciente
                    function obtenerNombrePaciente($link, $idPaciente)
                    {
                        // Realiza la consulta para obtener el nombre del paciente según el id_paciente
                        $sql = "SELECT nombre, aPaterno FROM pacientes WHERE id_paciente = $idPaciente";

                        // Ejecuta la consulta y obtén los datos
                        $result = $link->query($sql);

                        // Verifica si la consulta fue exitosa y devuelve el nombre del paciente
                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            return $row['nombre'] . ' ' . $row['aPaterno'];
                        } else {
                            return 'Paciente Desconocido';
                        }
                    }




// Verifica si la sesión existe y si el usuario tiene el rol "SuperAdministrador"
if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 'SuperAdministrador' || $_SESSION['rol'] == 'Administracion')) {

require "header.php";
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

          <!-- Button trigger modal -->
           <button type="button" class="btn boton-ayuda" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Página de inicio</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <b>Módulo de ventas:</b> En esta sección se pueden ver todas las ventas que ha tenido el año a manera de texto, tambien se visualiza una grafica con el número de mes y el monto obtenido en cada mes<br> <br>
                 <b>Secciones de movimientos:</b>Se visualizan secciones de los movimientos recientes asi como los pacientes añadidos recientemente
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
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
WHERE archivado = 'no'
GROUP BY YEAR(fecha_pagado)
ORDER BY anio DESC
LIMIT 1;";

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
                          <h5 class="card-title mb-9 fw-semibold">Ventas del año <?php echo $anio; ?> </h5>

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
              // Realiza la consulta para obtener la suma de montos de compras por fecha_aplicacion por mes
              $sqlMonthlyExpenses = "SELECT MONTH(fecha_aplicacion) as mes, SUM(monto) as total_gastos 
                                    FROM compras 
                                    GROUP BY MONTH(fecha_aplicacion)
                                    ORDER BY mes DESC LIMIT 1";

              $resultMonthlyExpenses = $link->query($sqlMonthlyExpenses);

              if ($resultMonthlyExpenses && $resultMonthlyExpenses->num_rows > 0) {
                  $rowMonthlyExpenses = $resultMonthlyExpenses->fetch_assoc();
                  $mes = $rowMonthlyExpenses['mes'];
                  $totalGastos = $rowMonthlyExpenses['total_gastos'];
                  $porcentajeDescuento = 9; // Puedes ajustar esto según tus datos reales
                  $mesAnterior = date("n") - 1; // Para calcular el porcentaje de descuento respecto al mes anterior

                  // Evitar la división por cero
                  $descuentoMensual = ($mesAnterior != 0) ? (($totalGastos / $mesAnterior) - 1) * 100 : 0;
              } else {
                  // Si no hay datos, establecer valores predeterminados
                  $mes = date("n");
                  $totalGastos = 0;
                  $porcentajeDescuento = 0;
                  $descuentoMensual = 0;
              }
              ?>

              <div class="col-lg-12">
                  <!-- Monthly Earnings -->
                  <div class="card">
                      <div class="card-body">
                          <div class="row align-items-start">
                            <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold">Gastos mensuales</h5>
                                    <h4 class="fw-semibold mb-3">$<?php echo number_format($totalGastos, 2); ?></h4>
                                    <div class="d-flex align-items-center pb-1">
                                        <?php
                                        if ($porcentajeDescuento < 0) {
                                            // Si el porcentaje es negativo, mostrar el icono de disminución
                                            echo '<span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-arrow-down-right text-danger"></i>
                                                  </span>';
                                            echo '<p class="text-dark me-1 fs-3 mb-0">' . abs($porcentajeDescuento) . '%</p>';
                                        } else {
                                            // Si el porcentaje es positivo, mostrar el icono de aumento
                                            echo '<span class="me-2 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-arrow-up-left text-success"></i>
                                                  </span>';
                                            echo '<p class="text-dark me-1 fs-3 mb-0">' . $porcentajeDescuento . '%</p>';
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
                      <div id="earning"></div>
                  </div>
              </div>





            </div>
          </div>
        </div>






        <div class="row">
          
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold">Operaciones recientes pagos</h5>
                </div>
                <ul class="timeline-widget mb-0 position-relative mb-n5">
                 

                  <?php

                  

                    
                    // Obtén los últimos 10 pagos
                    $operacionesPago = obtenerUltimosPagos($link, 8);

                    // Muestra la lista de operaciones
                    echo '<ul class="timeline-widget mb-0 position-relative mb-n5">';
                    foreach ($operacionesPago as $pago) {
                        echo '<li class="timeline-item d-flex position-relative overflow-hidden">';
                        echo '<div class="timeline-time text-dark flex-shrink-0 text-end">' . date('d M', strtotime($pago['fecha_pagado'])) . '</div>';
                        echo '<div class="timeline-badge-wrap d-flex flex-column align-items-center">';
                        echo '<span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>';
                        echo '<span class="timeline-badge-border d-block flex-shrink-0"></span>';
                        echo '</div>';
                        echo '<div class="timeline-desc fs-3 text-dark mt-n1">';
                        echo 'Pago recibido del paciente ' . obtenerNombrePaciente($link, $pago['id_paciente']) . ' por $' . number_format($pago['monto'], 2);
                        echo '</div>';
                        echo '</li>';
                    }
                    echo '</ul>';

                    // Cierra la conexión a la base de datos
                    

                    
                    ?>


                  
                </ul><br><br>
              </div>
            </div>
          </div>


          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
              
              <?php

              // Obtén los últimos ingresos de pacientes
            $ingresosPacientes = obtenerUltimosIngresos($link, 10);

            // Muestra la lista de ingresos
            echo '<div class="card-body p-4">';
            echo '<h5 class="card-title fw-semibold mb-4">Ingresos Recientes</h5>';
            echo '<div class="table-responsive">';
            echo '<table class="table text-nowrap mb-0 align-middle">';
            echo '<thead class="text-dark fs-4">';
            echo '<tr>';
            echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Id</h6></th>';
            echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nombre</h6></th>';
            echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Fecha de Ingreso</h6></th>';
            echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nota</h6></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($ingresosPacientes as $ingreso) {
                echo '<tr>';
                echo '<td class="border-bottom-0"><h6 class="fw-semibold mb-0">' . $ingreso['id_paciente'] . '</h6></td>';
                echo '<td class="border-bottom-0">';
                echo '<h6 class="fw-semibold mb-1">' . $ingreso['nombre'] . ' ' . $ingreso['aPaterno'] . ' ' . $ingreso['aMaterno'] . '</h6>';
                echo '</td>';
                echo '<td class="border-bottom-0">';
                echo '<p class="mb-0 fw-normal">' . date('d F', strtotime($ingreso['fechaIngreso'])) . '</p>';
                echo '</td>';
                echo '<td class="border-bottom-0">';
                echo '<div class="d-flex align-items-center gap-2">';
                echo '<a class="badge bg-primary rounded-3 fw-semibold" href="perfil.php?id_paciente=' . $ingreso['id_paciente'] . '">Ver Perfil de paciente</a>';
                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';

            // Cierra la conexión a la base de datos
           



            //$link->close();
            ?>




            </div>
          </div>
        </div>




        <!-- SEGUIMIENTO AGENDA -->


        <div class="row">
          
          <div class="col-md-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold">Operaciones recientes</h5>
                </div>


                <?php
                    
                // Obtén las últimas 10 operaciones de la tabla agenda
                $operacionesAgenda = obtenerUltimasOperacionesAgenda($link, 20);

                // Muestra la lista de operaciones
                echo '<ul class="timeline-widget mb-0 position-relative mb-n5">';
                foreach ($operacionesAgenda as $operacion) {
                    echo '<li class="timeline-item d-flex position-relative overflow-hidden">';
                    echo '<div class="timeline-time text-dark flex-shrink-0 text-end">' . date('d M', strtotime($operacion['fecha'])) . '</div>';
                    echo '<div class="timeline-badge-wrap d-flex flex-column align-items-center">';
                    echo '<span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>';
                    echo '<span class="timeline-badge-border d-block flex-shrink-0"></span>';
                    echo '</div>';
                    echo '<div class="timeline-desc fs-3 text-dark mt-n1">';
                    echo 'Operación registrada para el paciente ' . obtenerNombrePaciente($link, $operacion['id_paciente']) . '. Observaciones: ' . $operacion['observaciones'];
                    echo '</div>';
                    echo '</li>';
                }
                echo '</ul>';

                // Cierra la conexión a la base de datos

                
               
                ?>



                
              </div>
            </div>
          </div>


          
        </div>


        <!-- TERMINA SEGUIMIENTO AGENDA -->





        <div class="row">
          <div class="col-12 mb-4">
            <h4 class="text-center">Acciones Rápidas</h4>
          </div>

          <div class="col-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Lista de Ventas</h5>
                  <p class="card-text">Ver reporte detallado de ingresos en el sistema</p>
                  <a href="ventas.php" class="btn btn-primary">Ir a la sección</a>
                </div>
              </div>
          </div>  


          <div class="col-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Lista de Pacientes</h5>
                  <p class="card-text">Ver reporte detallado de datos referentes a pacientes</p>
                  <a href="pacientes.php" class="btn btn-primary">Ir a la sección</a>
                </div>
              </div>
          </div>



          <div class="col-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Lista de Gastos</h5>
                  <p class="card-text">Ver reportes detallados referentes a los gastos ejecutados.</p>
                  <a href="compras.php" class="btn btn-primary">Ir a la sección</a>
                </div>
              </div>
          </div>



          <div class="col-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Lista de Marketing</h5>
                  <p class="card-text">Ver datos de posibles clientes y vendedores activos.</p>
                  <a href="crm.php" class="btn btn-primary">Ir a la sección</a>
                </div>
              </div>
          </div>                    

        </div>
        
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
require "footer.php";

} else {
    // Si el usuario no tiene el rol adecuado, redirige a una página de acceso no autorizado
    header("Location: acceso_no_autorizado.php");
    exit(); // Asegura que el script se detenga después de redirigir
}

?> 
