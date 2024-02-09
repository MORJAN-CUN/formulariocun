$(document).ready(function(){

	if( $("#usuario_id").val() == '' ) return location.href = '/formulariocun/errors?err=404&messageErr=Usuario sin la sesión iniciada';

	//Eventos con el focus y validacion de campos en tiempo real
	$('#tipoDocumento').addClass('focus');
	$('#tipoDocumento').focus();

	//validamos el tipo de documento
	$('#tipoDocumento').on('change',function(){
		tipoDocumento = $(this).val();

		if(tipoDocumento == 'default'){
			$('#tipoDocumento').addClass('focus');
			$('#tipoDocumento').focus();
			errTipoDocumento = '* Selecciona el tipo de documento';
			$('#errTipoDocumento').html(errTipoDocumento);
		}else{
			errTipoDocumento = '';
			$('#errTipoDocumento').html(errTipoDocumento);

			$('#tipoDocumento').removeClass('focus');
			$('#documento').addClass('focus');
			$('#documento').focus();
		}
	});

	//validamos el documento
	$('#documento').on('input',function(){
		$('#documento').removeClass('focus');
		
		documento = $(this).val();
		
		if(!documento){
			errDocumento = '* Ingresa # de documento';
			$('#errDocumento').html(errDocumento);
			$('#documento').addClass('focus');
		}else if(!$.isNumeric(documento)){
			errDocumento = '* Formato no válido';
			$('#errDocumento').html(errDocumento);
			$('#documento').addClass('focus');
		}else{
			errDocumento = '';
			$('#errDocumento').html(errDocumento);
			$('#buttonCheckNames').addClass('buttonCheckNames');
		}

	});
	
	$('#buttonCheckNames').on('click',function(){
		$('#buttonCheckNames').removeClass('buttonCheckNames');
		$('#checkNombres').addClass('boxCheckNames');
		$('#genero').addClass('buttonCheckNames');
	});

	//validamos el primer nombre
	$('#primerNombre').on('keyup',function(){
		primerNombre = $(this).val();
		regex = /^[a-zA-ZñÑ]+$/;
  		
		if(!primerNombre){
			errPrimerNombre = '* Ingresa el primer nombre';
			$('#errPrimerNombre').html(errPrimerNombre);
		}else if(!regex.test(primerNombre)){
			errPrimerNombre = '* Formato no válido';
			$('#errPrimerNombre').html(errPrimerNombre);
		}else{
			errPrimerNombre = '';
			$('#errPrimerNombre').html(errPrimerNombre);
		}
	});

	//validamos el segundo nombre
	$('#segundoNombre').on('keyup',function(){
		segundoNombre = $(this).val();
		var regex = /^[a-zA-ZñÑ]+$/;

		if(!regex.test(segundoNombre)){
			errSegundoNombre = '* Formato no válido';
			$('#errSegundoNombre').html(errSegundoNombre);
		}else{
			errSegundoNombre = '';
			$('#errSegundoNombre').html(errSegundoNombre);
		}

	});

	$('#segundoNombre').blur(function(){
		segundoNombre = $(this).val();
		
		if(segundoNombre == ''){
			errSegundoNombre = '';
			$('#errSegundoNombre').html(errSegundoNombre);	
		}
		
	});

	//validamos el primer apellido
	$('#primerApellido').on('keyup',function(){
		primerApellido = $(this).val();
		regex = /^[a-zA-ZñÑ]+$/;
  		
		if(!primerApellido){
			errPrimerApellido = '* Ingresa el primer apellido';
			$('#errPrimerApellido').html(errPrimerApellido);
		}else if(!regex.test(primerApellido)){
			errPrimerApellido = '* Formato no válido';
			$('#errPrimerApellido').html(errPrimerApellido);
		}else{
			errPrimerApellido = '';
			$('#errPrimerApellido').html(errPrimerApellido);
		}
	});

	//validamos el segundo apellido
	$('#segundoApellido').on('keyup',function(){
		segundoApellido = $(this).val();
		var regex = /^[a-zA-ZñÑ]+$/;

		if(!regex.test(segundoApellido)){
			errSegundoApellido = '* Formato no válido';
			$('#errSegundoApellido').html(errSegundoApellido);
		}else{
			errSegundoApellido = '';
			$('#errSegundoApellido').html(errSegundoApellido);
		}

	});

	$('#segundoApellido').blur(function(){
		segundoApellido = $(this).val();
		
		if(segundoApellido == ''){
			errSegundoApellido = '';
			$('#errSegundoApellido').html(errSegundoApellido);	
		}
		
	});
	
	//validamos genero
	$('#genero').on('change',function(){
		genero = $(this).val();
		$('#checkNombres').removeClass('boxCheckNames');
		
		if(genero == 'default'){
			errGenero = '* Selecciona el genero';
			$('#errGenero').html(errGenero);
			$('#genero').addClass('focus');
			$('#genero').focus();
		}else{
			errGenero = '';
			$('#errGenero').html(errGenero);
			$('#genero').removeClass('buttonCheckNames');
			$('#fechaNacimiento').addClass('focus');
			$('#fechaNacimiento').focus();
		}

	});

	//validamos fecha de nacimiento
	$('#fechaNacimiento').on('change',function(){
		$('#fechaNacimiento').removeClass('focus');

		fechaNacimiento = $(this).val(); 
		
		//input date
		bd = new Date($(this).val());
		y_bd = bd.getFullYear();

		//valid range date
		md = new Date('2007-01-01');
		y_md = md.getFullYear();

		if(!fechaNacimiento){
			errFechaNacimiento = '* Selecciona la fecha de nacimiento';
			$('#errFechaNacimiento').html(errFechaNacimiento);
		}else if(y_bd > y_md){
			errFechaNacimiento = '* Fecha no válida';
			$('#errFechaNacimiento').html(errFechaNacimiento);
		}else{
			$('#fechaExpedicion').addClass('buttonCheckNames');
			errFechaNacimiento = '';
			$('#errFechaNacimiento').html(errFechaNacimiento);
		}

	});

	//validamos fecha de expedicion
	$('#fechaExpedicion').on('change',function(){
		$('#fechaExpedicion').removeClass('buttonCheckNames');
		fechaExpedicion = $(this).val();
		tipoDocumento = $('#tipoDocumento').val(); 
		fechaNacimiento = $('#fechaNacimiento').val();
		
		//input date
		bd = new Date(fechaNacimiento);
		y_bd = bd.getFullYear();
		age = y_bd + 18;
		
		//valid range date
		de = new Date(fechaExpedicion);
		y_de = de.getFullYear() + 1;

		if(!fechaExpedicion){
			errFechaExpedicion = '* Selecciona la fecha de expedicion';
			$('#errFechaExpedicion').html(errFechaExpedicion);
		}else if(typeof tipoDocumento != 'undefined' && tipoDocumento == 'C'){
			if(y_de < age){
				errFechaExpedicion = '* Fecha no válida';
				$('#errFechaExpedicion').html(errFechaExpedicion);
			}else{
				errFechaExpedicion = '';
				$('#errFechaExpedicion').html(errFechaExpedicion);
				$('#telefonoFijo').addClass('buttonCheckNames');	
			}
		}else{
			errFechaExpedicion = '';
			$('#errFechaExpedicion').html(errFechaExpedicion);
			$('#telefonoFijo').addClass('buttonCheckNames');
		
		}

		

	});

	//validamos indicativo
	$('#indicativo').on('change',function(){
		indicativo = $(this).val();
				
		if(indicativo == 'default'){
			errIndicativo = '* Selecciona el indicativo';
			$('#errIndicativo').html(errIndicativo);
			$('#indicativo').addClass('focus');
			$('#indicativo').focus();
		}else{
			errIndicativo = '';
			$('#errIndicativo').html(errIndicativo);
			$('#indicativo').removeClass('buttonCheckNames');
		}

	});

	//validamos telefono
	$('#telefonoFijo').on('input',function(){
		telefonoFijo = $(this).val();

		if(!telefonoFijo){
			errTelefonoFijo = '* Ingresa # de telefono';
			$('#errTelefonoFijo').html(errTelefonoFijo);
			$('#telefonoFijo').addClass('focus');
			$('#telefonoFijo').focus();
		}else if(!$.isNumeric(telefonoFijo)){
			errTelefonoFijo = '* Formato de telefono no válido';
			$('#errTelefonoFijo').html(errTelefonoFijo);
			$('#telefonoFijo').addClass('focus');
			$('#telefonoFijo').focus();
		}else{
			errTelefonoFijo = '';
			$('#errTelefonoFijo').html(errTelefonoFijo);
			$('#telefonoFijo').removeClass('focus');
			$('#telefonoFijo').removeClass('buttonCheckNames');
			$('#celular').addClass('buttonCheckNames');

		}

	});

	
	//validamos celular
	$('#celular').on('input',function(){
		$('#celular').removeClass('buttonCheckNames');
		
		celular = $(this).val();
		
		if(!celular){
			errCelular = '* Ingresa # de celular';
			$('#errCelular').html(errCelular);
			$('#celular').addClass('focus');
			$('#celular').focus();
		}else if(!$.isNumeric(celular)){
			errCelular = '* Formato no válido';
			$('#errCelular').html(errCelular);
			$('#celular').addClass('focus');
			$('#celular').focus();
		}else if(!celular.startsWith('3')){
			errCelular = '* Número no válido';
			$('#errCelular').html(errCelular);
			$('#celular').addClass('focus');
			$('#celular').focus();
		}else if(celular.length != 10){
			errCelular = '* El número debe ser de 10 digitos';
			$('#errCelular').html(errCelular);
			$('#celular').addClass('focus');
			$('#celular').focus();
		}else{
			errCelular = '';
			$('#errCelular').html(errCelular);
			$('#celular').removeClass('focus');
			$('#correo').addClass('focus');
			$('#correo').focus();
		}
		
	});

	//validamos correo
	$('#correo').on('input',function(){
		$('#correo').removeClass('buttonCheckNames');
		$('#cubrimiento').addClass('buttonCheckNames');

		correo = $('#correo').val();
		
		regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;

		if(!correo){
			errCorreo = '* Ingresa el correo';
			$('#errCorreo').html(errCorreo);
		}else if(!regexEmail.test(correo)){
			errCorreo = '* Formato de correo no válido';
			$('#errCorreo').html(errCorreo);
		}else{
			errCorreo = '';
			$('#errCorreo').html(errCorreo);
		}

	});

	//validamos cubrimiento
	$('#cubrimiento').on('change',function(){
		$('#cubrimiento').removeClass('buttonCheckNames');
		$('#promocion').addClass('focus');
		$('#promocion').focus();
	});

	$('#promocion').on('change',function(){
		$('#promocion').removeClass('focus');
		$('#periodo').addClass('focus');
		$('#periodo').focus();
	});

	$('#periodo').on('change',function(){
		$('#periodo').removeClass('focus');
		$('#programa').addClass('focus');
		$('#programa').focus();
	});

	$('#programa').on('change',function(){
		$('#programa').removeClass('focus');
		$('#ciclo').addClass('focus');
		$('#ciclo').focus();
	});

	$('#ciclo').on('change',function(){
		$('#ciclo').removeClass('focus');
		$('#tipoFormacion').addClass('focus');
		$('#tipoFormacion').focus();
	});

	$('#tipoFormacion').on('change',function(){
		$('#tipoFormacion').removeClass('focus');
		$('#valorMatricula').addClass('focus');
		$('#valorMatricula').focus();
	});
	
	$('#valorMatricula').on('change',function(){
		$('#valorMatricula').removeClass('focus');
		$('#valorDescuento').addClass('focus');
		$('#valorDescuento').focus();
	});

/*
	$('#valorMatricula').on('change',function(){
		$('#valorMatricula').removeClass('focus');
		$('#cuotas').addClass('focus');
		$('#cuotas').focus();
	});
*/
	//serverLocation = 'localhost';
	serverLocation = '190.184.202.251:8090/formularioback';

	//select tipo de documento
	$.ajax({
			url: 'http://'+serverLocation+'/tipo_documento.php',
			type: 'POST',
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].tipo_documento+'">'+obj[i].nombre_tipo_documento+'</option>';
                }
                
                $('#tipoDocumento').html(objHtml);
			}
		});

	//regionales o cubrimiento
	$.ajax({
			url: 'http://'+serverLocation+'/regional.php',
			type: 'POST',
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].nombre_regional+'">'+obj[i].nombre_regional+'</option>';
                }
                
                $('#cubrimiento').html('<option selected value="default">Cubrimiento</option>'+objHtml);
			}
		});


	//select tipo de promocion
	$.ajax({
			url: 'http://'+serverLocation+'/promocion_disponible.php',
			type: 'POST',
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].promocion+'">'+obj[i].promocion+'</option>';
                }
                
                $('#promocion').html('<option selected value="default">Método de financiamiento</option>'+objHtml);

            
				$('#promocion').on('change',function(){
					promocion = $(this).val();

					if(promocion == '2 X 1' || promocion == 'CUN VIVE 2 X 1'){
						//aca disparamos el modal
						$("#agregaNuevo").modal("show");

						cargaTipoDoc_b();
					}

				});
			}
		});

	promocion = $('#promocion').val();

});

