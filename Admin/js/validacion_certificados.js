function Consultar(){

	//capturamos el numero de documento
	identificacion = $('#cedula_estudiante').val();

	//validamos el campo capturado

	if(!identificacion){
		errIdentificacion = '* valor incorrecto';
		$('#errCedula_estudiante').html(errIdentificacion);
	}else if(identificacion <= 0){
		errIdentificacion = '* valor incorrecto';
		$('#errCedula_estudiante').html(errIdentificacion);
	}else if(!$.isNumeric(identificacion)){
		errIdentificacion = '* valor incorrecto';
		$('#errCedula_estudiante').html(errIdentificacion);
	}else{
		errIdentificacion = '';
		$('#errCedula_estudiante').html(errIdentificacion);
		identificacion = $('#cedula_estudiante').val();		
	}

	//si no hay errores de captura

	if(!errIdentificacion){
		$('#table_result').load('php/verificacion_certificados/vc_consulta.php',{identificacion});
	}
}


function ConsultaSolicitudes(){
	//capturamos el numero de documento
	identificacion = $('#cedula_estudiante_c').val();

	//validamos el campo capturado

	if(!identificacion){
		errIdentificacion = '* valor incorrecto';
		$('#errCedula_estudiante_c').html(errIdentificacion);
	}else if(identificacion <= 0){
		errIdentificacion = '* valor incorrecto';
		$('#errCedula_estudiante_c').html(errIdentificacion);
	}else if(!$.isNumeric(identificacion)){
		errIdentificacion = '* valor incorrecto';
		$('#errCedula_estudiante_c').html(errIdentificacion);
	}else{
		errIdentificacion = '';
		$('#errCedula_estudiante_c').html(errIdentificacion);
		identificacion = $('#cedula_estudiante_c').val();		
	}


	//si no hay errores de captura

	if(!errIdentificacion){
		$('#table_result').load('php/verificacion_certificados/solicitudes_encurso.php',{identificacion});
	}
}