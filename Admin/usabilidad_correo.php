<?php 
define("ruta", 'USC');
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
    <title>✅ Usabilidad Correo</title>
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
            <h2>Consulta Usabilidad Correo Estudiantil</h2>
            <hr style="border:1px solid #000;">
        </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Consultar estudiantes</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-3">
                          <label class="form-label" style="font-weight:bold;">Periodo:</label>
                          <div class="col">
                            <select class="form-control" id="periodo"></select>
                          </div>
                      </div>
                      <div class="col-6">
                          <label class="form-label"><br></label>
                          <button type="button" class="btn btn-green" onclick="Consultar();" id="btn_consultar">Consultar</button>
                      </div>
                      <div class="col-3">
                          <label class="form-label"><br></label>
                          <button type="button" class="btn btn-primary" style="width:100%;" data-bs-toggle="modal" data-bs-target="#Modal_Cargar_Excel">Reporte excel de accesos</button>
                      </div>
                      <div id="accesos_count" class="row" style="display:none;">
                        <div class="col-12 mb-4"></div>
                        <div class="col-4"></div>
                        <div class="col-2">
                          <label style="font-weight:bold;">No han ingresado: <span style="font-weight:normal;" id="no_han_ingresado_txt"></span></label>
                        </div>
                        <div class="col-2">
                          <label style="font-weight:bold;">Ya ingresaron: <span style="font-weight:normal;" id="ya_ingresaron_txt"></span></label>
                        </div>
                        <div class="col-2">
                          <label style="font-weight:bold;">Desconocidos: <span style="font-weight:normal;" id="no_sabe_txt"></span></label>
                        </div>
                        <div class="col-2">
                          <label style="font-weight:bold;">Total: <span style="font-weight:normal;" id="total_txt"></span></label>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-12">
                <hr style="border:1px solid #000;">
            </div>

            <div class="col-12">
              <div class="card">
                <br>
                <center>
                  <h3>Estudiantes</h3>
                </center>
                <br>
                <input type="text" class="form-control" placeholder="Buscador..." id="searchTerm" onkeyup="doSearch();" autocomplete="off" style="border: 1px solid #000;">
                <br>
                <div style="overflow-y: scroll; height:400px;">
                  <div id="table_result"></div>
                </div>
              </div>
            </div>


    </div>
</div>
      

    <!-- Modal Cargar Excel -->
    <div class="modal fade" id="Modal_Cargar_Excel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cargar Excel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <br>
            
            <label style="font-weight:bold;">Selecciona el periodo:</label><br><br>
            <select class="form-control" id="periodo_excel"></select>
            <br>
            <input type="button" value="Generar Reporte Excel" class="btn btn-dark" id="btnload" onclick="GenerarReporte();">

            <hr style="border:1px solid #000;">

            <div class="col-md-12 mb-2">
                <div id="loadingData" style="display:none;">
                    Cargando datos... Espera un momento <br>
                    <img src="img/Gif_Loading.gif" width="150">
                </div>
                <div class="result_file_load" style="display:none;">
                  <div class="alert alert-success" role="alert">
                      Tu archivo se ha cargado, a continuacion se muestra el resultado
                  </div>
                  <a href="#" class="btn btn-success" id="link_download_excel">Descargar Excel</a>
                </div>
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
    <script type="text/javascript" src="js/usabilidad_correo.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
