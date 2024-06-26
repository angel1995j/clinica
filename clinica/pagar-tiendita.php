<?php
require "header.php";
require "global.php";

// Verificar si la solicitud es POST para procesar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos enviados por POST
    $total_no_pagado = isset($_POST['total_no_pagado']) ? floatval($_POST['total_no_pagado']) : 0;
    $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';

    // Verificar la autenticación del usuario
    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        die('Usuario no autenticado');
    }

    // Obtener el id_usuario de la sesión
    $id_usuario = $_SESSION['id_usuario'];

    // Obtener id_paciente del POST (puedes ajustarlo según tu lógica)
    $id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;

    // Conectar a la base de datos
    $link = bases();

    // Consulta para obtener el saldo del paciente
    $sql_saldo = "SELECT saldo FROM pacientes WHERE id_paciente = $id_paciente";
    $resultado_saldo = $link->query($sql_saldo);
    if ($resultado_saldo->num_rows > 0) {
        $saldo_paciente = $resultado_saldo->fetch_assoc()['saldo'];
    } else {
        $saldo_paciente = 0;
    }
} else {
    die('Método de solicitud no válido');
}
?>

<div class="container-fluid py-4 mt-5">
    <div class="card-body px-0 pt-0 pb-4 pt-3 mt-5">
        <a href="deuda_tiendita_paciente.php?id_paciente=<?php echo $id_paciente; ?>" class="text-secondary mt-3"> 
            <i class="fa fa-undo" aria-hidden="true"></i> Regresar a movimientos del paciente 
        </a>
        <div class="container">
            <h2 class="mt-5 text-center">Confirmar Pago con Saldo</h2>
            <p class="text-center">Saldo Disponible: $<?php echo number_format($saldo_paciente, 2); ?></p>
            <form action="updates/pagar-tiendita.php" method="post" class="mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_no_pagado">Total a pagar</label>
                            <input type="text" class="form-control" id="total_no_pagado" name="total_no_pagado" value="<?php echo $total_no_pagado; ?>" readonly>
                        </div>
                        <div class="form-group mt-3">
                            <label for="saldo_paciente">Saldo actual del Paciente</label>
                            <input type="text" class="form-control" id="saldo_paciente" value="<?php echo number_format($saldo_paciente, 2); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $observaciones; ?>" readonly>
                        </div>
                        <div class="form-group mt-3">
                            <label for="forma_pago">Forma de Pago</label>
                            <select class="form-control" id="forma_pago" name="forma_pago" required>
                                <?php if ($saldo_paciente >= $total_no_pagado) { ?>
                                    <option value="Saldo" selected>Saldo (Disponible: <?php echo number_format($saldo_paciente, 2); ?>)</option>
                                <?php } else { ?>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                    <option value="Transferencia">Transferencia</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                <input type="hidden" name="saldo_paciente" value="<?php echo $saldo_paciente; ?>">
                <div class="form-group mt-3 text-center">
                    <button type="submit" class="btn btn-primary">Confirmar Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>
