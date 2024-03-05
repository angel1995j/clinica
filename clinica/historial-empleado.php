<?php
require "header.php";

// Recupera el ID del vendedor desde GET
$id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : 0;

if (!$id_usuario) {
    die('ID del vendedor no proporcionado');
}

// Conecta a la base de datos y obtén los datos del vendedor
require('global.php');
$link = bases();
$sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";

$resultado = $link->query($sql);

$vendedor = $resultado->fetch_assoc();

?>

<!--SECCION GENERAL -->
<!-- End Navbar -->
<div class="container-fluid py-4 mt-5">
    <div class="card mb-4 px-3 mt-5">
        <!--- INICIA CONTENIDO DE TABLA -->
        <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="vendedores.php" class="text-secondary mt-3">
                <i class="fa fa-undo" aria-hidden="true"></i> Volver a vendedores</a>
            <div class="container">
                <h2 class="mt-5 text-center">
                    Movimientos del vendedor: <?php echo $vendedor['nombre'] . " " . $vendedor['aPaterno']; ?>
                </h2>

                <!-- Tabla de comisiones del paciente -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="table-responsive mt-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID de Comisión</th>
                                        <th>Concepto</th>
                                        <th>Total Venta</th>
                                        <th>Porcentaje</th>
                                        <th>Estatus</th>
                                        <th>Fecha de Venta</th>
                                        <th>Fecha Pagado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Obtener comisiones del paciente
                                    $sqlComisiones = "SELECT * FROM comisiones WHERE id_usuario = $id_usuario";
                                    $resultadoComisiones = $link->query($sqlComisiones);

                                    while ($comision = $resultadoComisiones->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $comision['id_comision'] . "</td>";
                                        echo "<td>" . $comision['concepto'] . "</td>";
                                        echo "<td>" . $comision['total_venta'] . "</td>";
                                        echo "<td>" . $comision['porcentaje'] . "</td>";
                                        echo "<td>" . $comision['estatus'] . "</td>";
                                        echo "<td>" . $comision['fecha_venta'] . "</td>";
                                        echo "<td>" . $comision['fecha_pagado'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require "footer.php";
    ?>
