<?php 
define("ruta", 'RF');
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
    <title>✅ Recibos Full</title>
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
    
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <br>
            <h2>Cambiar valor de ordenes</h2>
            <hr style="border:1px solid #000;">
        </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Consultar Ordenes</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <h3>Consulta Masiva</h3>
                      <div class="col-lg-3 mb-3">
                          <label class="form-label col-form-label">Periodo</label>
                          <div class="col">
                           <select class="form-select" id="periodo">
                              <option value="">Periodo</option>
                            </select>
                          </div>
                      </div>
                      <div class="col-lg-3 mb-3">
                          <label class="form-label col-form-label">Programa</label>
                          <div class="col">
                           <select class="form-select" id="programa">
                              <option value="">Programa</option>
                            </select>
                          </div>
                      </div>
                      <div class="col-lg-3 mb-3">
                          <label class="form-label col-form-label">Ciclo</label>
                          <div class="col">
                           <select class="form-select" id="ciclo">
                              <option value="">Ciclo</option>
                            </select>
                          </div>
                      </div>
                      <div class="col-lg-3 mb-3">
                        <button type="button" id="btnload" class="btn btn-success" onclick="ConsultarOrdenes();" style="margin-top:2.5em;">Consultar</button>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                      <h3>Consulta Específica</h3>
                      <div class="col-lg-4 mb-3">
                          <label class="form-label col-4 col-form-label">Cédula</label>
                        <div class="col">
                          <input type="text" class="form-control" autocomplete="off" id="cedula">
                        </div>
                      </div>
                      <div class="col-lg-4 mb-3">
                        <button type="button" id="btnload1" class="btn btn-success" onclick="ConsultaCedula();" style="margin-top:2.5em;">Consultar</button>
                      </div>
                      <div class="col-lg-4">
                          <label class="form-label"><br></label>
                          <button type="button" class="btn btn-primary" style="width:100%;" data-bs-toggle="modal" data-bs-target="#Modal_Cargar_Excel">Cargar Excel</button>
                      </div>
                  </div>

        
                  <div class="form-footer">
                    <div class="row">
                      <div class="col-10">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-primary form-control"  data-bs-toggle="modal" data-bs-target="#ModalReportes">Reportes</button>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
                <div id="loadingData" style="display:none;">
                    ... Espera un momento 
                    <br>
                    <img src="img/Gif_Loading.gif" width="150">
                </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid #000;">
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-info" style="display: none;" id="btn_asig_masivo" onclick="AsignarValorMasivo();">Asignar valor full masivo</button>
                </div>

                <br>
                <center><h3>Resultado</h3></center>
                <br>
                <input type="text" class="form-control" placeholder="Buscador..." id="searchTerm" onkeyup="doSearch();" autocomplete="off" style="border: 1px solid #000;">
                <br>
                <div class="result_file_load" style="display:none;">
                  <div class="alert alert-success" role="alert">
                      Tu archivo se ha cargado, a continuacion se muestra el resultado
                  </div>
                </div>
                <div id="scroll" style="overflow-y: scroll;height: 500px;">
                  <div id="table_result"></div>
                </div>
              </div>
            </div>  
    </div>
