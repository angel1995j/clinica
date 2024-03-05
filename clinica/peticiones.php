<?php
require "header.php";
require "global.php";
$link = bases();
?>


      <!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">
        

        



          <div class="card mb-4 px-3 mt-5">
            
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="perfil.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
             Volver a paciente</a>


             <div class="col-12 mb-4" style="text-align: right;">
              <a href="" class="btn btn-primary">Nueva solicitud</a>
           </div>
              

            <div class="container">
            <h2 class="mt-5 text-center"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
            Paciente: Juan Lopez</h2>

            
            <nav>
          <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Activas</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Solicitudes resueltas</button>
          </div>
          </nav>


          <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7">TIPO DE PETICION</th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Nota petición</th>
                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Fecha </th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Accciones</th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                            <h6 class="mb-0 text-sm">Ropa</h6>
                        </div>
                      </td>
                      
                      <td class="align-middle text-center text-sm">
                       <span class="text-xs font-weight-bold">Usuario refiere necesitar sudaderas</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold">10/25/2023</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                       <span class="text-secondary text-xs font-weight-bold"><a href="perfil.html">Resolver</a></span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><a href="perfil.html">Archivar</a></span>
                      </td>
                      

                    </tr>




                     <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                            <h6 class="mb-0 text-sm">Calzado</h6>
                        </div>
                      </td>
                      
                      <td class="align-middle text-center text-sm">
                       <span class="text-xs font-weight-bold">Usuario refiere necesitar calzado</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold">10/35/2023</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                       <span class="text-secondary text-xs font-weight-bold"><a href="perfil.html">Resolver</a></span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><a href="perfil.html">Archivar</a></span>
                      </td>
                      

                    </tr>


                  


                  </tbody>
                </table>
              </div>
            </div>
            <!-- CIERRA CONTENIDO DE TABLA -->
          </div>




          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            
            <!--- INICIA CONTENIDO DE TABLA -->
              
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Paciente</th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Fecha Ingreso</th>
                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Fecha Salida</th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Accciones</th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <i class="fa fa-user me-3"></i>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Juan Lopez</h6>
                            <p class="text-xs mb-0">4433627874</p>
                          </div>
                        </div>
                      </td>
                      
                      <td class="align-middle text-center text-sm">
                       <span class="text-xs font-weight-bold">11/10/2023</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold">11/10/2023</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                       <span class="text-secondary text-xs font-weight-bold">Ver Contrato</span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><a href="perfil.html">Ver perfil</a></span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Archivar
                        </a>
                      </td>
                    </tr>


                  <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <i class="fa fa-user me-3"></i>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Juan Lopez</h6>
                            <p class="text-xs mb-0">4433627874</p>
                          </div>
                        </div>
                      </td>
                      
                      <td class="align-middle text-center text-sm">
                       <span class="text-xs font-weight-bold">11/10/2023</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold">11/10/2023</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                       <span class="text-secondary text-xs font-weight-bold">Ver Contrato</span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><a href="perfil.html">Ver perfil</a></span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Archivar
                        </a>
                      </td>
                    </tr>




                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <i class="fa fa-user me-3"></i>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Juan Lopez</h6>
                            <p class="text-xs mb-0">4433627874</p>
                          </div>
                        </div>
                      </td>
                      
                      <td class="align-middle text-center text-sm">
                       <span class="text-xs font-weight-bold">11/10/2023</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold">11/10/2023</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                       <span class="text-secondary text-xs font-weight-bold">Ver Contrato</span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><a href="perfil.html">Ver perfil</a></span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Archivar
                        </a>
                      </td>
                    </tr>



                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <i class="fa fa-user me-3"></i>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Juan Lopez</h6>
                            <p class="text-xs mb-0">4433627874</p>
                          </div>
                        </div>
                      </td>
                      
                      <td class="align-middle text-center text-sm">
                       <span class="text-xs font-weight-bold">11/10/2023</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold">11/10/2023</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                       <span class="text-secondary text-xs font-weight-bold">Ver Contrato</span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><a href="perfil.html">Ver perfil</a></span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Archivar
                        </a>
                      </td>
                    </tr>



                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <i class="fa fa-user me-3"></i>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Juan Lopez</h6>
                            <p class="text-xs mb-0">4433627874</p>
                          </div>
                        </div>
                      </td>
                      
                      <td class="align-middle text-center text-sm">
                       <span class="text-xs font-weight-bold">11/10/2023</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold">11/10/2023</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                       <span class="text-secondary text-xs font-weight-bold">Ver Contrato</span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><a href="perfil.html">Ver perfil</a></span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Archivar
                        </a>
                      </td>
                    </tr>


                  </tbody>
                </table>
              </div>
            </div>
            <!-- CIERRA CONTENIDO DE TABLA -->


          </div>
          
        </div>




          


            
              

            </div>




            </div>          
          
 







          </div>
       
<?php
require "footer.php";
?>