//funcion para la carga de select del beneficiario
function cargaTipoDoc_b(){
	$.ajax({
			url: 'http://'+serverLocation+'/tipo_documento.php',
			type: 'POST',
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].tipo_documento+'">'+obj[i].nombre_tipo_documento+'</option>';
                }
                
                $('#tipoDocumento_b').html('<option selected value="default">Tipo de documento</option>'+objHtml);
			}
		});
}

///////////////////////////Selects anidados//////////////////////////

$('#promocion').on('change',function(){

	promocion = $(this).val();

	$.ajax({
		url: 'http://'+serverLocation+'/periodo.php',
		type: 'POST',
		data: 'promocion='+promocion,
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
			var objHtml = '';
			
			for(var i=0; i< obj.length; i++){
				objHtml += '<option value ="'+obj[i].periodo+'">'+obj[i].periodo+'</option>';
			}
			
			$('#periodo').html('<option selected value="default">Periodo académico</option>'+objHtml);
		}
	});

});


//cuando cambie periodo carga el programa
$('#periodo').on('change',function(){
	periodo = $(this).val();
	promocion = $('#promocion').val();

	$.ajax({
			url: 'http://'+serverLocation+'/programa.php',
			type: 'POST',
			data: 'periodo='+periodo+'&promocion='+promocion,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].programa+'">'+obj[i].programa+'</option>';
                }
                
                $('#programa').html('<option selected value="default">Programa académico</option>'+objHtml);
			}
	});

	/// Consultar los descuentos disponibles

	$.ajax({
		url: 'http://'+serverLocation+'/descuentos.php',
		type: 'POST',
		data: 'periodo='+periodo,
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
			var objHtml = '';
			
			for(var i=0; i< obj.length; i++){
				objHtml += '<option value ="'+obj[i].grupo+'">'+obj[i].porcentaje+'%</option>';
			}
			
			$('#valorDescuento').html('<option selected value="1">Sin descuento</option>'+objHtml);
		}
	});	
});


