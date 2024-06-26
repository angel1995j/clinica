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
$sql_select = "SELECT nombre, aPaterno, aMaterno, numero_telefono, fecha_ingreso, fecha_salida, puesto, salario_neto, otros_conceptos, monto_otros_conceptos, archivado, contactos FROM empleados WHERE id_empleado = ?";
if ($stmt = $link->prepare($sql_select)) {
    $stmt->bind_param("i", $id_empleado);
    $stmt->execute();
    $stmt->bind_result($nombre, $aPaterno, $aMaterno, $numero_telefono, $fecha_ingreso, $fecha_salida, $puesto, $salario_neto, $otros_conceptos, $monto_otros_conceptos, $archivado, $contactos);

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

        <h3 class="mt-3">Editar datos del empleado <?php echo $nombre; ?></h3>
        <!-- Formulario de Edición -->
        <form action="updates/empleado.php" method="post" enctype="multipart/form-data">
            <!-- Campo de ID (oculto) -->
            <input type="hidden" name="id_empleado" value="<?php echo $id_empleado; ?>">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aPaterno">Apellido Paterno:</label>
                        <input type="text" class="form-control" name="aPaterno" value="<?php echo $aPaterno; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aMaterno">Apellido Materno:</label>
                        <input type="text" class="form-control" name="aMaterno" value="<?php echo $aMaterno; ?>" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero_telefono">Número de Teléfono:</label>
                        <input type="text" class="form-control" name="numero_telefono" value="<?php echo $numero_telefono; ?>">
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha de Ingreso:</label>
                        <input type="date" class="form-control" name="fecha_ingreso" value="<?php echo $fecha_ingreso; ?>" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_salida">Fecha de Salida:</label>
                        <input type="date" class="form-control" name="fecha_salida" value="<?php echo $fecha_salida; ?>">
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="puesto">Puesto:</label>
                        <input type="text" class="form-control" name="puesto" value="<?php echo $puesto; ?>" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="salario_neto">Salario Neto:</label>
                        <input type="number" step="0.01" class="form-control" name="salario_neto" value="<?php echo $salario_neto; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="otros_conceptos">Otros Conceptos:</label>
                        <textarea class="form-control" name="otros_conceptos" rows="4"><?php echo $otros_conceptos; ?></textarea>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contactos">Contactos:</label>
                        <textarea class="form-control" name="contactos" rows="4"><?php echo $contactos; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="monto_otros_conceptos">Monto Otros Conceptos:</label>
                        <input type="number" step="0.01" class="form-control" name="monto_otros_conceptos" value="<?php echo $monto_otros_conceptos; ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="archivado">Archivado:</label>
                        <select class="form-control" name="archivado" required>
                            <option value="si" <?php echo ($archivado == 'si') ? 'selected' : ''; ?>>Sí</option>
                            <option value="no" <?php echo ($archivado == 'no') ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Actualizar Empleado</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
// Incluye el archivo footer.php
require('footer.php');
?>
