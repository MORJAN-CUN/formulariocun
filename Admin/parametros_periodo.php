<?php 
define("ruta", 'PPF');
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
    <title>✅ Periodo</title>
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
          border: 1px solid red;
        }
    </style>


    <br>
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Parametrizacion parametros periodo</h3>
                </div>
                <div class="card-body">
                  <form id="form_create">
                    <div class="row">

                    <div class="col-6">
                          <!-- Periodo -->
                          <label class="errLabel" for="periodo" id="errPeriodo">Periodo:</label>
                              <select class="form-select mb-2" id="periodo">
                                <option disabled selected>Selecciona una opción</option>
                              </select>
                        </div>

                        <div class="col-6">
                          <!-- Tipo Promocion -->
                          <label class="errLabel" for="" id="">Tipo financiacion:</label>
                              <select class="form-select mb-2" id="tipofinanciacion">
                                <option disabled selected>Selecciona una opción</option>
                              </select> 
                        </div>

                        <div class="col-6">
                            <!-- Porcentaje Idiomas -->
                            <label class="errLabel" for="porcIdiomas" id="">Porcentaje a Pagar: <span id="alertporcpagar" style="display:none;font-size:12px;color:red;">Debe ser entre 0 o 100</span></label>
				              	     <input class="form-control input-sm" type="number" id="porcpagar" placeholder="0" onblur="valporcentaje()" min="0" max="100">
                        </div>
                        
                        <div class="col-6">
                          <!--fecha de registro-->
                            <label class="errLabel" for="fechaFinal" id="errFechaRegistro">Fecha Final:</label>
			                      <input class="form-control input-sm mb-2" type="date" id="fechaFinal"/> 
                        </div>

                        <div class="col-6">
                          <!-- Periodo Idiomas-->
                          <label class="errLabel" for="" id="errPeriodoIdiomas">Periodo Idiomas:</label>
                              <select class="form-select mb-2" id="periodoIdiomas">
                                <option disabled selected>Selecciona una opción</option>
                              </select>
                        </div>

                        <div class="col-6">
                          <!--fecha de registro-->
                            <label class="errLabel" for="fechaRegistro" id="errFechaRegistro">Fecha Registro:</label>
			                      <input class="form-control input-sm mb-2" type="date" id="fechaRegistro"/> 
                        </div>

                        <div class="col-6">
                            <!-- cuotas -->
                            <label class="errLabel" for="cuotas" id="errCuotas">Numero de cuotas: <span id="alertcuotas" style="display:none;font-size:12px;color:red;">Debe ser entre 1 o 4</span></label>
				              	     <input class="form-control input-sm" type="number" id="cuotas" placeholder="0" onblur="cuota()" id="cuotas" min="1" max="4">
                        </div> 
                     
                    </div>
                     </form>
                    <center>
                    <div class="form-footer" class="center">
                      <button type="button" class="btn btn-green" id="btn_guardarperiodo" onclick="GuardarDatos();">Guardar Datos</button>
                    </div>
                    </center>
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
        <center><h3>Parametros Periodos creados</h3></center>
        <br>
        <div id="table_periodos"></div>
        </div>
      </div>
      </div>

       <div class="modal modal-blur fade" id="modal-EditarPeriodo" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Editar Periodo:  (<span id=""></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" id="idperiodo_edit">
                <input type="hidden" id="periodoedit_antes">
                <input type="hidden" id="tipofinanciacionedit_antes">
                <label>Periodo:</label>
                <select class="form-select mb-2" id="periodoedit">
                  <option disabled selected>Selecciona una opción</option>
                </select>
                <br>
                <label>Tipo financiacion:</label>
                <select class="form-select mb-2" id="tipofinanciacionedit">
                  <option disabled selected>Selecciona una opción</option>
                </select> 
                <br>
                <label>Porcentaje a pagar:</label>
                <input type="text" class="form-control" id="porc_a_pagaredit" autocomplete="off">
                <br>
                <label>Fecha final:</label>
                <input type="date" class="form-control" id="fechafinal_edit" autocomplete="off">
                <br>
                <label>Fecha Registro:</label>
                <input type="date" class="form-control" id="fecharegistro_edit" autocomplete="off">
                <br>
                <label>Periodo idiomas:</label>
                <select class="form-select mb-2" id="periodoIdiomasedit">
                  <option disabled selected>Selecciona una opción</option>
                </select> 
                <br>
                <label>Numero de cuotas:</label>
                <input type="text" class="form-control" id="numero_cuotasedit" autocomplete="off">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <input type="button" class="btn btn-success" value="Actualizar Periodo" onclick="ActualizarPeriodo();">
              </div>
            </div>
          </div>
        </div>




    </div>
    
    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/periodo.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
