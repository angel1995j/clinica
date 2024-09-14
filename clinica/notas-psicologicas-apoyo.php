<?php
require "header-apoyo.php";

// Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

// Recupera el ID del usuario logueado desde la sesión
$id_usuario_logueado = isset($_SESSION['id_usuario']) ? intval($_SESSION['id_usuario']) : 0;

if (!$id_usuario_logueado) {
    die('Usuario no logueado');
}


if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Conecta a la base de datos y obtén los datos del paciente
require('global.php');
$link = bases();

$id_usuario_logueado = $_SESSION['id_usuario'];

$sql_paciente = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";
$resultado_paciente = $link->query($sql_paciente);
$paciente = $resultado_paciente->fetch_assoc();

if (!$paciente) {
    die('Paciente no encontrado');
}

// Genera el código para el No. de Expediente
$inicial_aPaterno = strtoupper(substr($paciente['aPaterno'], 0, 1));
$inicial_aMaterno = strtoupper(substr($paciente['aMaterno'], 0, 1));
$mes_actual = date('m'); // Mes en formato 01 al 12
$anio_actual = date('y'); // Últimos dos dígitos del año

$codigo_expediente = $inicial_aPaterno . $inicial_aMaterno . $mes_actual . $anio_actual;

// Obténer los registros de la tabla "notas_psicologicas" para el paciente actual y el usuario logueado
$sql_notas = "SELECT * 
              FROM notas_psicologicas 
              WHERE id_paciente = $id_paciente 
              AND id_usuario = $id_usuario_logueado
              ORDER BY fecha DESC, hora DESC";
$resultado_notas = $link->query($sql_notas);
?>

<!-- SECCION GENERAL -->

<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">

        <a href="perfil-apoyo.php?id_paciente=<?php echo $id_paciente; ?>" class="text-secondary mt-3">
            <i class="fa fa-undo" aria-hidden="true"></i> Volver a perfil del paciente
        </a>

        <div class="col-12" style="text-align: right;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarNota">
                Agregar Nota Psicológica
            </button>
        </div>

        <!-- Modal para agregar nota psicológica -->
        <div class="modal fade" id="modalAgregarNota" tabindex="-1" role="dialog" aria-labelledby="modalAgregarNotaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgregarNotaLabel">Agregar Nueva Nota Psicológica</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario de inserción -->
                        <form action="inserts/notas-psicologicas.php" method="POST">
                            <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
                            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_logueado; ?>">

                            <div class="form-group">
                                <label for="no_exp">No. de Expediente:</label>
                                <input type="text" class="form-control" name="no_exp" value="<?php echo $codigo_expediente; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="objetivo">Objetivo:</label>
                                <textarea class="form-control" name="objetivo" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="resumen">Resumen:</label>
                                <textarea class="form-control" name="resumen" rows="4" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="resultados">Resultados:</label>
                                <textarea class="form-control" name="resultados" rows="4" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="actividades">Actividades:</label>
                                <textarea class="form-control" name="actividades" rows="4" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="plan">Plan:</label>
                                <textarea class="form-control" name="plan" rows="4" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="fecha_proxima">Fecha de la Próxima Cita:</label>
                                <input type="date" class="form-control" name="fecha_proxima">
                            </div>

                            <div class="form-group mt-3">
                                <label for="cedula">Cédula Profesional:</label>
                                <input type="text" class="form-control" name="cedula">
                            </div>

                            <div class="form-group mt-3">
                                <label for="nombre_psicologo">Nombre del Psicólogo:</label>
                                <input type="text" class="form-control" name="nombre_psicologo">
                            </div>

                            <div class="form-group mt-3">
                                <label for="fecha">Fecha:</label>
                                <input type="date" class="form-control" name="fecha" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="hora">Hora:</label>
                                <input type="time" class="form-control" name="hora" required>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Guardar Nota</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Notas Psicológicas -->
        <div class="col-12 mt-4">
            <div class="card mb-4 px-3">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-3">
                        <h2>Notas Psicológicas del Paciente: <?php echo $paciente['nombre'] . " " . $paciente['aPaterno']; ?></h2>

                        <div class="row mt-3">
                            <div class="col-lg-12 d-flex align-items-stretch">
                                <div class="card w-100 mt-3">
                                    <div class="card-body p-4">
                                        <div class="mb-4">
                                            <h5 class="card-title fw-semibold">Notas Psicológicas</h5>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Hora</th>
                                                        <th>No. Expediente</th>           
                                                        <th>Próxima Cita</th>
                                                        <th>Detalles</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($fila_nota = $resultado_notas->fetch_assoc()) : ?>
                                                        <tr>
                                                            <td><?php echo $fila_nota['fecha']; ?></td>
                                                            <td><?php echo $fila_nota['hora']; ?></td>
                                                            <td><?php echo $fila_nota['no_exp']; ?></td>
                                                            <td><?php echo $fila_nota['fecha_proxima']; ?></td>
                                                            <td><a href='pdf/nota-psicologica.php?id_nota=<?php echo $fila_nota['id_nota']; ?>' target='_blank'>Ver nota</a></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Tabla de Notas Psicológicas -->

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
require "footer.php";
?>
