<?php 
define("ruta", 'GC');
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
    <title>✅ GESTORES COMERCIALES</title>
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
            <h2>Gestores comerciales</h2>
            <hr style="border:1px solid #000;">
        </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Activar Nuevo Gestor Comercial</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <!-- <div class="col-lg-3 mb-3">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" autocomplete="off">
                    </div> -->
                    <div class="col-lg-3 mb-3">
                        <label>Cédula:</label>
                        <input type="number" class="form-control" id="cedula" name="cedula" autocomplete="off" onkeyup="dataName()">
                        <br>
                        <div id="name"></div>
                    </div>
                    <div class="col-lg-3">
                      <br>
                      <button type="button" id="btncons" class="btn btn-success form-control" onclick="ActivarGestor();">Activar Gestor</button>
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

            <div class="col-12">
              <div class="card">
                <br>
                <center><h3>Gestores comerciales</h3></center>
                <br>
                <input type="text" class="form-control" placeholder="Buscador..." style="border:1px solid #000;"  id="searchTerm" onkeyup="doSearch();" autocomplete="off">
                <br>
                <div id="scroll" style="overflow-y: scroll;height: 500px;">
                  <div id="table_comerciales"></div>
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
    <script type="text/javascript" src="js/g_comerciales.js?v=<?php echo(rand()); ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