//cuando cambie periodo carga el programa

	



//cuando cambie programa se carga el ciclo
$('#programa').on('change',function(){
	programa = $(this).val();
	periodo =  $("#periodo").val();
	promocion = $('#promocion').val();

	$.ajax({
			url: 'http://'+serverLocation+'/ciclo.php',
			type: 'POST',
			data: 'programa='+programa+'&periodo='+periodo+'&promocion='+promocion,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].ciclo+'">'+obj[i].ciclo+'</option>';
                }
                $("#txt_plan_estudios").show();
                $('#ciclo').html('<option selected value="default">Tipo de formación</option>'+objHtml);
			}
		});
});


//cuando cambie el ciclo carga el tipo de formacion
$('#ciclo').on('change',function(){
	ciclo = $(this).val();
	programa = $('#programa').val();
	periodo =  $("#periodo").val();
	promocion = $('#promocion').val();

	$.ajax({
			url: 'http://'+serverLocation+'/tipo_formacion.php',
			type: 'POST',
			data: 'programa='+programa+'&periodo='+periodo+'&promocion='+promocion+'&ciclo='+ciclo,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].tipo_inscripcion+'">'+obj[i].tipo_inscripcion+'</option>';
                }
                
                $('#tipoFormacion').html('<option selected value="default">Tipo de Ingreso</option>'+objHtml);
			}
		});
});


//cuando cambie tipo formacion carga valor de matricula
$('#tipoFormacion').on('change',function(){
	tipoFormacion = $(this).val();
	ciclo = $('#ciclo').val();
	programa = $('#programa').val();
	periodo =  $("#periodo").val();
	promocion = $('#promocion').val();

	$.ajax({
			url: 'http://'+serverLocation+'/valor_matricula.php',
			type: 'POST',
			data: 'programa='+programa+'&periodo='+periodo+'&promocion='+promocion+'&ciclo='+ciclo+'&tipoFormacion='+tipoFormacion,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].valor_matricula+'">$'+obj[i].valor_matricula+' | $'+obj[i].valor_idiomas+' | $'+obj[i].valor_servicio+'</option>';
                }
                
                $('#valorMatricula').html('<option selected value="default">Valor matricula - idiomas - servicio médico</option>'+objHtml);
			}
		});
});

