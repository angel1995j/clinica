<?php
require "header.php";
require "global.php";
$link = bases();
?>

<!-- SECCION GENERAL -->
<div class="container-fluid py-4 mt-5">
    <div class="card-body px-0 pt-0 pb-4 pt-3 mt-5">
        <?php
        // Recuperar el id_pago desde la URL
        $id_pago = $_GET['id_pago'];


        // Consulta para obtener el id_paciente asociado al id_pago
        $sql_paciente = "SELECT id_paciente FROM pago_paciente WHERE id_pago = $id_pago";
        $resultado_paciente = $link->query($sql_paciente);

        if ($resultado_paciente->num_rows > 0) {
            $id_paciente = $resultado_paciente->fetch_assoc()['id_paciente'];
        } else {
            // Manejo de error si no se encuentra el id_paciente
            echo "No se encontró el id_paciente para el pago con ID: $id_pago";
            exit;
        }

        // Consulta para obtener el saldo del paciente
        $sql_saldo = "SELECT saldo FROM pacientes WHERE id_paciente = $id_paciente";
        $resultado_saldo = $link->query($sql_saldo);
        if ($resultado_saldo->num_rows > 0) {
            $saldo_paciente = $resultado_saldo->fetch_assoc()['saldo'];
        } else {
            $saldo_paciente = 0;
        }

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



        <a href="pagos-individual.php?id_paciente=<?php echo $id_paciente; ?>" class="text-secondary mt-3">
            <i class="fa fa-undo" aria-hidden="true"></i>
            Volver a los pagos del paciente
        </a>

        <div class="card mb-4 px-3 mt-5">
            <h2 class="mt-5 text-center mb-4">
                <i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
                Reportar pago número <?php echo $pago['numero_pago']; ?> del paciente: <?php echo $nombre_paciente; ?>
            </h2>




          <?php  
            // Consulta para verificar si existen registros con las condiciones dadas para los pagos 1 y 2
        $sql_condicion = "SELECT COUNT(*) AS count FROM pago_paciente WHERE id_paciente = $id_paciente AND numero_pago IN (1, 2) AND fecha_pagado < fecha_agregado";
        $resultado_condicion = $link->query($sql_condicion);

        // Verificar si se encontraron resultados
        // Consulta para verificar si existen registros con las condiciones dadas para los pagos 1 y 2
        $sql_condicion = "SELECT COUNT(*) AS count FROM pago_paciente WHERE id_paciente = $id_paciente AND numero_pago IN (1, 2) AND fecha_pagado < fecha_agregado";
        $resultado_condicion = $link->query($sql_condicion);

        // Verificar si se encontraron resultados
        if ($resultado_condicion && $resultado_condicion->num_rows > 0) {
            $row = $resultado_condicion->fetch_assoc();
            $count = $row['count'];

            // Verificar si se cumple la condición para aplicar el descuento en el pago 3
            if ($count == 2 && $pago['numero_pago']== 3) {
                // Obtener el monto del pago actual
                $id_pago_actual = $_GET['id_pago'];
                $sql_monto_actual = "SELECT monto FROM pago_paciente WHERE id_pago = $id_pago_actual";
                $resultado_monto_actual = $link->query($sql_monto_actual);

                if ($resultado_monto_actual && $resultado_monto_actual->num_rows > 0) {
                    $monto_pago_actual = $resultado_monto_actual->fetch_assoc()['monto'];

                    // Calcular el descuento
                    $descuento = ($monto_pago_actual) * 0.30; // Descuento del 30%
                    $total_con_descuento = $monto_pago_actual - $descuento;

                    // Mostrar la leyenda con el descuento calculado
                    echo '<small class="form-text text-center mt-3" style="color: red;">Último pago descuento de 30%. Monto a pagar con descuento: $' . number_format($total_con_descuento, 2) . '</small>';
                } else {
                    // Si no se pudo obtener el monto del pago actual
                    echo '<small class="form-text text-center mt-3">Error al obtener el monto del pago actual.</small>';
                }
            } else {
                // Si no se cumple la condición para aplicar el descuento
                //echo '<small class="form-text text-center mt-3">No se cumplen las condiciones para el 30% de descuento en el pago número 3.</small>';
            }
        } else {
            // Si no se encontraron los pagos 1 y 2
            //echo '<small class="form-text text-center mt-3">No se encontraron los pagos 1 y 2 para aplicar el descuento en el pago número 3.</small>';
        }


            //TERMINA CONDICION DEL 30%
        ?>







            <small class="form-text text-center mb-3" style="<?php echo $color_leyenda; ?>"><?php echo $leyenda; ?></small>
            <?php if ($saldo_paciente > 0 && $saldo_paciente >= $pago['monto']) { ?>
                <small class="form-text text-center mb-3" style="color: blue;">
                    Cuentas con <?php echo number_format($saldo_paciente, 0, ',', '.'); ?> de saldo, puedes pagar con tu saldo a favor.
                </small>
            <?php } elseif ($saldo_paciente > 0) { ?>
                <small class="form-text text-center mb-3" style="">
                    Cuentas con <?php echo number_format($saldo_paciente, 0, ',', '.'); ?> de saldo.
                    El saldo disponible no es suficiente para pagar el monto total del pago.
                </small>
            <?php } ?>

            <form action="updates/pago.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="monto">Monto Pagado:</label>
                            <input type="text" class="form-control" id="total" name="total" value="<?php echo $pago['monto']; ?>" required>
                            <small style="margin-left: 2%;">
                             <?php
                                $sugerido = $pago['monto'] * 0.05; // Calcula el 5% del monto
                                $total_sugerido = $pago['monto'] - $sugerido; // Resta el 5% del monto al monto original
                                echo $total_sugerido . " Pagando en efectivo"; // Imprime el total sugerido
                            ?>

                           
                            </small>

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
                            <label for="observaciones">Notas:</label>
                            <input type="text" class="form-control" id="nota" name="nota" value="<?php echo $pago['nota']; ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="forma_pago">Forma de Pago:</label>
                            <select class="form-control" id="forma_pago" name="forma_pago" required>
                                <?php if ($saldo_paciente >= $pago['monto']) { ?>
                                    <option value="Saldo" <?php if ($pago['forma_pago'] == 'Saldo') echo 'selected'; ?>>Saldo (Disponible: <?php echo number_format($saldo_paciente, 0, ',', '.'); ?>)</option>
                                <?php } ?>
                                <option value="Efectivo" <?php if ($pago['forma_pago'] == 'Efectivo') echo 'selected'; ?>>Efectivo</option>
                                <option value="Tarjeta" <?php if ($pago['forma_pago'] == 'Tarjeta') echo 'selected'; ?>>Tarjeta</option>
                                <option value="Transferencia Cuenta Lenin" <?php if ($pago['forma_pago'] == 'Transferencia Cuenta Lenin') echo 'selected'; ?>>Transferencia Cuenta Lenin</option>
                                <option value="Transferencia Cuenta Dante" <?php if ($pago['forma_pago'] == 'Transferencia Cuenta Dante') echo 'selected'; ?>>Transferencia Cuenta Dante</option>
                                <option value="Déposito Cuenta Lenin" <?php if ($pago['forma_pago'] == 'Déposito Cuenta Lenin') echo 'selected'; ?>>Déposito Cuenta Lenin</option>
                                <option value="Déposito Cuenta Dante" <?php if ($pago['forma_pago'] == 'Déposito Cuenta Dante') echo 'selected'; ?>>Déposito Cuenta Dante</option>
                                <option value="Envio de efectivo" <?php if ($pago['forma_pago'] == 'Envio de efectivo') echo 'selected'; ?>>Envío de efectivo</option>
                            </select>
                        </div>
                    </div>
                </div>

              

                <input type="hidden" class="form-control" id="descuento" name="descuento" value="<?php echo $pago['descuento']; ?>">
                <input type="hidden" class="form-control" id="observaciones" name="observaciones" value="<?php echo $pago['observaciones']; ?>">
                <input type="hidden" class="form-control" id="monto" name="monto" value="<?php echo $pago['monto']; ?>" >
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
