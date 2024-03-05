<?php
require "header.php"; 

$id_pago = $_GET['id_pago'];

if (!$id_pago) {
    die('ID del pago no proporcionado');
}

// Conecta a la base de datos y obtén los datos del pago
require('global.php');
$link = bases();
$sql_pago = "SELECT * FROM pago_paciente WHERE id_pago = $id_pago";
$resultado_pago = $link->query($sql_pago);
$pago = $resultado_pago->fetch_assoc();

// Recupera el nombre del paciente asociado al id_paciente en la tabla pago_paciente
$sql_nombre_paciente = "SELECT pacientes.nombre AS nombre_paciente, pacientes.aPaterno, pacientes.aMaterno
                        FROM pago_paciente
                        JOIN pacientes ON pago_paciente.id_paciente = pacientes.id_paciente
                        WHERE pago_paciente.id_pago = $id_pago";

$resultado_nombre_paciente = $link->query($sql_nombre_paciente);
$datos_paciente = $resultado_nombre_paciente->fetch_assoc();

// Recupera el nombre del usuario asociado al id_usuario en la tabla usuarios
$id_usuario = $pago['id_usuario'];
$sql_nombre_usuario = "SELECT nombre_usuario FROM usuarios WHERE id_usuario = $id_usuario";
$resultado_nombre_usuario = $link->query($sql_nombre_usuario);
$datos_usuario = $resultado_nombre_usuario->fetch_assoc();

?>

<!--SECCION GENERAL -->
<div class="container-fluid py-4 mt-5">
    <div class="card mb-4 px-3 mt-5">
        <!--- INICIA CONTENIDO DE TABLA -->
        <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="pagos.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i> Volver a todos los pagos</a>

            <div class="container">
                <h2 class="text-center mb-4">Detalle de Pago</h2>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-primary text-white text-center">
                            <div class="card-body">
                                <h5 class="card-title">Información de Pago</h5>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <p><strong>Monto:</strong> <?php echo $pago['monto']; ?></p>
                                <p><strong>Descuento:</strong> <?php echo $pago['descuento']; ?></p>
                                <p><strong>Total:</strong> <?php echo $pago['total']; ?></p>
                                 <p><strong>Comprobante:</strong> <?php echo $pago['comprobante']; ?></p>
                                 <p><strong>Número de pago:</strong> <?php echo $pago['numero_pago']; ?></p>
                                 <p><strong>Fecha Agregado:</strong> <?php echo $pago['fecha_agregado']; ?></p>
                                <p><strong>Fecha de Pago:</strong> <?php echo $pago['fecha_pagado']; ?></p>
                                <p><strong>Periodicidad:</strong> <?php echo $pago['periodicidad']; ?></p>
                                <p><strong>Observaciones:</strong> <?php echo $pago['observaciones']; ?></p>
                                <p><strong>Forma de Pago:</strong> <?php echo $pago['forma_pago']; ?></p>
                                <p><strong>Estatus:</strong> <?php echo $pago['estatus']; ?></p>
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
                                <h5 class="card-title">Información del empleado</h5>
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