/*
//cuando cambie valor matricula se carga cuotas
$('#valorMatricula').on('change',function(){
	valorMatricula = $(this).val();
	tipoFormacion = $('#tipoFormacion').val();
	ciclo = $('#ciclo').val();
	programa = $('#programa').val();
	periodo =  $("#periodo").val();
	promocion = $('#promocion').val();

	$.ajax({
			url: 'http://'+serverLocation+'/cuotas.php',
			type: 'POST',
			data: 'programa='+programa+'&periodo='+periodo+'&promocion='+promocion+'&ciclo='+ciclo+'&tipoFormacion='+tipoFormacion+'&valorMatricula='+valorMatricula,
			success: function(r){
				
				var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';

                for(var i=0; i< obj[0]['cuotas']; i++){

                    objHtml += '<option value ="'+(i+1)+'">'+(i+1)+'</option>';
                }
                
                $('#cuotas').html('<option selected value="default">Nro de cuotas</option>'+objHtml);
			}
		});


});
*/

function registrar() {
	//capturamos campos para validacion
	tipoDoc = $('#tipoDocumento').val();
	documento = $('#documento').val();
	primerNombre = $('#primerNombre').val();
	segundoNombre = $('#segundoNombre').val();
	primerApellido = $('#primerApellido').val();
	segundoApellido = $('#segundoApellido').val();
	genero = $('#genero').val();
	//genero = 'M';
	fechaNacimiento = $('#fechaNacimiento').val();
	//fechaNacimiento = '1999-01-01';
	fechaExpedicion = $('#fechaExpedicion').val();
	//fechaExpedicion = '2017-01-01';
	telefonoFijo = $('#telefonoFijo').val();
	//telefonoFijo = '00000000';
	indicativo = $('#indicativo').val();
	//indicativo = '601';
	celular = $('#celular').val();
	correo = $('#correo').val();
	cubrimiento = $('#cubrimiento').val();
	//cubrimiento = 'Bogota';
	promocion = $('#promocion').val();
	//promocion = $('#promocion').val();
	periodo = $('#periodo').val();
	//periodo =  $("#periodo").val();
	programa = $('#programa').val();
	ciclo = $('#ciclo').val();
	tipoFormacion = $('#tipoFormacion').val();
	valorMatricula = $('#valorMatricula').val();
	valorDescuento = $('#valorDescuento').val();
	//cuotas = $('#cuotas').val();
	cuotas = 4;

	regex = /^[a-zA-ZñÑ]+$/;

	//validamos tipo documento
	if(tipoDoc == 'default'){
		errTipoDocumento = '* Selecciona el tipo de documento';
		$('#errTipoDocumento').html(errTipoDocumento);
	}else{
		errTipoDocumento = '';
		$('#errTipoDocumento').html(errTipoDocumento);
		tipoDoc = $('#tipoDocumento').val();
	}

	
	//validamos documento
	if(documento == ''){
		errDocumento = '* Ingresa el # de documento';
		$('#errDocumento').html(errDocumento);
	}else if(!$.isNumeric(documento)){
		errDocumento = '* Formato no válido';
		$('#errDocumento').html(errDocumento);
	}else{
		errDocumento = '';
		$('#errDocumento').html(errDocumento);
		documento = $('#documento').val();
	}

	//validamos primer nombre
	if(!primerNombre){
			errPrimerNombre = '* Ingresa el primer nombre';
			$('#errPrimerNombre').html(errPrimerNombre);
		}else if(!regex.test(primerNombre)){
			errPrimerNombre = '* Formato no válido';
			$('#errPrimerNombre').html(errPrimerNombre);
		}else{
			errPrimerNombre = '';
			$('#errPrimerNombre').html(errPrimerNombre);
			primerNombre = $('#primerNombre').val();
			primerNombre = primerNombre.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
		}

	//validamos segundo nombre
	if(segundoNombre == ''){
		errSegundoNombre = '';
		$('#errSegundoNombre').html(errSegundoNombre);
		segundoNombre = $('#segundoNombre').val();
		segundoNombre = segundoNombre.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
	}else if(!regex.test(segundoNombre)){
		errSegundoNombre = '* Formato no válido';
		$('#errSegundoNombre').html(errSegundoNombre);
	}
	

	//validamos primer apellido
	if(!primerApellido){
			errPrimerApellido = '* Ingresa el primer apellido';
			$('#errPrimerApellido').html(errPrimerApellido);
		}else if(!regex.test(primerApellido)){
			errPrimerApellido = '* Formato no válido';
			$('#errPrimerApellido').html(errPrimerApellido);
		}else{
			errPrimerApellido = '';
			$('#errPrimerApellido').html(errPrimerApellido);
			primerApellido = $('#primerApellido').val();
			primerApellido = primerApellido.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
		}

	
	//validamos segundo apellido
	if(segundoApellido == ''){
		errSegundoApellido = '';
		$('#errSegundoApellido').html(errSegundoApellido);
		segundoApellido = $('#segundoApellido').val();
		segundoApellido = segundoApellido.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
	}else if(!regex.test(segundoApellido)){
		errSegundoApellido = '* Formato no válido';
		$('#errSegundoApellido').html(errSegundoApellido);
	}


	//validamos genero
	if(genero == 'default'){
		errGenero = '* Selecciona el genero';
		$('#errGenero').html(errGenero);
	}else{
		errGenero = '';
		$('#errGenero').html(errGenero);
		genero = $('#genero').val();
	}

	//validamos fecha de nacimiento
		//input date
		bd = new Date(fechaNacimiento);
		y_bd = bd.getFullYear();

		//valid range date
		md = new Date('2007-01-01');
		y_md = md.getFullYear();

		if(!fechaNacimiento){
			errFechaNacimiento = '* Selecciona la fecha de nacimiento';
			$('#errFechaNacimiento').html(errFechaNacimiento);
		}else if(y_bd > y_md){
			errFechaNacimiento = '* Fecha no válida';
			$('#errFechaNacimiento').html(errFechaNacimiento);
		}else{
			errFechaNacimiento = '';
			$('#errFechaNacimiento').html(errFechaNacimiento);
			fechaNacimiento = $('#fechaNacimiento').val();
		}

	//validamos fecha de expedicion
		//input date
		bd = new Date(fechaNacimiento);
		y_bd = bd.getFullYear();
		age = y_bd + 18;
		
		//valid range date
		de = new Date(fechaExpedicion);
		y_de = de.getFullYear();

		if(!fechaExpedicion){
			errFechaExpedicion = '* Selecciona la fecha de expedicion';
			$('#errFechaExpedicion').html(errFechaExpedicion);
		}else if(typeof tipoDocumento != 'undefined' && tipoDocumento == 'C'){
			if(y_de < age){
				errFechaExpedicion = '* Fecha no válida';
				$('#errFechaExpedicion').html(errFechaExpedicion);
			}else{
				errFechaExpedicion = '';
				$('#errFechaExpedicion').html(errFechaExpedicion);					
			}
		}else{
			errFechaExpedicion = '';
			$('#errFechaExpedicion').html(errFechaExpedicion);
			fechaExpedicion = $('#fechaExpedicion').val();
		
		}

	//validamos indicativo
		if(indicativo == 'default'){
			errIndicativo = '* Selecciona el indicativo';
			$('#errIndicativo').html(errIndicativo);
			$('#indicativo').addClass('focus');
			$('#indicativo').focus();
		}else{
			errIndicativo = '';
			$('#errIndicativo').html(errIndicativo);
			$('#indicativo').removeClass('buttonCheckNames');
			indicativo = $('#indicativo').val();
		}

	

	//validamos telefono fijo
	if(!telefonoFijo){
			errTelefonoFijo = '* Ingresa # de telefono';
			$('#errTelefonoFijo').html(errTelefonoFijo);
		}else if(!$.isNumeric(telefonoFijo)){
			errTelefonoFijo = '* Formato de teléfono válido';
			$('#errTelefonoFijo').html(errTelefonoFijo);
		}else{
			errTelefonoFijo = '';
			$('#errTelefonoFijo').html(errTelefonoFijo);
			telefonoFijo = $('#telefonoFijo').val();
		}

	
	//validamos celular
	if(!celular){
			errCelular = '* Ingresa # de celular';
			$('#errCelular').html(errCelular);
		}else if(!$.isNumeric(celular)){
			errCelular = '* Formato no válido';
			$('#errCelular').html(errCelular);
		}else if(!celular.startsWith('3')){
			errCelular = '* Número no válido';
			$('#errCelular').html(errCelular);
		}else if(celular.length != 10){
			errCelular = '* El número debe ser de 10 digitos';
			$('#errCelular').html(errCelular);
		}else{
			errCelular = '';
			$('#errCelular').html(errCelular);
			celular = $('#celular').val();
		}

	//validamos correo
	regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;

		if(!correo){
			errCorreo = '* Ingresa el correo';
			$('#errCorreo').html(errCorreo);
		}else if(!regexEmail.test(correo)){
			errCorreo = '* Formato de correo no válido';
			$('#errCorreo').html(errCorreo);
		}else{
			errCorreo = '';
			$('#errCorreo').html(errCorreo);
			correo = $('#correo').val();
		}

/*
	//validamos cubrimiento
	if(cubrimiento == 'default'){
		errCubrimiento = '* Selecciona el cubrimiento';
		$('#errCubrimiento').html(errCubrimiento);
	}else{
		errCubrimiento = '';
		$('#errCubrimiento').html(errCubrimiento);
		cubrimiento = $('#cubrimiento').val();
	}
	
	//validamos promocion
	if(promocion == 'default'){
		errPromocion = '* Selecciona la promocion';
		$('#errPromocion').html(errPromocion);
	}else{
		errPromocion = '';
		$('#errPromocion').html(errPromocion);
		promocion = $('#promocion').val();
	}
*/	

	cubrimiento = 'Bogota';
	promocion = $('#promocion').val();

	//validamos promoción
	if(promocion == 'default'){
		errPromocion = '* Selecciona la promoción';
		return $('#errPromocion').html(errPromocion);
	}else{
		errPromocion = '';
		$('#errPromocion').html(errPromocion);
		periodo = $('#promocion').val();
	}


	//validamos periodo
	if(periodo == 'default'){
		errPeriodo = '* Selecciona el periodo';
		return $('#errPeriodo').html(errPeriodo);
	}else{
		errPeriodo = '';
		$('#errPeriodo').html(errPeriodo);
		periodo = $('#periodo').val();
	}

	//validamos programa
	if(programa == 'default'){
		errPrograma = '* Selecciona el programa';
		return $('#errPrograma').html(errPrograma);
	}else{
		errPrograma = '';
		$('#errPrograma').html(errPrograma);
		programa = $('#programa').val();
	}

	//validamos ciclo
	if(ciclo == 'default'){
		errCiclo = '* Selecciona el ciclo';
		return $('#errCiclo').html(errCiclo);
	}else{
		errCiclo = '';
		$('#errCiclo').html(errCiclo);
		ciclo = $('#ciclo').val();
	}

	//validamos tipo de formacion
	if(tipoFormacion == 'default'){
		errTipoFormacion = '* Selecciona el tipo de formacion';
		return $('#errTipoFormacion').html(errTipoFormacion);
	}else{
		errTipoFormacion = '';
		$('#errTipoFormacion').html(errTipoFormacion);
		tipoFormacion = $('#tipoFormacion').val();
	}
	
	//validamos valor matricula
	if(valorMatricula == 'default'){
		errValorMatricula = '* Selecciona valor que corresponda';
		return $('#errValorMatricula').html(errValorMatricula);
	}else{
		errValorMatricula = '';
		$('#errValorMatricula').html(errValorMatricula);
		valorMatricula = $('#valorMatricula').val();
	}

/*
	//validamos cuotas
	if(cuotas == 'default'){
		errCuotas = '* Selecciona el # de cuotas';
		$('#errCuotas').html(errCuotas);
	}else{
		errCuotas = '';
		$('#errCuotas').html(errCuotas);
		cuotas = $('#cuotas').val();	
	} 
*/
		
	//+errSegundoNombre
	//+errSegundoApellido

	//errors = errTipoDocumento+errDocumento+errPrimerNombre+errPrimerApellido+errGenero+errFechaNacimiento+errFechaExpedicion+errIndicativo+errTelefonoFijo+errCelular+errCorreo+errCubrimiento+errPromocion+errPeriodo+errPrograma+errCiclo+errTipoFormacion+errValorMatricula+errCuotas;
	errors = '';

	usuario_id = $("#usuario_id").val();
	
	//si no hay errores
	if(!errors){
		telefonoFijo = indicativo+telefonoFijo;

		if(promocion == '2 X 1' || promocion == 'CUN VIVE 2 X 1'){
			if(typeof beneficiario == 'undefined'){
				errPromocion = '* Debes diligenciar los datos del beneficiario';
				$('#errPromocion').html(errPromocion);
				return;
			}else{
				var info = {
							tipo_documento : tipoDoc,
							documento : documento,
							primer_nombre :  primerNombre,
							segundo_nombre : segundoNombre,
							primer_apellido : primerApellido,
							segundo_apellido :segundoApellido,
							genero : genero,
							fecha_nacimiento : fechaNacimiento,
							fecha_expedicion : fechaExpedicion,
							telefono_fijo : telefonoFijo,
							celular : celular,
							correo : correo,
							cubrimiento : cubrimiento,
							promocion : promocion,
							periodo : periodo,
							programa : programa,
							ciclo : ciclo,
							tipo_formacion : tipoFormacion,
							valor_matricula : valorMatricula,
							cuotas : cuotas,
							beneficiario : beneficiario,
							usuario_id: usuario_id,
							valor_descuento: valorDescuento,
						   };
			}			
		}else{
			var info = {
							tipo_documento : tipoDoc,
							documento : documento,
							primer_nombre :  primerNombre,
							segundo_nombre : segundoNombre,
							primer_apellido : primerApellido,
							segundo_apellido :segundoApellido,
							genero : genero,
							fecha_nacimiento : fechaNacimiento,
							fecha_expedicion : fechaExpedicion,
							telefono_fijo : telefonoFijo,
							celular : celular,
							correo : correo,
							cubrimiento : cubrimiento,
							promocion : promocion,
							periodo : periodo,
							programa : programa,
							ciclo : ciclo,
							tipo_formacion : tipoFormacion,
							valor_matricula : valorMatricula,
							cuotas : cuotas,
							usuario_id: usuario_id,
							valor_descuento: valorDescuento,
						   };
		}

	var arrInfo = JSON.stringify(info);

	//llama el servicio del back para registrar la promocion
	$.ajax({
			url: 'http://'+serverLocation+'/registra_promocion.php',
			type: 'POST',
			data: {
				info : arrInfo
			},
			success: function(r){

				console.log( r );

				if(r['status'] == true){
					
					if(r['output'].includes('Salida: ERROR')){
						location.href = '/formulariocun/errors?err=202&messageErr='+r['output'];
					}else{
						location.href = '/formulariocun/answer?message='+'Recibo de Pago Modelo Virtual - '+r['output'];
					}

				}else{
					location.href = '/formulariocun/errors?err=200&messageErr='+r['output'];
				}
			},
			error: function (error) {
				
				location.href = '/formulariocun/errors?err=500&messageErr='+error['responseText'];

			}
		});
	}else{
		console.log("entra aca");
	}
}

