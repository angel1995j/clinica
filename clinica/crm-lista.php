<?php
require('global.php');
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit();
}

// Verificar el rol del usuario
$user_role = $_SESSION['rol'];
if ($user_role == 'SuperAdministrador') {
    require "header.php";
} else {
    require "header-recepcion.php";
}

// Conexión a la base de datos
$link = bases();

// Consulta para obtener los contactos
$sql = "SELECT id_contacto, nombre, aPaterno, aMaterno, telefono, costo, estado, observaciones, fecha_ingreso, intensidad, archivado, id_usuario 
        FROM contactos";
$result = $link->query($sql);

?>

<!-- SECCION GENERAL -->
<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">
        <div class="col-6">
            <h4>Lista de Contactos</h4>
        </div>
        <div class="col-6 text-right" style="text-align: right;">
            <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addContactoModal">
                Agregar Contacto
            </button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="card-header pb-0">
                    <h6>Lista de Contactos</h6>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Nombre</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Apellido Paterno</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Apellido Materno</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Teléfono</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Costo</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Estado</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Observaciones</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Fecha de Ingreso</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Intensidad</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if ($result->num_rows > 0):
                                    while ($row = $result->fetch_assoc()): 
                                        // Verificar el estatus de archivado
                                        $archivado_class = ($row['archivado'] == 1) ? 'text-danger' : 'text-success';
                                        $archivado_text = ($row['archivado'] == 1) ? 'Archivado' : 'Activo';

                                        // Color según la intensidad (similar al ejemplo anterior)
                                        $color = '';
                                        switch ($row['intensidad']) {
                                            case 'Interesado':
                                                $color = 'green';
                                                break;
                                            case 'Muy interesado':
                                                $color = 'darkgreen';
                                                break;
                                            case 'Poco interesado':
                                                $color = 'orange';
                                                break;
                                            case 'No contesta':
                                                $color = 'gray';
                                                break;
                                            case 'Mal momento':
                                                $color = 'red';
                                                break;
                                            case 'En espera':
                                                $color = 'yellow';
                                                break;
                                            default:
                                                $color = 'blue';
                                                break;
                                        }
                                ?>
                                    <tr>
                                      
                                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                        <td><?php echo htmlspecialchars($row['aPaterno']); ?></td>
                                        <td><?php echo htmlspecialchars($row['aMaterno']); ?></td>
                                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                                        <td><?php echo htmlspecialchars($row['costo']); ?></td>
                                        <td><?php echo htmlspecialchars($row['estado']); ?></td>
                                        <td><?php echo htmlspecialchars($row['observaciones']); ?></td>
                                        <td><?php echo htmlspecialchars($row['fecha_ingreso']); ?></td>
                                        <td>
                                            <div style="background-color: <?php echo $color; ?>; height:25px; width:25px; border-radius: 50%;"></div>
                                        </td>
                                       
                                        <td>
                                            <!-- Aquí podrías agregar botones para acciones como editar o eliminar -->
                                            <a href="editar-contacto.php?id_contacto=<?php echo $row['id_contacto']; ?>" class="btn btn-secondary btn-sm">Editar</a>
                                        </td>
                                    </tr>
                                <?php 
                                    endwhile;
                                else: ?>
                                    <tr>
                                        <td colspan="12">No se encontraron contactos.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar nuevo contacto -->
<div class="modal fade" id="addContactoModal" tabindex="-1" role="dialog" aria-labelledby="addContactoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="addContactoModalLabel">Agregar Nuevo Contacto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <form action="inserts/contactos.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-4 col-form-label">Nombre:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nombre" required>
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="aPaterno" class="col-sm-4 col-form-label">Apellido Paterno:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="aPaterno" required>
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="aMaterno" class="col-sm-4 col-form-label">Apellido Materno:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="aMaterno" required>
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="telefono" class="col-sm-4 col-form-label">Teléfono:</label>
                                    <div class="col-sm-8">
                                        <input type="tel" class="form-control" name="telefono">
                                    </div>
                                </div>

                                  <div class="form-group row mt-3">
                                    <label for="costo" class="col-sm-4 col-form-label">Costo:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="costo">
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="fecha_ingreso" class="col-sm-4 col-form-label">Fecha de ingreso:</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="fecha_ingreso">
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="estado" class="col-sm-4 col-form-label">Estado:</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="estado" required>
                                            <option value="Suscriptor" selected>Suscriptor</option>
                                            <option value="Lead">Lead</option>
                                            <option value="Lead calificado">Lead calificado</option>
                                            <option value="Oportunidad">Oportunidad</option>
                                            <option value="Ganado">Ganado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="observaciones" class="col-sm-4 col-form-label">Observaciones:</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="observaciones" rows="4"></textarea>
                                    </div>
                                </div>


                                <div class="form-group row mt-3">
                                    <label for="intensidad" class="col-sm-4 col-form-label">Intensidad:</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="intensidad" required>
                                            <option value="Interesado" selected>Interesado</option>
                                            <option value="Muy interesado">Muy interesado</option>
                                            <option value="Poco interesado">Poco interesado</option>
                                            <option value="No contesta">No contesta</option>
                                            <option value="Mal momento">Mal momento</option>
                                            <option value="En espera">En espera</option>
                                        </select>
                                    </div>
                                </div>


                          

                                <div class="form-group row mt-3">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                </div>
                            </form>
        </div>
    </div>
</div>

<!-- SECCION GENERAL -->

<?php 
$link->close();
require "footer.php";
?>
