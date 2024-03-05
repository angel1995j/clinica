<?php
require "header.php";

// Recupera el ID del vendedor desde GET
$id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : 0;

if (!$id_usuario) {
    die('ID del vendedor no proporcionado');
}

// Conecta a la base de datos y obtén los datos del vendedor
require('global.php');
$link = bases();
$sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";

$resultado = $link->query($sql);

$vendedor = $resultado->fetch_assoc();

?>

<!--SECCION GENERAL -->
<!-- End Navbar -->
<div class="container-fluid py-4 mt-5">
    <div class="card mb-4 px-3 mt-5">
        <!--- INICIA CONTENIDO DE TABLA -->
        <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="vendedores.php" class="text-secondary mt-3">
                <i class="fa fa-undo" aria-hidden="true"></i> Volver a vendedores</a>

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaVenta" style="float: right;">
            Añadir nueva comisión
          </button>


          <div class="modal fade" id="nuevaVenta" tabindex="-1" aria-labelledby="nuevaVentaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar nueva venta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container mt-5">
                            <!-- Formulario Bootstrap -->
                           <form action="inserts/comisiones.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name="id_usuario" value="<?php echo $vendedor['id_usuario']; ?>">
                            
                            <div class="form-group row">
                                <label for="concepto" class="col-sm-4 col-form-label">Concepto:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="concepto" required>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="total_venta" class="col-sm-4 col-form-label">Total de Venta:</label>
                                <div class="col-sm-8">
                                    <input type="number" step="0.01" class="form-control" name="total_venta" required>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="porcentaje" class="col-sm-4 col-form-label">Porcentaje:</label>
                                <div class="col-sm-8">
                                    <input type="number" step="0.01" class="form-control" name="porcentaje" required>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="estatus" class="col-sm-4 col-form-label">Estatus:</label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="estatus">
                                        <option value="Pagado">Pagado</option>
                                        <option value="No Pagado" selected>No Pagado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="archivado" class="col-sm-4 col-form-label">Archivado:</label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="archivado">
                                        <option value="no" selected>No</option>
                                        <option value="si">Sí</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="fecha_venta" class="col-sm-4 col-form-label">Fecha de Venta:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="fecha_venta" required>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="fecha_pagado" class="col-sm-4 col-form-label">Fecha Pagado:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="fecha_pagado">
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </div>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>



            <div class="container">
                <h2 class="mt-5 text-center">
                    Movimientos del vendedor: <?php echo $vendedor['nombre'] . " " . $vendedor['aPaterno']; ?>
                </h2>

                <!-- Tabla de comisiones del paciente -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="table-responsive mt-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID de Comisión</th>
                                        <th>Concepto</th>
                                        <th>Total Venta</th>
                                        <th>Porcentaje</th>
                                        <th>Fecha de Venta</th>
                                        <th>Monto a Pagar</th> <!-- Nueva columna -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Obtener comisiones del vendedor
                                    $sqlComisiones = "SELECT * FROM comisiones WHERE id_usuario = $id_usuario AND estatus = 'No Pagado' ";
                                    $resultadoComisiones = $link->query($sqlComisiones);

                                    while ($comision = $resultadoComisiones->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $comision['id_comision'] . "</td>";
                                        echo "<td>" . $comision['concepto'] . "</td>";
                                        echo "<td>" . $comision['total_venta'] . "</td>";
                                        echo "<td>" . $comision['porcentaje'] . "%</td>";
                                        echo "<td>" . $comision['fecha_venta'] . "</td>";

                                        // Calcular el monto a pagar
                                        $montoAPagar = $comision['total_venta'] * ($comision['porcentaje'] / 100);
                                        echo "<td><b>" . $montoAPagar . "</b></td>";

                                         echo "<td><a href='pagar-comision.php?id_comision=" . $comision['id_comision'] . "' class='btn btn-primary'>Pagar</a></td>";

                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require "footer.php";
    ?>
