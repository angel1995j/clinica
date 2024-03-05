<?php

session_start();
// Conecta a la base de datos y obtén los datos del paciente
require('global.php');
$link = bases();



// Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}



$sql = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";

$resultado = $link->query($sql);

$paciente = $resultado->fetch_assoc();

// Obtener el último registro de la tabla credito para el paciente seleccionado
$sqlCredito = "SELECT *
                   FROM credito
                   WHERE id_paciente = $id_paciente
                   ORDER BY id_credito DESC
                   LIMIT 1";

$resultado_credito = $link->query($sqlCredito);

$credito = $resultado_credito->fetch_assoc();


if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Tiendita') {
    require "header-tiendita.php";
     $rol = $_SESSION['rol'];
} else {
    require "header.php";
     $rol = $_SESSION['rol'];
}


?>

<!--SECCION GENERAL -->
<!-- End Navbar -->
<div class="container-fluid py-4 mt-5">
    <div class="card mb-4 px-3 mt-5">
        <!--- INICIA CONTENIDO DE TABLA -->
        <div class="card-body px-0 pt-0 pb-4 pt-3">

            <?php if ($rol === 'Tiendita') { ?>
                    <a href="pacientes-minimo.php" class="text-secondary mt-3">
                <i class="fa fa-undo" aria-hidden="true"></i> Volver a pacientes</a>
             <?php   } else { ?>
                   <a href="perfil.php?id_paciente=<?php echo $paciente['id_paciente'];?>" class="text-secondary mt-3">
                <i class="fa fa-undo" aria-hidden="true"></i> Volver a paciente</a>
              <?php  } ?>

            
            <div class="container">
                <h2 class="mt-5 text-center">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
                    Paciente: <?php echo $paciente['nombre'] . " " . $paciente['aPaterno']; ?>
                </h2>
               <h4 class="mt-5 text-center">
                        <?php
                        if (!empty($credito) && isset($credito['saldo'])) {
                            if ($credito['saldo'] > 0) {
                                echo "Este usuario cuenta con saldo a favor de: $" . $credito['saldo'];
                            } elseif ($credito['saldo'] < 0) {
                                echo "Este usuario tiene una deuda de: $" . abs($credito['saldo']);
                            } else {
                                echo "Este usuario no tiene saldo ni deuda.";
                            }
                        } else {
                            echo "No se pudo obtener información de crédito para este usuario.";
                        }
                        ?>
                </h4>

                <?php if (!empty($paciente['restriccionesConsumo'])): ?>
                    <h5 class="mt-3 text-center" style="color: red;">
                        Atención: El paciente tiene las siguientes restricciones de consumo: <?php echo $paciente['restriccionesConsumo']; ?>
                    </h5>
                <?php else: ?>
                    <h5 class="mt-3 text-center" style="color: green;">
                        Este paciente no tiene restricciones de consumo.
                    </h5>
                <?php endif; ?>


                <div class="row mt-5">

                    <div class="col-md-2">
                        <a class="btn btn-warning" href="carrito.php?id_paciente=<?php echo $paciente['id_paciente'];?>">
                          Nuevo consumo
                        </a>
                    </div>

                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#desgloce-credito">
                          Ver Movimientos de crédito
                        </button>
                    </div>
                 

                    <div class="col-md-3">
                        <a class="btn btn-primary" href="movimientos_tiendita_paciente.php?id_paciente=<?php echo $paciente['id_paciente'];?>">
                          Ver movimientos de compra
                        </a>
                    </div>

                    <div class="col-md-2">
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#restriccionesConsumo">
                          Añadir restricción
                        </button>
                    </div>

                    

                    <div class="col-md-2">
                     <?php if ($rol === 'Tiendita') { ?>
                           Para añadir saldo solicitelo al admin 
                     <?php   } else { ?>
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subir-credito">
                            Añadir saldo
                          </button>
                      <?php  } ?>
                      </div> 


                </div>
            </div>
        </div>
    </div>

            <!-- Modal movimientos -->
                <div class="modal fade" id="desgloce-credito" tabindex="-1" role="dialog" aria-labelledby="desgloce-creditoLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Movimientos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                

                                // Verificar si hay registros en la consulta
                                $sqlTodosCreditos = "SELECT * FROM credito WHERE id_paciente = $id_paciente";
                                $resultadoTodosCreditos = $link->query($sqlTodosCreditos);

                                if ($resultadoTodosCreditos === false) {
                                    // Imprimir el mensaje de error si la consulta falla
                                    echo "Error en la consulta SQL: " . $link->error;
                                } elseif ($resultadoTodosCreditos->num_rows > 0) {
                                ?>
                                    <div class="table-responsive mt-5">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Saldo</th>
                                                    <th>Fecha Actualización</th>
                                                    <th>Operación</th>
                                                    <th>Método</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($credito = $resultadoTodosCreditos->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $credito['saldo'] . "</td>";
                                                    echo "<td>" . $credito['fecha_actualizacion'] . "</td>";
                                                    echo "<td>" . $credito['operacion'] . "</td>";
                                                    echo "<td>" . $credito['metodoPago'] . "</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                } else {
                                    echo "<p class='text-center'>Este usuario no cuenta con crédito agregado.</p>";
                                }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>



             <!-- Modal Dar de alta crédito -->
            <div class="modal fade" id="subir-credito" tabindex="-1" role="dialog" aria-labelledby="subir-creditoLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dar de alta crédito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                     <form action="inserts/credito.php" method="POST">
                        <!-- Campo id_paciente (puede ser un campo desplegable si tienes una lista de pacientes) -->
                        <div class="form-group">
                            <input type="hidden" name="id_paciente" value="<?php echo $paciente['id_paciente'];?>" class="form-control" readonly>
                        </div>

                        <!-- Campo saldo -->
                        <div class="form-group">
                            <label for="saldo">Saldo:</label>
                            <input type="number" name="saldo" step="0.01" required class="form-control">
                        </div>

                        <!-- Campo operacion -->
                        <div class="form-group mt-3">
                            <label for="operacion">Operación:</label>
                            <select name="operacion" class="form-control" required>
                                <option value="Saldo a favor">Saldo a favor</option>
                                <option value="Ajuste de saldo">Ajuste de saldo</option>
                            </select>
                        </div>

                        <!-- Campo metodoPago -->
                        <div class="form-group mt-3">
                            <label for="metodoPago">Método de Pago:</label>
                            <select name="metodoPago" class="form-control" required>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                                <option value="Tarjeta de Débito">Tarjeta de Débito</option>
                                <option value="Envío de Efectivo">Envío de Efectivo</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <!-- Campo fecha_actualizacion -->
                        <div class="form-group mt-3">
                            <label for="fecha_actualizacion">Fecha de Actualización:</label>
                            <input type="date" name="fecha_actualizacion" placeholder="YYYY-MM-DD" required class="form-control">
                        </div>

                        <!-- Botón de enviar -->
                        <button type="submit" class="btn btn-primary mt-3">Insertar Crédito</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

             <!-- Modal restriccionesConsumo -->
            <div class="modal fade" id="restriccionesConsumo" tabindex="-1" role="dialog" aria-labelledby="restriccionesConsumo" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dar de alta crédito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                     <form action="updates/restriccion.php" method="POST">
                        <!-- Campo id_paciente (puede ser un campo desplegable si tienes una lista de pacientes) -->
                        <div class="form-group">
                            <input type="hidden" name="id_paciente" value="<?php echo $paciente['id_paciente'];?>" class="form-control" readonly>
                        </div>

                        <!-- Campo restriccionesConsumo -->
                        <div class="form-group mt-3">
                            <label for="restriccionesConsumo">Indique restricciónes de consumo:</label>
                              <textarea name="restriccionesConsumo" rows="4" required class="form-control"></textarea>
                        </div>

                        <!-- Botón de enviar -->
                        <button type="submit" class="btn btn-primary mt-3">Insertar Restricción</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

<?php
require "footer.php";
?>
