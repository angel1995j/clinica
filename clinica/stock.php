<?php
require "header.php";
require "global.php";
$link = bases();
?>


      <!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">
      <div class="row mt-5">

        <div class="col-6">
          
        </div>

        <div class="col-6" style="text-align: right;">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="ti ti-input-search fs-6"></i></span>
              <input type="text" class="form-control" placeholder="Buscar producto...">
            </div>
          </div>

        </div>



        <div class="col-12 mt-5">
          <div class="card mb-4 px-3">
            <div class="card-header pb-0">
              <h6>Productos</h6>
            </div>



          <nav>
          <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Medicamentos</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Tiendita</button>

            <button class="nav-link" id="nav-alimentos-tab" data-bs-toggle="tab" data-bs-target="#nav-alimentos" type="button" role="tab" aria-controls="nav-alimentos" aria-selected="false">Alimentos</button>

          </div>
          </nav>

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <div class="row mt-5">

                 <div class="col-12 mb-4" style="text-align: right;">
                  <a href="punto-venta.html" class="btn btn-primary">Añadir consumo</a>
                  <a href="" class="btn btn-primary" style="margin-left: 2%;">Añadir nuevo producto</a>

                  <a href="consumos.html" class="btn btn-primary" style="margin-left: 2%;">Ver movimientos</a>

                </div>
                

               

                    
                    <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                   <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>



                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>

                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>



                    <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                  <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/aspirina.jpeg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Aspirina</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>
                    
                  </div>
              </div>
            </div>
            <!-- CIERRA CONTENIDO DE TABLA -->
          </div>




          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            
            <!--- INICIA CONTENIDO DE TABLA -->
              
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <div class="row mt-5">

                 <div class="col-12 mb-4" style="text-align: right;">
                  <a href="punto-venta.html" class="btn btn-primary">Añadir consumo</a>
                  <a href="" class="btn btn-primary" style="margin-left: 2%;">Añadir nuevo producto</a>
                  <a href="consumos.html" class="btn btn-primary" style="margin-left: 2%;">Ver movimientos</a>
                </div>
                    
                    <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>



                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>



                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/coca.png" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>
                    
                  </div>
              </div>
            </div>
            <!-- CIERRA CONTENIDO DE TABLA -->


          </div>









           <div class="tab-pane fade" id="nav-alimentos" role="tabpanel" aria-labelledby="nav-alimentos-tab">
            
            <!--- INICIA CONTENIDO DE TABLA -->
              
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <div class="row mt-5">

                 <div class="col-12 mb-4" style="text-align: right;">
                  <a href="punto-venta.html" class="btn btn-primary">Añadir consumo</a>
                  <a href="" class="btn btn-primary" style="margin-left: 2%;">Añadir nuevo producto</a>
                  <a href="consumos.html" class="btn btn-primary" style="margin-left: 2%;">Ver movimientos</a>
                </div>
                    
                    <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>



                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>



                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Jitomate</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="col-3">
                      <div class="card">
                       <img src="assets/images/products/jitomate.jpg" class="imagen-producto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Coca cola lata</h5>
                          <p class="card-text"><b>Precio compra: $15.00</b></p>
                          <p class="text-stock">Stock: 25</p>
                          <div class="d-flex">
                          <a href="#" class="btn btn-outline-secondary m-1">Editar</a>
                           <a href="#" class="btn btn-outline-danger m-1">Eliminar</a>
                          </div>
                        </div>
                      </div>
                     </div>
                    
                  </div>
              </div>
            </div>
            <!-- CIERRA CONTENIDO DE TABLA -->


          </div>








          
        </div>







          </div>
        </div>

<?php
require "footer.php";
?>