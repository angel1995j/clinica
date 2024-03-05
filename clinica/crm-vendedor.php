<?php
require "header-vendedor.php";
require "global.php";
$link = bases();

if (isset($_SESSION['id_usuario'])) {
    // Asigna el ID del usuario logueado a la variable
    $id_usuario_logueado = $_SESSION['id_usuario'];
} else {
    // Si no hay sesión, redirige al usuario al inicio de sesión o a otra página
    header("Location: iniciar_sesion.php");
    exit();
}

$currentDate = date("Y-m-d");

//calcula dias desde primer contacto
function calcularDiasTranscurridos($fechaInicio, $fechaFin)
{
    $diferencia = strtotime($fechaFin) - strtotime($fechaInicio);
    $dias = floor($diferencia / (60 * 60 * 24));
    return $dias;
}

$intensidad = $row['intensidad'];

// Define los colores según el valor de intensidad
$color = '';
switch ($intensidad) {
    case 'Frio':
        $color = 'blue';
        break;
    case 'Tibio':
        $color = 'yellow';
        break;
    case 'Caliente':
        $color = 'red';
        break;
    default:
        // Color predeterminado si no coincide con ninguna categoría
        $color = 'gray';
}



?>




      <!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">


      <div class="row mt-5">

        <div class="col-12 mb-4" style="text-align: right;">

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoContacto">
            Añadir nuevo contacto
          </button>
          
        </div>


         <!-- Modal -->
        <div class="modal fade" id="nuevoContacto" tabindex="-1" aria-labelledby="nuevoContactoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar nuevo contacto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container mt-5">

                            <!-- Formulario Bootstrap para nuevo contacto -->
                            <form action="inserts/contactos-vendedor.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-4 col-form-label">Nombre:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nombre" required>
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="aPaterno" class="col-sm-4 col-form-label">Apellido Paterno:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="aPaterno" required>
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="aMaterno" class="col-sm-4 col-form-label">Apellido Materno:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="aMaterno" required>
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="telefono" class="col-sm-4 col-form-label">Teléfono:</label>
                                    <div class="col-sm-8">
                                        <input type="tel" class="form-control" name="telefono">
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="fecha_ingreso" class="col-sm-4 col-form-label">Fecha de ingreso:</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="fecha_ingreso">
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="estado" class="col-sm-4 col-form-label">Estado:</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="estado" required>
                                            <option value="Ingresado" selected>Ingresado</option>
                                            <option value="En Proceso">En Proceso</option>
                                            <option value="En espera">En espera</option>
                                            <option value="Cerrado">Cerrado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="observaciones" class="col-sm-4 col-form-label">Observaciones:</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="observaciones" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="intensidad" class="col-sm-4 col-form-label">Intensidad:</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="intensidad" required>
                                            <option value="Frio" selected>Frio</option>
                                            <option value="Tibio">Tibio</option>
                                            <option value="Caliente">Caliente</option>
                                        </select>
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

          
          
        <div class="col-3 mt-5">
          <div class="card overflow-hidden">
              <div class="card-body">
                  <h5 class="card-title mb-9 fw-semibold">Ingresado &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-play" aria-hidden="true"></i></h5>

                  <?php
                  // Realiza una consulta SQL para obtener los registros con estado "Ingresado"
                  $sql = "SELECT * FROM contactos WHERE estado = 'Ingresado' AND id_usuario = $id_usuario_logueado";

                  $result = $link->query($sql);

                  // Verifica si hay resultados
                  if ($result->num_rows > 0) {
                      // Itera sobre los resultados y muestra cada registro
                      while ($row = $result->fetch_assoc()) {
                          ?>
                          <div class="d-flex flex-column justify-content-center">
                              <div class="row item-lead">
                                  <div class="col-md-10"> 
                                      <h5 class="mb-0 text-sm"><?php echo $row['nombre'] . ' ' . $row['aPaterno'] . ' ' . $row['aMaterno']; ?></h5>
                                      <p class="text-xs mb-0 mt-2"> <i class="fa fa-phone"></i> &nbsp;<?php echo $row['telefono']; ?></p>
                                      <p class="text-xs mb-0 mt-2"><b>Ingreso: </b><?php echo $row['fecha_ingreso']; ?></p>

                                      <p class="text-xs mb-0 mt-2">(Han pasado <?php echo calcularDiasTranscurridos($row['fecha_ingreso'], $currentDate); ?> días desde el primer contacto)</p>

                                       <?php
                                      // Consulta SQL para obtener el nombre y apellido paterno del vendedor
                                      $sqlVendedor = "SELECT nombre, aPaterno FROM usuarios WHERE id_usuario = " . $row['id_usuario'];
                                      $resultVendedor = $link->query($sqlVendedor);

                                      // Verifica si hay resultados
                                      if ($resultVendedor->num_rows > 0) {
                                          $vendedor = $resultVendedor->fetch_assoc();
                                          ?>
                                          <p class="text-xs mb-0 text-primary">Vendedor: <?php echo $vendedor['nombre'] . ' ' . $vendedor['aPaterno']; ?></p><br>
                                          <?php
                                      } else {
                                          // Muestra un mensaje si no hay resultados
                                          echo "Vendedor no encontrado.";
                                      }

                                      if ($row['intensidad'] == "Caliente") { ?>
                                          <div style="background-color: red; height:25px; width:25px; border-radius: 50%;"></div>
                                        <?php } elseif ($row['intensidad'] == "Tibio") {?>
                                          <div style="background-color: yellow; height:25px; width:25px; border-radius: 50%;"></div>
                                       <?php } elseif ($row['intensidad'] == "Frio") {?>
                                          <div style="background-color: blue; height:25px; width:25px; border-radius: 50%;"></div>
                                      <?php }?>

                                 
                                  </div>
                                  <div class="col-md-2">
                                      <a href="editar-contacto-vendedor.php?id_contacto=<?php echo $row['id_contacto']?>" style="color: black;"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                                  </div>
                              </div>
                          </div>
                          <?php
                      }
                  } else {
                      // Muestra un mensaje si no hay resultados
                      echo "No hay registros ingresados.";
                  }
                  ?>
              </div>
          </div>
      </div>





          <div class="col-3 mt-5">
          <div class="card overflow-hidden">
              <div class="card-body">
                  <h5 class="card-title mb-9 fw-semibold">En Espera &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-play" aria-hidden="true"></i></h5>

                  <?php
                  // Realiza una consulta SQL para obtener los registros con estado "En Espera"
                  $sql = "SELECT * FROM contactos WHERE estado = 'En Espera' AND id_usuario = $id_usuario_logueado";
                  $result = $link->query($sql);

                  // Verifica si hay resultados
                  if ($result->num_rows > 0) {
                      // Itera sobre los resultados y muestra cada registro
                      while ($row = $result->fetch_assoc()) {
                          ?>
                          <div class="d-flex flex-column justify-content-center">
                              <div class="row item-lead">
                                  <div class="col-md-10"> 
                                      <h5 class="mb-0 text-sm"><?php echo $row['nombre'] . ' ' . $row['aPaterno'] . ' ' . $row['aMaterno']; ?></h5>
                                      <p class="text-xs mb-0 mt-2"> <i class="fa fa-phone"></i> &nbsp;<?php echo $row['telefono']; ?></p>
                                      <p class="text-xs mb-0 mt-2"><b>Ingreso: </b><?php echo $row['fecha_ingreso']; ?></p>

                                      <p class="text-xs mb-0 mt-2">(Han pasado <?php echo calcularDiasTranscurridos($row['fecha_ingreso'], $currentDate); ?> días desde el primer contacto)</p>

                                       <?php
                                      // Consulta SQL para obtener el nombre y apellido paterno del vendedor
                                      $sqlVendedor = "SELECT nombre, aPaterno FROM usuarios WHERE id_usuario = " . $row['id_usuario'];
                                      $resultVendedor = $link->query($sqlVendedor);

                                      // Verifica si hay resultados
                                      if ($resultVendedor->num_rows > 0) {
                                          $vendedor = $resultVendedor->fetch_assoc();
                                          ?>
                                          <p class="text-xs mb-0 text-primary">Vendedor: <?php echo $vendedor['nombre'] . ' ' . $vendedor['aPaterno']; ?></p><br>
                                          <?php
                                      } else {
                                          // Muestra un mensaje si no hay resultados
                                          echo "Vendedor no encontrado.";
                                      }

                                      if ($row['intensidad'] == "Caliente") { ?>
                                          <div style="background-color: red; height:25px; width:25px; border-radius: 50%;"></div>
                                        <?php } elseif ($row['intensidad'] == "Tibio") {?>
                                          <div style="background-color: yellow; height:25px; width:25px; border-radius: 50%;"></div>
                                       <?php } elseif ($row['intensidad'] == "Frio") {?>
                                          <div style="background-color: blue; height:25px; width:25px; border-radius: 50%;"></div>
                                      <?php }?>

                                    
                                  </div>
                                  <div class="col-md-2">
                                      <a href="editar-contacto-vendedor.php?id_contacto=<?php echo $row['id_contacto']?>" style="color: black;"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                                  </div>
                              </div>
                          </div>
                          <?php
                      }
                  } else {
                      // Muestra un mensaje si no hay resultados
                      echo "No hay registros ingresados.";
                  }
                  ?>
              </div>
          </div>
      </div>



