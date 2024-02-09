<?php 
define("ruta", 'LC');
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
    <title>✅ Credyty</title>
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
            <h2>Automatizaciones Credyty</h2>
            <hr style="border:1px solid #000;">
            <label>Descarga <a href="php/credyty/downloadfileplantilla.php">aqui</a> la plantilla que se debe cargar</label>
            <br><br>
        </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Cargar Excel Credyty</h3>
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data" id="form_uploadfile">
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Descripción del archivo</label>
                        <div class="col">
                          <input type="text" class="form-control" id="descrip" name="descrip" required="on" autocomplete="off">
                        </div>
                      </div>
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Archivo excel</label>
                        <div class="col">
                          <input type="file" class="form-control" id="file" name="file" required="on">
                        </div>
                      </div>
                      <div class="form-footer">
                        <button type="submit" id="btnload" class="btn btn-green">Cargar Archivo</button>
                      </div>

                  </form>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
                <div id="loadingData" style="display:none;">
                    Cargando datos... Espera un momento 
                    <img src="img/Gif_Loading.gif" width="150">
                </div>

                <div id="result_file_load" style="display:none;">
                  <div class="alert alert-success" role="alert">
                      Tu archivo se ha cargado, puedes verificar el resultado descargando el reporte
                  </div>
                  <a href="#" class="btn btn-success" id="link_download_excel">Descargar Excel</a>
                </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid #000;">
            </div>

            <div class="col-12">
                <div class="card">
                <br>
                <center><h3>Cargues Realizados</h3></center>
                <br>
                <div id="scroll" style="overflow-y: scroll;height: 500px;">
                  <div id="table_loads"></div>
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

<!-- Modal ver detalle credyty-->
<div class="modal fade" id="Modal-detalle_credyty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resultado cargue</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label>Resultado:</label>
        <br>
        <div id="scroll">
          <div id="table_detalle_credyty">
            <h2>Cargando datos, espera un momento...</h2>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
        <a href="" id="href_btn_modal_credyty" class="btn btn-success">Descargar Excel</a>
      </div>
    </div>
  </div>
</div>


    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/credyty.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
