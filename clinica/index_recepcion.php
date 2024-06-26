<?php 
session_start();

// Función para obtener los últimos ingresos limitados de pacientes
function obtenerUltimosIngresos($link, $limit) {
    // Realiza la consulta para obtener los últimos ingresos limitados de pacientes
    $sql = "SELECT id_paciente, nombre, aPaterno, aMaterno, fechaIngreso FROM pacientes ORDER BY fechaIngreso DESC LIMIT ?";
    
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $stmt->bind_result($id_paciente, $nombre, $aPaterno, $aMaterno, $fechaIngreso);
        $datos = [];
        while ($stmt->fetch()) {
            $datos[] = [
                'id_paciente' => $id_paciente,
                'nombre' => $nombre,
                'aPaterno' => $aPaterno,
                'aMaterno' => $aMaterno,
                'fechaIngreso' => $fechaIngreso
            ];
        }
        $stmt->close();
        return $datos;
    } else {
        return [];
    }
}

// Función para obtener las últimas operaciones de la tabla agenda limitadas
function obtenerUltimasOperacionesAgenda($link, $limit) {
    // Realiza la consulta para obtener las últimas operaciones de la tabla agenda limitadas
    $sql = "SELECT fecha, id_paciente, observaciones FROM agenda ORDER BY fecha DESC LIMIT ?";
    
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $stmt->bind_result($fecha, $id_paciente, $observaciones);
        $datos = [];
        while ($stmt->fetch()) {
            $datos[] = [
                'fecha' => $fecha,
                'id_paciente' => $id_paciente,
                'observaciones' => $observaciones
            ];
        }
        $stmt->close();
        return $datos;
    } else {
        return [];
    }
}

// Función para obtener las últimas compras limitadas
function obtenerUltimasCompras($link, $limit) {
    // Realiza la consulta para obtener las últimas compras limitadas
    $sql = "SELECT fecha_aplicacion, concepto, quien_compra, cuenta_compra, tipo_compra, monto FROM compras ORDER BY fecha_aplicacion DESC LIMIT ?";
    
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $stmt->bind_result($fecha_aplicacion, $concepto, $quien_compra, $cuenta_compra, $tipo_compra, $monto);
        $datos = [];
        while ($stmt->fetch()) {
            $datos[] = [
                'fecha_aplicacion' => $fecha_aplicacion,
                'concepto' => $concepto,
                'quien_compra' => $quien_compra,
                'cuenta_compra' => $cuenta_compra,
                'tipo_compra' => $tipo_compra,
                'monto' => $monto
            ];
        }
        $stmt->close();
        return $datos;
    } else {
        return [];
    }
}

// Función para obtener los últimos pagos limitados
function obtenerUltimosPagos($link, $limit) {
    // Realiza la consulta para obtener los últimos pagos limitados
    $sql = "SELECT fecha_pagado, id_paciente, monto FROM pago_paciente ORDER BY fecha_pagado DESC LIMIT ?";
    
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $stmt->bind_result($fecha_pagado, $id_paciente, $monto);
        $datos = [];
        while ($stmt->fetch()) {
            $datos[] = [
                'fecha_pagado' => $fecha_pagado,
                'id_paciente' => $id_paciente,
                'monto' => $monto
            ];
        }
        $stmt->close();
        return $datos;
    } else {
        return [];
    }
}

// Función para obtener el nombre del paciente
function obtenerNombrePaciente($link, $idPaciente) {
    // Realiza la consulta para obtener el nombre del paciente según el id_paciente
    $sql = "SELECT nombre, aPaterno FROM pacientes WHERE id_paciente = ?";
    
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("i", $idPaciente);
        $stmt->execute();
        $stmt->bind_result($nombre, $aPaterno);
        if ($stmt->fetch()) {
            return $nombre . ' ' . $aPaterno;
        } else {
            return 'Paciente Desconocido';
        }
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
    </div>
    
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
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
                    echo '<a class="badge bg-primary rounded-3 fw-semibold" href="perfil.php?id_paciente=' . $ingreso['id_paciente'] . '">Ver Peticiones del paciente</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
                ?>
            </div>
        </div>
    </div>

    <!-- COMPRAS RECIENTES -->
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Compras recientes</h5>
                    </div>
                    <?php
                    // Obtén las últimas 20 compras de la tabla compras
                    $comprasRecientes = obtenerUltimasCompras($link, 20);

                    // Muestra la lista de compras
                    echo '<ul class="timeline-widget mb-0 position-relative mb-n5">';
                    foreach ($comprasRecientes as $compra) {
                        echo '<li class="timeline-item d-flex position-relative overflow-hidden">';
                        echo '<div class="timeline-time text-dark flex-shrink-0 text-end">' . date('d M', strtotime($compra['fecha_aplicacion'])) . '</div>';
                        echo '<div class="timeline-badge-wrap d-flex flex-column align-items-center">';
                        echo '<span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>';
                        echo '<span class="timeline-badge-border d-block flex-shrink-0"></span>';
                        echo '</div>';
                        echo '<div class="timeline-desc fs-3 text-dark mt-n1">';
                        echo 'Compra realizada por ' . $compra['quien_compra'] . '. Concepto: ' . $compra['concepto'] . ', Monto: $' . number_format($compra['monto'], 2);
                        echo '</div>';
                        echo '</li>';
                    }
                    echo '</ul>';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- TERMINA COMPRAS RECIENTES -->
</div>

<script>
    // Parsea el JSON generado en PHP
    var jsonData = <?php echo json_encode($json_data); ?>;

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
