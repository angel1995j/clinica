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

// Obtén los registros de la tabla "agenda" para el paciente actual con fecha próxima y los datos de usuario
$hoy = date('Y-m-d H:i:s');
$sql_agenda = "SELECT agenda.*, usuarios.nombre AS nombre_usuario, usuarios.aPaterno AS aPaterno_usuario, usuarios.rol AS rol_usuario 
               FROM agenda 
               INNER JOIN usuarios ON agenda.id_usuario = usuarios.id_usuario
               WHERE agenda.id_paciente = $id_paciente AND agenda.fecha > '$hoy' 
               ORDER BY agenda.fecha";
$resultado_agenda = $link->query($sql_agenda);

// Obtén los registros de la tabla "evolucion" para el paciente actual
$sql_evolucion = "SELECT evolucion.*, usuarios.nombre AS nombre_usuario_evolucion
                 FROM evolucion
                 INNER JOIN usuarios ON evolucion.id_usuario = usuarios.id_usuario
                 WHERE evolucion.id_paciente = $id_paciente AND evolucion.id_usuario = $id_usuario_logueado
                 ORDER BY evolucion.fecha DESC LIMIT 25";
$resultado_evolucion = $link->query($sql_evolucion);

// Obtén la lista de usuarios con rol Padrino, Psicologo, y Medico para el modal
$sql_usuarios_modal = "SELECT id_usuario, CONCAT(nombre, ' ', aPaterno, ' - ', rol) AS nombre_rol FROM usuarios WHERE rol IN ('Padrino', 'Psicologo', 'Medico')";
$resultado_usuarios_modal = $link->query($sql_usuarios_modal);





?>

<!--SECCION GENERAL -->

<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">

        <a href="perfil-apoyo.php?id_paciente=<?php echo $id_paciente; ?>" class="text-secondary mt-3">
            <i class="fa fa-undo" aria-hidden="true"></i> Volver a perfil del paciente
        </a>

        <div class="col-12" style="text-align: right;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEvolucion">
                Agregar Evolución
            </button>
        </div>

        <!-- Modal para agregar cita -->
        <div class="modal fade" id="modalAgregarCita" tabindex="-1" role="dialog" aria-labelledby="modalAgregarCitaLabel" aria-hidden="true">
            <!-- ... (Código del modal de cita) ... -->
        </div>

        <!-- Modal para agregar evolución -->
        <div class="modal fade" id="modalAgregarEvolucion" tabindex="-1" role="dialog" aria-labelledby="modalAgregarEvolucionLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgregarEvolucionLabel">Agregar Nueva Evolución</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario de inserción --> 
                        <form action="inserts/evolucion-apoyo.php" method="POST"  enctype="multipart/form-data">
                            <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">

                            <div class="form-group">
                                <label for="descripcion">Título:</label>
                                <textarea class="form-control" name="descripcion" rows="1" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="evaluacion">Descripción de evaluación:</label>
                                <textarea class="form-control" name="evaluacion" rows="12" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="imagen">Descripción en imágen:</label>
                                <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*">
                            </div>

                            <div class="form-group mt-3">
                                <label for="fecha">Fecha:</label>
                                <input type="datetime-local" class="form-control" name="fecha" required>

                            </div>

                                
                                <!-- Campo oculto para almacenar el id_usuario seleccionado -->
                                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_logueado; ?>">
                    


                            <button type="submit" class="btn btn-primary mt-3">Guardar Evolución</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ... (Resto del código) ... -->

        <div class="col-12 mt-4">
            <div class="card mb-4 px-3">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-3">
                        <h2>Agenda y Evolución del paciente: <?php echo $paciente['nombre'] . " " . $paciente['aPaterno']; ?></h2>

                        <!-- ... (Resto del código) ... -->

                        <!-- Tabla de Evolución -->
                        <div class="row mt-3">
                            <div class="col-lg-12 d-flex align-items-stretch">
                                <div class="card w-100 mt-3">
                                    <div class="card-body p-4">
                                        <div class="mb-4">
                                            <h5 class="card-title fw-semibold">Evolución del paciente</h5>
                                        </div>

                                        <div class="container mt-5">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha</th>
                                                            <th>Descripción</th>
                                                            <th>Evaluación</th>
                                                            <th>Registrado por</th>
                                                            <th>Imágen</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($fila_evolucion = $resultado_evolucion->fetch_assoc()) : ?>
                                                            <tr>
                                                                <td><?php echo $fila_evolucion['fecha']; ?></td>
                                                                <td><?php echo $fila_evolucion['descripcion']; ?></td>
                                                                <td><?php echo $fila_evolucion['evaluacion']; ?></td>
                                                                <td><?php echo $fila_evolucion['nombre_usuario_evolucion']; ?></td>
                                                                <td><a href="assets/images/evolucion/<?php echo $fila_evolucion['imagen']; ?>" target="_blank">Ver</a></td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Tabla de Evolución -->

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
require "footer.php";
?>
