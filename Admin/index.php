<?php
session_start();

// Destruir todas las variables de sesión.
$_SESSION = array();

// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>✅ Login - CUN</title>
<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
<link rel="shortcut icon" href="https://cun.edu.co/wp-content/uploads/cropped-Icono-para-pa%CC%81gina-32x32.jpg" type="image/x-icon"> <!-- favicon -->
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/btnGoogle.css?v=<?php echo(rand()); ?>">
</head>
<body class='snippet-body'>

<div class="container px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">

            <div class="col-12">
                <br>
                <center><h3 class="or text-center">App Servicios CUN</h3></center>
            </div>

            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row logo"></div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="img/Logo_CUN.png" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    
                    <div class="row px-12 mb-4">
                        <div class="line"></div> 
                        <br>
                        <small class="or text-center" style="font-size:20px;">Necesitamos los siguientes datos</small>
                    </div>
                    <br><br>
                    <div class="row px-3">
                        <h6 class="mb-0 text-sm">Email</h6>
                        <input class="mb-4" type="text" id="email" autocomplete="off" onkeypress="Login(event)"> 
                    </div>
                    <div class="row px-3">
                        <h6 class="mb-0 text-sm">Contraseña</h6>
                        <input type="password" id="password" autocomplete="off" onkeypress="Login(event)"> 
                    </div>
                    <br>
                    <div class="row mb-3 px-3">
                        <button type="submit" class="btn btn-success text-center form-control" onclick="AccederN();">Acceder</button> 
                        <br><br>

                        <div class='g-sign-in-button' style="display:none;">
                            <div class=content-wrapper>
                                <div class='logo-wrapper'>
                                    <img src='https://developers.google.com/identity/images/g-logo.png'>
                                </div>
                                <span class='text-container'>
                                    <span>Acceder con Google</span>
                                </span>
                            </div>
                        </div>

                        <a href="#" class="text-center form-control" style="border:none;display: none;" data-toggle="modal" data-target="#Modal-CambiarPass">¿Has olvidado tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-green py-4">
            <div class="row px-3"> 
                <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2021. Todos los derechos reservados.</small>
                <div class="social-contact ml-4 ml-sm-auto"> 
                    <span class="fa fa-facebook mr-4 text-sm"></span> 
                    <span class="fa fa-google-plus mr-4 text-sm"></span> 
                    <span class="fa fa-linkedin mr-4 text-sm"></span> 
                    <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> 
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="Modal-CambiarPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label style="font-size:17px;">Necesitamos los siguientes datos:</label>
        <br><br>
        <div class="row px-3">
            <h6 class="mb-0 text-sm">Email</h6>
            <input class="mb-4" type="text" id="email_recovery" autocomplete="off"> 
        </div>
        <div class="row px-3">
            <h6 class="mb-0 text-sm">Cedula</h6>
            <input class="mb-4" type="text" id="cedula_recovery" autocomplete="off"> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" onclick="SolicitarNewPass();">Solicitar</button>
      </div>
    </div>
  </div>
</div>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/index.js?v=<?php echo(rand()); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
