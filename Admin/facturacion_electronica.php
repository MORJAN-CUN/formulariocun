<?php 
define("ruta", 'FE');
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
    <title>✅ Facturación electronica</title>
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
            <h2>Facturación electronica comercial</h2>
            <hr style="border:1px solid #000;">
        </div>

            <div class="col-md-5">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Cargar</h3>
                </div>
                <div class="card-body">
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Numero de factura:</label>
                        <div class="col">
                          <input type="number" class="form-control" autocomplete="off" id="num_factura" onkeyup="dataInfo()"> 
                        </div>
                        <br>
                        <div id="info"></div>
                      </div>
                      <div class="form-footer">
                        <button type="button" id="btnload" class="btn btn-green" onclick="CargarMovMes();">Cargar Factura</button>
                      </div>
                      
                </div>
              </div>
            </div>

            <div class="col-md-7" id="div_ejecu_procesos" style="display:none;">
              <div class="card">
                <div class="card-header">
                  <div id="gif_loading">
                    <h3 class="card-title">Ejecutando procesos...</h3>
                    <img src="img/Gif_Loading.gif" width="60">
                  </div>
                  
                  <div class="alert alert-success" role="alert" id="result_process" style="display:none;">
                     Se ha terminado de ejecutar los procesos
                  </div>

                </div>
                <div class="card-body">
                   <label style="font-weight:bold;display: none;" id="label_uno">1. cunp_facele_movimiento_base.recupera_movimiento:&nbsp;&nbsp;&nbsp;<span style="font-weight:normal;" id="result_uno"></span></label>
                   <br><br>
                   <label style="font-weight:bold;display: none;" id="label_dos">2. cunp_facele_cabecera_factura.agrupa_base_x_periodo:&nbsp;&nbsp;&nbsp;<span style="font-weight:normal;" id="result_dos"></span></label>
                   <br><br>
                   <label style="font-weight:bold;display: none;" id="label_tres">3. cunp_facele_cabecera_factura.renumeracion_para_envio:&nbsp;&nbsp;&nbsp;<span style="font-weight:normal;" id="result_tres"></span></label>
                   <br><br>
                   <label style="font-weight:bold;display: none;" id="label_cuatro">4. cunp_facele_cabecera_factura.registra_envio_ebill:&nbsp;&nbsp;&nbsp;<span style="font-weight:normal;" id="result_cuatro"></span></label>
                   <br><br>
                   <label style="font-weight:bold;display: none;" id="label_cinco">5. JOB EBILL:&nbsp;&nbsp;&nbsp;<span style="font-weight:normal;" id="result_cinco"></span></label>
                </div>
              </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid #000;">
            </div>

            <div class="col-12">
              <div class="card">
                <br>
                <center><h3>Facturas cargadas</h3></center>
                <br>
                <input type="text" class="form-control" placeholder="Buscador..." id="searchTerm" onkeyup="doSearch();" autocomplete="off" style="border: 1px solid #000;">
                <br>
                <div id="scroll" style="overflow-y: scroll;height: 300px;">
                  <div id="table_result"></div>
                </div>
              </div>
            </div>

    </div>
</div>
  




    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/facturacione.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
