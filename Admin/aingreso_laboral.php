<?php 
define("ruta", 'AIL');
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
    <title>✅ Actualizaciones Ingreso Laboral</title>
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
            <h2>Actualizaciones de ingreso laboral</h2>
            <hr style="border:1px solid #000;">
        </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Generar filtros</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 mb-3">
                        <label>Centro de costos:</label>
                        <select class="form-control" id="centro_costo">
                        </select>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label>Estado:</label>
                        <select class="form-control" id="estado">
                          <option value="">TODOS</option>
                          <option value="ACTIVO">ACTIVO</option>
                          <option value="RETIRADO">RETIRADO</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Existe en ingreso laboral?:</label>
                        <select class="form-control" id="existe_ingreso">
                          <option value="">TODOS</option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Palabra clave:</label>
                        <input type="text" class="form-control" id="palabra_clave">
                    </div>
                    <div class="col-lg-3">
                      <br>
                      <button type="button" id="btncons" class="btn btn-green form-control" onclick="Consultar();">Consultar</button>
                    </div>
                  </div>  
                  <div class="form-footer"></div>
                </div>
              </div>
            </div>
          
            <div class="col-12">
                <hr style="border:1px solid #000;">
            </div>

            <div class="col-12">
              <div class="card">
                <br>
                <center><h3>Empleados</h3></center>
                <br>
                <input type="text" class="form-control" placeholder="Buscador..." style="border:1px solid #000;"  id="searchTerm" onkeyup="doSearch();" autocomplete="off">
                <br>
                <div id="scroll" style="overflow-y: scroll;height: 500px;">
                  <div id="table_empleados"></div>
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


    <!-- Modal Editar empleado-->
    <div class="modal fade" id="Modal_EditarEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar datos del empleado: <span id="txt_nom_empleado" style="font-weight:normal;"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div style="display:none;">
              <input type="text" id="cedula_empleado">
            </div>
            <label style="color:red;font-size: 10px;">Nota: Los datos se actualizaran en la base de datos de Ingreso Laboral</label>
            <br><br>
            <label>Nombres:</label>
            <input type="text" class="form-control" id="nombres_empleado">
            <br>
            <label>Apellidos:</label>
            <input type="text" class="form-control" id="apellidos_empleado">
            <br>
            <label>Correo:</label>
            <input type="text" class="form-control" id="correo_empleado">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="ActualizarDatoIngreso();">Actualizar datos</button>
          </div>
        </div>
      </div>
    </div>


    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/aingreso_laboral.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
