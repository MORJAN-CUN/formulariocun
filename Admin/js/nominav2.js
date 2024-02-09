function ConsultarN(){

	periodo = $("#periodo").val();
	cedula = $("#cedula").val();
	consecutivo = $("#consecutivo").val();

	if(periodo == '' || periodo == undefined || periodo == null){
		Swal.fire("Debes escoger un periodo");
		return 0;
	}

	if(cedula == '' || cedula == undefined || cedula == null){
		cedula = null;
	}

	if(consecutivo == '' || consecutivo == undefined || consecutivo == null){
		Swal.fire("El consecutivo no puede estar vacio");
		return 0;
	}

	datos = {'periodo':periodo,'cedula':cedula,'consecutivo':consecutivo};

	$("#result_file_load").hide();
	$("#btnload").prop("disabled", true);
	$("#loadingData").show();
	$(".alert").removeClass('alert-success');
	$(".alert").removeClass('alert-danger');

	$.ajax({
	data: datos,
	type: 'POST',
	dataType: 'JSON',
	url: 'php/nomina/ConsNominav2.php',
		success:function(R){
			$("#btnload").prop("disabled", false);
			$("#loadingData").hide();
			$("#result_file_load").show();
			status = R['status'];
			link = R['link'];

			$("#periodo").val('');
			$("#cedula").val('');
			$("#consecutivo").val('');

			$('#link_download_excel').attr('href', link);

			if(status == 1){
				Swal.fire("Archivo generado correctamente", "", "success");
				$(".alert").html('Tu archivo se ha generado correctamente, puedes descargar el resultado');
				$(".alert").addClass('alert-success');
				$("#link_download_excel").show();
			}else{
				$(".alert").addClass('alert-danger');
				$(".alert").html('Ha ocurrido un problema generando el archivo, intentalo nuevamente');
				Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
				$("#link_download_excel").hide();
			}

		},error:function( jqXHR, textStatus, errorThrown ){
			$("#btnload").prop("disabled", false);
			$("#loadingData").hide();
			Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
		}
	})

}



