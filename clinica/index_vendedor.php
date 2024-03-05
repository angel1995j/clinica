<?php
session_start();
require "header-vendedor.php";
require 'global.php';
$link = bases();


$id_usuario_logueado = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;

if ($id_usuario_logueado > 0) {

function obtenerUltimasComisiones($link, $limit, $id_usuario)
{
    $id_usuario = $link->real_escape_string($id_usuario);
    $sql = "SELECT fecha_venta, total_venta, porcentaje, estatus FROM comisiones WHERE id_usuario = $id_usuario ORDER BY fecha_venta DESC LIMIT $limit";
    $result = $link->query($sql);

    $comisiones = [];

    while ($row = $result->fetch_assoc()) {
        $comisiones[] = $row;
    }

    return $comisiones;
}



    $sql = "SELECT MONTH(fecha_venta) as mes, SUM(total_venta) as total_ventas 
        FROM comisiones 
        WHERE id_usuario = $id_usuario_logueado
        GROUP BY MONTH(fecha_venta)";

    $result = $link->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $json_data = json_encode($data);

    if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Vendedor') {
?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 frase mb-4">
                    <p>Frase del día: <b style="font-size: 15px;">
                            <?php
                            $url = "https://frasedeldia.azurewebsites.net/api/phrase";
                            $json = file_get_contents($url);
                            $frase_data = json_decode($json, true);
                            echo $frase_data['phrase'];
                            ?>
                        </b></p>
                </div>
                <div class="col-lg-8 d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="grafica"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                       <div class="col-lg-12">
                          <?php
                          $sqlYearlySales = "SELECT YEAR(fecha_venta) as anio, SUM(total_venta) as total_ventas 
                                           FROM comisiones 
                                           WHERE id_usuario = $id_usuario_logueado
                                           GROUP BY YEAR(fecha_venta)
                                           ORDER BY anio DESC LIMIT 1";
                          $resultYearlySales = $link->query($sqlYearlySales);
                          if ($resultYearlySales && $resultYearlySales->num_rows > 0) {
                              $rowYearlySales = $resultYearlySales->fetch_assoc();
                              $anio = $rowYearlySales['anio'];
                              $totalVentas = $rowYearlySales['total_ventas'];
                              $porcentajeCrecimiento = 9;
                              $ultimoAnio = date("Y") - 1;
                              $crecimientoAnual = (($totalVentas / $ultimoAnio) - 1) * 100;
                          } else {
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
                      $sqlMonthlyExpenses = "SELECT MONTH(fecha_venta) as mes, SUM(total_venta) as total_gastos 
                                          FROM comisiones 
                                          WHERE id_usuario = $id_usuario_logueado
                                          GROUP BY MONTH(fecha_venta)
                                          ORDER BY mes DESC LIMIT 1";
                      $resultMonthlyExpenses = $link->query($sqlMonthlyExpenses);
                      if ($resultMonthlyExpenses && $resultMonthlyExpenses->num_rows > 0) {
                          $rowMonthlyExpenses = $resultMonthlyExpenses->fetch_assoc();
                          $mes = $rowMonthlyExpenses['mes'];
                          $totalGastos = $rowMonthlyExpenses['total_gastos'];
                          $porcentajeDescuento = 9;
                          $mesAnterior = date("n") - 1;
                          $descuentoMensual = ($mesAnterior != 0) ? (($totalGastos / $mesAnterior) - 1) * 100 : 0;
                      } else {
                          $mes = date("n");
                          $totalGastos = 0;
                          $porcentajeDescuento = 0;
                          $descuentoMensual = 0;
                      }
                      ?>
                      <div class="col-lg-12">
                          <div class="card">
                              <div class="card-body">
                                  <div class="row align-items-start">
                                      <div class="col-8">
                                          <h5 class="card-title mb-9 fw-semibold">Gastos mensuales</h5>
                                          <h4 class="fw-semibold mb-3">$<?php echo number_format($totalGastos, 2); ?></h4>
                                          <div class="d-flex align-items-center pb-1">
                                              <?php
                                              if ($porcentajeDescuento < 0) {
                                                  echo '<span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                                          <i class="ti ti-arrow-down-right text-danger"></i>
                                                        </span>';
                                                  echo '<p class="text-dark me-1 fs-3 mb-0">' . abs($porcentajeDescuento) . '%</p>';
                                              } else {
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
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <h5 class="card-title fw-semibold">Operaciones recientes</h5>
                            </div>
                            <ul class="timeline-widget mb-0 position-relative mb-n5">
                                <?php
                                $comisiones = obtenerUltimasComisiones($link, 20, $id_usuario_logueado);
                                  echo '<ul class="timeline-widget mb-0 position-relative mb-n5">';
                                  foreach ($comisiones as $comision) {
                                      echo '<li class="timeline-item d-flex position-relative overflow-hidden">';
                                      echo '<div class="timeline-time text-dark flex-shrink-0 text-end">' . date('d M', strtotime($comision['fecha_venta'])) . '</div>';
                                      echo '<div class="timeline-badge-wrap d-flex flex-column align-items-center">';
                                      echo '<span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>';
                                      echo '<span class="timeline-badge-border d-block flex-shrink-0"></span>';
                                      echo '</div>';
                                      echo '<div class="timeline-desc fs-3 text-dark mt-n1">';
                                      echo '<p>Total de ventas: $' . number_format($comision['total_venta'], 2) . '</p>';
                                      echo '<p>Porcentaje: ' . $comision['porcentaje'] . '%</p>';
                                      // Agrega más detalles según sea necesario
                                      echo '</div>';
                                      echo '</li>';
                                  }
                                  echo '</ul>';

                                $link->close();
                                ?>
                            </ul><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
           var jsonData = <?php echo $json_data; ?>;
            var meses = [];
            var montosPagados = [];
            jsonData.forEach(function(item) {
                meses.push("Mes " + item.mes);
                montosPagados.push(item.total_ventas);
            });
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
        require "footer.php";
    } else {
        header("Location: acceso_no_autorizado.php");
        exit();
    }
}
?>
