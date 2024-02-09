<div class="container-fluid text-center superiorBar mb-4">
	<img src="views/resources/images/logo_blanco.png" alt="logo_cun" />
</div>

<div class="container mb-4">
		<div class="row">
			
			<div class="col-lg-6 columnaContainer text-center">
				<img src="views/resources/images/student-cun.png">
			</div>

			<input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $_SESSION["id_user"] ?>">

			<div class="col-lg-6 columnaContainer">
				<form>
					<!-- tipo de documento -->
					<select class="form-select" id="tipoDocumento">
			        <option selected value="default">Tipo de documento</option>
			        </select>
			        <label class="mb-2 errLabel" for="tipoDocumento" id="errTipoDocumento"></label>

			        <!-- documento de identidad -->
					<div class="input-group mb-3">
					  
					  <input class="form-control input-sm" type="text" id="documento" placeholder="Nro de documento">  
					  <div class="input-group-append">
					    <button id="buttonCheckNames" type="button" class="btn btn-light input-group-text" onclick="apiNames()"><i class="fas fa-check"></i></button>
					  </div>
					</div>
										
        			<label class="mb-2 errLabel" for="documento" id="errDocumento"></label>


        	<div id="checkNombres">
	        	<!-- primer nombre -->
						<input class="form-control input-sm" type="text" id="primerNombre" placeholder="Primer nombre">
	        	<label class="mb-2 errLabel" for="primerNombre" id="errPrimerNombre"></label>

	        	<!-- segundo nombre -->
						<input class="form-control input-sm" type="text" id="segundoNombre" placeholder="Segundo Nombre">
	        	<label class="mb-2 errLabel" for="segundoNombre" id="errSegundoNombre"></label>

	        	<!-- primer apellido -->
						<input class="form-control input-sm" type="text" id="primerApellido" placeholder="Primer apellido">
	        	<label class="mb-2 errLabel" for="primerApellido" id="errPrimerApellido"></label>

	        	<!-- segundo apellido -->
						<input class="form-control input-sm" type="text" id="segundoApellido" placeholder="Segundo apellido">
	        	<label class="mb-2 errLabel" for="segundoApellido" id="errSegundoApellido"></label>

	       	</div>

	       	<!-- genero -->
        		<select class="form-select mb-2" id="genero">
			          <option selected value="default">Género</option>
			          <option value="M">Masculino</option>
			          <option value="F">Femenino</option>
			      </select>
			      <label class="mb-2 errLabel" for="genero" id="errGenero"></label>


			      <div>
        			<hr>
			        
			        <!--fecha de nacimiento-->
			        <label for="fechaNacimiento">Fecha de nacimiento</label>
			        <input class="form-control input-sm mb-2" type="date" id="fechaNacimiento"/>
			        <label class="mb-2 errLabel" for="fechaNacimiento" id="errFechaNacimiento"></label>

			        <hr>

			        <!--fecha de expedicion de documento-->
			        <label for="fechaExpedicion">Fecha de expedición del documento</label>
			        <input class="form-control input-sm" type="date" id="fechaExpedicion"/>
			        <label class="mb-2 errLabel" for="fechaExpedicion" id="errFechaExpedicion"></label>

			        <hr>

			        <!-- telefono fijo -->
							<div class="input-group">
							  <div class="input-group-prepend">
							    <span class="input-group-append" id="inputGroup-sizing-default">
							    	
							    	<select class="form-select" id="indicativo">
							          <option selected value="default">Indicativo</option>
							          <option value="601">601</option>
							          <option value="602">602</option>
							          <option value="603">603</option>
							          <option value="604">604</option>
							          <option value="605">605</option>
							          <option value="606">606</option>
							          <option value="607">607</option>
							          <option value="608">608</option>
							          <option value="609">609</option>
							      </select>

							    </span>
							  </div>

								<input class="form-control input-sm" type="text" id="telefonoFijo" placeholder="Telefono fijo">  
							</div>
			        <label class="mb-2 errLabel" for="indicativo" id="errIndicativo"></label>
			        <label class="mb-2 errLabel" for="telefonoFijo" id="errTelefonoFijo"></label>
			        
			        </div>

			        <!-- celular -->
							<input class="form-control input-sm" type="text" id="celular" placeholder="Celular">
        			<label class="mb-2 errLabel" for="celular" id="errCelular"></label>

        			<!-- correo -->
							<input class="form-control input-sm" type="email" id="correo" placeholder="Correo">
        			<label class="mb-2 errLabel" for="correo" id="errCorreo"></label>

        			<hr>

        			<!-- cubrimiento -->
        			<select class="form-select mb-2" id="cubrimiento" style="display:none;">
			            <option selected value="default">Modalidad</option>
			            <option value="Virtual">Virtual</option>
			            <option value="Presencial">Presencial</option>
			            <option value="Distancia">Distancia</option>
			        </select>
			        <label class="mb-2 errLabel" for="cubrimiento" id="errCubrimiento"></label>

			        <!-- promocion -->
        			<select class="form-select mb-2" id="promocion">
			            <option selected value="default">Promoción</option>
			        </select>
			        <label class="mb-2 errLabel" for="promocion" id="errPromocion"></label>

			        <!-- periodo academico -->
        			<select class="form-select mb-2" id="periodo">
			            <option selected value="default">Periodo académico</option>
			        </select>
			        <label class="mb-2 errLabel" for="periodo" id="errPeriodo"></label>

			        <!-- programa academico -->
        			<select class="form-select mb-2" id="programa">
			            <option selected value="default">Programa académico</option>
			        </select>
			        <label class="mb-2 errLabel" for="programa" id="errPrograma"></label>


			        <!-- ciclo propedeutico -->
        			<select class="form-select mb-2" id="ciclo">
			            <option selected value="default">Tipo de formación</option>
			        </select>
			        <label class="mb-2 errLabel" for="ciclo" id="errCiclo"></label>

			        <!-- tipo de formacion -->
        			<select class="form-select mb-2" id="tipoFormacion">
			            <option selected value="default">Tipo de ingreso</option>
			        </select>
			        <label class="mb-2 errLabel" for="tipoFormacion" id="errTipoFormacion"></label>

			        <!-- valor matricula - idiomas - servicio medico -->
        			<select class="form-select mb-2" id="valorMatricula">
			            <option selected value="default">Valor matricula - idiomas - servicio médico</option>
			        </select>
			        <label class="mb-2 errLabel" for="valorMatricula" id="errValorMatricula"></label>

			        <!-- valor matricula - idiomas - servicio medico -->
        			<select class="form-select mb-2" id="valorDescuento">
			            <option selected value="1">Sin descuento</option>
			        </select>
			        <label class="mb-2 errLabel" for="valorDescuento" id="errvalorDescuento"></label>

			        <!-- cuotas -->
        			<select class="form-select mb-2" id="cuotas" style="display:none;">
			            <option selected value="default">Nro de cuotas</option>
			        </select>
			        <label class="mb-2 errLabel" for="cuotas" id="errCuotas"></label>

			        <div class="text-center mt-4">
			        	<button type="button" class="btn btn-registro" onclick="registrar()">Registrar</button>
			        </div>

			    </form>
			</div>

		</div>		
