<?php 
define("ruta", 'AFC');
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
    <title>✅ Fechas Cartera</title>
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
            <h2>Actualizaciones fechas de cartera</h2>
            <hr style="border:1px solid #000;">
        </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Consultar estudiante</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-3">
                          <label class="form-label" style="font-weight:bold;">Cedula:</label>
                          <div class="col">
                            <input type="number" class="form-control" id="cedula_estudiante" autocomplete="off">
                          </div>
                      </div>
                      <div class="col-6">
                          <label class="form-label"><br></label>
                          <button type="button" class="btn btn-green" onclick="Consultar();">Consultar</button>
                      </div>
                      <div class="col-3">
                          <label class="form-label"><br></label>
                          <button type="button" class="btn btn-primary" style="width:100%;" data-bs-toggle="modal" data-bs-target="#Modal_Cargar_Excel">Cargar Excel</button>
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
                  <h3>Notas debito</h3>
                </center>
                <br>
                <input type="text" class="form-control" placeholder="Buscador..." id="searchTerm" onkeyup="doSearch();" autocomplete="off" style="border: 1px solid #000;">
                <br>
                <div style="overflow-y: scroll;height: 500px;">
                  <div id="table_result"></div>
                </div>
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
            <label style="color:red;">Descarga la plantilla <a href="php/fechas_cartera/downloadfileplantilla.php">aqui</a></label>
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
                <div class="result_file_load" style="display:none;">
                  <div class="alert alert-success" role="alert">
                      Tu archivo se ha cargado, a continuacion se muestra el resultado
                  </div>
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


    <!-- Modal -->
    <div class="modal fade" id="Modal_EditarFecha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar fecha de vencimiento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div style="display:none;">
              <input type="text" hidden id="cedula_estudiante_edit">
              <input type="text" hidden id="periodo_estudiante_edit">
              <input type="text" hidden id="nota_debito_estudiante_edit">
            </div>
            <label style="font-weight:bold;">Fecha de vencimiento:</label>
            <input type="date" class="form-control" id="fecha_vencimiento_edit">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="ActualizarFecha();">Actualizar</button>
          </div>
        </div>
      </div>
    </div>


<style type="text/css">
  
  .scroll{
    overflow-y: scroll; 
    height:400px;
  }
</style>

  

    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/fechas_cartera.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
