<?php 
define("ruta", 'CM');
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
    <title>✅ Cargue de metas</title>
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

    <style type="text/css"> 
      .card_op:hover{
        border: 1px solid #000;
        cursor: pointer;
       }
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

    <div class="wrapper">
    <?php include 'templates/header.php' ?>
    
  <div class="container" style="display:none;">
    <div class="row">
        <div class="col-lg-12">
            <br>
            <h2>Cargue de metas del periodo</h2>
            <hr style="border:1px solid #000;">
        </div>
      </div>
  </div>
    
  <br>
  <div class="container manual_reg" style="display:none;">
      <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Cargar Meta</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                        <label style="font-weight: bold;">Unidad de negocio</label>
                        <select class="form-control" id="unidad_negocio">
                        </select>
                    </div>

                    <div class="col-4">
                        <label style="font-weight: bold;">Periodo</label>
                        <select class="form-control" id="periodo">
                        </select>
                    </div>

                    <div class="col-4">
                      <label></label><br>
                       <button type="button" class="btn btn-green" onclick="ConsultarGruposA();">Buscar</button>
                    </div>

                    <div class="col-12">
                      <hr style="border:1px solid #000;">
                    </div>

                    <div class="col-12">
                      <div id="table_grupos_analisis" style="overflow-y: scroll;height: 300px;"></div>
                    </div>

                    <div class="col-4" style="display:none;">
                        <label style="font-weight: bold;">Grupo de analisis</label>
                        <select class="form-control" id="grupo_analisis">
                        </select>
                    </div>

                      <div class="col-6" id="div_uno_data" style="display:none;">
                      </div>

                      <div class="col-2" id="div_dos_data" style="display:none;">
                        <br><br>
                        <label style="font-weight:bold;text-decoration-line: underline;">TOTAL</label>
                      </div>

                      <div class="col-2" id="div_tres_data" style="display:none;">
                        <br><br>
                        <label style="font-weight:bold;text-decoration-line: underline;">Estudiantes: <span style="font-weight:normal;" id="txt_tot_estudiantes"></span></label>
                      </div>

                      <div class="col-2" id="div_cuatro_data" style="display:none;">
                        <br><br>
                        <label style="font-weight:bold;text-decoration-line: underline;">Valor: <span style="font-weight:normal;" id="txt_valor_dinero"></span></label>
                      </div>

                  </div>
                </div>
              </div>
          </div>

      </div>
  </div>
        
  
  <div class="container" id="crear_new_meta" style="display:none;">

      <div class="col-12">
        <hr style="border:1px solid #000;">
      </div>

        <div class="card">
          <div class="card-body">
          <div class="row">
            <div class="col-4 mb-2">
                <input type="button" value="Crear Nueva Meta" class="btn btn-dark form-control" data-bs-toggle="modal" data-bs-target="#ModalCrearMeta">
            </div>
            <div class="col-4 mb-2">
                <input type="button" value="Migrar Datos" class="btn btn-warning form-control" onclick="MigrarDatos();">
            </div>
            <div class="col-4 mb-2">
                <input type="button" value="Reportes" class="btn btn-success form-control" data-bs-toggle="modal" data-bs-target="#ModalReportes">
            </div>
          </div>
            
          </div>
        </div>

        <div class="col-12">
          <hr style="border:1px solid #000;">
        </div>

          <div class="row">
            <input type="text" id="grupo_analisis_id" style="display:none;">
               <div class="col-12">
                <div class="card">
                <br>
                <center><h3>Metas creadas</h3></center>
                <br>
                <input type="text" class="form-control" placeholder="Buscador..." id="searchTerm" onkeyup="doSearch();" autocomplete="off" style="border: 1px solid #000;">
                <hr style="border:2px solid #000;">

                <div class="row">
                  <div class="col-2 mb-2">
                    <label>Ajustar Valores:</label>
                    <input type="number" class="form-control" style="border: 1px solid #000;" id="valor_temporal">
                  </div>
                  <div class="col-2 mb-2">
                    <br>
                    <input type="button" value="+ %" class="btn btn-success form-control" style="border: 1px solid #000;" onclick="SumarPorcentaje();">
                  </div>
                  <div class="col-2 mb-2">
                    <br>
                    <input type="button" value="- %" class="btn btn-danger form-control" style="border: 1px solid #000;" onclick="RestarPorcentaje();">
                  </div>
                  <div class="col-2 mb-2">
                    <br>
                    <input type="button" value="Resetar" class="btn btn-warning form-control" style="border: 1px solid #000;" onclick="ConsultarGruposA();">
                  </div>
                  <label style="font-size:10px;color: red;">Los valores solo se actualizaran temporalmente, hasta que realices la migracion de los datos</label>
                </div>
                <br>
                <div id="table_metas_creadas" style="overflow-y: scroll;height: 600px;"></div>
                </div>
              </div>
          </div>
    </div>

    <!-- Modal Crear meta -->
    <div class="modal fade" id="ModalCrearMeta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear meta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_cerrar_modal_crear_meta"></button>
          </div>
          <div class="modal-body">
            <form id="form_insert">
                <label style="font-weight: bold;">Grupo de analisis:</label>
                <select class="form-control" id="grupo_analisis_insert">
                </select>
                <br>
                <label style="font-weight: bold;">Regional</label>
                <select class="form-control" id="regional">
                </select>
                <br>
                <label style="font-weight: bold;">Sede</label>
                <select class="form-control" id="sede">
                </select>
                <br>

                <div id="div_tipo_alumno">
                  <label style="font-weight: bold;">Tipo alumno</label>
                  <select class="form-control" id="tipo_alumno">
                  </select>
                  <br>
                </div>

                <div id="div_programa">
                  <label style="font-weight: bold;">Programa</label>
                  <select class="form-control" id="programa">
                  </select>
                  <br>
                </div>

                <div id="div_modalidad">
                  <label style="font-weight: bold;">Modalidad</label>
                  <select class="form-control" id="modalidad">
                  </select>
                  <br>
                </div>

                <div id="div_ciclo">
                  <label style="font-weight: bold;">Ciclo</label>
                  <select class="form-control" id="ciclo">
                  </select>
                  <br>
                </div>

                <div id="div_meta_estudiantes">
                  <label style="font-weight: bold;">Meta estudiantes</label>
                  <input type="number" class="form-control" id="meta_estudiantes">
                  <br>
                </div>

                <div id="div_meta_valor_ingresos">
                  <label style="font-weight: bold;">Meta valor ingresos</label>
                  <input type="number" class="form-control" id="valor_ingresos">
                  <br>
                </div>

                <button type="button" class="btn btn-green form-control" onclick="AgregarMeta();">Crear</button>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="Modal_EditarMeta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar meta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div style="display:none;">
                <input type="text" id="id_meta">
                <input type="text" id="regional_edit_audi">
                <input type="text" id="sede_edit_audi">
                <input type="text" id="tipo_alumno_edit_audi">
                <input type="text" id="programa_edit_audi">
                <input type="text" id="modalidad_edit_audi">
                <input type="text" id="ciclo_edit_audi">
                <input type="text" id="meta_estudiantes_edit_audi">
                <input type="text" id="valor_ingresos_edit_audi">
            </div>
            
            <!--- Cargar selects para editar -->
            <label style="font-weight: bold;">Regional</label>
            <select class="form-control" id="regional_edit">
            </select>
            <br>
            <label style="font-weight: bold;">Sede</label>
            <select class="form-control" id="sede_edit">
            </select>
            <br>
            <div id="div_tipo_alumno_edit">
              <label style="font-weight: bold;">Tipo alumno</label>
              <select class="form-control" id="tipo_alumno_edit">
              </select>
            </div>
            <br>
            <div id="div_programa_edit">
              <label style="font-weight: bold;">Programa</label>
              <select class="form-control" id="programa_edit">
              </select>
            </div>
            <br>
            <div id="div_modalidad_edit">
              <label style="font-weight: bold;">Modalidad</label>
              <select class="form-control" id="modalidad_edit">
              </select>
            </div>
            <br>
            <div id="div_ciclo_edit">
              <label style="font-weight: bold;">Ciclo</label>
              <select class="form-control" id="ciclo_edit">
              </select>
            </div>
            <br>

            <div id="div_meta_estudiantes_edit">
              <label style="font-weight: bold;">Meta estudiantes</label>
              <input type="number" class="form-control" id="meta_estudiantes_edit">
            </div>
            <br>
            <div id="div_meta_valor_ingresos_edit">
              <label style="font-weight: bold;">Meta valor ingresos</label>
              <input type="number" class="form-control" id="valor_ingresos_edit">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="UpdateMetaReg();">Actualizar datos</button>
          </div>
        </div>
      </div>
    </div>




    <!-- Modal destino-->
    <div class="modal fade" id="Modal_Masivo_Destino" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-sm">
        <div class="modal-content"  style="border:2px solid #000;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Metas Masivas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <input type="hidden" id="registros_mg">
              <label>Escoge el periodo de destino</label>
              <select class="form-select mb-2" id="periodo_destino_ms">
                <option disabled selected>Selecciona una opción</option>
              </select>
              <br>
              <label>Escoge el grupo de analisis destino</label>
              <select class="form-select mb-2" id="grupo_analisis_destino_ms">
                <option disabled selected>Selecciona una opción</option>
              </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="MigrarDatosPNew();">Migrar datos</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal resultado masivo-->
    <div class="modal fade" id="Modal_result_ms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Resultado gestion metas masivas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">           
            <div id="scroll" style="overflow-y: scroll;height: 300px;">
              <div id="table_result_ms"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>


    <!---- Modal Reportes ---->

    <div class="modal fade" id="ModalReportes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Generar Reportes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label>Periodo:</label>
            <select class="form-control" id="periodo_reporte" style="border:1px solid #000;">
            </select>
            <br>
            <label>Grupo Analisis:</label>
            <select class="form-control" id="grupo_analisis_reporte" style="border:1px solid #000;">
            </select>
            <br>
            <input type="button" value="Generar Reporte" class="btn btn-success" onclick="ExportarExcel();" id="btn_reporte">

            <hr style="border: 1px solid #000;">
            <br>
            <div id="result_file_load"></div>

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

             <div id="div_tipo_alumno_unoxuno" style="display:none;">
              <br>
              <label>Selecciona el tipo de alumno:</label>
              <select class="form-select mb-2" id="tipo_alumno_edit_unoxuno" style="border:1px solid #000;">
                <option disabled selected>Selecciona una opción</option>
              </select>
            </div>

            <div id="div_programa_unoxuno" style="display:none;">
              <br>
              <label>Selecciona el programa:</label>
              <select class="form-select mb-2" id="programa_edit_unoxuno" style="border:1px solid #000;">
                <option disabled selected>Selecciona una opción</option>
              </select>
            </div>

            <div id="div_modalidad_unoxuno" style="display:none;">
              <br>
              <label>Selecciona la modalidad:</label>
              <select class="form-select mb-2" id="modalidad_edit_unoxuno" style="border:1px solid #000;">
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

            <div id="div_meta_estudiantes_unoxuno" style="display:none;">
              <br>
              <label>Meta estudiantes:</label>
              <input type="number" class="form-control" id="meta_estudiantes_edit_unoxuno" style="border:1px solid #000;">
            </div>

            <div id="div_valor_meta_estudiantes_unoxuno" style="display:none;">
              <br>
              <label>Escribe el valor de la meta de estudiantes:</label>
              <input type="text" class="form-control" id="valor_meta_estudiantes_edit_unoxuno" style="border:1px solid #000;">
            </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-success" onclick="ActualizarTableTemporalUnoxUno();">Actualizar dato</button>
            </div>
          </div>
        </div>
      </div>



    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/cargue_metas.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://use.fontawesome.com/4ed0008cdd.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
</body>
</html>