</div>
    


    <!-- Modal -->
    <div class="modal fade" id="Modal_Actualizar_Orden" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar orden</h5>
          </div>
          <div class="modal-body">
            <div style="display: none;">
              <input type="text" id="id_orden">
              <input type="text" id="id_documento">
              <input type="text" id="valor_orden_act">
            </div>
            <label>Actualizar orden #<span style="font-weight:bold;" id="numero_orden_txt"></span></label>
            <br><br>
            <label>Selecciona un valor:</label>
            <select class="form-control" id="valor_orden_select" style="border: 1px solid #000;">
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="$('#Modal_Actualizar_Orden').modal('hide');">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="Actualizar_Valor();">Actualizar valor</button>
          </div>
        </div>
      </div>
    </div>

     <!-- Modal Orden masivo-->
    <div class="modal fade" id="Modal_Actualizar_Orden_MS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar orden</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$('#Modal_Actualizar_Orden_MS').modal('hide');"></button>
          </div>
          <div class="modal-body">
            <div style="display: none;">
              <input type="text" id="registros_mg">
            </div>
            <label style="color:red;">Se actualizaran todas las ordenes seleccionadas con el valor seleccionado</label>
            <br><br>
            <label>Selecciona un valor:</label>
            <select class="form-control" id="valor_orden_ms" style="border: 1px solid #000;">
              <option value="">Seleccionar</option>
              <option value="nuevo">Valor nuevo</option>
              <option value="antiguo">Valor continuo</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="$('#Modal_Actualizar_Orden_MS').modal('hide');">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="ActualizarOrdenesMs();">Actualizar valor de ordenes</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal respuesta ordenes -->
    <div class="modal fade" id="Modal_Result_Ordenes_Ms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Resultado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$('#Modal_Result_Ordenes_Ms').modal('hide');"></button>
          </div>
          <div class="modal-body">
            <div id="table_result_ordenes_ms"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="$('#Modal_Result_Ordenes_Ms').modal('hide');">Cerrar</button>
          </div>
        </div> 
      </div>
    </div>

    <!-- Modal valores-->
    <div class="modal fade" id="Modal_Actualizar_Valores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar valores orden</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$('#Modal_Actualizar_Valores').modal('hide');"></button>
          </div>
          <div class="modal-body">
            <div style="display:none;">
              <input type="text" id="id_orden_edit">
              <input type="text" id="documento_orden_edit">
              <input type="text" id="cedula_orden_edit">
              <input type="text" id="valor_orden_edit2">
              <input type="text" id="valor_servicio_medico2">
              <input type="text" id="valor_idiomas_edit2">
              <input type="text" id="porcentaje_descuento">
            </div>
            <label>Valor de orden:</label>
            <input type="number" class="form-control" id="valor_orden_db" style="display:none;">
            <input type="number" class="form-control" id="valor_orden_edit" onkeyup="sumTot();">
            <br>
            <label>Porcentaje ajuste:</label>
            <input type="number" class="form-control" id="porc_descuento_edit" onkeyup="sumTot();" autocomplete="off">
            <br>
            <label>Valor de servicio medico:</label>
            <input type="number" class="form-control" id="valor_servicio_medico">
            <br>
            <label>Valor de idiomas:</label>
            <input type="number" class="form-control" id="valor_idiomas_edit" disabled>
            <br>
            <label>Valor de descuento:</label>
            <input type="number" class="form-control" id="valor_descuento" disabled="on">
            <br>
            <hr style="border:1px solid #000;">
            <label style="font-weight: bold;font-size: 20px;">Total: <span style="font-weight:normal;" id="span_total_valores"></span></label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="$('#Modal_Actualizar_Valores').modal('hide');">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="ActualizarValores();">Actualizar valores</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal Reportes-->
    <div class="modal fade" id="ModalReportes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Generar reportes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label style="font-weight:bold;">Escoge el reporte que deseas generar:</label>
            <hr style="border:1px solid #000;">
            <div class="row">
              <div class="col-lg-3">
                <div class="card" style="border: 1px solid #000;">
                  <br>
                  <center>
                    <img class="card-img-top" src="img/ordenes_modificadas.png" style="width:40%;">
                  </center>
                  <div class="card-body">
                    <h5 class="card-title">Ordenes modificadas</h5>
                    <p class="card-text">Genera reporte de las ordenes que has modificado.</p>
                    <a href="#" class="btn btn-info form-control" data-bs-toggle="modal" data-bs-target="#ModalReporteOrdenesModificadas" id="btnreporteordenesmod">Generar reporte</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="$('#Modal_Actualizar_Valores').modal('hide')">Cerrar</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal Reporte ordenes modificadas-->
    <div class="modal fade" id="ModalReporteOrdenesModificadas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="border:2px solid #000;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ordenes modificadas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label style="font-weight:bold;">Selecciona las fechas de consulta:</label>
            <br><br><br>
            <label>Fecha desde:</label>
            <input type="date" class="form-control" id="fecha_desde">
            <br>
            <label>Fecha hasta:</label>
            <input type="date" class="form-control" id="fecha_hasta">
            <br>
            <input type="button" class="btn btn-success" value="Generar Reporte" onclick="ReporteOrdenesMod();">
            <br><br>
            <div id="loadingDataReporte" style="display:none;">
                Generado excel, ... Espera un momento
                <br> 
                <img src="img/Gif_Loading.gif" width="150">
            </div>
            <br>
            <div id="result_file_load" style="display:none;">
              <hr style="border:1px solid #000;">
              <div class="alert success" role="alert">
                  Tu archivo se ha generado correctamente, puedes descargar el resultado
              </div>
              <a href="#" class="btn btn-success" id="link_download_excel">Descargar Excel</a>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Cargar Excel -->
    <div class="modal fade" id="Modal_Cargar_Excel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cargar Excel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label style="color:red;">Descarga la plantilla <a href="php/recibos_full/downloadfileplantilla.php">aqui</a></label>
            <br><br>
            <form method="post" enctype="multipart/form-data" id="form_uploadfile">
              <label style="font-weight:bold;">Selecciona el archivo de excel:</label><br><br>
              <input type="file" class="form-control" style="border: 1px solid #000;" id="file" name="file" required="on">
              <br>
              <input type="submit" value="Cargar Excel" class="btn btn-success" id="btnload">
            </form>
            <hr style="border:1px solid #000;">

            <div class="col-md-12 mb-2">
                <div id="loadingData" style="display:none;">
                    Cargando datos... Espera un momento <br>
                    <img src="img/Gif_Loading.gif" width="150">
                </div>
            </div>
            <div class="scroll result_file_load" style="display:none;">
              <div id="table_result_excel"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/recibos_full.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
