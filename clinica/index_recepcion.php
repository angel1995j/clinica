<?php 
session_start();


// Función para obtener los últimos ingresos limitados de pacientes
    function obtenerUltimosIngresos($link, $limit)
          {
                // Realiza la consulta para obtener los últimos ingresos limitados de pacientes
                $sql = "SELECT id_paciente, nombre, aPaterno, aMaterno, fechaIngreso FROM pacientes ORDER BY fechaIngreso DESC LIMIT $limit";

                // Ejecuta la consulta y obtén los datos
                $result = $link->query($sql);

                // Verifica si la consulta fue exitosa y devuelve los datos
                if ($result && $result->num_rows > 0) {
                    return $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    return [];
                }
            }


            // Función para obtener las últimas operaciones de la tabla agenda limitadas
                function obtenerUltimasOperacionesAgenda($link, $limit)
                {
                    // Realiza la consulta para obtener las últimas operaciones de la tabla agenda limitadas
                    $sql = "SELECT fecha, id_paciente, observaciones FROM agenda ORDER BY fecha DESC LIMIT $limit";

                    // Ejecuta la consulta y obtén los datos
                    $result = $link->query($sql);

                    // Verifica si la consulta fue exitosa y devuelve los datos
                    if ($result && $result->num_rows > 0) {
                        return $result->fetch_all(MYSQLI_ASSOC);
                    } else {
                        return [];
                    }
                }

// Función para obtener los últimos pagos limitados
                    function obtenerUltimosPagos($link, $limit)
                    {
                        // Realiza la consulta para obtener los últimos pagos limitados
                        $sql = "SELECT fecha_pagado, id_paciente, monto FROM pago_paciente ORDER BY fecha_pagado DESC LIMIT $limit";

                        // Ejecuta la consulta y obtén los datos
                        $result = $link->query($sql);

                        // Verifica si la consulta fue exitosa y devuelve los datos
                        if ($result && $result->num_rows > 0) {
                            return $result->fetch_all(MYSQLI_ASSOC);
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




// Verifica si la sesión existe y si el usuario tiene el rol "Recepcion"
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Recepcion') {

require "header-recepcion.php";
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
          
          






        <div class="row">
          
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold">Operaciones recientes</h5>
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
