<?php
define("ruta", 'PD');
include 'php/acceso.php';
include 'php/DatosEmpleado.php';
include 'php/ValPass.php';
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>✅ Parametrización diplomados</title>
  <!-- CSS files -->
  <link href="css/tabler.min.css" rel="stylesheet" />
  <link href="css/tabler-flags.min.css" rel="stylesheet" />
  <link href="css/tabler-payments.min.css" rel="stylesheet" />
  <link href="css/tabler-vendors.min.css" rel="stylesheet" />
  <link href="css/demo.min.css" rel="stylesheet" />
  <link href="css/template.css" rel="stylesheet" />
  <link rel="shortcut icon" href="https://cun.edu.co/wp-content/uploads/cropped-Icono-para-pa%CC%81gina-32x32.jpg" type="image/x-icon"> <!-- favicon -->
</head>

<body class="antialiased">
  <div class="wrapper">
    <?php include 'templates/header.php' ?>

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <br>
          <h2>Parametrizacion diplomados</h2>
          <hr style="border:1px solid #000;">
        </div>

        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Crear parametrización</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <label class="form-label">Periodo:</label>
                  <div class="col">
                    <select class="form-control" id="periodo"></select>
                  </div>
                </div>
                <div class="col-3">
                  <label class="form-label">Regional:</label>
                  <div class="col">
                    <select class="form-control" id="regional"></select>
                  </div>
                </div>

                <div class="col-3">
                  <label class="form-label">Programa:</label>
                  <div class="col">
                    <select class="form-control" id="programa"></select>
                  </div>
                </div>

                <div class="col-3">
                  <label class="form-label">Grupo:</label>
                  <div class="col">
                    <select class="form-control" id="grupo"></select>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-3">
                  <label class="form-label">Porcentaje:</label>
                  <div class="col">
                    <select class="form-control" id="valor_uso"></select>
                  </div>
                </div>

                <div class="col-6">
                  <label class="form-label">Línea de crédito:</label>
                  <div class="col">
                    <select class="form-control" id="linea_credito"></select>
                  </div>
                </div>
              </div>

              <div class="form-footer">
                <button type="button" id="btnload" class="btn btn-green" onclick="ConsultarCabeceras();">Consultar</button>
                <button type="button" id="btncrear" style="display:none;" class="btn btn-dark" onclick="CrearEncabezado();">Crear</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <hr style="border:1px solid #000;">
        </div>

        <div class="col-12" style="display:none;" id="div_tabla">
          <div class="card">
            <br>
            <center>
              <h3>Encabezados</h3>
            </center>
            <br>
            <div id="scroll" style="overflow-y: scroll;height: 500px;">
              <div id="table_encabezados">
                <center><img src="img/Gif_Loading.gif" width="350"></center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal datos encabezado -->
    <div class="modal fade" id="ModalDatosEnc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Fechas encabezado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="text" id="id_secuencia_modal" style="display:none;">
            <div class="row">
              <div class="col-6">
                <label>Agregar nueva fecha de vencimiento:</label>
                <input type="date" class="form-control" id="fecha_insert">
                <br>
                <input type="button" value="Guardar Fecha" class="btn btn-primary" onclick="GuardarFecha();">
              </div>
            </div>
            <hr style="border:1px solid #000;">
            <div id="table_detalle"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal editar fecha  -->
    <div class="modal fade" id="Modal_EditarFecha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="border:2px solid #000;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar fecha</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="text" id="id_detalle_edit" style="display:none;">
            <input type="text" id="fecha_vencimiento_edit_audit" style="display:none;">
            <label>Fecha de vencimiento:</label>
            <input type="date" class="form-control" id="fecha_vencimiento_edit">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="UpdateDetalle();">Guardar camios</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal editar encabezado -->
    <div class="modal fade" id="Modal_EditarEncabezado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar encabezado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div style="display:none;">
              <input type="text" id="id_encabezado_edit">
              <input type="text" id="periodo_edit_audi">
              <input type="text" id="grupo_edit_audi">
              <input type="text" id="programa_edit_audi">
              <input type="text" id="centro_costos_edit_audi">
            </div>
            <label>Periodo:</label>
            <select class="form-control" id="periodo_edit"></select>
            <br>
            <label>Grupo:</label>
            <select class="form-control" id="grupo_edit"></select>
            <br>
            <label>Programa:</label>
            <select class="form-control" id="programa_edit"></select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="UpdateEncabezado();">Guardar cambios</button>
          </div>
        </div>
      </div>
    </div>


    <style type="text/css">
      #scroll {
        overflow-y: scroll;
        height: 500px;
      }
    </style>



    <?php include 'templates/ayuda.php'; ?>
    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/pdiplomados.js?v=<?php echo (rand()); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>