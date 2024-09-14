<?php
require "header-apoyo.php";

// Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

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

// Obtén los registros de la tabla "notas_consejeria" para el paciente actual
$sql_notas = "SELECT * 
              FROM notas_consejeria 
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarConsejeria">
                Agregar Nota de Consejería
            </button>
        </div>

        <!-- Modal para agregar nota de consejería -->
        <div class="modal fade" id="modalAgregarConsejeria" tabindex="-1" role="dialog" aria-labelledby="modalAgregarConsejeriaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgregarConsejeriaLabel">Agregar Nueva Nota de Consejería</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario de inserción -->
                        <form action="inserts/notas-consejeria.php" method="POST">
                            <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
                            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_logueado; ?>">

                            <div class="form-group mt-3">
                                <label for="fecha">FECHA DE LA SESIÓN ACTUAL</label>
                                <input type="date" class="form-control" name="fecha" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="hora">HORA DE LA SESIÓN ACTUAL</label>
                                <input type="time" class="form-control" name="hora" required>
                            </div>

                            <div class="form-group">
                                <label for="objetivo">OBJETIVO TERAPEUTICO DE CONSEJERIA</label>
                                <textarea class="form-control" name="objetivo" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="resumen">RESUMEN DE LA SESIÓN (ASPECTOS TRABAJADOS EN SESION)</label>
                                <textarea class="form-control" name="resumen" rows="4" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="resultados">RESULTADOS DE LA SESIÓN DE CONSEJERIA (CONDUCTA Y DISPOSICIÓN)</label>
                                <textarea class="form-control" name="resultados" rows="4" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="aspectos_esperados">ASPECTOS QUE SE ESPERAN TRABAJAR EN LA SIGUIENTE SESIÓN</label>
                                <textarea class="form-control" name="aspectos_esperados" rows="4" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="tareas">TAREAS ASIGNADAS AL USUARIO</label>
                                <textarea class="form-control" name="tareas" rows="4" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="aspectos_trabajados">ASPECTOS TRABAJADOS CON EL USUARIO PARA REINSERCIÓN SOCIAL</label>
                                <textarea class="form-control" name="aspectos_trabajados" rows="4" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="observaciones">OBSERVACIONES</label>
                                <textarea class="form-control" name="observaciones" rows="4" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="fecha_proxima">FECHA DE LA PRÓXIMA SESIÓN</label>
                                <input type="date" class="form-control" name="fecha_proxima">
                            </div>

                            

                            <button type="submit" class="btn btn-primary mt-3">Guardar Nota</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Notas de Consejería -->
        <div class="col-12 mt-4">
            <div class="card mb-4 px-3">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-3">
                        <h2>Notas de Consejería del Paciente: <?php echo $paciente['nombre'] . " " . $paciente['aPaterno']; ?></h2>

                        <div class="row mt-3">
                            <div class="col-lg-12 d-flex align-items-stretch">
                                <div class="card w-100 mt-3">
                                    <div class="card-body p-4">
                                        <div class="mb-4">
                                            <h5 class="card-title fw-semibold">Notas de Consejería</h5>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Hora</th>       
                                                        <th>Próxima Cita</th>
                                                        <th>Detalles</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($fila_nota = $resultado_notas->fetch_assoc()) : ?>
                                                        <tr>
                                                            <td><?php echo $fila_nota['fecha']; ?></td>
                                                            <td><?php echo $fila_nota['hora']; ?></td>
                                                            <td><?php echo $fila_nota['fecha_proxima']; ?></td>
                                                            <td><a href='pdf/nota-consejeria.php?id_consejeria=<?php echo $fila_nota['id_consejeria']; ?>' target='_blank'>Ver nota</a></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Tabla de Notas de Consejería -->

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
require "footer.php";
?>
