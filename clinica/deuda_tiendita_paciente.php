<?php
require "header.php";

// Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Conecta a la base de datos y obtén los datos del paciente
require('global.php');
$link = bases();
$sql = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";

$resultado = $link->query($sql);

$paciente = $resultado->fetch_assoc();

// Calcular la suma total de órdenes no pagadas
$totalNoPagado = calcularTotalNoPagado($link, $id_paciente);

?>

<!--SECCION GENERAL -->
<!-- End Navbar -->
<div class="container-fluid py-4 mt-5">
    <div class="card mb-4 px-3 mt-5">
        <!--- INICIA CONTENIDO DE TABLA -->
        <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="tiendita_paciente.php?id_paciente=<?php echo $paciente['id_paciente'];?>" class="text-secondary mt-3">
                <i class="fa fa-undo" aria-hidden="true"></i> Volver a tiendita del paciente</a>
            <div class="container">
                <h2 class="mt-5 text-center">
                    Movimientos del paciente: <?php echo $paciente['nombre'] . " " . $paciente['aPaterno']; ?>
                </h2>
                <p class="text-center">
                    Este paciente tiene un saldo de $<?php echo $paciente['saldo']; ?>
                </p>

                <!-- Botones -->
                <div class="text-center mb-3">
                    <div class="d-flex justify-content-center">
                        <form action="generar-adeudo.php" method="post">
                            <button type="submit" class="btn btn-primary m-2" name="generar_adeudo">
                                Generar Adeudo
                            </button>
                            <input type="hidden" name="total_no_pagado" value="<?php echo $totalNoPagado; ?>">
                            <input type="hidden" name="observaciones" value="Adeudo tiendita">
                            <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
                        </form>
                        
                        <?php if ($paciente['saldo'] >= $totalNoPagado): ?>
                            <form action="pagar-tiendita.php" method="post">
                                <button type="submit" class="btn btn-primary m-2" name="pagar_con_saldo">
                                    Pagar con Saldo
                                </button>
                                <input type="hidden" name="total_no_pagado" value="<?php echo $totalNoPagado; ?>">
                                <input type="hidden" name="observaciones" value="Adeudo tiendita">
                                <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
                            </form>
                        <?php else: ?>
                            <a href="#" class="btn btn-primary disabled">Pagar con Saldo</a>
                        <?php endif; ?>
                    </div>
                </div>


                <!-- Tabla de órdenes y detalles -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="table-responsive mt-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID de Orden</th>
                                        <th>Fecha de Creación</th>
                                        <th>Total</th>
                                        <th>Detalles</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Obtener órdenes del paciente
                                    $sqlOrdenes = "SELECT * FROM ordenes WHERE id_paciente = $id_paciente AND estatus= 'No Pagado'";
                                    $resultadoOrdenes = $link->query($sqlOrdenes);
                                    $totalSumado = 0;

                                    while ($orden = $resultadoOrdenes->fetch_assoc()) {
                                        $totalSumado += $orden['total'];

                                        echo "<tr>";
                                        echo "<td>" . $orden['id_orden'] . "</td>";
                                        echo "<td>" . $orden['fecha_creacion'] . "</td>";
                                        echo "<td>" . $orden['total'] . "</td>";

                                        // Obtener detalles de la orden
                                        $id_orden = $orden['id_orden'];
                                        $sqlDetalles = "SELECT detalles_orden.*, productos.titulo 
                                                        FROM detalles_orden 
                                                        INNER JOIN productos ON detalles_orden.id_producto = productos.id_producto 
                                                        WHERE detalles_orden.id_orden = $id_orden";
                                        $resultadoDetalles = $link->query($sqlDetalles);

                                        // Mostrar detalles en una lista
                                        echo "<td><ul>";
                                        while ($detalle = $resultadoDetalles->fetch_assoc()) {
                                            echo "<li>" . $detalle['titulo'] . " - Cantidad: " . $detalle['cantidad'] . " - Subtotal: $" . $detalle['subtotal'] . "</li>";
                                        }
                                        echo "</ul></td>";
                                        echo "<td>" . $orden['estatus'] . "</td>";

                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <p class="lead">Suma Total de Órdenes No Pagadas: $<?php echo $totalSumado; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function generarAdeudo() {
        // Lógica para generar un adeudo
        alert('Lógica para generar adeudo aquí...');
    }
</script>

<?php
require "footer.php";
?>

<?php
// Función para calcular el total de las órdenes no pagadas
function calcularTotalNoPagado($link, $id_paciente) {
    $sql = "SELECT SUM(total) AS total_sumado FROM ordenes WHERE id_paciente = $id_paciente AND estatus = 'No Pagado'";
    $resultado = $link->query($sql);
    $fila = $resultado->fetch_assoc();
    return $fila['total_sumado'] ?? 0;
}
?>
