<?php 
define("ruta", 'RP');
include 'php/acceso.php'; 
include 'php/DatosEmpleado.php';
include 'php/ValPass.php';
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>✅ Roles y perfiles</title>
    <!-- CSS files --> 
    <link href="css/tabler.min.css" rel="stylesheet"/>
    <link href="css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="css/demo.min.css" rel="stylesheet"/>
    <link href="css/template.css" rel="stylesheet"/>
    <link rel="shortcut icon" href="https://cun.edu.co/wp-content/uploads/cropped-Icono-para-pa%CC%81gina-32x32.jpg" type="image/x-icon"> <!-- favicon -->
  </head>
  <body class="antialiased">
    <div class="wrapper">
    <?php include 'templates/header.php' ?>


    <br>
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Parametrizacion de roles y perfiles</h3>
                </div>
                
                <div class="row">
                 <div class="col-md-6">
                    <div class="card-body">
                        <div class="form-group">
                          <label class="form-label">Nombre del perfil o rol:</label>
                          <div >
                            <input type="text" class="form-control" autocomplete="off" id="nom_rol">
                            <small class="form-hint"></small>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Estado:</label>
                          <div >
                            <select class="form-select" id="est_rol">
                              <option value="1">Activo</option>
                              <option value="0">Inactivo</option>
                            </select>
                          </div>
                        </div>
                        <br>
                        <button type="button" class="btn btn-success" onclick="CrearRol();">Crear Rol</button>
                        <br><br>
                        <label class="form-label">Asignar Roles y perfiles</label>
                        <button type="submit" class="btn btn-dark" onclick="AsignarRoles();">Asignar roles</button>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card-body">
                        <div class="form-group">
                          <label class="form-label">Accesos</label>
                          <div>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="MF">
                              <span class="form-check-label">Metodos de Financiacion</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="PPF">
                              <span class="form-check-label">Parametros periodo (Financiacion)</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="RP">
                              <span class="form-check-label">Roles y Perfiles</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="LC">
                              <span class="form-check-label">Legalizados Credyty</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="CN">
                              <span class="form-check-label">Archivo de nomina</span>
                            </label>
                             <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="FF">
                              <span class="form-check-label">Formulario Financiacion</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="RF">
                              <span class="form-check-label">Ajuste de recibos</span>
                            </label>
                            <ul>
                              <li>
                                <label class="form-check">
                                  <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="AO">
                                  <span class="form-check-label">Recibo full</span>
                                </label>
                              </li>
                              <li>
                                <label class="form-check">
                                  <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="AJO">
                                  <span class="form-check-label">Ajustar orden</span>
                                </label>
                              </li>
                              <li>
                                <label class="form-check">
                                  <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="AVO">
                                  <span class="form-check-label">Editar valores de la orden</span>
                                </label>
                              </li>
                              <li>
                                <label class="form-check">
                                  <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="ACO">
                                  <span class="form-check-label">Activar orden</span>
                                </label>
                              </li>
                              <li>
                                <label class="form-check">
                                  <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="QCO">
                                  <span class="form-check-label">Quitar orden</span>
                                </label>
                              </li>
                              <li>
                                <label class="form-check">
                                  <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="CV">
                                  <span class="form-check-label">Cun Vive</span>
                                </label>
                              </li>
                              <li>
                                <label class="form-check">
                                  <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="HZ">
                                  <span class="form-check-label">Horario Zoho</span>
                                </label>
                              </li>
                              <li>
                                <label class="form-check">
                                  <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="CZ">
                                  <span class="form-check-label">Correo Zoho</span>
                                </label>
                              </li>
                            </ul>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="RPVIVSFAMA">
                              <span class="form-check-label">RPVI Vs FAMA</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="PARM">
                              <span class="form-check-label">Parametrizar Metas</span>
                            </label>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card-body">
                        <div class="form-group">
                          <label class="form-label"></label>
                          <div>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="CM">
                              <span class="form-check-label">Cargue de Metas</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="FE">
                              <span class="form-check-label">Facturacion electronica</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="PD">
                              <span class="form-check-label">Parametrización Diplomados</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="AIL">
                              <span class="form-check-label">Actualizaciones ingreso laboral</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="CIL">
                              <span class="form-check-label">Consulta ingreso laboral</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="AFC">
                              <span class="form-check-label">Ajuste Fechas de cartera</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" value="GC" name="checks[]">
                              <span class="form-check-label">Gestores Comerciales</span>
                            </label>
                            <ul>
                              <li>
                                <label class="form-check">
                                  <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="AGC">
                                  <span class="form-check-label">Activar Gestores Comerciales</span>
                                </label>
                              </li>
                            </ul>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="VCE">
                              <span class="form-check-label">Verificación de certificados</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol" type="checkbox" name="checks[]" value="USC">
                              <span class="form-check-label">Usabilidad Correo</span>
                            </label>
                            <label class="form-check">
                              <input class="form-check-input acceso_rol_updt" type="checkbox" value="AP" name="checks[]" >
                              <span class="form-check-label">Aplicación Pagos</span>
                            </label>
                            <ul>
                              <li>
                                <label class="form-check">
                                  <input class="form-check-input acceso_rol_updt" type="checkbox" value="GAP" name="checks[]" >
                                  <span class="form-check-label">Gestión</span>
                                </label>
                              </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card-body">
                        <div class="form-group">
                          
                        </div>
                    </div>
                  </div>


                </div>
                <div class="card-body">
                    
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="container">
     <div class="col-12">
        <hr style="border:1px solid #000;">
    </div>

    <div class="col-12">
        <div class="card">
        <br>
        <center><h3>Roles creados</h3></center>
        <br>
        <div id="table_roles"></div>
        </div>
      </div>

      <div class="modal modal-blur fade" id="modal-AsigPerfil" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Asignacion de perfiles a usuarios</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                  <input type="text" class="form-control" placeholder="Buscador..." id="searchTerm" onkeyup="doSearch();" autocomplete="off">
                </div>
                <div class="col-lg-2">
                  <input type="button" class="btn btn-info" value="Asignacion Masiva" onclick="AsignacionMasiva();">
                </div>
                <div class="col-lg-4">
                  <select class="form-select" id="src_perfil" onchange="dataPerfil()" class="form-control">
                    <option value="">Perfil...</option>
                  </select>
                </div>
            </div>
            
            <br>
            <h3>Escoge el usuario:</h3>
            <div id="table_usuarios">
              <h2>Cargando datos, espera un momento...</h2>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>


     <div class="modal modal-blur fade" id="modal-AsigPerfilEmpleado" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Asignar Perfil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id_user">
            <h3>Escoge el perfil</h3>
            <div id="select_perfiles"></div>
            <br>
            <input type="button" class="btn btn-primary" value="Actualizar Perfil" onclick="UpdPerfilEmp();">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal modal-blur fade" id="modal-EditarPerfil" tabindex="-1" role="dialog" aria-hidden="true" data-target="#staticBackdrop">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Perfil:  (<span id="span_nom_perfil"></span>)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id_perfil_upd">
            <label>Nombre del perfil:</label>
            <input type="text" class="form-control" id="nom_perfil_updt">
            <br>
            <label>Estado:</label>
            <select class="form-select" id="est_rol_updt">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
            <hr style="border:1px solid #000;">
            <div class="form-group">
                <label class="form-label">Accesos</label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="MF" id="MF_updt" name="checks_upd[]">
                    <span class="form-check-label">Metodos de Financiacion</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="PPF" id="PPF_updt" name="checks_upd[]">
                    <span class="form-check-label">Parametros periodo (Financiacion)</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="RP" id="RP_updt" name="checks_upd[]">
                    <span class="form-check-label">Roles y Perfiles</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="LC" id="LC_updt" name="checks_upd[]">
                    <span class="form-check-label">Legalizados credyty</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="CN" id="CN_updt" name="checks_upd[]">
                    <span class="form-check-label">Archivo de nomina</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="FF" id="FF_updt" name="checks_upd[]">
                    <span class="form-check-label">Formulario Financiación</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="RF" id="RF_updt" name="checks_upd[]">
                    <span class="form-check-label">Ajuste de recibos</span>
                  </label>
                  <ul>
                    <li>
                      <label class="form-check">
                        <input class="form-check-input acceso_rol_updt" type="checkbox" value="AO" id="AO_updt" name="checks_upd[]" >
                        <span class="form-check-label">Recibo full</span>
                      </label>
                    </li>
                    <li>
                      <label class="form-check">
                        <input class="form-check-input acceso_rol_updt" type="checkbox" value="AJO" id="AJO_updt" name="checks_upd[]" >
                        <span class="form-check-label">Ajustar orden</span>
                      </label>
                    </li>
                    <li>
                      <label class="form-check">
                        <input class="form-check-input acceso_rol_updt" type="checkbox" value="AVO" id="AVO_updt" name="checks_upd[]" >
                        <span class="form-check-label">Editar valores de la orden</span>
                      </label>
                    </li>
                    <li>
                      <label class="form-check">
                        <input class="form-check-input acceso_rol_updt" type="checkbox" value="ACO" id="ACO_updt" name="checks_upd[]" >
                        <span class="form-check-label">Activar orden</span>
                      </label>
                    </li>
                    <li>
                      <label class="form-check">
                        <input class="form-check-input acceso_rol_updt" type="checkbox" value="QCO" id="QCO_updt" name="checks_upd[]" >
                        <span class="form-check-label">Quitar orden</span>
                      </label>
                    </li>
                    <li>
                      <label class="form-check">
                        <input class="form-check-input acceso_rol_updt" type="checkbox" value="CV" id="CV_updt" name="checks_upd[]" >
                        <span class="form-check-label">Cun Vive</span>
                      </label>
                    </li>
                    <li>
                      <label class="form-check">
                        <input class="form-check-input acceso_rol_updt" type="checkbox" value="HZ" id="HZ_updt" name="checks_upd[]" >
                        <span class="form-check-label">Horario Zoho</span>
                      </label>
                    </li>
                    <li>
                      <label class="form-check">
                        <input class="form-check-input acceso_rol_updt" type="checkbox" value="CZ" id="CZ_updt" name="checks_upd[]" >
                        <span class="form-check-label">Correo Zoho</span>
                      </label>
                    </li>
                  </ul>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="RPVIVSFAMA" id="RPVIVSFAMA_updt" name="checks_upd[]">
                    <span class="form-check-label">RPVI VS FAMA</span>
                  </label>
                   <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="PARM" id="PARM_updt" name="checks_upd[]">
                    <span class="form-check-label">Parametrizar Metas</span>
                  </label>
                   <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="CM" id="CM_updt" name="checks_upd[]">
                    <span class="form-check-label">Cargue de Metas</span>
                  </label>
                   <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="FE" id="FE_updt" name="checks_upd[]">
                    <span class="form-check-label">Facturacion electronica</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="PD" id="PD_updt" name="checks_upd[]">
                    <span class="form-check-label">Parametrización Diplomados</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="AIL" id="AIL_updt" name="checks_upd[]">
                    <span class="form-check-label">Actualizaciones ingreso laboral</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="CIL" id="CIL_updt" name="checks_upd[]">
                    <span class="form-check-label">Consulta ingreso laboral</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="AFC" id="AFC_updt" name="checks_upd[]">
                    <span class="form-check-label">Ajuste fechas de cartera</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="GC" id="GC_updt" name="checks_upd[]">
                    <span class="form-check-label">Gestores Comerciales</span>
                  </label>
                  <ul>
                    <li>
                      <label class="form-check">
                        <input class="form-check-input acceso_rol_updt" type="checkbox" value="AGC" id="AGC_updt" name="checks_upd[]">
                        <span class="form-check-label">Activar Gestores comerciales</span>
                      </label>
                    </li>
                  </ul>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="VCE" id="VCE_updt" name="checks_upd[]" >
                    <span class="form-check-label">Verificación de certificados</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="USC" id="USC_updt" name="checks_upd[]" >
                    <span class="form-check-label">Usabilidad Correo</span>
                  </label>
                  <label class="form-check">
                    <input class="form-check-input acceso_rol_updt" type="checkbox" value="AP" id="AP_updt" name="checks_upd[]" >
                    <span class="form-check-label">Aplicación Pagos</span>
                  </label>
                  <ul>
                    <li>
                      <label class="form-check">
                        <input class="form-check-input acceso_rol_updt" type="checkbox" value="GAP" id="GAP_updt" name="checks_upd[]" >
                        <span class="form-check-label">Gestión</span>
                      </label>
                    </li>
                  </ul>
            </div>
            <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload()">Cerrar</button>
            <input type="button" class="btn btn-success" value="Actualizar Perfil" onclick="UpdatePerfil();">
          </div>
        </div>
      </div>
    </div>

    <div class="modal modal-blur fade" id="modal-AsigPerfilEmpleadoMasivo" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Asignar Perfil Masivo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="empleados_ids">
            <h3>Escoge el perfil</h3>
            <div id="select_perfiles_ms"></div>
            <br>
            <input type="button" class="btn btn-primary" value="Asignar Perfil" onclick="AsignacionMasivaPerfil();">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>




    </div>
    
    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/tabler-min.js"></script>
    <script src="js/Roles.js?v=<?php echo(rand()); ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>