<div class="col-3 mt-5">
          <div class="card overflow-hidden">
              <div class="card-body">
                  <h5 class="card-title mb-9 fw-semibold">En Proceso &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-play" aria-hidden="true"></i></h5>

                  <?php
                  // Realiza una consulta SQL para obtener los registros con estado "En Proceso"
                  $sql = "SELECT * FROM contactos WHERE estado = 'En Proceso' AND id_usuario = $id_usuario_logueado";
                  $result = $link->query($sql);

                  // Verifica si hay resultados
                  if ($result->num_rows > 0) {
                      // Itera sobre los resultados y muestra cada registro
                      while ($row = $result->fetch_assoc()) {
                          ?>
                          <div class="d-flex flex-column justify-content-center">
                              <div class="row item-lead">
                                  <div class="col-md-10"> 
                                      <h5 class="mb-0 text-sm"><?php echo $row['nombre'] . ' ' . $row['aPaterno'] . ' ' . $row['aMaterno']; ?></h5>
                                      <p class="text-xs mb-0 mt-2"> <i class="fa fa-phone"></i> &nbsp;<?php echo $row['telefono']; ?></p>
                                      <p class="text-xs mb-0 mt-2"><b>Ingreso: </b><?php echo $row['fecha_ingreso']; ?></p>

                                      <p class="text-xs mb-0 mt-2">(Han pasado <?php echo calcularDiasTranscurridos($row['fecha_ingreso'], $currentDate); ?> días desde el primer contacto)</p>

                                       <?php
                                      // Consulta SQL para obtener el nombre y apellido paterno del vendedor
                                      $sqlVendedor = "SELECT nombre, aPaterno FROM usuarios WHERE id_usuario = " . $row['id_usuario'];
                                      $resultVendedor = $link->query($sqlVendedor);

                                      // Verifica si hay resultados
                                      if ($resultVendedor->num_rows > 0) {
                                          $vendedor = $resultVendedor->fetch_assoc();
                                          ?>
                                          <p class="text-xs mb-0 text-primary">Vendedor: <?php echo $vendedor['nombre'] . ' ' . $vendedor['aPaterno']; ?></p><br>
                                          <?php
                                      } else {
                                          // Muestra un mensaje si no hay resultados
                                          echo "Vendedor no encontrado.";
                                      }

                                      if ($row['intensidad'] == "Caliente") { ?>
                                          <div style="background-color: red; height:25px; width:25px; border-radius: 50%;"></div>
                                        <?php } elseif ($row['intensidad'] == "Tibio") {?>
                                          <div style="background-color: yellow; height:25px; width:25px; border-radius: 50%;"></div>
                                       <?php } elseif ($row['intensidad'] == "Frio") {?>
                                          <div style="background-color: blue; height:25px; width:25px; border-radius: 50%;"></div>
                                      <?php }

                                      ?>


                                  </div>
                                  <div class="col-md-2">
                                      <a href="editar-contacto-vendedor.php?id_contacto=<?php echo $row['id_contacto']?>" style="color: black;"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                                  </div>
                              </div>
                          </div>
                          <?php
                      }
                  } else {
                      // Muestra un mensaje si no hay resultados
                      echo "No hay registros ingresados.";
                  }
                  ?>
              </div>
          </div>
      </div>