//rellena los campos cedula del formulario principal
function apiNames(){
	
	tipoDoc = $('#tipoDocumento').val();
	documento = $('#documento').val();

	//validamos tipo documento
	if(tipoDoc == 'default'){
		errTipoDocumento = '* Selecciona el tipo de documento';
		$('#errTipoDocumento').html(errTipoDocumento);
	}else{
		errTipoDocumento = '';
		$('#errTipoDocumento').html(errTipoDocumento);
		tipoDoc = $('#tipoDocumento').val();
	}

	
	//validamos documento
	if(documento == ''){
		errDocumento = '* Ingresa el # de documento';
		$('#errDocumento').html(errDocumento);
	}else if(!$.isNumeric(documento)){
		errDocumento = '* Formato no válido';
		$('#errDocumento').html(errDocumento);
	}else{
		errDocumento = '';
		$('#errDocumento').html(errDocumento);
		documento = $('#documento').val();
	}

	//validamos tipo de documento 
		if(tipoDoc == 'C'){
			$.ajax({
				url: 'libs/api_nombres.php',
				type: 'POST',
				data: 'documento='+documento,
				success: function(r){
					if(r['statusCode'] == 200){
						nombreCompleto = r['data']['arrayFullName'];
						$('#primerNombre').val(r['data']['arrayFullName'][0]);
						$('#segundoNombre').val(r['data']['arrayFullName'][1]);
						$('#primerApellido').val(r['data']['arrayFullName'][2]);
						$('#segundoApellido').val(r['data']['arrayFullName'][3]);
					}else{
						errCedula = 'Nro de documento no válido';
						$('#errDocumento').html(errCedula);
						$('#documento').val('');

					}
				}	
			});
		}
}


