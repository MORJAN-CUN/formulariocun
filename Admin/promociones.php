 <?php 
define("ruta", 'MF');
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
    <title>✅ Financiación</title>
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
    <style>
        .errorva{
         border:1px solid red;
         }
         .sig{
          border: 2px solid #598E55;
         }
         .card_op:hover{
          border: 1px solid #000;
          cursor: pointer;
         }

         #WindowLoad{
            position:fixed;
            top:0px;
            left:0px;
            z-index:3200;
            filter:alpha(opacity=65);
           -moz-opacity:65;
            opacity:0.75;
            background:#999;
        }
        .pintarTd{
          background: #A1D39D !important;
        }
    </style>

    <br>
    <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <center><label style="font-size:20px;">¿Que deseas realizar?</label></center>
            <br>
          </div>
          <div class="col-lg-6">
              <div class="card card_op" onclick="OpcionEs(1);">
                <center>
                  <br>
                  <img src="img/editar.png" class="card-img-top" style="width: 90px;">
                </center>
                <div class="card-body">
                  <h5 class="card-title">Crear financiación manual</h5>
                  <p class="card-text">Podras crear tu financiacion manual segun tu necesidad</p>
                  <input type="button" class="btn btn-success form-control" value="Entrar">
                </div>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="card card_op" onclick="OpcionEs(2);">
                <center>
                  <br>
                  <img src="img/multiple.png" class="card-img-top" style="width: 90px;">
                </center>
                <div class="card-body">
                  <h5 class="card-title">Crear financiación masiva</h5>
                  <p class="card-text">Podras crear tu financiacion escogiendo una anterior</p>
                  <input type="button" class="btn btn-success form-control" value="Entrar">
                </div>
              </div>
          </div>
          <div class="col-lg-12">
            <hr style="border: 1px solid #000;">
          </div>
        </div>

        <div id="div_masivo" style="display: none;">
          <center><h2>Financiación masiva</h2></center>
          <br>
          <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                    <label>Selecciona el periodo del cual quieres duplicar los datos:</label>
                    <select class="form-select mb-2" id="periodomasivo">
                      <option disabled selected>Selecciona una opción</option>
                    </select>
                </div>
                <div class="col-4">
                  <br>
                  <input type="button" value="Ver datos" class="btn btn-info" onclick="verPeriodoMs();">
                </div>
              </div>
                

            </div>
          </div>


          <!-- Modal Gestion masiva-->
          <div class="modal fade" id="Modal_Masivo_F" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Financiacion Masiva</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <label style="color:red;font-size: 12px;">Se migraran los datos que esten marcados con el check</label>
                  <br><br>
                  <input type="hidden" id="tipo_masivo_gest">
                   <label>Buscador:</label>
                  <input type="text" class="form-control" placeholder="Buscador..." style="border: 1px solid #000;" id="searchTerm3" onkeyup="doSearch(3);" autocomplete="off">     
                  <br>
                  <div id="scroll" style="overflow-y: scroll;height: 500px;">
                    <div id="div_table_periodos"></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-success" onclick="MigrarDatos();">Migrar datos</button>
                </div>
              </div>
            </div>
          </div>

           <!-- Modal destino-->
          <div class="modal fade" id="Modal_Masivo_Destino" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-sm modal-dialog-centered">
              <div class="modal-content"  style="border:2px solid #000;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Financiacion Masiva</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="registros_mg">
                    <label>Escoge el periodo de destino de la migracion de datos</label>
                    <select class="form-select mb-2" id="periodomasivodest">
                      <option disabled selected>Selecciona una opción</option>
                    </select>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-success" onclick="MigrarDatosPNew();">Migrar datos al periodo</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal destino-->
          <div class="modal fade" id="Modal_result_ms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Resultado gestion financiacion masiva</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <label>Buscador:</label>
                  <input type="text" class="form-control" placeholder="Buscador..." style="border: 1px solid #000;" id="searchTerm2" onkeyup="doSearch(2);" autocomplete="off">                  
                  <div id="scroll" style="overflow-y: scroll;height: 500px;">
                    <div id="table_result_ms"></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="Modal_edit_td_unoxuno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-sm modal-dialog-centered">
              <div class="modal-content"  style="border:2px solid #000;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edición financiación</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 <input type="hidden" id="id_span_edit">
                 <input type="hidden" id="tipo_edit_unoxuno">
                 <label style="font-weight: bold;">Se actualizara el registro seleccionado</label>

                 <div id="div_tipofinanciacion_unoxuno" style="display:none;">
                  <br>
                  <label>Selecciona el tipo de financiacion:</label>
                  <select class="form-select mb-2" id="tipofinanciacion_edit_unoxuno" style="border:1px solid #000;">
                    <option disabled selected>Selecciona una opción</option>
                  </select>
                </div>

                <div id="div_periodoidiomas_unoxuno" style="display:none;">
                  <br>
                  <label>Selecciona el periodo de idiomas:</label>
                  <select class="form-select mb-2" id="periodoIdiomas_edit_unoxuno" style="border:1px solid #000;">
                    <option disabled selected>Selecciona una opción</option>
                  </select>
                </div>

                <div id="div_programacademico_unoxuno" style="display:none;">
                  <br>
                  <label>Selecciona el programa academico:</label>
                  <select class="form-select mb-2" id="programa_edit_unoxuno" style="border:1px solid #000;">
                    <option disabled selected>Selecciona una opción</option>
                  </select>  
                </div>

                <div id="div_ciclo_unoxuno" style="display:none;">
                  <br>
                  <label>Selecciona el ciclo:</label>
                  <select class="form-select mb-2" id="ciclo_edit_unoxuno" style="border:1px solid #000;">
                    <option disabled selected>Selecciona una opción</option>
                  </select>
                </div>

                <div id="div_tipoinscripcion_unoxuno" style="display:none;">
                  <br>
                  <label>Selecciona el tipo de inscripcion:</label>
                  <select class="form-select mb-2" id="tipoinscripcion_edit_unoxuno" style="border:1px solid #000;">
                    <option disabled selected>Selecciona una opción</option>
                  </select>
                </div>

                <div id="div_valormatricula_unoxuno" style="display:none;">
                  <br>
                  <label>Escribe el valor de la matricula:</label>
                  <input type="number" class="form-control" id="valormatricula_edit_unoxuno" style="border:1px solid #000;">
                </div>

                <div id="div_valoridiomas_unoxuno" style="display:none;">
                  <br>
                  <label>Escribe el valor de idiomas:</label>
                  <input type="text" class="form-control" id="valoridiomas_edit_unoxno" style="border:1px solid #000;">
                </div>

                <div id="div_valorservicio_unoxuno" style="display:none;">
                  <br>
                  <label>Escribe el valor de servicio:</label>
                  <input type="text" class="form-control" id="valorservicio_edit_unoxuno" style="border:1px solid #000;">
                </div>

                <div id="div_cuotas_unoxuno" style="display:none;">
                  <br>
                  <label>Escribe las cuotas:</label>
                  <input type="text" class="form-control" id="cuotas_edit_unoxuno" style="border:1px solid #000;">
                </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-success" onclick="ActualizarTableTemporalUnoxUno();">Actualizar dato</button>
                </div>
              </div>
            </div>
          </div>


          <div class="modal fade" id="Modal_edit_td_masivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-sm modal-dialog-centered">
              <div class="modal-content"  style="border:2px solid #000;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edición financiación masiva</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" id="tipo_entrada_edit">
                    <label>Se actualizaran todos los datos marcados en la columna <b id="nom_colum_edit"></b></label>
                    <br>
                    <div id="div_tipofinanciacion" style="display:none;">
                      <br>
                      <label>Selecciona el tipo de financiacion:</label>
                      <select class="form-select mb-2" id="tipofinanciacion_edit_ms" style="border:1px solid #000;">
                        <option disabled selected>Selecciona una opción</option>
                      </select>
                    </div>

                    <div id="div_periodoidiomas" style="display:none;">
                      <br>
                      <label>Selecciona el periodo de idiomas:</label>
                      <select class="form-select mb-2" id="periodoIdiomas_edit_ms" style="border:1px solid #000;">
                        <option disabled selected>Selecciona una opción</option>
                      </select>
                    </div>

                    <div id="div_programacademico" style="display:none;">
                      <br>
                      <label>Selecciona el programa academico:</label>
                      <select class="form-select mb-2" id="programa_edit_ms" style="border:1px solid #000;">
                        <option disabled selected>Selecciona una opción</option>
                      </select>  
                    </div>

                    <div id="div_ciclo" style="display:none;">
                      <br>
                      <label>Selecciona el ciclo:</label>
                      <select class="form-select mb-2" id="ciclo_edit_ms" style="border:1px solid #000;">
                        <option disabled selected>Selecciona una opción</option>
                      </select>
                    </div>

                    <div id="div_tipoinscripcion" style="display:none;">
                      <br>
                      <label>Selecciona el tipo de inscripcion:</label>
                      <select class="form-select mb-2" id="tipoinscripcion_edit_ms" style="border:1px solid #000;">
                        <option disabled selected>Selecciona una opción</option>
                      </select>
                    </div>

                    <div id="div_valormatricula" style="display:none;">
                      <br>
                      <label>Escribe el valor de la matricula:</label>
                      <input type="text" class="form-control" id="valormatricula_edit_ms" style="border:1px solid #000;">
                    </div>

                    <div id="div_valoridiomas" style="display:none;">
                      <br>
                      <label>Escribe el valor de idiomas:</label>
                      <input type="text" class="form-control" id="valoridiomas_edit_ms" style="border:1px solid #000;">
                    </div>

                    <div id="div_valorservicio" style="display:none;">
                      <br>
                      <label>Escribe el valor de servicio:</label>
                      <input type="text" class="form-control" id="valorservicio_edit_ms" style="border:1px solid #000;">
                    </div>

                    <div id="div_cuotas" style="display:none;">
                      <br>
                      <label>Escribe las cuotas:</label>
                      <input type="text" class="form-control" id="cuotas_edit_ms" style="border:1px solid #000;">
                    </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-success" onclick="ActualizarTableTemporal();">Actualizar datos</button>
                </div>
              </div>
            </div>
          </div>



        </div>

          <div id="div_manual" style="display: none;">
            <center><h2>Financiación manual</h2></center>
                <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Metodo de Financiación</h3>
                        </div>
                        <div class="card-body">
                        <form id="form_create">
                            <div class="row">
                                <div class="col-6">
                                  <!-- Estado -->  
                                      <label class="errLabel" for="estado" id="errEstado">Estado:</label>
                                      <select class="form-select" id="estado" required>
                                        <option disabled selected>Selecciona una opción</option>
                                        <option value="A">Activo</option>
                                        <option value="I">Inactivo</option>
                                      </select>
                                </div>

                                <div class="col-6">
                                  <!--fecha de registro-->
                                    <label class="errLabel" for="fechaRegistro" id="errFechaRegistro">Fecha de registro:</label>
                                    <input class="form-control input-sm mb-2" type="date" id="fechaRegistro"/> 
                                </div>

                                <div class="col-6">
                                    <!-- Financiaion -->
                                    <label class="errLabel" for="tipoPromocion" id="">Financiación</label>
                                      <select class="form-select mb-2" id="tipoPromocion">
                                        <option disabled selected>Selecciona una opción</option>
                                      </select>
                                </div>

                                <div class="col-6" style="display: none;">
                                  <!-- Tipo Promocion -->
                                  <label class="errLabel" for="" id="">Tipo Financiación:</label>
                                    <input class="form-control input-sm" type="text" style="text-transform:uppercase;" id="" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese opción">
                                </div>
                                
                                <div class="col-6">
                                  <!-- Periodo -->
                                  <label class="errLabel" for="periodo" id="errPeriodo">Periodo:</label>
                                      <select class="form-select mb-2" id="periodo">
                                        <option disabled selected>Selecciona una opción</option>
                                      </select>
                                </div>


                                <div class="col-6">
                                  <!-- Periodo Idiomas-->
                                  <label class="errLabel" for="periodoIdiomas" id="errPeriodoIdiomas">Periodo Idiomas:</label>
                                      <select class="form-select mb-2" id="periodoIdiomas">
                                        <option disabled selected>Selecciona una opción</option>
                                      </select>
                                </div>
                                  
                                <div class="col-6">
                                  <!-- programa Academico -->
                                  <label class="errLabel" for="programa" id="errPrograma">Programa académico:</label>
                                      <select class="form-select mb-2" id="programa">
                                        <option disabled selected>Selecciona una opción</option>
                                      </select>
                                </div>      

                                <div class="col-6">
                                  <!-- ciclo Propedeutico -->
                                  <label class="errLabel" for="ciclo" id="errCiclo">Ciclo Propedeutico:</label>
                                      <select class="form-select mb-2" id="ciclo">
                                        <option disabled selected>Selecciona una opción</option>
                                      </select>
                                </div>  
                                      
                                <div class="col-6">
                                  <!-- tipo Inscripcion -->
                                  <label class="errLabel" for="tipoInscripcion" id="errTipoInscripcion">Tipo Inscripcion:</label>
                                      <select class="form-select mb-2" id="tipoInscripcion">
                                        <option disabled selected>Selecciona una opción</option>
                                      </select>
                                </div> 
                                    
                                <div class="col-6">
                                  <!-- valor Matricula -->
                                  <label class="errLabel" for="valorMatricula" id="errValorMatricula">Valor Matricula:<span id="alertmatricula" style="display:none;font-size:12px;color:red;">No puede ser un valor Negativo</span></label>
                                    <input class="form-control input-sm" type="number" onblur="matricula()" id="valorMatricula" min="0" placeholder="Ingrese Valor">
                                </div> 

                                <div class="col-6">
                                   <!-- valor Idiomas -->
                                   <label class="errLabel" for="valorIdiomas" id="errvalorIdiomas">Valor Idiomas:<span id="alertidioma" style="display:none;font-size:12px;color:red;">No puede ser un valor Negativo</span></label>
                                    <input class="form-control input-sm" type="number" onblur="idioma()" id="valorIdiomas" min="0" placeholder="Ingrese Valor">
                                      </select>
                                </div> 
                                      
                                <div class="col-6">
                                    <!-- valor Servicio -->
                                   <label class="errLabel" for="valorServicio" id="errValorServicio">Valor Servicio:<span id="alertservicio" style="display:none;font-size:12px;color:red;">No puede ser un valor Negativo</span></label>
                                    <input class="form-control input-sm" type="number" onblur="servicio()" id="valorServicio" min="0" placeholder="Ingrese Valor">
                                </div> 

                                <div class="col-6">
                                    <!-- cuotas -->
                                    <label class="errLabel" for="cuotas" id="errCuotas">Numero de cuotas: <span id="alertcuotas" style="display:none;font-size:12px;color:red;">Debe ser entre 1 y 4</span></label>
                                     <input class="form-control input-sm" type="number" onblur="cuota()" id="cuotas" min="1" max="4" placeholder="Ingrese Valor">
                                </div> 

                                <div class="col-6">
                                    <!-- Porcentaje Matricula -->
                                    <label class="errLabel" for="porcMatricula" id="errPorcMatricula">Porc Matricula<span id="alertporcmatricula" style="display:none;font-size:12px;color:red;">Debe ser entre 0 y 100</span></label>
                                     <input class="form-control input-sm" type="number" onblur="porcmatricula()" id="porcMatricula" min="0" max="100" placeholder="Ingrese Valor">
                                </div> 
                                     
                                <div class="col-6">
                                    <!-- Porcentaje Idiomas -->
                                    <label class="errLabel" for="porcIdiomas" id="errporcIdiomas">Porcentaje Idiomas:<span id="alertporcidioma" style="display:none;font-size:12px;color:red;">Debe ser entre 0 y 100</span></label>
                                     <input class="form-control input-sm" type="number"  onblur="porcidioma()" id="porcIdiomas" min="0" placeholder="Ingrese Valor">
                                </div>  

                                <div class="col-2">
                                  <br>
                                  <label style="font-size: 15px;">Es cun vive?</label><br>
                                  <input type="checkbox" name="" style="width: 30px;height: 30px;" id="check_cunvive">
                                </div>
                                
                                <div class="col-2">
                                  <br>
                                  <label style="font-size: 15px;">Es 2x1?</label><br>
                                  <input type="checkbox" name="" style="width: 30px;height: 30px;" id="check_2x1">
                                </div>
                                

                                <!-- <div class="col-6"> -->
                                    <!-- Valor Traslado Matricula -->
                                   <!--  <label class="errLabel" for="valTrasmatricula" id="errValTrasmatricula">Valor Traslado Matricula:</label>
                                     <input class="form-control input-sm" type="number" id="valTrasmatricula" placeholder="0">
                                </div> 

                                <div class="col-6"> -->
                                    <!-- Valor Traslado Idiomas -->
                                    <!-- <label class="errLabel" for="valTrasidiomas" id="errValTrasidiomas">Valor Traslado Idiomas:</label>
                                     <input class="form-control input-sm" type="number" id="valTrasidiomas" placeholder="0">
                                </div> -->

                               <!-- <div class="col-6"> -->
                                    <!-- Valor Promosion Beneficiario -->
                                <!--    <label class="errLabel" for="valPrombeneficiario" id="errValPrombeneficiario">Valor Promedio Benefisiario:</label>
                                     <input class="form-control input-sm" type="number" id="valPrombeneficiario" placeholder="0">
                                </div> -->

                            </div>
                            </form>
                            <center>
                            <div class="form-footer" class="center">
                              <button type="button" class="btn btn-green" id="btn_guardarpromociones" onclick="GuardarDatos();">Guardar Datos</button>
                            </div>
                            </center>
                            </div>
                      </div>
                    </div>

                </div>
          </div>
            
    </div>



     <!-- Ventana modal de edicion promociones -->
          <div class="modal modal-blur fade" id="modal-EditarPromociones" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Editar Financiación:  (<span id=""></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" id="idpromocion_edit">
                <input type="hidden" id="tipoPromocionedit_antes">
                <input type="hidden" id="periodoedit_antes">
                <input type="hidden" id="periodoIdiomasedit_antes">
                <input type="hidden" id="programaedit_antes">
                <input type="hidden" id="cicloedit_antes">
                <input type="hidden" id="tipoInscripcionedit_antes">
                <input type="hidden" id="fecharegistro_edit">
                <label>Estado:</label>
                <select class="form-select mb-2" id="estadoedit">
                  <option disabled selected>Selecciona una opción</option>
                  <option value="A">Activo</option>
                  <option value="I">Inactivo</option>
                </select>
                <!-- <br> -->
                <!-- <label>Fecha Registro:</label> -->
                <!--<input type="date" class="form-control" id="fecharegistro_edit" autocomplete="off">-->
                <br>
                <label>Financiación:</label>
                <select class="form-select mb-2" id="tipoPromocionedit">
                  <option disabled selected>Selecciona una opción</option>
                </select>
                <br>
                <label>Periodo:</label>
                <select class="form-select mb-2" id="periodoedit">
                  <option disabled selected>Selecciona una opción</option>
                </select>
                <br>
                <label>Periodo Idiomas:</label>
                <select class="form-select mb-2" id="periodoIdiomasedit">
                  <option disabled selected>Selecciona una opción</option>
                </select>
                <br>
                <label>Programa académico:</label>
                <select class="form-select mb-2" id="programaedit">
                  <option disabled selected>Selecciona una opción</option>
                </select>
                <br>
                <label>Ciclo Propedeutico:</label>
                <select class="form-select mb-2" id="cicloedit">
                  <option disabled selected>Selecciona una opción</option>
                </select>
                <br>
                <label>Tipo Inscripcion:</label>
                <select class="form-select mb-2" id="tipoInscripcionedit">
                  <option disabled selected>Selecciona una opción</option>
                </select>
                <br>
                <label>Valor Matricula:</label><span id="alertmatriculaedit" style="display:none;font-size:12px;color:red;">No puede ser un valor Negativo</span></label>
                <input type="number" class="form-control" onblur="matriculaedit()" id="valorMatriculaedit" autocomplete="off">
                <br>
                <label>Valor Servicio:</label><span id="alertservicioedit" style="display:none;font-size:12px;color:red;">No puede ser un valor Negativo</span></label>
                <input type="number" class="form-control" onblur="servicioedit()" id="valorServicioedit" autocomplete="off">
                <br>
                <label>Valor Idiomas:</label><span id="alertidiomaedit" style="display:none;font-size:12px;color:red;">No puede ser un valor Negativo</span></label>
                <input type="number" class="form-control" onblur="idiomaedit()" id="valorIdiomasedit" autocomplete="off">
                <br>
                <label>Numero de cuotas:</label><span id="alertcuotasedit" style="display:none;font-size:12px;color:red;">Debe ser entre 1 y 4</span></label>
                <input type="number" class="form-control" onblur="cuotaedit()" id="cuotasedit" autocomplete="off">
                <br>
                <label>Porc Matricula:</label><span id="alertporcmatriculaedit" style="display:none;font-size:12px;color:red;">Debe ser entre 0 y 100</span></label>
                <input type="number" class="form-control" onblur="porcmatriculaedit()" id="porcMatriculaedit" autocomplete="off">
                <br>
                <label>Porcentaje Idiomas:</label><span id="alertporcidiomaedit" style="display:none;font-size:12px;color:red;">Debe ser entre 0 y 100</span></label>
                <input type="number" class="form-control" onblur="porcidiomaedit()" id="porcIdiomasedit" autocomplete="off">
                <br>
                  <div class = 'row' >
                    <div class = 'col-4' >
                      <label style="font-size: 15px;" >Es cun vive?</label>
                      <input type="checkbox" name="" style="width: 30px;height: 30px;" id="check_cunviveedit" autocomplete="off">
                    </div><br>
                    <div class = 'col-4' >
                  <label style="font-size: 15px;">Es 2x1?</label>
                  <input type="checkbox" name="" style="width: 30px;height: 30px;" id="check_2x1edit" autocomplete="off">
                  </div><br>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <input type="button" class="btn btn-success" id="btn_actualizarpromociones" value="Actualizar promocion" onclick="ActualizarPromocion();">
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
            <center><h3>Financiaciones creadas</h3></center>
            <br>
            <div class="card-body">
              <div class="col-lg-12">
                  <label>Buscador:</label>
                  <input type="text" class="form-control" placeholder="Buscador..." style="border: 1px solid #000;" id="searchTerm" onkeyup="doSearch(1);" autocomplete="off">
                  <br>
              </div>
            </div>
            <div id="scroll" style="overflow-y: scroll;height: 500px;">
              <div id="table_promociones"></div>  
            </div>
          </div>
      </div>
    </div>

    </div>

    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/formpromociones.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>