<div class="col-3 mt-5">
          <div class="card overflow-hidden">
              <div class="card-body">
                  <h5 class="card-title mb-9 fw-semibold">Cerrado &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-play" aria-hidden="true"></i></h5>

                  <?php
                  // Realiza una consulta SQL para obtener los registros con estado "Cerrado"
                  $sql = "SELECT * FROM contactos WHERE estado = 'Cerrado' AND id_usuario = $id_usuario_logueado";
                  $result = $link->query($sql);

                  // Verifica si hay resultados
                  if ($result->num_rows > 0) {
                      // Itera sobre los resultados y muestra cada registro
                      while ($row = $result->fetch_assoc()) {
                          ?>
                          <div class="d-flex flex-column justify-content-center">
                              <div class="row item-lead">
                                  <div class="col-md-10"> 
                                      <h5 class="mb-0 text-sm"><?php echo $row['nombre'] . ' ' . $row['aPaterno'] . ' ' . $row['aMaterno']; ?></h5>
                                      <p class="text-xs mb-0 mt-2"> <i class="fa fa-phone"></i> &nbsp;<?php echo $row['telefono']; ?></p>
                                      <p class="text-xs mb-0 mt-2"><b>Ingreso: </b><?php echo $row['fecha_ingreso']; ?></p>

                                      <p class="text-xs mb-0 mt-2">(Han pasado <?php echo calcularDiasTranscurridos($row['fecha_ingreso'], $currentDate); ?> días desde el primer contacto)</p>

                                       <?php
                                      // Consulta SQL para obtener el nombre y apellido paterno del vendedor
                                      $sqlVendedor = "SELECT nombre, aPaterno FROM usuarios WHERE id_usuario = " . $row['id_usuario'];
                                      $resultVendedor = $link->query($sqlVendedor);

                                      // Verifica si hay resultados
                                      if ($resultVendedor->num_rows > 0) {
                                          $vendedor = $resultVendedor->fetch_assoc();
                                          ?>
                                          <p class="text-xs mb-0 text-primary">Vendedor: <?php echo $vendedor['nombre'] . ' ' . $vendedor['aPaterno']; ?></p><br>
                                          <?php
                                      } else {
                                          // Muestra un mensaje si no hay resultados
                                          echo "Vendedor no encontrado.";
                                      }


                                      if ($row['intensidad'] == "Caliente") { ?>
                                          <div style="background-color: red; height:25px; width:25px; border-radius: 50%;"></div>
                                        <?php } elseif ($row['intensidad'] == "Tibio") {?>
                                          <div style="background-color: yellow; height:25px; width:25px; border-radius: 50%;"></div>
                                       <?php } elseif ($row['intensidad'] == "Frio") {?>
                                          <div style="background-color: blue; height:25px; width:25px; border-radius: 50%;"></div>
                                      <?php }

                                      ?>
                                  </div>
                                  <div class="col-md-2">
                                      <a href="editar-contacto-vendedor.php?id_contacto=<?php echo $row['id_contacto']?>" style="color: black;"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                                  </div>
                              </div>
                          </div>
                          <?php
                      }
                  } else {
                      // Muestra un mensaje si no hay resultados
                      echo "No hay registros ingresados.";
                  }
                  ?>
              </div>
          </div>
      </div>



                            



        </div>



      <div class="row mt-5">

utiliza en todas el formato de abajo que tiene datos estaticos, esos datos deben salir de Base de datos

<?php
require "footer.php";
?>