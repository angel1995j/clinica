<?php
require "header.php";
require "global.php";
$link = bases();

// Recuperar el id_compra desde la URL
$id_compra = $_GET['id_compra'];

// Consulta para obtener los datos de la compra con el id especificado
$sql = "SELECT * FROM compras WHERE id_compra = $id_compra";
$resultado = $link->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    $compra = $resultado->fetch_assoc();
?>

    <!-- SECCION GENERAL -->
    <div class="container-fluid py-4 mt-5">
        <div class="card-body px-0 pt-0 pb-4 pt-3 mt-5">
            <a href="compras.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
                Volver a todas las compras</a>

            <div class="card mb-4 px-3 mt-5">
                <h2 class="mt-5 text-center mb-4"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
                    Reportar compra número <?php echo $compra['id_compra']; ?> - Concepto: <?php echo $compra['concepto']; ?></h2>

                <form action="updates/reportar-compra.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monto">Monto:</label>
                                <input type="text" class="form-control" id="monto" name="monto" value="<?php echo $compra['monto']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comprobante">Comprobante:</label>
                                <input type="file" class="form-control" id="comprobante" name="comprobante">
                                <input type="hidden" class="form-control" id="id_compra" name="id_compra" value="<?php echo $compra['id_compra']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_aplicacion">Fecha de aplicación:</label>
                                <input type="date" class="form-control" id="fecha_aplicacion" name="fecha_aplicacion" value="<?php echo $compra['fecha_aplicacion']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estatus">Estatus:</label>
                                <select class="form-control" id="estatus" name="estatus" required>
                                    <option value="Pagada" <?php if ($compra['estatus'] == 'Pagada') echo 'selected'; ?>>Pagada</option>
                                    <option value="No Pagada" <?php if ($compra['estatus'] == 'No Pagada') echo 'selected'; ?>>No Pagada</option>
                                    <!-- Agrega las opciones de estatus necesarias -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Agrega aquí los campos adicionales de tu formulario -->
                    <!-- ... -->

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Actualizar Compra</button><br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
} else {
    echo "No se encontraron datos para la compra con ID: $id_compra";
}

require "footer.php";
?>
