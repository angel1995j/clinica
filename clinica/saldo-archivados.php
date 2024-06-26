<?php
require "header.php";

// Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Conecta a la base de datos y obtén los datos del paciente
require('global.php');
$link = bases();
$sql = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";
$resultado = $link->query($sql);
$paciente = $resultado->fetch_assoc();
?>


      <!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">

      

      <div class="row mt-5">

        <a href="perfil.php?id_paciente=<?php echo $id_paciente;?>" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
             Volver a perfil del paciente</a>

        <div class="col-12 mb-4 mt-4" style="text-align:right;">


          <a class="btn boton-secundario" href="saldo.php?id_paciente=<?php echo $id_paciente;?>">
            Ver activos
          </a>


          


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir saldo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="inserts/saldo.php" method="post" enctype="multipart/form-data">
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
                    <label for="observaciones">Observaciones:</label>
                    <input type="text" class="form-control" name="observaciones" id="observaciones" value="">
                  </div>

                  <div class="form-group mt-3">
                    <label for="forma_pago">Forma de pago:</label>
                    <select class="form-control" id="forma_pago" name="forma_pago">
                      <option value="Efectivo">Efectivo</option>
                      <option value="Tarjeta">Tarjeta</option>
                      <option value="Transferencia">Transferencía Cuenta Dante</option>
                      <option value="Transferencía Cuenta Lenin">Transferencía Cuenta Lenin</option>
                      <option value="Déposito Cuenta Dante">Déposito Cuenta Dante</option>
                      <option value="Déposito Cuenta Lenin">Déposito Cuenta Lenin</option>
                      <option value="Envio de efectivo">Envío de efectivo</option>
                    </select>
                  </div>

                  <input type="hidden" name="archivado" value="no">
                  <input type="hidden" name="estatus" value="No aplicado">
                  <input type="hidden" name="id_paciente" value="<?php echo $_GET['id_paciente']; ?>">
                  <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">

                  <button type="submit" class="btn btn-primary mt-3">Guardar Pago</button>
                  <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Cerrar</button>
                </form>
              </div>
            </div>
          </div>
        </div>



        </div>





         <div class="row">

                <div class="col-4 d-flex">
                    <label for="num_registros" class="col-form-label">Mostrar: </label>
                
                    <select name="num_registros" id="num_registros" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
              
                    <label for="num_registros" class="col-form-label">registros </label>
                </div>

              <div class="col-4"></div>

                <div class="col-4 d-flex">
                    <label for="campo" class="col-form-label">Buscar:&nbsp;&nbsp;</label>
               
                    <input type="text" name="campo" id="campo" class="form-control">
                </div>
            </div>

        


        <div class="col-12">
          <div class="card mb-4 px-3 mt-5">
            <div class="card-header pb-0">
              <h6>Saldo individual del Paciente:  <?php echo $paciente['nombre']. " " . $paciente['aPaterno'];?></h6>
            </div>



         

            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-2 mt-3">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Concepto</th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2 text-center">Fecha de Vencimiento</th>

                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2 text-center">Monto</th>


                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Accciones</th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                     

                     <tbody id="content">

                   </tbody>


                </table>
              </div>

              <div class="row">
                <div class="col-6 text-left">
                    <label id="lbl-total"></label>
                </div>

                <div class="col-6" id="nav-paginacion"></div>

                <input type="hidden" id="pagina" value="1">
                <input type="hidden" id="orderCol" value="0">
                <input type="hidden" id="orderType" value="asc">
               </div>


            </div>
            <!-- CIERRA CONTENIDO DE TABLA -->
          </div>







        </div>

<script>
    // Llamando a la función getData()
    getData();

    // Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData.
    document.getElementById("campo").addEventListener("keyup", getData, false);
    document.getElementById("num_registros").addEventListener("change", getData, false);

    // Peticion AJAX
    function getData() {
        let input = document.getElementById("campo").value;
        let num_registros = document.getElementById("num_registros").value;
        let content = document.getElementById("content");
        let pagina = document.getElementById("pagina").value;
        let orderCol = document.getElementById("orderCol").value;
        let orderType = document.getElementById("orderType").value;

        // Agrega el id_paciente a la FormData
        let urlParams = new URLSearchParams(window.location.search);
        let id_paciente = urlParams.get('id_paciente');
        
        let formData = new FormData();
        formData.append('campo', input);
        formData.append('registros', num_registros);
        formData.append('pagina', pagina);
        formData.append('orderCol', orderCol);
        formData.append('orderType', orderType);
        formData.append('id_paciente', id_paciente); // Agrega el id_paciente aquí

        fetch("loads/saldo-archivados.php", { 
            method: "POST", // Cambiado a POST ya que estás enviando datos en el cuerpo
            body: formData
        }).then(response => response.json())
        .then(data => {
            content.innerHTML = data.data;
            document.getElementById("lbl-total").innerHTML = 'Mostrando ' + data.totalFiltro +
                ' de ' + data.totalRegistros + ' registros';
            document.getElementById("nav-paginacion").innerHTML = data.paginacion;
        }).catch(err => console.error("Error en la solicitud AJAX:", err));
    }

    function nextPage(pagina) {
        document.getElementById('pagina').value = pagina;
        getData();
    }

    let columns = document.getElementsByClassName("sort");
    let tamanio = columns.length;
    for (let i = 0; i < tamanio; i++) {
        columns[i].addEventListener("click", ordenar);
    }

    function ordenar(e) {
        let elemento = e.target;

        document.getElementById('orderCol').value = elemento.cellIndex;

        if (elemento.classList.contains("asc")) {
            document.getElementById("orderType").value = "asc";
            elemento.classList.remove("asc");
            elemento.classList.add("desc");
        } else {
            document.getElementById("orderType").value = "desc";
            elemento.classList.remove("desc");
            elemento.classList.add("asc");
        }

        getData();
    }
</script>
    

<?php
require "footer.php";
?>