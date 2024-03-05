<?php
require "header-apoyo.php";

// Recupera el ID del usuario desde la sesión
$id_usuario_actual = isset($_SESSION['id_usuario']) ? intval($_SESSION['id_usuario']) : 0;

// Conecta a la base de datos y obtén los datos del usuario actual
require('global.php');
$link = bases();

// Consulta SQL para obtener el usuario actual
$sql_usuario_actual = "SELECT id_usuario, nombre, aPaterno, rol FROM usuarios WHERE id_usuario = $id_usuario_actual";
$resultado_usuario_actual = $link->query($sql_usuario_actual);
$usuario_actual = $resultado_usuario_actual->fetch_assoc();

if (!$usuario_actual) {
    die('Usuario no encontrado');
}

// Consulta SQL para obtener los pacientes relacionados con el usuario actual
$sql_pacientes = "SELECT id_paciente, nombre, aPaterno FROM pacientes";
$resultado_pacientes = $link->query($sql_pacientes);

// Consulta SQL para obtener la agenda del usuario actual con fechas próximas
$hoy = date('Y-m-d H:i:s');
$sql_agenda = "SELECT agenda.*, pacientes.nombre AS nombre_paciente, pacientes.aPaterno AS aPaterno_paciente 
               FROM agenda 
               INNER JOIN pacientes ON agenda.id_paciente = pacientes.id_paciente
               WHERE agenda.id_usuario = $id_usuario_actual AND agenda.fecha > '$hoy' 
               ORDER BY agenda.fecha";

$resultado_agenda = $link->query($sql_agenda);

?>

<!--SECCION GENERAL -->

<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">
       

        <div class="col-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCita">
                Agregar Cita
            </button>
        </div>


         <div class="col-6">
            <!-- Boton de ayuda -->
           <button type="button" class="btn boton-ayuda" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
          </button>

          <!-- Modal de ayuda-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agenda propia</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Desde aqui se pueden gestionar todas las citas realizadas, próximas a suceder tambien se incluye fecha observaciones y con que paciente se realiza la cita
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal para agregar cita -->
        <div class="modal fade" id="modalAgregarCita" tabindex="-1" role="dialog" aria-labelledby="modalAgregarCitaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgregarCitaLabel">Agregar Nueva Cita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario de inserción -->
                        <form action="inserts/agenda-apoyo.php" method="POST">
                            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_actual; ?>">

                            <div class="form-group">
                                <label for="id_paciente">Seleccionar Paciente:</label>
                                <select class="form-control" name="id_paciente" required>
                                    <?php while ($row_paciente = $resultado_pacientes->fetch_assoc()) : ?>
                                        <option value="<?php echo $row_paciente['id_paciente']; ?>"><?php echo $row_paciente['nombre'] . " " . $row_paciente['aPaterno']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="fecha">Fecha:</label>
                                <input type="datetime-local" class="form-control" name="fecha" required>
                            </div>

                            <div class="form-group">
                                <label for="observaciones">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Guardar Cita</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="card mb-4 px-3">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-3">
                        <h2>Agenda del usuario: <?php echo $usuario_actual['nombre'] . " " . $usuario_actual['aPaterno'] . " - " . $usuario_actual['rol']; ?></h2>

                        <div class="row">
                            <div class="col-lg-12 d-flex align-items-stretch">
                                <div class="card w-100 mt-3">
                                    <div class="card-body p-4">
                                        <div class="mb-4">
                                            <h5 class="card-title fw-semibold">Agenda del usuario</h5>
                                        </div>

                                        <div class="container mt-5">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha</th>
                                                            <th>Observaciones</th>
                                                            <th>Paciente</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($fila_agenda = $resultado_agenda->fetch_assoc()) : ?>
                                                            <tr>
                                                                <td><?php echo $fila_agenda['fecha']; ?></td>
                                                                <td>
                                                                    <span class="badge badge-sm bg-success">
                                                                        <?php echo $fila_agenda['observaciones']; ?>
                                                                    </span>
                                                                </td>
                                                                <td><?php echo $fila_agenda['nombre_paciente']." ". $fila_agenda['aPaterno_paciente']; ?></td>
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

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<?php
require "footer.php";
?>
