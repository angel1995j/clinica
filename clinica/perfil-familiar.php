<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de clinica</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="assets/css/custom.css" />
  <script src="https://kit.fontawesome.com/1517bc3b2d.js" crossorigin="anonymous"></script>
</head>


<?php
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;
$codigoUnico = isset($_GET['codigoUnico']) ? $_GET['codigoUnico'] : '';

if (!$id_paciente || !$codigoUnico) {
    die('ID del paciente o código único no proporcionado');
}

// Conecta a la base de datos y obtén los datos del paciente
require('global.php');
$link = bases();
$sql = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente AND codigoUnico = '$codigoUnico'";

$resultado = $link->query($sql);

// Verifica si existe el paciente con el id_paciente y código único proporcionados
if ($resultado->num_rows === 0) {
    die('No se encontró un paciente con el ID y código único proporcionados');
}

$paciente = $resultado->fetch_assoc();
?>

<body>

  <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <!--<a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>-->
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <b>Bienvenido de nuevo <?php echo $paciente['nombreFamiliar']; ?></b>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                
              </li>
            </ul>
          </div>
        </nav>
      </header>

  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

     
        

    <!-- Sidebar Start -->

    <!--  Main wrapper -->
    <div class="container-fluid py-4">


          <div class="card mb-4 px-3 mt-2">
            
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-4 pt-3">
            
            <div class="text-center">
             <a href="#" class="text-nowrap text-logo">
            Clinica 7Angeles
             </a>
           </div>
              

            <div class="container">
            

            <div class="row mt-3">

              <div class="col-md-6 bg-primary text-center cuadros-familiar">
                  <?php
                  // Obtener la suma de monto cuando estatus es "No Pagado"
                  $sqlNoPagado = "SELECT SUM(monto) AS totalNoPagado FROM pago_paciente WHERE id_paciente = $id_paciente AND estatus = 'No Pagado'";
                  $resultNoPagado = $link->query($sqlNoPagado);
                  $rowNoPagado = $resultNoPagado->fetch_assoc();
                  $totalNoPagado = $rowNoPagado['totalNoPagado'];
                  ?>
                  <p><i class="fa fa-frown-o" aria-hidden="true" style="font-size: 45px; color: black;"></i><br><br>Tienes una deuda de: $<?php echo number_format($totalNoPagado, 2, ',', '.'); ?> MXN</p>
                  <p style="font-size:15px;"><button type="button" class="text-white" data-bs-toggle="modal" data-bs-target="#modalPagosNoPagados" style="background: none; border: none;">Ver detalles</button></p>
              </div>


                <!-- Agrega este modal al final de tu HTML, antes de cerrar el body -->
                <div class="modal fade" id="modalPagosNoPagados" tabindex="-1" aria-labelledby="modalPagosNoPagadosLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalPagosNoPagadosLabel">Detalle de no pagados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php
                        // Consulta para obtener los registros de pagos no pagados para el paciente actual
                        $sqlPagosNoPagados = "SELECT * FROM pago_paciente WHERE id_paciente = $id_paciente AND estatus = 'No Pagado'";
                        $resultPagosNoPagados = $link->query($sqlPagosNoPagados);

                        // Muestra la tabla solo si hay pagos no pagados
                        if ($resultPagosNoPagados->num_rows > 0) {
                          echo '<table class="table">';
                          echo '<thead>';
                          echo '<tr>';
                          echo '<th>ID Pago</th>';
                          echo '<th>Monto</th>';
                          echo '<th>Fecha de pago</th>';
                          echo '<th>Detalles</th>';
                          echo '</tr>';
                          echo '</thead>';
                          echo '<tbody>';

                          while ($rowPagosNoPagados = $resultPagosNoPagados->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $rowPagosNoPagados['id_pago'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['monto'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['fecha_agregado'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['observaciones'] . '</td>';
                            echo '</tr>';
                          }

                          echo '</tbody>';
                          echo '</table>';
                        } else {
                          echo '<p>No hay pagos no pagados para este paciente.</p>';
                        }
                        ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>



              <div class="col-md-6 bg-primary text-center cuadros-familiar">
                  <?php
                  // Obtener la suma de monto cuando estatus es "Pagado"
                  $sqlPagado = "SELECT SUM(monto) AS totalPagado FROM pago_paciente WHERE id_paciente = $id_paciente AND estatus = 'Pagado'";
                  $resultPagado = $link->query($sqlPagado);
                  $rowPagado = $resultPagado->fetch_assoc();
                  $totalPagado = $rowPagado['totalPagado'];
                  ?>
                  <?php if ($totalPagado > 0): ?>
                      <p><i class="fa fa-smile-o" aria-hidden="true" style="font-size: 45px; color: black;"></i><br><br>Pagaste la cantidad de: $<?php echo number_format($totalPagado, 2, ',', '.'); ?> MXN</p>
                  <?php else: ?>
                      <p><i class="fa fa-meh-o" aria-hidden="true" style="font-size: 45px; color: black;"></i><br><br>No has hecho ningún pago aún.</p>
                  <?php endif; ?>
                   <p style="font-size:15px;"><button type="button" class="text-white" data-bs-toggle="modal" data-bs-target="#modalPagosPagados" style="background: none; border: none;">Ver detalles</button></p>
              </div>




               <!-- Agrega este modal al final de tu HTML, antes de cerrar el body -->
                <div class="modal fade" id="modalPagosPagados" tabindex="-1" aria-labelledby="modalPagosPagadosLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalPagosPagadosLabel">Detalle de pagados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php
                        // Consulta para obtener los registros de pagos pagados para el paciente actual
                        $sqlPagosNoPagados = "SELECT * FROM pago_paciente WHERE id_paciente = $id_paciente AND estatus = 'Pagado'";
                        $resultPagosNoPagados = $link->query($sqlPagosNoPagados);

                        // Muestra la tabla solo si hay pagos pagados
                        if ($resultPagosNoPagados->num_rows > 0) {
                          echo '<table class="table">';
                          echo '<thead>';
                          echo '<tr>';
                          echo '<th>ID Pago</th>';
                          echo '<th>Monto</th>';
                          echo '<th>Fecha de pagado</th>';
                          echo '<th>Detalles</th>';
                          echo '</tr>';
                          echo '</thead>';
                          echo '<tbody>';

                          while ($rowPagosNoPagados = $resultPagosNoPagados->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $rowPagosNoPagados['id_pago'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['monto'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['fecha_pagado'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['observaciones'] . '</td>';
                            echo '</tr>';
                          }

                          echo '</tbody>';
                          echo '</table>';
                        } else {
                          echo '<p>No hay pagos pagados para este paciente.</p>';
                        }
                        ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>




          </div>



            <p class="text-center"><b>El tratamiento de tu familiar continua muy bien &nbsp;&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></b></p>


           <?php
            // Obtén la fecha actual en formato yyyy-mm-dd
            $fecha_actual = date('Y-m-d');

            // Consulta para obtener los pagos retrasados del paciente actual
            $sqlPagosRetrasados = "SELECT COUNT(*) AS pagosRetrasados, DATEDIFF('$fecha_actual', fecha_agregado) AS diasRetraso
                                   FROM pago_paciente
                                   WHERE id_paciente = $id_paciente
                                   AND estatus = 'No Pagado'
                                   AND '$fecha_actual' > fecha_agregado";

            $resultPagosRetrasados = $link->query($sqlPagosRetrasados);
            $rowPagosRetrasados = $resultPagosRetrasados->fetch_assoc();

            $pagosRetrasados = $rowPagosRetrasados['pagosRetrasados'];
            $diasRetraso = $rowPagosRetrasados['diasRetraso'];

            // Muestra la alerta solo si hay pagos retrasados
            if ($pagosRetrasados > 0) {
                echo '<div class="alert alert-danger text-center mt-4">';
                echo "Tienes $pagosRetrasados pago(s) retrasado(s) por ($diasRetraso) día(s)<br>";
                echo '<span class="text-primary"><a href="https://api.whatsapp.com/send?phone=524435280745&text=Me%20gustar%C3%ADa%20reportar%20un%20pago" target="_blank">Reportar Pago</a></span>';
                echo '</div>';
            }
            ?>




            <div class="row mt-5">
            

                <div class="col-md-3 col-sm-3 text-center">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreditos">
                  Ver movimientos de tiendita
                </button>

                </div>

                <!-- Button trigger modal -->
                

                <!-- Modal de todos los pagos -->
                <div class="modal fade" id="modalCreditos" tabindex="-1" aria-labelledby="modalCreditos" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content" style="overflow: overlay;">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalCreditosLabel">Detalle de todos los pagos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        <h3>Saldo actual: $

                          <?php $sql_saldo = "SELECT * FROM credito WHERE id_paciente = $id_paciente ORDER BY `credito`.`id_credito` DESC LIMIT 1";

                          $resultado_saldo = $link->query($sql_saldo);

                          $saldo = $resultado_saldo->fetch_assoc();
                          echo $saldo['saldo'];
                          ?>

                        </h3>
                        <?php
                        // Consulta para obtener los registros de creditos para el paciente actual
                        $sqlCredito = "SELECT * FROM credito WHERE id_paciente = $id_paciente ORDER BY `credito`.`id_credito` DESC LIMIT 5";

                        $resultCredito = $link->query($sqlCredito);

                        // Muestra la tabla solo si hay pagos pagados
                        if ($resultCredito->num_rows > 0) {
                          echo '<table class="table">';
                          echo '<thead>';
                          echo '<tr>';
                          echo '<th>Saldo</th>';
                          echo '<th>Fecha de actualización</th>';
                          echo '<th>Operación</th>';
                          echo '<th>Método de pago</th>';
                         
                          echo '</tr>';
                          echo '</thead>';
                          echo '<tbody>';

                          while ($rowCreditos = $resultCredito->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $rowCreditos['saldo'] . '</td>';
                            echo '<td>' . $rowCreditos['fecha_actualizacion'] . '</td>';
                            echo '<td>' . $rowCreditos['operacion'] . '</td>';
                            echo '<td>' . $rowCreditos['metodoPago'] . '</td>';
                            echo '</tr>';
                          }

                          echo '</tbody>';
                          echo '</table>';
                        } else {
                          echo '<p>No hay pagos movimientos de tiendita para este paciente.</p>';
                        }
                        ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>




                <div class="col-md-3 col-sm-3 text-center">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPeticiones">
                   Ver peticiones del paciente
                  </button>
                </div>

              

              <!-- Modal de todos los pagos -->
                <div class="modal fade" id="modalPeticiones" tabindex="-1" aria-labelledby="modalPeticiones" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content" style="overflow: overlay;">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalPeticionesLabel">Peticiones del paciente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        
                        <?php
                        // Consulta para obtener los registros de creditos para el paciente actual
                       $sqlPeticiones = "SELECT * FROM peticion_paciente WHERE id_paciente = $id_paciente AND estatus = 'No resuelto'";


                        $resultPeticiones = $link->query($sqlPeticiones);

                        // Muestra la tabla solo si hay pagos pagados
                        if ($resultPeticiones->num_rows > 0) {
                          echo '<table class="table">';
                          echo '<thead>';
                          echo '<tr>';
                          echo '<th>Detalle</th>';
                          echo '<th>Quien Procesa</th>';
                          echo '<th>Monto</th>';
                         
                          echo '</tr>';
                          echo '</thead>';
                          echo '<tbody>';

                          while ($rowPeticiones = $resultPeticiones->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $rowPeticiones['detalle'] . '</td>';
                            echo '<td>' . $rowPeticiones['quien_procesa'] . '</td>';
                            echo '<td>' . $rowPeticiones['monto'] . '</td>';
                            echo '</tr>';
                          }

                          echo '</tbody>';
                          echo '</table>';
                        } else {
                          echo '<p>No hay peticiones para este paciente.</p>';
                        }
                        ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>






                <div class="col-md-3 col-sm-3 text-center">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTodos">Ver detalles de pagos</button>
                </div>



                <!-- Modal de todos los pagos -->
                <div class="modal fade" id="modalTodos" tabindex="-1" aria-labelledby="modalTodosLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content" style="overflow: overlay;">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalTodosLabel">Detalle de todos los pagos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php
                        // Consulta para obtener los registros de pagos pagados para el paciente actual
                        $sqlTodos = "SELECT * FROM pago_paciente WHERE id_paciente = $id_paciente";
                        $resultPagosNoPagados = $link->query($sqlTodos);

                        // Muestra la tabla solo si hay pagos pagados
                        if ($resultPagosNoPagados->num_rows > 0) {
                          echo '<table class="table">';
                          echo '<thead>';
                          echo '<tr>';
                          echo '<th>ID Pago</th>';
                          echo '<th>Monto</th>';
                          echo '<th>Descuento</th>';
                          echo '<th>Total</th>';
                          echo '<th>Fecha débida de pago</th>';
                          echo '<th>Fecha de pagado</th>';
                          echo '<th>Detalles</th>';
                          echo '<th>Forma de pago</th>';
                          echo '<th>Estatus</th>';
                          echo '</tr>';
                          echo '</thead>';
                          echo '<tbody>';

                          while ($rowPagosNoPagados = $resultPagosNoPagados->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $rowPagosNoPagados['id_pago'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['monto'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['descuento'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['total'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['fecha_agregado'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['fecha_pagado'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['observaciones'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['forma_pago'] . '</td>';
                            echo '<td>' . $rowPagosNoPagados['estatus'] . '</td>';
                            echo '</tr>';
                          }

                          echo '</tbody>';
                          echo '</table>';
                        } else {
                          echo '<p>No hay pagos pagados para este paciente.</p>';
                        }
                        ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>



                <div class="col-md-3 col-sm-3 text-center">
                  <a class="btn btn-success" href="https://api.whatsapp.com/send?phone=524435280745&text=Me%20gustar%C3%ADa%20recibir%20informaci%C3%B3n." target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i>
                    Preguntar dudas por whatsapp
                  </a>
                </div>



            </div>
              

            </div>




            </div>          
          
 







          </div>
       

        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Diseñado y desarrollado por:  <a href="https://www.cemprende.com.mx/" target="_blank" class="pe-1 text-primary text-decoration-underline">Cemprende</a></p>
        </div>

     
 


<!-- SECCION GENERAL -->



    </div>

  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
</body>

</html>