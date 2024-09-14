<?php
require "header.php";
require "global.php";
$link = bases();

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
    case 'Interesado':
        $color = 'green'; // Cambia el color según tu preferencia
        break;
    case 'Muy interesado':
        $color = 'darkgreen'; // Cambia el color según tu preferencia
        break;
    case 'Poco interesado':
        $color = 'orange'; // Cambia el color según tu preferencia
        break;
    case 'No contesta':
        $color = 'gray'; // Cambia el color según tu preferencia
        break;
    case 'Mal momento':
        $color = 'red'; // Cambia el color según tu preferencia
        break;
    case 'En espera':
        $color = 'yellow'; // Cambia el color según tu preferencia
        break;
    default:
        // Color predeterminado si no coincide con ninguna categoría
        $color = 'blue';
}




?>




      <!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">


      <div class="row mt-5">

        <div class="col-6 mb-4">

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoContacto">
            Añadir nuevo contacto
          </button>

          <a class="btn btn-danger" href="crm-lista.php">
            Modo Lista
          </a>
          
        </div>


        <div class="col-6">
            <!-- Boton de ayuda -->
           <button type="button" class="btn boton-ayuda" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
          </button>

          <!-- Modal de ayuda-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">CRM</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Desde aqui podemos visualizar todos los contactos que llegan al sistema, añadidos desde esta misma sección o añadidos por los vendedores, en colores se visualiza el nivel de intensidad del contacto, al presionar el icono de más podemos editar ese contacto.

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
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
                            <form action="inserts/contactos.php" method="post" enctype="multipart/form-data">
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
                                    <label for="costo" class="col-sm-4 col-form-label">Costo:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="costo">
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
                                            <option value="Suscriptor" selected>Suscriptor</option>
                                            <option value="Lead">Lead</option>
                                            <option value="Lead calificado">Lead calificado</option>
                                            <option value="Oportunidad">Oportunidad</option>
                                            <option value="Ganado">Ganado</option>
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
                                            <option value="Interesado" selected>Interesado</option>
                                            <option value="Muy interesado">Muy interesado</option>
                                            <option value="Poco interesado">Poco interesado</option>
                                            <option value="No contesta">No contesta</option>
                                            <option value="Mal momento">Mal momento</option>
                                            <option value="En espera">En espera</option>
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
                  <h5 class="card-title mb-9 fw-semibold">Suscriptor &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-play" aria-hidden="true"></i></h5>

                  <?php
                  // Realiza una consulta SQL para obtener los registros con estado "Suscriptor"
                  $sql = "SELECT * FROM contactos WHERE estado = 'Suscriptor'";
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
                                      ?>

                                        


                                     <?php
                                        // Definimos el color y el texto según la intensidad usando un switch
                                        $color = '';
                                        $texto = '';
                                        switch ($row['intensidad']) {
                                            case 'Interesado':
                                                $color = 'green';
                                                $texto = 'Interesado';
                                                break;
                                            case 'Muy interesado':
                                                $color = 'darkgreen';
                                                $texto = 'Muy interesado';
                                                break;
                                            case 'Poco interesado':
                                                $color = 'orange';
                                                $texto = 'Poco interesado';
                                                break;
                                            case 'No contesta':
                                                $color = 'gray';
                                                $texto = 'No contesta';
                                                break;
                                            case 'Mal momento':
                                                $color = 'red';
                                                $texto = 'Mal momento';
                                                break;
                                            case 'En espera':
                                                $color = 'yellow';
                                                $texto = 'En espera';
                                                break;
                                            default:
                                                $color = 'blue'; // Color predeterminado
                                                $texto = 'Desconocido';
                                                break;
                                        }
                                        ?>

                                        <!-- Aquí mostramos el círculo de color y el texto correspondiente -->
                                        <div style="display: flex; align-items: center;">
                                            <div style="background-color: <?php echo $color; ?>; height:25px; width:25px; border-radius: 50%; margin-right: 10px;"></div>
                                            <span><?php echo $texto; ?></span>
                                        </div>


                                  </div>
                                  <div class="col-md-2">
                                      <a href="editar-contacto.php?id_contacto=<?php echo $row['id_contacto']?>" style="color: black;"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
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
                  <h5 class="card-title mb-9 fw-semibold">Lead &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-play" aria-hidden="true"></i></h5>

                  <?php
                  // Realiza una consulta SQL para obtener los registros con estado "Lead"
                  $sql = "SELECT * FROM contactos WHERE estado = 'Lead'";
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
                                      ?>

                                      <?php
                                        // Definimos el color y el texto según la intensidad usando un switch
                                        $color = '';
                                        $texto = '';
                                        switch ($row['intensidad']) {
                                            case 'Interesado':
                                                $color = 'green';
                                                $texto = 'Interesado';
                                                break;
                                            case 'Muy interesado':
                                                $color = 'darkgreen';
                                                $texto = 'Muy interesado';
                                                break;
                                            case 'Poco interesado':
                                                $color = 'orange';
                                                $texto = 'Poco interesado';
                                                break;
                                            case 'No contesta':
                                                $color = 'gray';
                                                $texto = 'No contesta';
                                                break;
                                            case 'Mal momento':
                                                $color = 'red';
                                                $texto = 'Mal momento';
                                                break;
                                            case 'En espera':
                                                $color = 'yellow';
                                                $texto = 'En espera';
                                                break;
                                            default:
                                                $color = 'blue'; // Color predeterminado
                                                $texto = 'Desconocido';
                                                break;
                                        }
                                        ?>

                                        <!-- Aquí mostramos el círculo de color y el texto correspondiente -->
                                        <div style="display: flex; align-items: center;">
                                            <div style="background-color: <?php echo $color; ?>; height:25px; width:25px; border-radius: 50%; margin-right: 10px;"></div>
                                            <span><?php echo $texto; ?></span>
                                        </div>

                                  </div>
                                  <div class="col-md-2">
                                      <a href="editar-contacto.php?id_contacto=<?php echo $row['id_contacto']?>" style="color: black;"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
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
                  <h5 class="card-title mb-9 fw-semibold">Lead calificado &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-play" aria-hidden="true"></i></h5>

                  <?php
                  // Realiza una consulta SQL para obtener los registros con estado "Lead calificado"
                  $sql = "SELECT * FROM contactos WHERE estado = 'Lead calificado'";
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
                                      ?>

                                     <?php
                                        // Definimos el color y el texto según la intensidad usando un switch
                                        $color = '';
                                        $texto = '';
                                        switch ($row['intensidad']) {
                                            case 'Interesado':
                                                $color = 'green';
                                                $texto = 'Interesado';
                                                break;
                                            case 'Muy interesado':
                                                $color = 'darkgreen';
                                                $texto = 'Muy interesado';
                                                break;
                                            case 'Poco interesado':
                                                $color = 'orange';
                                                $texto = 'Poco interesado';
                                                break;
                                            case 'No contesta':
                                                $color = 'gray';
                                                $texto = 'No contesta';
                                                break;
                                            case 'Mal momento':
                                                $color = 'red';
                                                $texto = 'Mal momento';
                                                break;
                                            case 'En espera':
                                                $color = 'yellow';
                                                $texto = 'En espera';
                                                break;
                                            default:
                                                $color = 'blue'; // Color predeterminado
                                                $texto = 'Desconocido';
                                                break;
                                        }
                                        ?>

                                        <!-- Aquí mostramos el círculo de color y el texto correspondiente -->
                                        <div style="display: flex; align-items: center;">
                                            <div style="background-color: <?php echo $color; ?>; height:25px; width:25px; border-radius: 50%; margin-right: 10px;"></div>
                                            <span><?php echo $texto; ?></span>
                                        </div>

                                  </div>
                                  <div class="col-md-2">
                                      <a href="editar-contacto.php?id_contacto=<?php echo $row['id_contacto']?>" style="color: black;"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
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
                  <h5 class="card-title mb-9 fw-semibold">Oportunidad &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-play" aria-hidden="true"></i></h5>

                  <?php
                  // Realiza una consulta SQL para obtener los registros con estado "Oportunidad"
                  $sql = "SELECT * FROM contactos WHERE estado = 'Oportunidad'";
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
                                      ?>


                                      <?php
                                        // Definimos el color y el texto según la intensidad usando un switch
                                        $color = '';
                                        $texto = '';
                                        switch ($row['intensidad']) {
                                            case 'Interesado':
                                                $color = 'green';
                                                $texto = 'Interesado';
                                                break;
                                            case 'Muy interesado':
                                                $color = 'darkgreen';
                                                $texto = 'Muy interesado';
                                                break;
                                            case 'Poco interesado':
                                                $color = 'orange';
                                                $texto = 'Poco interesado';
                                                break;
                                            case 'No contesta':
                                                $color = 'gray';
                                                $texto = 'No contesta';
                                                break;
                                            case 'Mal momento':
                                                $color = 'red';
                                                $texto = 'Mal momento';
                                                break;
                                            case 'En espera':
                                                $color = 'yellow';
                                                $texto = 'En espera';
                                                break;
                                            default:
                                                $color = 'blue'; // Color predeterminado
                                                $texto = 'Desconocido';
                                                break;
                                        }
                                        ?>

                                        <!-- Aquí mostramos el círculo de color y el texto correspondiente -->
                                        <div style="display: flex; align-items: center;">
                                            <div style="background-color: <?php echo $color; ?>; height:25px; width:25px; border-radius: 50%; margin-right: 10px;"></div>
                                            <span><?php echo $texto; ?></span>
                                        </div>

                                  </div>
                                  <div class="col-md-2">
                                      <a href="editar-contacto.php?id_contacto=<?php echo $row['id_contacto']?>" style="color: black;"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
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
                  <h5 class="card-title mb-9 fw-semibold">Ganado &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-play" aria-hidden="true"></i></h5>

                  <?php
                  // Realiza una consulta SQL para obtener los registros con estado "Ganado"
                  $sql = "SELECT * FROM contactos WHERE estado = 'Ganado'";
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
                                      ?>


                                      <?php
                                        // Definimos el color y el texto según la intensidad usando un switch
                                        $color = '';
                                        $texto = '';
                                        switch ($row['intensidad']) {
                                            case 'Interesado':
                                                $color = 'green';
                                                $texto = 'Interesado';
                                                break;
                                            case 'Muy interesado':
                                                $color = 'darkgreen';
                                                $texto = 'Muy interesado';
                                                break;
                                            case 'Poco interesado':
                                                $color = 'orange';
                                                $texto = 'Poco interesado';
                                                break;
                                            case 'No contesta':
                                                $color = 'gray';
                                                $texto = 'No contesta';
                                                break;
                                            case 'Mal momento':
                                                $color = 'red';
                                                $texto = 'Mal momento';
                                                break;
                                            case 'En espera':
                                                $color = 'yellow';
                                                $texto = 'En espera';
                                                break;
                                            default:
                                                $color = 'blue'; // Color predeterminado
                                                $texto = 'Desconocido';
                                                break;
                                        }
                                        ?>

                                        <!-- Aquí mostramos el círculo de color y el texto correspondiente -->
                                        <div style="display: flex; align-items: center;">
                                            <div style="background-color: <?php echo $color; ?>; height:25px; width:25px; border-radius: 50%; margin-right: 10px;"></div>
                                            <span><?php echo $texto; ?></span>
                                        </div>

                                  </div>
                                  <div class="col-md-2">
                                      <a href="editar-contacto.php?id_contacto=<?php echo $row['id_contacto']?>" style="color: black;"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
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





<?php
require "footer.php";
?>