$(document).ready(function(){

	//serverLocation = 'localhost/';
	serverLocation = '190.184.202.251:8090/';

	//realizamos cargue de periodos activos
	$.ajax({
		url: 'http://'+serverLocation+'formularioback/Admin/PeriodosActivos.php',
		method: 'POST',
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].periodo+'">'+obj[i].periodo+'</option>';
                }

			$('#periodo').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#periodo_excel').html('<option selected value="">Seleccionar</option>'+objHtml);

		}	
	});

});


function Consultar(){

	periodo = $("#periodo").val();

	if(periodo == ''){
		Swal.fire("Debes seleccionar un periodo");
		return 0;
	}

	$("#btn_consultar").prop("disabled", true);
	$("#table_result").html('<center><img src="img/Gif_Loading.gif" width="250"></center>');

	$("#no_han_ingresado_txt").html('');
	$("#ya_ingresaron_txt").html('');
	$("#no_sabe_txt").html('');
	$("#total_txt").html('');
	
	datos = {'periodo':periodo};

	//Consultar totales

	totales_usabilidad(periodo);

	$.ajax({
	data: datos,
	type: 'POST',
	url: 'php/usabilidad_correo/ConsultarEstudiantes.php',
		success:function(table){
			$("#btn_consultar").prop("disabled", false);
			$("#table_result").html(table);
		},error:function( jqXHR, textStatus, errorThrown ){
            $("#btn_consultar").prop("disabled", false);
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
	});

}

function totales_usabilidad(periodo){

	datos = {'periodo':periodo};

	$.ajax({
	data: datos,
	type: 'POST',
	url: 'php/usabilidad_correo/ConsultarTotales.php',
	dataType: 'JSON',
		success:function(R){

			$("#no_han_ingresado_txt").html(addCommas(R['sin_ingreso']));
			$("#ya_ingresaron_txt").html(addCommas(R['ya_ingresaron']));
			$("#no_sabe_txt").html(addCommas(R['ingreso_desconocido']));
			$("#total_txt").html(addCommas(R['total_ingresos']));
			
			$("#accesos_count").show();

		}
	});
}

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


function doSearch() {

    var tableReg = document.getElementById('Tabla');
    var searchText = document.getElementById('searchTerm').value.toLowerCase();
    var cellsOfRow = "";
    var found = false;
    var compareWith = "";

    for (var i = 1; i < tableReg.rows.length; i++) {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        found = false;
        for (var j = 0; j < cellsOfRow.length && !found; j++) {
            compareWith = cellsOfRow[j].innerHTML.toLowerCase();
            if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                found = true;
            }
        }
        if (found) {
            tableReg.rows[i].style.display = '';
        } else {
            tableReg.rows[i].style.display = 'none';
        }
    }
}

function GenerarReporte(){

	periodo = $("#periodo_excel").val();

	if(periodo == ''){
		Swal.fire("Debes seleccionar un periodo");
		return 0;
	}

	$("#loadingData").show();
    $("#btnload").prop("disabled", true);
    $(".result_file_load").hide();

	datos = {'periodo':periodo};

	$.ajax({
	url: 'php/usabilidad_correo/GenerarReporte.php',
	data: datos,
	type: 'POST',
	dataType: 'JSON',
		success:function(R){

			$("#btnload").prop("disabled", false);
			$("#loadingData").hide();
			$(".result_file_load").show();
			status = R['status'];
			link = R['link'];

			$("#periodo_excel").val('');

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

		}
	});

}
