<?php 
define("ruta", 'AP');
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
    <title>✅ Aplicación Pagos</title>
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
    
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <br>
            <h2>Consulta pagos</h2>
            <hr style="border:1px solid #000;">
        </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Generar filtros</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <h4>Consulta Masiva</h4>
                    <div class="col-lg-3 mb-3">
                        <label>Desde:</label>
                        <input type="date" class="form-control" id="fecha_desde" autocomplete="off" 
                        value="<?php echo date('Y'); ?>-<?php echo date('m'); ?>-01">
                    </div>
                    <!-- <div class="col-lg-3 mb-3">
                        <label>Hasta:</label>
                        <input type="date" class="form-control" id="fecha_hasta" autocomplete="off" 
                        value="<?php /* echo date('Y'); */ ?>-<?php /* echo date('m'); */ ?>-<?php /* echo date('d'); */ ?>">
                    </div> -->
                    <!-- <div class="col-lg-3">
                        <label>Estado</label>
                        <select name="state" id="state" class="form-select" onchange="ConsultarState()">
                            <option selected disabled>Seleccionar...</option>
                            <option value="PENDING">Pending</option>
                            <option value="APPROVED">Approved</option>
                            <option value="APPROVED_PARTIAL">Approved Partial</option>
                            <option value="REJECTED">Rejected</option>
                            <option value="FAILED">Failed</option>
                        </select>
                    </div> -->
                    <div class="col-lg-3">
                      <br>
                      <button type="button" id="btncons" class="btn btn-green form-control" onclick="ConsultarFechas();">Consultar</button>
                    </div>
                    <div class="col-lg-3">
                      <br>
                      <button type="button" id="btncons" class="btn btn-info form-control" onclick="ConsultarFechasDiferencia();">Consultar Diferencia De Valores</button>
                    </div>
                    <div class="col-lg-3">
                      <br>
                      <button type="button" id="btncons" class="btn btn-warning form-control" onclick="ConsultarState();">Consultar Estados Vacios</button>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                  <h3>Consulta Específica</h3>
                      <div class="col-md-5 mb-3">
                          <label class="form-label col-form-label">Referencia, Identificación, Valor Pagado:</label>
                        <div class="col">
                          <input type="text" class="form-control" autocomplete="off" id="especifica">
                        </div>
                      </div>
                      <div class="col-lg-4 mb-3">
                        <button type="button" id="btnload1" class="btn btn-success" onclick="ConsultaEsp();" style="margin-top:2.5em;">RF</button>
                        <button type="button" id="btnload1" class="btn btn-info" onclick="ConsultaID();" style="margin-top:2.5em;">ID</button>
                        <button type="button" id="btnload1" class="btn btn-warning" onclick="ConsultaVP();" style="margin-top:2.5em;">VP</button>
                      </div>
                  </div>  
                  <div class="form-footer"></div>
                </div>
              </div>
            </div>
          
            <div class="col-12">
                <hr style="border:1px solid #000;">
            </div>

            <!-- <div class="col-12">
              
              <input type="button" value="Generar Reporte" class="btn btn-primary" onclick="GenerarReporte();" id="btn_reporte">
              <br><br>
              <img src="img/Gif_Loading.gif" width="150" id="loading_reporte" style="display:none;">
              <div id="result_file_load" style="display:none;">
                <br>
                <div class="alert success" role="alert">
                    Tu archivo se ha generado correctamente, puedes descargar el resultado
                </div>
                <a href="#" class="btn btn-success" id="link_download_excel">Descargar Excel</a>
                <br><br>
              </div>

            </div> -->
            <div class="col-md-6">
                <div id="loadingData" style="display:none;">
                    ... Espera un momento 
                    <br>
                    <img src="img/Gif_Loading.gif" width="150">
                </div>
            </div>
            <div class="col-12">
              <div class="card">
                <br>
                <center><h3>Registro de pagos</h3></center>
                <br>
                <input type="text" class="form-control" placeholder="Buscador..." style="border:1px solid #000;"  id="searchTerm" onkeyup="doSearch();" autocomplete="off">
                <br>
                <div id="scroll" style="overflow-y: scroll;height: 500px;">
                  <div id="table_pagos"></div>
                </div>
              </div>
            </div>        
    </div>
</div>
  
<style type="text/css">
  
  #scroll{
    overflow-y: scroll; 
    height:500px;
  }
</style>




    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/aplicacion_pago.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
