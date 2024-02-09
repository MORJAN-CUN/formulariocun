<?php
//Validar si la pass es igual a la cedula
$id_empleado = $_SESSION['id_user'];

//Enviar ID por cURL para consultar datos del empleado
$url = 'http://190.184.202.251:8090/formularioback/Admin/DatosEmpleado.php';
//$url = 'http://localhost/CUN/formularioback/Admin/DatosEmpleado.php';

$datos = array(
	'id' => $id_empleado
);

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


$result = curl_exec($ch);

curl_close($ch);

$data_empleado = json_decode($result,true);

$password = $data_empleado['password'];
$cedula = $data_empleado['cedula'];

if($password == $cedula){

	?>

	<script type="text/javascript">
		
		window.onload = LoadModal;
		function LoadModal(){
			$("#modal-ActualizarPass_bloq").modal('show');
			//$('#modal-ActualizarPass').modal({backdrop: 'static', keyboard: false})
		}

	</script>


	<!-- Modal -->
	<div class="modal fade" id="modal-ActualizarPass_bloq" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Actualizar contraseña</h5>
	      </div>
	      <div class="modal-body">
	        <center><label style="font-size:20px;">Debes cambiar tu contraseña</label></center>
	              <hr style="border: 1px solid #000;">
	              <label>Contraseña actual:</label>
	              <input type="password" class="form-control" id="pass_actual_bloq">
	              <br>
	              <label>Contraseña nueva:</label>
	              <input type="password" class="form-control" id="pass_new_bloq">
	              <br>
	              <label>Confirma la contraseña:</label>
	              <input type="password" class="form-control" id="pass_new_confirm_bloq">
	              <br>

	              <div id="pswd_info2">
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
	            <input type="button" class="btn btn-success" value="Actualizar contraseña" onclick="ActualizarPassNew();" id="btn_guardar_pass">
	      </div>
	    </div>
	  </div>
	</div>

	<script src="js/ValPass.js?v=<?php echo(rand()); ?>"></script>

	<?php

}
