<?php
require "header.php"; 

$id_historial = $_GET['id_historial'];

if (!$id_historial) {
    die('ID del historial no proporcionado');
}

// Conecta a la base de datos y obtén los datos del historial de saldo
require('global.php');
$link = bases();
$sql_historial = "SELECT * FROM historial_saldo WHERE id_historial = $id_historial";
$resultado_historial = $link->query($sql_historial);
$historial = $resultado_historial->fetch_assoc();

// Recupera el nombre del paciente asociado al id_paciente en la tabla historial_saldo
$sql_nombre_paciente = "SELECT pacientes.nombre AS nombre_paciente, pacientes.aPaterno, pacientes.aMaterno
                        FROM historial_saldo
                        JOIN pacientes ON historial_saldo.id_paciente = pacientes.id_paciente
                        WHERE historial_saldo.id_historial = $id_historial";

$resultado_nombre_paciente = $link->query($sql_nombre_paciente);
$datos_paciente = $resultado_nombre_paciente->fetch_assoc();


?>

<!--SECCION GENERAL -->
<div class="container-fluid py-4 mt-5">
    <div class="card mb-4 px-3 mt-5">
        <!--- INICIA CONTENIDO DE TABLA -->
        <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="saldo.php?id_paciente=8" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i> Volver a todos los saldos</a>

            <div class="container">
                <h2 class="text-center mb-4">Detalle de Historial de Saldo</h2>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-primary text-white text-center">
                            <div class="card-body">
                                <h5 class="card-title">Información de Historial de Saldo</h5>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <p><strong>Monto:</strong> <?php echo $historial['monto']; ?></p>
                                <p><strong>Comprobante:</strong> <?php echo $historial['comprobante']; ?></p>
                                <p><strong>Fecha Agregado:</strong> <?php echo $historial['fecha_agregado']; ?></p>
                                <p><strong>Fecha de Pago:</strong> <?php echo $historial['fecha_pagado']; ?></p>
                                <p><strong>Observaciones:</strong> <?php echo $historial['observaciones']; ?></p>
                                <p><strong>Forma de Pago:</strong> <?php echo $historial['forma_pago']; ?></p>
                                <p><strong>Estatus:</strong> <?php echo $historial['estatus']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-success text-white text-center">
                            <div class="card-body">
                                <h5 class="card-title">Información del Paciente</h5>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <p><strong>Nombre:</strong> <?php echo $datos_paciente['nombre_paciente']; ?></p>
                                <p><strong>Apellido Paterno:</strong> <?php echo $datos_paciente['aPaterno']; ?></p>
                                <p><strong>Apellido Materno:</strong> <?php echo $datos_paciente['aMaterno']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-info text-white text-center">
                            <div class="card-body">
                                <h5 class="card-title">Información del Usuario</h5>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <p><strong>Nombre de Usuario:</strong> <?php echo $datos_usuario['nombre_usuario']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- FIN CONTENIDO DE TABLA -->
    </div>
</div>
<!-- SECCION GENERAL -->

<?php require "footer.php"; ?>
