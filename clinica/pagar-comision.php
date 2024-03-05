<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de clinica</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="assets/css/custom.css" />
   <script src="https://kit.fontawesome.com/1517bc3b2d.js" crossorigin="anonymous"></script>
       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</head>
<?php
//require "header.php";

// Conecta a la base de datos y obtén los datos del vendedor
require('global.php');
$link = bases();

// Obtén la información de la comisión a actualizar
$id_comision = isset($_GET['id_comision']) ? intval($_GET['id_comision']) : 0;

if (!$id_comision) {
    die('ID de la comisión no proporcionado');
}

$sqlComision = "SELECT * FROM comisiones WHERE id_comision = $id_comision";
$resultadoComision = $link->query($sqlComision);
$comision = $resultadoComision->fetch_assoc();

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos del formulario
    $concepto = $_POST['concepto'];
    $total_venta = $_POST['total_venta'];
    $porcentaje = $_POST['porcentaje'];
    $estatus = "Pagado";
    $fecha_pagado = $_POST['fecha_pagado'];
    $id_usuario = $comision['id_usuario'];

    // Aquí debes realizar la validación de los datos según tus necesidades
    // y realizar la actualización en la base de datos

    // Ejemplo de actualización (debes adaptarlo según tu estructura de base de datos)
    $sqlActualizar = "UPDATE comisiones SET
        concepto = '$concepto',
        total_venta = '$total_venta',
        porcentaje = '$porcentaje',
        estatus = '$estatus',
        fecha_pagado = '$fecha_pagado'
        WHERE id_comision = $id_comision";

    if ($link->query($sqlActualizar) === TRUE) {
    // Éxito en la actualización, redirige a pagar-comisiones.php?id_usuario dinámicamente
    $id_usuario = $comision['id_usuario'];
    header("Location: pagar-comisiones.php?id_usuario=$id_usuario");
    exit();  // Asegúrate de salir después de la redirección
        } else {
            // Error en la actualización, puedes manejarlo según tus necesidades
            echo "Error al actualizar la comisión: " . $link->error;
        }
}

?>

<div class="container py-4 mt-5">
    <div class="card mb-4 px-3 mt-5">
        <!--- INICIA CONTENIDO DE TABLA -->
        <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="pagar-comisiones.php?id_usuario=<?php echo $comision['id_usuario']; ?>" class="text-secondary mt-3">
                <i class="fa fa-undo" aria-hidden="true"></i> Volver a vendedores</a>
            <div class="container">
                

                <!-- Tabla de comisiones del vendedor -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="table-responsive mt-5">
                            <!-- Aquí puedes incluir la tabla de comisiones -->
                            <?php $montoAPagar = $comision['total_venta'] * ($comision['porcentaje'] / 100);?>
                            <h1>Pagar comisión con monto de: <?php echo $montoAPagar;?>  </h1> <br>


                            <!-- Formulario de actualización -->
                            <form method="post" action="">
                                <div class="mb-3">
                                    <label for="concepto" class="form-label">Concepto:</label>
                                    <input type="text" class="form-control" name="concepto" value="<?php echo $comision['concepto']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="total_venta" class="form-label">Total Venta:</label>
                                    <input type="number" class="form-control" name="total_venta" value="<?php echo $comision['total_venta']; ?>" readonly style="background: #ededed;">
                                </div>

                                <div class="mb-3">
                                    <label for="porcentaje" class="form-label">Porcentaje:</label>
                                    <input type="number" class="form-control" name="porcentaje" value="<?php echo $comision['porcentaje']; ?>" readonly style="background: #ededed;">
                                </div>


                                <div class="mb-3">
                                    <label for="fecha_pagado" class="form-label">Fecha Pagado:</label>
                                    <input type="date" class="form-control" name="fecha_pagado" value="<?php echo $comision['fecha_pagado']; ?>">
                                </div>

                                <button type="submit" class="btn btn-primary">Actualizar Comisión</button>
                            </form>
                            <!-- Fin del formulario de actualización -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
require "footer.php";
?>
