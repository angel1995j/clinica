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
$sql_select = "SELECT * FROM empleados WHERE id_empleado = ?";
if ($stmt = $link->prepare($sql_select)) {
    $stmt->bind_param("i", $id_empleado);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Recupera los datos necesarios
        $nombre = $row['nombre'];
        $aPaterno = $row['aPaterno'];
        $aMaterno = $row['aMaterno'];
        $numero_telefono = $row['numero_telefono'];
        $fecha_ingreso = $row['fecha_ingreso'];
        $fecha_salida = $row['fecha_salida'];
        $puesto = $row['puesto'];
        $salario_bruto = $row['salario_bruto'];
        $salario_neto = $row['salario_neto'];
        $otros_conceptos = $row['otros_conceptos'];
        $monto_otros_conceptos = $row['monto_otros_conceptos'];
        $archivado = $row['archivado'];
        // Recupera los demás campos según tu estructura
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
        <h3 class="mt-3">Añadir nota  al empleado <?php echo $nombre; ?> <?php echo $aPaterno; ?></h3>
<!-- Formulario de Edición -->
       <form action="inserts/nota-empleado.php" method="post" enctype="multipart/form-data">
            <!-- Campo de ID (oculto) -->
            <input type="hidden" name="id_empleado" value="<?php echo $id_empleado; ?>">

            <!-- Otros campos se han eliminado y se agregarán los nuevos -->

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
                        <input type="number" step="0.01" class="form-control" name="monto" value="<?php echo $monto; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha">Fecha de Aplicación:</label>
                        <input type="date" class="form-control" name="fecha" value="" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="motivo">Motivo:</label>
                        <input type="text" class="form-control" name="motivo" value="" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Crearle nota</button>
                </div>
            </div>
        </form>




</div>

</div>
<?php
// Incluye aquí tu pie de página común
?>