//rellena los campos cedula del formulario secundario
function apiNames_b(){
	
	tipoDoc_b = $('#tipoDocumento_b').val();
	documento_b = $('#documento_b').val();

	//validamos tipo documento
	if(tipoDoc_b == 'default'){
		errTipoDocumento_b = '* Selecciona el tipo de documento';
		$('#errTipoDocumento_b').html(errTipoDocumento_b);
	}else{
		errTipoDocumento_b = '';
		$('#errTipoDocumento_b').html(errTipoDocumento_b);
		tipoDoc_b = $('#tipoDocumento_b').val();
	}

	
	//validamos documento
	if(documento_b == ''){
		errDocumento_b = '* Ingresa el # de documento';
		$('#errDocumento_b').html(errDocumento_b);
	}else if(!$.isNumeric(documento_b)){
		errDocumento_b = '* Formato no válido';
		$('#errDocumento_b').html(errDocumento_b);
	}else{
		errDocumento_b = '';
		$('#errDocumento_b').html(errDocumento_b);
		documento_b = $('#documento_b').val();
	}

	//validamos tipo de documento 
		if(tipoDoc_b == 'C'){
			$.ajax({
				url: 'libs/api_nombres.php',
				type: 'POST',
				data: 'documento='+documento_b,
				success: function(r){
					if(r['statusCode'] == 200){
						nombreCompleto = r['data']['arrayFullName'];
						$('#primerNombre_b').val(r['data']['arrayFullName'][0]);
						$('#segundoNombre_b').val(r['data']['arrayFullName'][1]);
						$('#primerApellido_b').val(r['data']['arrayFullName'][2]);
						$('#segundoApellido_b').val(r['data']['arrayFullName'][3]);
					}else{
						errCedula = 'Nro de documento no válido';
						$('#errDocumento_b').html(errCedula);
						$('#documento_b').val('');
					}
				}	
			});
		}
}


