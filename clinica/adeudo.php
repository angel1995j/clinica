<?php require "header-recepcion.php"; 
$id_paciente = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : null;

?>

<div class="container mt-3">


<div class="card mt-5">
    <div class="card-header">
        
    </div>
    <div class="card-body">
        <h5 class="card-title mt-5">Añadir Pago Adicional</h5>
        <form action="inserts/pago-adicional-individual-recepcion.php?id_paciente=<?php echo $id_paciente; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="monto">Monto:</label>
                <input type="text" class="form-control" id="monto" name="monto" required>
            </div>

            <div class="form-group mt-3">
                <label for="comprobante">Comprobante (imagen o archivo):</label>
                <input type="file" class="form-control-file" id="comprobante" name="comprobante" accept="image/*">
            </div>

            <div class="form-group mt-3">
                <label for="fecha_agregado">Fecha de Agregado:</label>
                <input type="text" class="form-control" id="fecha_agregado" name="fecha_agregado" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>

            <div class="form-group mt-3">
                <label for="fecha_pagado">Fecha de Pagado:</label>
                <input type="date" class="form-control" id="fecha_pagado" name="fecha_pagado">
            </div>

            <div class="form-group mt-3">
                <label for="observaciones">Categoría:</label>
                <select class="form-control" id="observaciones" name="observaciones">
                    <option value="medicamento">Medicamento</option>
                    <option value="consultas externas">Consultas Externas</option>
                    <option value="peticiones">Peticiones</option>
                    <option value="tratamiento">Tratamiento</option>
                    <option value="otros gastos">Otros Gastos</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="notas">Notas:</label>
                <input type="text" class="form-control" name="nota" id="nota" value="">
            </div>

            <div class="form-group mt-3">
                <label for="estatus">Estatus:</label>
                <select class="form-control" id="estatus" name="estatus">
                    <option value="Pagado">Pagado</option>
                    <option value="No Pagado">No Pagado</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="forma_pago">Forma de pago:</label>
                <select class="form-control" id="forma_pago" name="forma_pago">
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Transferencia">Transferencia Cuenta Dante</option>
                    <option value="Transferencia Cuenta Lenin">Transferencia Cuenta Lenin</option>
                    <option value="Deposito Cuenta Dante">Depósito Cuenta Dante</option>
                    <option value="Deposito Cuenta Lenin">Depósito Cuenta Lenin</option>
                    <option value="Envio de efectivo">Envío de efectivo</option>
                </select>
            </div>

            <input type="hidden" name="id_paciente" value="<?php echo $_GET['id_paciente']; ?>">

            <button type="submit" class="btn btn-primary mt-3">Guardar Pago</button>
        </form>
    </div>
</div>

</div>
<?php require "footer.php"; ?>
