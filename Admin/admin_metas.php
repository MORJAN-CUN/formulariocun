<?php 
define("ruta", 'PARM');
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
    <title>✅ Parametrizar metas</title>
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
    
    <style type="text/css">
        #table_result tr:hover {background-color: #D6EFD4;}

    </style>

    <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <br>
            <h2>Parametrizacion tipos de unidades de negocio</h2>
            <hr style="border:1px solid #000;">
        </div>

      
        <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Crear nuevo tipo de unidad de negocio</h3>
                </div>
                <div class="card-body">
                  <form id="FormInsert">
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Nombre de la unidad de negocio</label>
                        <div class="col">
                          <input type="text" class="form-control" autocomplete="off" id="nombre_meta">
                        </div>
                      </div>
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Opciones de parametrización</label>
                        <div class="col">
                          
                          <table class="table">
                            <thead>
                              <tr>
                                <th scope="col"><center>Modalidad</center></th>
                                <th scope="col"><center>Programa</center></th>
                                <th scope="col"><center>Ciclo</center></th>
                                <th scope="col"><center>Tipo Alumno</center></th>
                                <th scope="col"><center>Meta valor ingresos</center></th>
                                <th scope="col"><center>Meta estudiantes</center></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th><center><input type="checkbox" style="width:25px;height: 25px;" id="modalidad"></center></th>
                                <th><center><input type="checkbox" style="width:25px;height: 25px;" id="programa"></center></th>
                                <th><center><input type="checkbox" style="width:25px;height: 25px;" id="ciclo"></center></th>
                                <th><center><input type="checkbox" style="width:25px;height: 25px;" id="tipo_alumno"></center></th>
                                <th><center><input type="checkbox" style="width:25px;height: 25px;" id="valor_meta"></center></th>
                                <th><center><input type="checkbox" style="width:25px;height: 25px;" id="cantidad_meta"></center></th>
                              </tr>
                            </tbody>
                          </table>

                        </div>
                      </div>
                      <div class="form-footer">
                        <button type="button" class="btn btn-green" onclick="CrearMeta();">Crear unidad de negocio</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>


    <div class="container">

      <div class="col-12">
        <hr style="border:1px solid #000;">
      </div>

        <div class="row">
             <div class="col-12">
              <div class="card">
              <br>
              <center><h3>Tipos de unidades de negocios creadas</h3></center>
              <br>
              <div id="table_tipos_metas"></div>
              </div>
            </div>
        </div>
    </div>

</div>
  

    <!-- Modal -->
    <div class="modal fade" id="Modal_EditarTipoMeta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar tipo de meta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="text" id="id_unidad_negocio" style="display:none;">
            <label>Nombre de unidad de negocio:</label>
            <input type="text" class="form-control" id="nom_meta_edit">
            <hr>
            <label style="font-weight:bold;">Opciones:</label>
            <br><br>
            <label><input type="checkbox" name="" id="modalidad_edit"> Modalidad</label>
            <br>
            
            <label><input type="checkbox" name="" id="programa_edit"> Programa</label>
            <br>
            
            <label><input type="checkbox" name="" id="ciclo_edit"> Ciclo</label>
            <br>
            
            <label><input type="checkbox" name="" id="tipo_alumno_edit"> Tipo alumno</label>
            <br>
            
            <label><input type="checkbox" name="" id="valor_meta_edit"> Meta valor ingresos</label>
            <br>
            
            <label><input type="checkbox" name="" id="cantidad_meta_edit"> Meta estudiantes</label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="ActualizarUnidadNegocio();">Guardar cambios</button>
          </div>
        </div>
      </div>
    </div>


    <?php include 'templates/ayuda.php'; ?>

    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/admin_metas.js?v=<?php echo(rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
