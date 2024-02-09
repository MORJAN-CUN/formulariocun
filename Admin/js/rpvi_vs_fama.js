$(document).ready(function(){
	//realizamos cargue de periodos activos
	$.ajax({
		url: 'http://localhost/CUN/formularioback/Admin/PeriodosActivos.php',
		method: 'POST',
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].periodo+'">'+obj[i].periodo+'</option>';
                }

			$('#periodo').html('<option selected value="default">Periodo</option>'+objHtml);
		}
	});
});


function ConsultarOrdenes(){
	periodo = $('#periodo').val();
	identificacion = $('#identificacion').val();
	errors = '';

	//validamos periodo
	if(periodo == 'default'){
		errors += 'Selecciona un periodo académico';
		Swal.fire(errors, '* Campos obligatorios', 'warning');
	}else{
		errors += '';
		periodo = $('#periodo').val();
	}

	//validamos identificacion
	if(!identificacion){
		errors += '<br>Ingresa el numero de identificacion';
		Swal.fire(errors, '* Campos obligatorios', 'warning');
	}else if(!$.isNumeric(identificacion)){
		errors += '<br>Formato de identificacion no válido';
		Swal.fire(errors, '* Campos obligatorios', 'warning');
	}else{
		errors += '';
		identificacion = $('#identificacion').val();
	}

	if(errors == ''){
		cadena = 'identificacion='+identificacion+'&periodo='+periodo;
		//ajax llamando las consultas
		$.ajax({
			url: 'http://localhost/CUN/formularioback/Admin/rpvi_vs_fama/rpvi_fama.php',
			method: 'POST',
			data: cadena,
			dataType: 'json',
			success: function(r){
				$('#table_result').load('../Admin/php/fama_rpvi/fama_rpvi_table.php',{r});
				
			}
		});
	}
}