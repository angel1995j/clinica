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

// Obtén los registros de la tabla "hojas_egreso" para el paciente actual
$sql_notas = "SELECT * 
              FROM hojas_egreso 
              WHERE id_paciente = $id_paciente 
              AND id_usuario = $id_usuario_logueado
              ORDER BY fecha DESC";
$resultado_notas = $link->query($sql_notas);

// Verifica si la consulta tuvo éxito
if (!$resultado_notas) {
    // Muestra el error de MySQL si la consulta falló
    die('Error en la consulta SQL: ' . $link->error);
}
?>

<!-- SECCION GENERAL -->

<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">

        <a href="perfil-apoyo.php?id_paciente=<?php echo $id_paciente; ?>" class="text-secondary mt-3">
            <i class="fa fa-undo" aria-hidden="true"></i> Volver a perfil del paciente
        </a>

        <div class="col-12" style="text-align: right;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarConsejeria">
                Agregar Hoja de egreso
            </button>
        </div>

        <!-- Modal para agregar nota de consejería -->
        <div class="modal fade" id="modalAgregarConsejeria" tabindex="-1" role="dialog" aria-labelledby="modalAgregarConsejeriaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgregarConsejeriaLabel">Agregar Nueva Hoja de egreso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario de inserción -->
                       <form action="inserts/hojas-egreso.php" method="POST">
                            <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
                            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_logueado; ?>">

                            <div class="form-group">
                                <label for="fecha">Fecha y Hora de Egreso</label>
                                <input type="datetime-local" class="form-control" name="fecha" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="motivos_egreso">Motivos de Egreso</label>
                                <select class="form-control" name="motivos_egreso" required>
                                    <option value="" disabled selected>Selecciona un motivo</option>
                                    <option value="SOLICITUD DEL USUARIO">SOLICITUD DEL USUARIO</option>
                                    <option value="SOLICITUD DE UN FAMILIAR">SOLICITUD DE UN FAMILIAR</option>
                                    <option value="OBJETIVOS CUBIERTOS DEL TRATAMIENTO">OBJETIVOS CUBIERTOS DEL TRATAMIENTO</option>
                                    <option value="TRASLADO (REFERENCIA)">TRASLADO (REFERENCIA)</option>
                                    <option value="ABANDONO DEL ESTABLECIMIENTO SIN AUTORIZACIÓN DEL RESPONSABLE DEL TRATAMIENTO">ABANDONO DEL ESTABLECIMIENTO SIN AUTORIZACIÓN DEL RESPONSABLE DEL TRATAMIENTO</option>
                                    <option value="DEFUNCIÓN">DEFUNCIÓN</option>
                                    <option value="DISPOSICIÓN DE LA AUTORIDAD COMPETENTE">DISPOSICIÓN DE LA AUTORIDAD COMPETENTE</option>
                                </select>
                            </div>


                            <div class="form-group mt-3">
                                <label for="diagnostico_ingreso">Diagnóstico de Ingreso</label>
                                <textarea class="form-control" name="diagnostico_ingreso" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="periodo_internamiento">Periodo de Internamiento</label>
                                <textarea class="form-control" name="periodo_internamiento" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="tratamiento_llevado_cabo">Tratamiento Llevado a Cabo</label>
                                <textarea class="form-control" name="tratamiento_llevado_cabo" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="estudios_realizados">Estudios Realizados</label>
                                <textarea class="form-control" name="estudios_realizados" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="eeg">E.E.G</label>
                                <textarea class="form-control" name="eeg" rows="3"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="laboratorio">Laboratorio</label>
                                <textarea class="form-control" name="laboratorio" rows="3"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="rx">RX</label>
                                <textarea class="form-control" name="rx" rows="3"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="pruebas_psicologicas">Pruebas Psicológicas</label>
                                <textarea class="form-control" name="pruebas_psicologicas" rows="3"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="otros">Otros</label>
                                <textarea class="form-control" name="otros" rows="3"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="evolucion_manejo_estancia">Evolución y Manejo Durante la Estancia</label>
                                <textarea class="form-control" name="evolucion_manejo_estancia" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="descripcion_estado_general">Descripción del Estado General</label>
                                <textarea class="form-control" name="descripcion_estado_general" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="exploracion_fisica_egreso">Exploración Física al Egreso</label>
                                <textarea class="form-control" name="exploracion_fisica_egreso" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="problemas_clinicos_pendientes">Problemas Clínicos Pendientes</label>
                                <textarea class="form-control" name="problemas_clinicos_pendientes" rows="3"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="recomendaciones_seguimiento">Recomendaciones para Seguimiento de Caso</label>
                                <textarea class="form-control" name="recomendaciones_seguimiento" rows="3" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="pronostico">Pronóstico</label>
                                <textarea class="form-control" name="pronostico" rows="3"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="observaciones_generales">Observaciones Generales Acerca del Usuario</label>
                                <textarea class="form-control" name="observaciones_generales" rows="3"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="fechas_horas">Fechas y Horas</label>
                                <div id="fechas_horas_container">
                                    <div class="fecha-hora-entry">
                                        <input type="date" name="fechas_horas[0][fecha]" class="form-control mb-2" required>
                                        <input type="time" name="fechas_horas[0][hora]" class="form-control mb-2" required>
                                        <button type="button" class="btn btn-danger remove-entry" style="display:none;">Eliminar</button>
                                    </div>
                                </div>
                                <button type="button" id="add_entry" class="btn btn-primary mt-2">Agregar Fecha y Hora</button>
                            </div>


                            <button type="submit" class="btn btn-primary mt-4">Guardar Hoja de Egreso</button>
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
                        <h2>Hojas de egreso del Paciente: <?php echo $paciente['nombre'] . " " . $paciente['aPaterno']; ?></h2>

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
                                                        <th>Hoja egreso</th>
                                                        <th>Seguimiento</th>
                                                        <th>Carta compromiso</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($fila_nota = $resultado_notas->fetch_assoc()) : ?>
                                                        <tr>
                                                            <td><?php echo $fila_nota['fecha']; ?></td>
                                                            <td><a href='pdf/hoja-egreso.php?id_egreso=<?php echo $fila_nota['id_egreso']; ?>' target='_blank'>Ver hoja de egreso</a></td>
                                                            <td><a href='pdf/seguimiento.php?id_egreso=<?php echo $fila_nota['id_egreso']; ?>' target='_blank'>Ver hoja de seguimiento</a></td> 

                                                            <td><a href='pdf/carta-compromiso.php?id_egreso=<?php echo $fila_nota['id_egreso']; ?>' target='_blank'>Ver carta compromiso</a></td>
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


<script>
document.getElementById('add_entry').addEventListener('click', function() {
    var container = document.getElementById('fechas_horas_container');
    var index = container.children.length;

    var newEntry = document.createElement('div');
    newEntry.classList.add('fecha-hora-entry');
    newEntry.innerHTML = `
        <input type="date" name="fechas_horas[${index}][fecha]" class="form-control mb-2" required>
        <input type="time" name="fechas_horas[${index}][hora]" class="form-control mb-2" required>
        <button type="button" class="btn btn-danger remove-entry">Eliminar</button>
    `;
    container.appendChild(newEntry);

    // Muestra el botón de eliminar si hay más de un campo
    var removeButtons = document.querySelectorAll('.remove-entry');
    removeButtons.forEach(function(btn) {
        btn.style.display = 'block';
    });
});

document.getElementById('fechas_horas_container').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-entry')) {
        e.target.parentElement.remove();
    }
});
</script>

<?php
require "footer.php";
?>
