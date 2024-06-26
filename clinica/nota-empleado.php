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

        <h3 class="mt-3">Añadir nota al empleado <?php echo $nombre; ?> <?php echo $aPaterno; ?></h3>
        <!-- Formulario de Edición -->
        <form action="inserts/nota-empleado.php" method="post" enctype="multipart/form-data">
            <!-- Campo de ID (oculto) -->
            <input type="hidden" name="id_empleado" value="<?php echo $id_empleado; ?>">

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_operacion">Tipo de Operación:</label>
                        <select class="form-control" name="tipo_operacion" required>
                            <option value="Descuento">Descuento</option>
                            <option value="Bono">Bono</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="monto">Monto:</label>
                        <input type="number" step="0.01" class="form-control" name="monto" value="<?php echo isset($monto) ? $monto : ''; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha">Fecha de Aplicación:</label>
                        <input type="date" class="form-control" name="fecha" value="<?php echo isset($fecha) ? $fecha : ''; ?>" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="motivo">Motivo:</label>
                        <input type="text" class="form-control" name="motivo" value="<?php echo isset($motivo) ? $motivo : ''; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Crear nota</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
// Incluye aquí tu pie de página común
require('footer.php');
?>
