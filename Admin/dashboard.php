<?php
define("ruta", 'dashboard.php');
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
    <title>✅ Dashboard</title>
    <!-- CSS files --> 
    <link href="css/tabler.min.css" rel="stylesheet"/>
    <link href="css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="css/demo.min.css" rel="stylesheet"/>
    <link href="css/template.css" rel="stylesheet"/>
    <link href="css/header.css?v=<?php echo(rand()); ?>" rel="stylesheet"/>
    <link href="css/dashboard.css?v=<?php echo(rand()); ?>" rel="stylesheet"/>
    <link rel="shortcut icon" href="https://cun.edu.co/wp-content/uploads/cropped-Icono-para-pa%CC%81gina-32x32.jpg" type="image/x-icon"> <!-- favicon -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body class="antialiased">
    <div class="wrapper">
    <?php include 'templates/header.php' ?>


    <br>
    <div class="container">
        <div class="row">

                <h1>BIENVENIDO</h1>
                <label for="">¿Que deseas realizar hoy <span></span><?php echo $nombre_corto; ?> ?</label>
                <hr style="border:1px solid #000;">

                <div class="col-lg-12 mb-3" style="display:">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Buscador</h5>
                        <input type="text" class="form-control" style="border: 1px solid #000;" id="buscador">
                      </div>
                    </div>
                </div>    

                <?php if (in_array("RP", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                            <div class="empty-img">
                                <img src="img/Roles_Perfiles.png" style="height: 100px;">
                            </div>
                            <p class="empty-title titulo_modulo">Roles y Perfiles</p>
                            <p class="empty-subtitle text-muted">
                            Podras parametrizar roles y perfiles a los usuarios
                            </p>
                            <div class="empty-action">
                                <a href="Roles.php" class="btn btn-success">
                                Ingresar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("FF", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                            <div class="empty-img">
                                <img src="img/Form_Promociones2.png" style="height: 100px;">
                            </div>
                            <p class="empty-title titulo_modulo">Form Financiacion</p>
                            <p class="empty-subtitle text-muted">
                            Capturar los datos del estudiante
                            </p>
                            <div class="empty-action">
                                <a href="../" class="btn btn-success">
                                Ingresar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("PPF", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                            <div class="empty-img">
                                <img src="img/configuraciones.png" style="height: 100px;">
                            </div>
                            <p class="empty-title titulo_modulo">Parametros Periodo</p>
                            <p class="empty-subtitle text-muted">
                            Podras parametrizar los parametros de periodo
                            </p>
                            <div class="empty-action">
                                <a href="parametros_periodo.php" class="btn btn-success">
                                Ingresar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>


                <?php if (in_array("MF", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                            <div class="empty-img">
                                <img src="img/calculadora.png" style="height: 100px;">
                            </div>
                            <p class="empty-title titulo_modulo">Financiación</p>
                            <p class="empty-subtitle text-muted">
                            Podras parametrizar los metodos de financiacion
                            </p>
                            <div class="empty-action">
                                <a href="promociones.php" class="btn btn-success">
                                Ingresar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>


                <?php if (in_array("LC", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/Logo_Credity.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Legalizados Credyty</p>
                        <p class="empty-subtitle text-muted">
                            Conciliación del archivo de credyty con las notas credito
                        </p>
                        <div class="empty-action">
                            <a href="credyty.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>


                <?php if (in_array("CN", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/nomina.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Archivo de nomina</p>
                        <p class="empty-subtitle text-muted">
                            Generar archivo de nomina electronica en formato excel
                        </p>
                        <div class="empty-action">
                            <a href="nomina.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("RF", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/Recibos_Full.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Ajuste de recibos</p>
                        <p class="empty-subtitle text-muted">
                            Permite cambiar el valor de la orden de matricula a recibos full u otros valores individuales
                        </p>
                        <div class="empty-action">
                            <a href="recibos_full.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("RPVIVSFAMA", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/vs.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">RPVI Vs FAMA</p>
                        <p class="empty-subtitle text-muted">
                            Realiza una comparativa de ordenes RPVI - FAMA
                        </p>
                        <div class="empty-action">
                            <a href="rpvi_vs_fama.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("PARM", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/ParametrizarMetas.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Parametrizar Metas</p>
                        <p class="empty-subtitle text-muted">
                            Permite parametrizar las unidades de negocio con los criterios de metas
                        </p>
                        <div class="empty-action">
                            <a href="admin_metas.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("CM", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/metas.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Cargue de Metas</p>
                        <p class="empty-subtitle text-muted">
                            Realiza el cargue de las metas del periodo
                        </p>
                        <div class="empty-action">
                            <a href="cargue_metas.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <?php if (in_array("FE", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/facturacion_electronica.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Facturación electronica</p>
                        <p class="empty-subtitle text-muted">
                            Realiza el cargue de la factura electronica comercial
                        </p>
                        <div class="empty-action">
                            <a href="facturacion_electronica.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("PD", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/diploma.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Parametrización Diplomados</p>
                        <p class="empty-subtitle text-muted">
                            Realiza la parametrizacion de las fechas de los diplomados
                        </p>
                        <div class="empty-action">
                            <a href="pdiplomados.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("AIL", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/Actualizacion_Ingreso_Laboral.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Actualizaciones Ingreso Laboral</p>
                        <p class="empty-subtitle text-muted">
                            Realiza la actualizacion de datos de los empleados en ingreso laboral
                        </p>
                        <div class="empty-action">
                            <a href="aingreso_laboral.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("CIL", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/ingreso_laboral.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Consulta Ingreso Laboral</p>
                        <p class="empty-subtitle text-muted">
                            Realiza la consulta de los empleados del aplicativo de ingreso laboral
                        </p>
                        <div class="empty-action">
                            <a href="cingreso_laboral.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if (in_array("GC", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/gestor_comercial.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Gestores Comerciales</p>
                        <p class="empty-subtitle text-muted">
                            Realiza la activación de los gestores comerciales
                        </p>
                        <div class="empty-action">
                            <a href="g_comerciales.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("AFC", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/Fechas_Cartera.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Ajuste Fechas de cartera</p>
                        <p class="empty-subtitle text-muted">
                            Realiza el ajuste de las fechas de vencimiento de la cartera
                        </p>
                        <div class="empty-action">
                            <a href="fechas_cartera.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if (in_array("VCE", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item">
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/sello-certificado.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Certificados Estudiantiles</p>
                        <p class="empty-subtitle text-muted">
                            Verificacion de certificados emitidos por el servicio web.
                        </p>
                        <div class="empty-action">
                            <a href="verificar_certificados.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>


                <?php if (in_array("USC", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item" >
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/Usabilidad_Correo.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Usabilidad Correo</p>
                        <p class="empty-subtitle text-muted">
                            Consulta la usabilidad del correo de los estudiantes
                        </p>
                        <div class="empty-action">
                            <a href="usabilidad_correo.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <?php if (in_array("AP", $accesos_arr)) { ?>
                <div class="col-lg-3 mb-3 item" >
                    <div class="card card_dashb" style="height:400px;">
                        <div class="empty">
                        <div class="empty-img"><img src="img/pago-con-tarjeta-de-credito.png" style="height: 100px;">
                        </div>
                        <p class="empty-title titulo_modulo">Aplicación de pagos</p>
                        <p class="empty-subtitle text-muted">
                            Consulta diaramente los pagos que se han procesado
                        </p>
                        <div class="empty-action">
                            <a href="aplicacion_pago.php" class="btn btn-success">
                            Ingresar
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

        </div>
    </div>


    <a href="javascript:void(0);" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a>

    </div>

    <?php include 'templates/footer.php' ?>

    <script src="js/tabler-min.js"></script>
    <script src="js/dashboard.js?v=<?php echo(rand()); ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