</div>


<!-- Modal Beneficiario -->
<div class="modal fade text-dark" id="agregaNuevo" tabindex="-1" aria-labelledby="agregaNuevo" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="agregaNuevo">Datos de beneficiario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        	<form>
					<!-- tipo de documento -->
					<select class="form-select" id="tipoDocumento_b">
			            <option selected value="default">Tipo de documento</option>
			        </select>
			        <label class="mb-2 errLabel" for="tipoDocumento_b" id="errTipoDocumento_b"></label>

			        <!-- documento de identidad -->
							<div class="input-group mb-3">
							  <input class="form-control input-sm" type="text" id="documento_b" placeholder="Nro de documento">
							  <div class="input-group-append">
							    <button type="button" class="btn btn-light input-group-text" onclick="apiNames_b()"><i class="fas fa-check"></i></button>
							  </div>
							</div>
							<label class="mb-2 errLabel" for="documento_b" id="errDocumento_b"></label>
										
        			<!-- primer nombre -->
							<input class="form-control input-sm" type="text" id="primerNombre_b" placeholder="Primer nombre">
        			<label class="mb-2 errLabel" for="primerNombre_b" id="errPrimerNombre_b"></label>

        			<!-- segundo nombre -->
							<input class="form-control input-sm" type="text" id="segundoNombre_b" placeholder="Segundo Nombre">
        			<label class="mb-2 errLabel" for="segundoNombre_b" id="errSegundoNombre_b"></label>

        			<!-- primer apellido -->
							<input class="form-control input-sm" type="text" id="primerApellido_b" placeholder="Primer apellido">
        			<label class="mb-2 errLabel" for="primerApellido_b" id="errPrimerApellido_b"></label>

        			<!-- segundo apellido -->
							<input class="form-control input-sm" type="text" id="segundoApellido_b" placeholder="Segundo apellido">
        			<label class="mb-2 errLabel" for="segundoNombre_b" id="errSegundoApellido_b"></label>

        			<!-- genero -->
        			<select class="form-select mb-2" id="genero_b">
			            <option selected value="default">Género</option>
			            <option value="M">Masculino</option>
			            <option value="F">Femenino</option>
			        </select>
			        <label class="mb-2 errLabel" for="genero_b" id="errGenero_b"></label>

			        <hr>
			        
			        <!--fecha de nacimiento-->
			        <label for="fechaNacimiento_b">Fecha de nacimiento</label>
			        <input class="form-control input-sm mb-2" type="date" id="fechaNacimiento_b"/>
			        <label class="mb-2 errLabel" for="fechaNacimiento_b" id="errFechaNacimiento_b"></label>

			        <hr>

			        <!--fecha de expedicion de documento-->
			        <label for="fechaExpedicion_b">Fecha de expedición del documento</label>
			        <input class="form-control input-sm" type="date" id="fechaExpedicion_b"/>
			        <label class="mb-2 errLabel" for="fechaExpedicion_b" id="errFechaExpedicion_b"></label>

			        <hr>

			        <!-- telefono fijo -->
							<div class="input-group">
							  <div class="input-group-prepend">
							    <span class="input-group-append" id="inputGroup-sizing-default">
							    	
							    	<select class="form-select" id="indicativo_b">
							          <option selected value="default">Indicativo</option>
							          <option value="601">601</option>
							          <option value="602">602</option>
							          <option value="603">603</option>
							          <option value="604">604</option>
							          <option value="605">605</option>
							          <option value="606">606</option>
							          <option value="607">607</option>
							          <option value="608">608</option>
							          <option value="609">609</option>
							      </select>

							    </span>
							  </div>

								<input class="form-control input-sm" type="text" id="telefonoFijo_b" placeholder="Telefono fijo">  
							</div>
			        <label class="mb-2 errLabel" for="indicativo_b" id="errIndicativo_b"></label>
			        <label class="mb-2 errLabel" for="telefonoFijo_b" id="errTelefonoFijo_b"></label>


			        <!-- celular -->
							<input class="form-control input-sm" type="text" id="celular_b" placeholder="Celular">
        			<label class="mb-2 errLabel" for="celular_b" id="errCelular_b"></label>

        			<!-- correo -->
							<input class="form-control input-sm" type="email" id="correo_b" placeholder="Correo">
        			<label class="mb-2 errLabel" for="correo_b" id="errCorreo_b"></label>
        			
			</form>
        

      </div>
      
      <div class="modal-footer">
				<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> -->
        <button type="button" class="btn btn-success" onclick="agregaBeneficiario()">Guardar</button>
      </div>

    </div>
  </div>
</div>
