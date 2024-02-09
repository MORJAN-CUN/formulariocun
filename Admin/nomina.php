<?php
define("ruta", 'CN');
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
    <title>✅ Consulta Nomina</title>
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
            <h2>Generar reporte de consulta de nomina</h2>
            <hr style="border:1px solid #000;">
        </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Consultar nomina</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Periodo</label>
                        <div class="col">
                          <input type="number" class="form-control" autocomplete="off" id="periodo">
                        </div>
                      </div>
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Cedula <span style="color:green;font-size:10px;">Opcional</span></label>
                        <div class="col">
                          <input type="number" class="form-control" autocomplete="off" id="cedula">
                        </div>
                      </div>
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Consecutivo de inicio</label>
                        <div class="col">
                          <input type="number" class="form-control" autocomplete="off" id="consecutivo">
                        </div>
                      </div>
                      <div class="form-footer">
                        <button type="button" id="btnload" class="btn btn-green" onclick="ConsultarN();">Consultar</button>
                      </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
                <div id="loadingData" style="display:none;">
                    Generado excel, Tiempo aproximado 2 Minutos ... Espera un momento
                    <br> 
                    <img src="img/Gif_Loading.gif" width="150">
                </div>

                <div id="result_file_load" style="display:none;">
                  <div class="alert" role="alert">
                      Tu archivo se ha generado correctamente, puedes descargar el resultado
                  </div>
                  <a href="#" class="btn btn-success" id="link_download_excel">Descargar Excel</a>
                </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid #000;">
            </div>

    </div>
</div>


    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/nominav2.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
