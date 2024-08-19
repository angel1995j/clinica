<?php
// Incluye el archivo global.php
require('global.php');

// Conecta a la base de datos
$link = bases();

// Recupera el ID del empleado desde GET
$id_empleado = isset($_GET['id_empleado']) ? intval($_GET['id_empleado']) : 0;

if (!$id_empleado) {
    die('ID del empleado no proporcionado');
}

// Recupera los datos del empleado de la base de datos
$sql_select = "SELECT nombre, aPaterno, aMaterno, numero_telefono, fecha_ingreso, fecha_salida, puesto, salario_bruto, salario_neto, otros_conceptos, monto_otros_conceptos, archivado FROM empleados WHERE id_empleado = ?";
if ($stmt = $link->prepare($sql_select)) {
    $stmt->bind_param("i", $id_empleado);
    $stmt->execute();
    $stmt->bind_result($nombre, $aPaterno, $aMaterno, $numero_telefono, $fecha_ingreso, $fecha_salida, $puesto, $salario_bruto, $salario_neto, $otros_conceptos, $monto_otros_conceptos, $archivado);

    if ($stmt->fetch()) {
        // Continuar con la lógica
    } else {
        die('No se encontró el empleado con ID ' . $id_empleado);
    }

    $stmt->close();
} else {
    die('Error en la preparación de la consulta');
}

// Incluye el archivo header.php
require('header.php');
?>

<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">
        <a href="quincena-empleado.php?id_empleado=<?php echo $id_empleado; ?>" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
             Volver al empleado</a>

        <!-- Formulario de Documentos -->
        <h3 class="mt-3">Agregar Documento</h3>
        <form action="inserts/doc-empleado.php" method="post" enctype="multipart/form-data">
            <!-- Campo de ID (oculto) -->
            <input type="hidden" name="id_empleado" value="<?php echo $id_empleado; ?>">

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_documento">Tipo de Documento:</label>
                        <select class="form-control" name="tipo_documento" required>
                            <option value="Cursos o Actualizaciones">Cursos o Actualizaciones</option>
                            <option value="Actas Administrativas">Actas Administrativas</option>
                            <option value="Documentos Internos">Documentos Internos</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="observaciones">Observaciones:</label>
                        <input type="text" class="form-control" name="observaciones">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="archivo">Archivo:</label>
                        <input type="file" class="form-control" name="archivo" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Agregar Documento</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
// Incluye aquí tu pie de página común
require('footer.php');
?>
