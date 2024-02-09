<?php 
define("ruta", 'VCE');
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
    <title>✅ Verificación de Certificados</title>
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
            <h2>Verificación de Certificados</h2>
            <hr style="border:1px solid #000;">
        </div>

        <!-- Cards with tabs component -->
        <div class="card-tabs ">
          <!-- Cards navigation -->
          <ul class="nav nav-tabs">
            <li class="nav-item"><a href="#tab-top-1" class="nav-link active" data-bs-toggle="tab">Certificados Generados</a></li>
            <li class="nav-item"><a href="#tab-top-2" class="nav-link" data-bs-toggle="tab">Solicitudes en Curso</a></li>
            
          </ul>
          <div class="tab-content">
            
            <!-- Content of card #1 -->
            <div id="tab-top-1" class="card tab-pane active show">
              <div class="card-body">
                <div class="card-title">Certificados Generados</div>
                
                <!-- consulta de cedula -->
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
                                <label for="cedula_estudiante" id="errCedula_estudiante" style="color: #FF5733;"></label>
                              </div>
                          </div>
                          <div class="col-6">
                              <label class="form-label"><br></label>
                              <button type="button" class="btn btn-green" onclick="Consultar();">Consultar</button>
                          </div>
                          <div class="col-3">
                              
                          </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Content of card #2 -->
            <div id="tab-top-2" class="card tab-pane">
              <div class="card-body">
                <div class="card-title">Solicitudes en Curso</div>
                
                <!-- consulta de cedula -->
                <div class="col-md-12">

                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Solicitudes en Curso</h3>
                    </div>
                    <div class="card-body">
                      <div class="row">
                          <div class="col-3">
                              <label class="form-label" style="font-weight:bold;">Cedula:</label>
                              <div class="col">
                                <input type="number" class="form-control" id="cedula_estudiante_c" autocomplete="off">
                                <label for="cedula_estudiante" id="errCedula_estudiante_c" style="color: #FF5733;"></label>
                              </div>
                          </div>
                          <div class="col-6">
                              <label class="form-label"><br></label>
                              <button type="button" class="btn btn-green" onclick="ConsultaSolicitudes();">Consultar</button>
                          </div>
                          <div class="col-3">
                              
                          </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            
          </div>
        </div>

        <!-- resultados -->

        <div class="col-12">
                <hr style="border:1px solid #000;">
            </div>

            <div class="col-12">
              <div class="card">
                
                
                <br>
                
                <div style="overflow-y: scroll;height: 500px;">
                  <div id="table_result"></div>
                </div>
              </div>
            </div>

        <!-- 
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
                            <label for="cedula_estudiante" id="errCedula_estudiante" style="color: #FF5733;"></label>
                          </div>
                      </div>
                      <div class="col-6">
                          <label class="form-label"><br></label>
                          <button type="button" class="btn btn-green" onclick="Consultar();">Consultar</button>
                      </div>
                      <div class="col-3">
                          
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
                
                <center>
                  <br>
                  <h3>Certificados Emitidos</h3>
                </center>
                <br>
                
                <div style="overflow-y: scroll;height: 500px;">
                  <div id="table_result"></div>
                </div>
              </div>
            </div>

          -->


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
    <script type="text/javascript" src="js/validacion_certificados.js?v=<?php echo(rand()); ?>"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