//funcion para guardar beneficiario

function agregaBeneficiario(){
	//capturamos campos para validacion
	tipoDoc_b = $('#tipoDocumento_b').val();
	documento_b = $('#documento_b').val();
	primerNombre_b = $('#primerNombre_b').val();
	segundoNombre_b = $('#segundoNombre_b').val();
	primerApellido_b = $('#primerApellido_b').val();
	segundoApellido_b = $('#segundoApellido_b').val();
	genero_b = $('#genero_b').val();
	fechaNacimiento_b = $('#fechaNacimiento_b').val();
	fechaExpedicion_b = $('#fechaExpedicion_b').val();
	telefonoFijo_b = $('#telefonoFijo_b').val();
	celular_b = $('#celular_b').val();
	correo_b = $('#correo_b').val();
	indicativo_b = $('#indicativo_b').val();

	//validacion de campos

	//validamos tipo documento
	if(tipoDoc_b == 'default'){
		errTipoDocumento_b = '* Selecciona el tipo de documento';
		$('#errTipoDocumento_b').html(errTipoDocumento_b);
	}else{
		errTipoDocumento_b = '';
		$('#errTipoDocumento_b').html(errTipoDocumento_b);
		tipoDoc_b = $('#tipoDocumento_b').val();
	}

	
	//validamos documento
	if(documento_b == ''){
		errDocumento_b = '* Ingresa el # de documento';
		$('#errDocumento_b').html(errDocumento_b);
	}else if(!$.isNumeric(documento_b)){
		errDocumento_b = '* Formato no válido';
		$('#errDocumento_b').html(errDocumento_b);
	}else{
		errDocumento_b = '';
		$('#errDocumento_b').html(errDocumento_b);
		documento_b = $('#documento_b').val();
	}

	//validamos primer nombre
	if(primerNombre_b == ''){
		errPrimerNombre_b = '* Ingresa el primer nombre';
		$('#errPrimerNombre_b').html(errPrimerNombre_b);
	}else if($.isNumeric(primerNombre_b)){
		errPrimerNombre_b = '* Formato no válido';
		$('#errPrimerNombre_b').html(errPrimerNombre_b);
	}else{
		errPrimerNombre_b = '';
		$('#errPrimerNombre_b').html(errPrimerNombre_b);
		primerNombre_b = $('#primerNombre_b').val();
		primerNombre_b = primerNombre_b.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
	}

	//validamos segundo nombre
	if($.isNumeric(segundoNombre_b)){
		errSegundoNombre_b = '* Formato no válido';
		$('#errSegundoNombre_b').html(errSegundoNombre_b);
	}else{
		errSegundoNombre_b = '';
		$('#errSegundoNombre_b').html(errSegundoNombre_b);
		segundoNombre_b = $('#segundoNombre_b').val();
		segundoNombre_b = segundoNombre_b.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
	}

	//validamos primer apellido
	if(primerApellido_b == ''){
		errPrimerApellido_b = '* Ingresa el primer apellido';
		$('#errPrimerApellido_b').html(errPrimerApellido_b);
	}else if($.isNumeric(primerApellido_b)){
		errPrimerApellido_b = '* Formato no válido';
		$('#errPrimerApellido_b').html(errPrimerApellido_b);
	}else{
		errPrimerApellido_b = '';
		$('#errPrimerApellido_b').html(errPrimerApellido_b);
		primerApellido_b = $('#primerApellido_b').val();
		primerApellido_b = primerApellido_b.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
	}

	//validamos segundo apellido
	if($.isNumeric(segundoApellido_b)){
		errSegundoApellido_b = '* Formato no válido';
		$('#errSegundoApellido_b').html(errSegundoApellido_b);
	}else{
		errSegundoApellido_b = '';
		$('#errSegundoApellido_b').html(errSegundoApellido_b);
		segundoApellido_b = $('#segundoApellido_b').val();
		segundoApellido_b = segundoApellido_b.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
	}


	//validamos genero
	if(genero_b == 'default'){
		errGenero_b = '* Selecciona el genero';
		$('#errGenero_b').html(errGenero_b);
	}else{
		errGenero_b = '';
		$('#errGenero_b').html(errGenero_b);
		genero_b = $('#genero_b').val();
	}

	
	//validamos fecha de nacimiento
	if(fechaNacimiento_b == ''){
		errFechaNacimiento_b = '* Selecciona la fecha de nacimiento';
		$('#errFechaNacimiento_b').html(errFechaNacimiento_b);
	}else{
		errFechaNacimiento_b = '';
		$('#errFechaNacimiento_b').html(errFechaNacimiento_b);
		fechaNacimiento_b = $('#fechaNacimiento_b').val();
		
	}

	//validamos fecha de expedicion
	if(fechaExpedicion_b == ''){
		errFechaExpedicion_b = '* Selecciona la fecha de expedicion del documento';
		$('#errFechaExpedicion_b').html(errFechaExpedicion_b);
	}else{
		errFechaExpedicion_b = '';
		$('#errFechaExpedicion_b').html(errFechaExpedicion_b);
		fechaExpedicion_b = $('#fechaExpedicion_b').val();
		
	}
	

	//validamos fecha de nacimiento
		//input date
		bd = new Date(fechaNacimiento_b);
		y_bd = bd.getFullYear();

		//valid range date
		md = new Date('2007-01-01');
		y_md = md.getFullYear();

		if(!fechaNacimiento_b){
			errFechaNacimiento_b = '* Selecciona la fecha de nacimiento';
			$('#errFechaNacimiento_b').html(errFechaNacimiento_b);
		}else if(y_bd > y_md){
			errFechaNacimiento_b = '* Fecha no válida';
			$('#errFechaNacimiento_b').html(errFechaNacimiento_b);
		}else{
			errFechaNacimiento_b = '';
			$('#errFechaNacimiento_b').html(errFechaNacimiento_b);
			fechaNacimiento_b = $('#fechaNacimiento_b').val();
		}

	//validamos fecha de expedicion
		//input date
		bd = new Date(fechaNacimiento_b);
		y_bd = bd.getFullYear();
		age = y_bd + 18;
		
		//valid range date
		de = new Date(fechaExpedicion_b);
		y_de = de.getFullYear();

		if(!fechaExpedicion_b){
			errFechaExpedicion_b = '* Selecciona la fecha de expedicion';
			$('#errFechaExpedicion_b').html(errFechaExpedicion_b);
		}else if(typeof tipoDoc_b != 'undefined' && tipoDoc_b == 'C'){
			if(y_de < age){
				errFechaExpedicion_b = '* Fecha no válida';
				$('#errFechaExpedicion_b').html(errFechaExpedicion_b);
			}else{
				errFechaExpedicion_b = '';
				$('#errFechaExpedicion_b').html(errFechaExpedicion_b);					
			}
		}else{
			errFechaExpedicion_b = '';
			$('#errFechaExpedicion_b').html(errFechaExpedicion_b);
			fechaExpedicion_b = $('#fechaExpedicion_b').val();
		
		}
	//validamos indicativo
		if(indicativo_b == 'default'){
			errIndicativo_b = '* Selecciona el indicativo';
			$('#errIndicativo_b').html(errIndicativo_b);
		}else{
			errIndicativo_b = '';
			$('#errIndicativo_b').html(errIndicativo_b);
			indicativo_b = $('#indicativo_b').val();
		}

	//validamos telefono fijo
	if(telefonoFijo_b == ''){
		errTelefonoFijo_b = '* Ingresa el # de telefono';
		$('#errTelefonoFijo_b').html(errTelefonoFijo_b);
	}else if(!$.isNumeric(telefonoFijo_b)){
		errTelefonoFijo_b = '* Formato no válido';
		$('#errTelefonoFijo_b').html(errTelefonoFijo_b);
	}else{
		errTelefonoFijo_b = '';
		$('#errTelefonoFijo_b').html(errTelefonoFijo_b);
		telefonoFijo_b = $('#telefonoFijo_b').val();
	}


	//validamos celular
	if(celular_b == ''){
		errCelular_b = '* Ingresa el # de celular';
		$('#errCelular_b').html(errCelular_b);
	}else if(!$.isNumeric(celular_b)){
		errCelular_b = '* Formato no válido';
		$('#errCelular_b').html(errCelular_b);
	}else{
		errCelular_b = '';
		$('#errCelular_b').html(errCelular_b);
		celular_b = $('#celular_b').val();
	}

	//validamos correo
	if(correo_b == ''){
		errCorreo_b = '* Ingresa el correo';
		$('#errCorreo_b').html(errCorreo_b);
	}else if($("#correo_b").val().indexOf('@', 0) == -1 || $("#correo_b").val().indexOf('.', 0) == -1){
		errCorreo_b = '* Formato no válido';
		$('#errCorreo_b').html(errCorreo_b);
	}else{
		errCorreo_b = '';
		$('#errCorreo_b').html(errCorreo_b);
		correo_b = $('#correo_b').val();
	}

	//si no hay errores
	//errSegundoNombre_b+
	//errSegundoApellido_b+

	errors_b = errTipoDocumento_b+errDocumento_b+errPrimerNombre_b+errPrimerApellido_b+errGenero_b+errFechaNacimiento_b+errFechaExpedicion_b+errTelefonoFijo_b+errCelular_b+errCorreo_b;

	if(errors_b == ''){

		nombres_b = primerNombre_b+' '+segundoNombre_b;
		apellidos_b = primerApellido_b+' '+segundoApellido_b;
		telefonoFijo_b = indicativo_b+telefonoFijo_b;
		
		cadena_b = 'tipodoc='+tipoDoc_b+'&documento='+documento_b+'&nombres='+nombres_b+'&apellidos='+apellidos_b+'&genero='+genero_b+'&fechaNacimiento='+fechaNacimiento_b+'&fechaExpedicion='+fechaExpedicion_b+'&telefonoFijo='+telefonoFijo_b+'&celular='+celular_b+'&correo='+correo_b;

		beneficiario = {
						tipoDoc: tipoDoc_b,
						documento: documento_b,
						nombres: nombres_b,
						p_nombre: primerNombre_b,
						s_nombre: segundoNombre_b,
						p_apellido: primerApellido_b,
						s_apellido: segundoApellido_b,
						apellidos: apellidos_b,
						genero: genero_b,
						fechaNacimiento: fechaNacimiento_b,
						fechaExpedicion: fechaExpedicion_b,
						telefonoFijo: telefonoFijo_b,
						celular: celular_b,
						correo: correo_b
					};
		
		//evento de modal
		$("#agregaNuevo").modal("hide");
		$('#periodo').addClass('focus');
		$('#periodo').focus();

		return beneficiario;
	}

}
