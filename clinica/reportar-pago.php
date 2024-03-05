<?php
require "header.php";
require "global.php";
$link = bases();

?>

<!-- SECCION GENERAL -->
<div class="container-fluid py-4 mt-5">
    <div class="card-body px-0 pt-0 pb-4 pt-3 mt-5">
        <a href="pagos.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
            Volver a todos los pagos</a>

        <div class="card mb-4 px-3 mt-5">


            <?php
            // Recuperar el id_pago desde la URL
            $id_pago = $_GET['id_pago'];

            // Consulta para obtener los datos del pago con el id especificado
            $sql = "SELECT * FROM pago_paciente WHERE id_pago = $id_pago";
            $resultado = $link->query($sql);

            // Verificar si se encontraron resultados
            if ($resultado->num_rows > 0) {
                $pago = $resultado->fetch_assoc();

                // Consulta para obtener el nombre del paciente asociado al id_paciente en la tabla pago_paciente
                $sql_nombre_paciente = "SELECT pacientes.nombre AS nombre_paciente
                                FROM pago_paciente
                                JOIN pacientes ON pago_paciente.id_paciente = pacientes.id_paciente
                                WHERE pago_paciente.id_pago = $id_pago";

                $resultado_nombre_paciente = $link->query($sql_nombre_paciente);
                $nombre_paciente = $resultado_nombre_paciente->fetch_assoc()['nombre_paciente'];

                // Obtén la fecha actual
                $fecha_actual = new DateTime();

                // Convierte la fecha_agregado a un objeto DateTime
                $fecha_agregado = new DateTime($pago['fecha_agregado']);

                // Calcula la diferencia de días
                $diferencia_dias = $fecha_actual->diff($fecha_agregado)->days;

                // Definir el color de la leyenda
                $color_leyenda = '';
                // Compara directamente las fechas
                if ($fecha_agregado > $fecha_actual) {
                    $leyenda = "Pago con " . $fecha_agregado->diff($fecha_actual)->days . " día(s) de adelanto";
                    $color_leyenda = 'color: green;';
                } elseif ($fecha_agregado < $fecha_actual) {
                    $leyenda = "Pago retrasado por " . $fecha_actual->diff($fecha_agregado)->days . " día(s)";
                    $color_leyenda = 'color: red;';
                } else {
                    $leyenda = "Fecha actual";
                }

            ?>

                <h2 class="mt-5 text-center mb-4"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
                    Reportar pago número <?php echo $pago['numero_pago']; ?> del paciente: <?php echo $nombre_paciente; ?></h2>

                <small class="form-text text-center mb-3" style="<?php echo $color_leyenda; ?>"><?php echo $leyenda; ?></small>


                <form action="updates/pago.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monto">Monto:</label>
                                <input type="text" class="form-control" id="monto" name="monto" value="<?php echo $pago['monto']; ?>" required>
                            </div>
                            <!-- Resto de los campos del lado izquierdo -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comprobante">Comprobante:</label>
                                <input type="file" class="form-control" id="comprobante" name="comprobante">
                                <input type="hidden" class="form-control" id="numero_pago" name="numero_pago" value="<?php echo $pago['numero_pago']; ?>">

                            </div>
                            <!-- Resto de los campos del lado derecho -->
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descuento">Descuento:</label>
                                <input type="text" class="form-control" id="descuento" name="descuento" value="<?php echo $pago['descuento']; ?>">
                            </div>
                            <!-- Resto de los campos del lado izquierdo -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total">Total:</label>
                                <input type="text" class="form-control" id="total" name="total" value="<?php echo $pago['total']; ?>" required>
                            </div>
                            <!-- Resto de los campos del lado derecho -->
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_agregado">Fecha debida de pago:</label>
                                <input type="date" class="form-control" id="fecha_agregado" name="fecha_agregado" value="<?php echo $pago['fecha_agregado']; ?>" readonly style="background: #e7e6e4;">
                            </div>
                            <!-- Resto de los campos del lado izquierdo -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_pagado">Fecha de pago:</label>
                                <input type="date" class="form-control" id="fecha_pagado" name="fecha_pagado" value="<?php echo $pago['fecha_pagado']; ?>" required>
                            </div>
                            <!-- Resto de los campos del lado derecho -->
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="observaciones">Observaciones:</label>
                                <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $pago['observaciones']; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="forma_pago">Forma de Pago:</label>
                                <select class="form-control" id="forma_pago" name="forma_pago" required>
                                    <option value="Efectivo" <?php if ($pago['forma_pago'] == 'Efectivo') echo 'selected'; ?>>Efectivo</option>
                                    <option value="Tarjeta" <?php if ($pago['forma_pago'] == 'Tarjeta') echo 'selected'; ?>>Tarjeta</option>
                                    <option value="Transferencia" <?php if ($pago['forma_pago'] == 'Transferencia') echo 'selected'; ?>>Transferencia</option>
                                    <option value="Deposito" <?php if ($pago['forma_pago'] == 'Deposito') echo 'selected'; ?>>Déposito</option>
                                    <option value="Envio de efectivo" <?php if ($pago['forma_pago'] == 'Envio de efectivo') echo 'selected'; ?>>Envío de efectivo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="estatus" value="Pagado">
                    <input type="hidden" name="id_pago" value="<?php echo $id_pago; ?>">

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Actualizar Pago</button>
                    </div>
                </form>

            <?php
            } else {
                echo "No se encontraron datos para el pago con ID: $id_pago";
            }
            ?>

        </div>


    </div>

</div>

<?php require "footer.php"; ?>
