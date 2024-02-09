<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
        <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
        <a href="https://cun.edu.co/" target="_blank">
            <img src="img/Logo_CUN.png" width="110" height="70" alt="Tabler">
        </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <span class="avatar avatar-sm" style="background-image: url(img/User.png)"></span>
            <div class="d-none d-xl-block ps-2">
                <div><?php echo $data_empleado['nombre']; ?></div>
                <div class="mt-1 small text-muted">Colaborador CUN</div>
            </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-ActualizarDatos">Ajustes</a>
            <a href="php/Logout.php" class="dropdown-item">Cerrar Sesion</a>
            </div>
        </div>
        </div>
    </div>
    </header>
    <div class="navbar-expand-md">

        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="dashboard.php">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
              </ul>
            
            </div>
          </div>
        </div>
      </div>

      <style>
        .valPass{
          border: 1px solid red;
        }
      </style>

      <div class="modal modal-blur fade" id="modal-ActualizarDatos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Actualizar datos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <center><label style="font-size:20px;">Cambiar contraseña</label></center>
              <hr style="border: 1px solid #000;">
              <label>Contraseña actual:</label>
              <input type="password" class="form-control" id="pass_actual">
              <br>
              <label>Contraseña nueva:</label>
              <input type="password" class="form-control" id="pass_new">
              <br>
              <label>Confirma la contraseña:</label>
              <input type="password" class="form-control" id="pass_new_confirm">
              <br>

              <div id="pswd_info">
                 <h4>La contraseña debe cumplir con los siguientes requisitos:</h4>
                 <ul>
                    <li id="letter">Al menos debería tener <strong>una letra</strong></li>
                    <li id="capital">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                    <li id="number">Al menos debería tener <strong>un número</strong></li>
                    <li id="length">Debería tener <strong>8 carácteres</strong> como mínimo</li>
                 </ul>
              </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
              <input type="button" class="btn btn-success" value="Actualizar contraseña" onclick="ActualizarPass();" id="btn_guardar_pass">
            </div>
          </div>
        </div>
      </div>

<script src="js/header.js"></script>
