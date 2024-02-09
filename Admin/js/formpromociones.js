$(document).ready(function(){
	
	//serverLocation = 'localhost/CUN';
	serverLocation = '190.184.202.251:8090';

	//select periodo
	$.ajax({
		url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Periodo.php',
		type: 'POST',
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
			var objHtml = '';
			
			for(var i=0; i< obj.length; i++){
				objHtml += '<option value ="'+obj[i].periodo+'">'+obj[i].periodo+" "+obj[i].nombre+'</option>';
			}
			
			$('#periodo').html('<option disabled selected>Selecciona una opción</option>'+objHtml);


			//Periodo masivo
		    var objHtmlms = '';

		    for(var i=0; i< obj.length; i++){
				objHtmlms += '<option value ="'+obj[i].periodo+'">'+obj[i].periodo+" "+obj[i].nombre+'</option>';
			}
			

			$('#periodomasivo').html('<option disabled selected>Selecciona una opción</option>'+objHtmlms);
			$('#periodomasivodest').html('<option disabled selected>Selecciona una opción</option>'+objHtmlms);

			//Periodo edit
			var objHtmledit = '';

			for(var i=0; i< obj.length; i++){
				objHtmledit += '<option value ="'+obj[i].periodo+'">'+obj[i].periodo+" "+obj[i].nombre+'</option>';
			}
			
			$('#periodoedit').html('<option disabled selected>Selecciona una opción</option>'+objHtmledit);

		}
	});

	//select periodo carga Idiomas
	$('#periodo').on('change',function(){
		periodo = $(this).val();

		//select periodo Idiomas
		$.ajax({
			url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Periodo_idiomas.php',
			type: 'POST',
			data: 'periodo='+periodo,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
				var objHtml = '';
				
				for(var i=0; i< obj.length; i++){
					objHtml += '<option value ="'+obj[i].periodo_idiomas+'">'+obj[i].periodo_idiomas+'</option>';
				}
				
				$('#periodoIdiomas').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
			}
		});
	});



	//cuando cambie periodo carga el programa
	$('#periodo').on('change',function(){
	periodo = $(this).val();

	//select Programa Academico
	$.ajax({
		url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Programa.php',
		type: 'POST',
		data: 'periodo='+periodo,
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
			var objHtml = '';
			
			for(var i=0; i< obj.length; i++){
				objHtml += '<option value ="'+obj[i].nombre+'">'+obj[i].nombre+'</option>';
			}
			
			$('#programa').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
		}
	});
});

//cuando cambie el ciclo carga el tipo de formacion
$('#programa').on('change',function(){
	programa = $(this).val();
	periodo =  $('#periodo').val();

	//select Ciclo propedeutico
	$.ajax({
		url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Ciclo.php',
		type: 'POST',
		data: 'programa='+programa+'&periodo='+periodo,
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
			var objHtml = '';
			
			for(var i=0; i< obj.length; i++){
				objHtml += '<option value ="'+obj[i].ciclo+'">'+obj[i].ciclo+'</option>';
			}
			
			$('#ciclo').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
		}
	});
});

//cuando cambie el ciclo carga el tipo de formacion
$('#ciclo').on('change',function(){
	ciclo = $(this).val();
	programa = $('#programa').val();
	periodo =  $('#periodo').val();

	//select Tipo Inscripcion:
	$.ajax({
		url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Inscripcion.php',
		type: 'POST',
		data: 'programa='+programa+'&periodo='+periodo+'&ciclo='+ciclo,
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
			var objHtml = '';
			
			for(var i=0; i< obj.length; i++){
				objHtml += '<option value ="'+obj[i].descripcion+'">'+obj[i].descripcion+'</option>';
			}
			
			$('#tipoInscripcion').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
		}
	});
});

	//select financiacion:
	$.ajax({
		url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Financiacion.php',
		type: 'POST',
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
			var objHtml = '';
			var objHtml_edit_ms = '';
			var objHtml_edit_unoxuno = '';

			for(var i=0; i< obj.length; i++){
				objHtml += '<option value ="'+obj[i].descripcion+'">'+obj[i].descripcion+'</option>';
				objHtml_edit_ms += '<option value ="'+obj[i].descripcion+'">'+obj[i].descripcion+'</option>';
				objHtml_edit_unoxuno += '<option value ="'+obj[i].descripcion+'">'+obj[i].descripcion+'</option>';
			}
			
			$('#tipoPromocion').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
			//$('#financiacion').html('<option disabled selected>Selecciona una opción</option>'+objHtml);

			//Edit MS
			$('#tipofinanciacion_edit_ms').html('<option disabled selected>Selecciona una opción</option>'+objHtml_edit_ms);
			$('#tipofinanciacion_edit_unoxuno').html('<option disabled selected>Selecciona una opción</option>'+objHtml_edit_unoxuno);

			//financiacion edit
			var objHtmledit = '';

			for(var i=0; i< obj.length; i++){
				objHtmledit += '<option value ="'+obj[i].descripcion+'">'+obj[i].descripcion+'</option>';
			}
			
			$('#tipoPromocionedit').html('<option disabled selected>Selecciona una opción</option>'+objHtmledit);

		}
	});

});

function GuardarDatos(){

	//serverLocation = 'localhost/CUN';
	serverLocation = '190.184.202.251:8090';

	estado = $("#estado").val();
	fechaRegistro = $("#fechaRegistro").val();
	tipoPromocion = $("#tipoPromocion").val();
	periodo = $("#periodo").val();
	periodoIdiomas = $("#periodoIdiomas").val();
	programa = $("#programa").val();
	ciclo = $("#ciclo").val();
	tipoInscripcion = $("#tipoInscripcion").val();
	valorMatricula = $("#valorMatricula").val();
	valorIdioma = $("#valorMatricula").val();
	valorServicio = $("#valorServicio").val();
	cuotas = $("#cuotas").val();
	porcMatricula = $("#porcMatricula").val();
	porcIdiomas = $("#porcIdiomas").val();
	//financiacion = $("#financiacion").val();
		
	if(estado == '' || fechaRegistro == '' || tipoPromocion == '' || periodo == '' || periodoIdiomas == '' || ciclo == '' || tipoInscripcion == '' 
		|| valorMatricula == '' || valorIdioma == '' || valorServicio == '' || cuotas == '' || porcMatricula == '' 
		|| porcIdiomas == ''){
		Swal.fire("Hay datos vacios");
		return 0;
	}

	if($('#check_cunvive').prop('checked')){
	    cunvive = 'S';
	}else{
		cunvive = 'N';
	}

	if($('#check_2x1').prop('checked')){
	    C_2X1 = 'S';
	}else{
		C_2X1 = 'N';
	}

	datos = {'estado':estado,'fechaRegistro':fechaRegistro,'tipoPromocion':tipoPromocion,'periodo':periodo,'periodoIdiomas':periodoIdiomas,
			'programa':programa,'ciclo':ciclo,'tipoInscripcion':tipoInscripcion,'valorMatricula':valorMatricula,'valorIdioma':valorIdioma,
			'valorServicio':valorServicio,'cuotas':cuotas,'porcMatricula':porcMatricula,'porcIdiomas':porcIdiomas,
			'cunvive':cunvive,'C_2X1':C_2X1};

	$.ajax({
	url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/CrearPromociones.php',
	type: 'POST',
	data: datos,
		success:function(R){
			if(R == 1){
				Swal.fire("Guardado Correctamente", "", "success");
				$("#form_createpromo")[0].reset();
				ConsultarPeriodos();
				return 0;
			}else if(R == 2){
				Swal.fire("El registro ya se encuentra Creado", "por favor valide con otros parametros", "warning");
				//Swal.fire("Ha ocurrido un error", "", "error");
				return 0;
			}else{
				Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
			}
		},error:function( jqXHR, textStatus, errorThrown ){
			//Swal.fire("El registro ya se encuentra Creado", "por favor valide con otros parametros", "warning");
			Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
		}
	});
	
}

window.onload = ConsultarPromociones;
function ConsultarPromociones(){

	$.ajax({
	url: 'php/PromocionesCreadas.php',
	type: 'POST',
		success:function(Table){
			$("#table_promociones").html(Table);
		},error:function( jqXHR, textStatus, errorThrown ){
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
	});

}

function EditarPromociones(str){

id_promocion = str;
$("#idpromocion_edit").val(id_promocion)
//serverLocation = 'localhost/CUN';
serverLocation = '190.184.202.251:8090';
//Cargar datos en inputs

datos = {'id_promocion':id_promocion};

$.ajax({
url: 'php/ConsDatosPromocion.php',
data: datos,
type: 'POST',
dataType: 'JSON',
    success:function(Data){
        //console.log(Data);
        estado = Data['ESTADO'];
        fechafinal_registro = Data['FECHA_REGISTRO'];
        tipo_promocion = Data['TIPO_PROMOCION'];
        periodo = Data['PERIODO'];
        periodo_idiomas = Data['PERIODO_IDIOMAS'];
        programa = Data['PROGRAMA']; 
        ciclo = Data['CICLO'];
        tipo_inscripcion = Data['TIPO_INSCRIPCION'];
        numero_cuotas = Data['NUMERO_CUOTAS'];
        valor_matricula = Data['VALOR_MATRICULA'];
        valor_idiomas = Data['VALOR_IDIOMAS'];
        valor_servicio = Data['VALOR_SERVICIO'];
        es_cun_vive = Data['ES_CUN_VIVE'];
        es_2x1 = Data['ES_2X1'];
        porc_matricula = Data['PORC_MATRICULA'];
        porc_idiomas = Data['PORC_IDIOMAS'];

        $("#estadoedit").val(estado);
        $("#fecharegistro_edit").val(fechafinal_registro);
        $("#tipoPromocionedit").val(tipo_promocion);
        $("#periodoedit").val(periodo);
        $("#valorMatriculaedit").val(valor_matricula);
        $("#valorServicioedit").val(valor_servicio);
        $("#valorIdiomasedit").val(valor_idiomas);
        $("#cuotasedit").val(numero_cuotas);
        $("#porcMatriculaedit").val(porc_matricula);
        $("#porcIdiomasedit").val(porc_idiomas);

		//Antes
        $("#tipoPromocionedit_antes").val(tipo_promocion);
		$("#periodoedit_antes").val(periodo);
		$("#periodoIdiomasedit_antes").val(periodo_idiomas);
		$("#programaedit_antes").val(programa);
		$("#cicloedit_antes").val(ciclo);
		$("#tipoInscripcionedit_antes").val(tipo_inscripcion);

        if(es_cun_vive == 'S'){
            $("#check_cunviveedit").prop('checked',true);
        }else{
            $("#check_cunviveedit").prop('checked',false);
        }

        if(es_2x1 == 'S'){
            $("#check_2x1edit").prop('checked',true);
        }else{
            $("#check_2x1edit").prop('checked',false);
        }

        
        //select Edit periodo Idiomas
        $.ajax({
            url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Periodo_idiomas.php',
            type: 'POST',
            data: 'periodo='+periodo,
            async:true,
            success: function(r){
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].periodo_idiomas+'">'+obj[i].periodo_idiomas+'</option>';
                }
                
                $('#periodoIdiomasedit').html('<option disabled selected>Selecciona una opción</option>'+objHtml);

                $("#periodoIdiomasedit").val(periodo_idiomas);
            }
        }); 
        //select Edit Programa Academico
        $.ajax({
            url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Programa.php',
            type: 'POST',
            data: 'periodo='+periodo,
            async:true,
            success: function(r){
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].nombre+'">'+obj[i].nombre+'</option>';
                }
                $('#programaedit').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
                $("#programaedit").val(programa);
                
                }
            });     

        //select Ciclo propedeutico
        $.ajax({
            url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Ciclo.php',
            type: 'POST',
            data: 'programa='+programa+'&periodo='+periodo,
            success: function(r){
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].ciclo+'">'+obj[i].ciclo+'</option>';
                }
                
                $('#cicloedit').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
                $("#cicloedit").val(ciclo);
            }
        });


        //select Tipo Inscripcion:
        $.ajax({
            url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Inscripcion.php',
            type: 'POST',
            data: 'programa='+programa+'&periodo='+periodo+'&ciclo='+ciclo,
            success: function(r){
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].descripcion+'">'+obj[i].descripcion+'</option>';
                }
                
                $('#tipoInscripcionedit').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
                $("#tipoInscripcionedit").val(tipo_inscripcion);
                $("#modal-EditarPromociones").modal('show');
            }
        });


    }
}); 
}

//select periodo carga Idiomas
	$('#periodoedit').on('change',function(){
		periodo = $(this).val();

		//select periodo Idiomas
		$.ajax({
			url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Periodo_idiomas.php',
			type: 'POST',
			data: 'periodo='+periodo,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
				var objHtml = '';
				
				for(var i=0; i< obj.length; i++){
					objHtml += '<option value ="'+obj[i].periodo_idiomas+'">'+obj[i].periodo_idiomas+'</option>';
				}
				
				$('#periodoIdiomasedit').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
			}
		});
	});

	function ActualizarPromocion(){

	//Capturar datos de inputs del modal de edit

		id_promocion = $("#idpromocion_edit").val();
		estado = $("#estadoedit").val();
		fecha_registro = $("#fecharegistro_edit").val();
		tipo_promocion = $("#tipoPromocionedit").val();
		periodo = $("#periodoedit").val();
		periodo_idiomas = $("#periodoIdiomasedit").val();
		programa = $("#programaedit").val();
		ciclo = $("#cicloedit").val();
		tipo_inscripcion = $("#tipoInscripcionedit").val();
		numero_cuotas = $("#cuotasedit").val();
		valor_matricula = $("#valorMatriculaedit").val();
		valor_idiomas = $("#valorIdiomasedit").val();
		valor_servicio = $("#valorServicioedit").val();
		porc_matricula = $("#porcMatriculaedit").val();
		porc_idiomas = $("#porcIdiomasedit").val();

		//Antes
		tipoPromocionedit_antes = $("#tipoPromocionedit_antes").val();
		periodoedit_antes = $("#periodoedit_antes").val();
		periodoIdiomasedit_antes = $("#periodoIdiomasedit_antes").val();
		programaedit_antes = $("#programaedit_antes").val();
		cicloedit_antes = $("#cicloedit_antes").val();
		tipoInscripcionedit_antes = $("#tipoInscripcionedit_antes").val();

		if($("#check_cunviveedit").prop("checked")){
			es_cun_vive = 'S';
		}else{
			es_cun_vive = 'N';
		}

		if($("#check_2x1edit").prop("checked")){
			es_2x1 = 'S';
		}else{
			es_2x1 = 'N';
		}


		if(estado == '' || estado == null){Swal.fire("Selecciona el estado");return 0;}
		if(fecha_registro == '' || fecha_registro == null){Swal.fire("Hay fechas vacias");return 0;}
		if(tipo_promocion == '' || tipo_promocion == null) {Swal.fire("Selecciona una financiación");return 0;}
		if(periodo == '' || periodo == null){Swal.fire("Selecciona el periodo");return 0;}
		if(periodo_idiomas == '' || periodo_idiomas == null){Swal.fire("Selecciona el periodo idiomas");return 0;}
		if(programa == '' || programa == null) {Swal.fire("Selecciona el programa");return 0;}
		if(ciclo == '' || ciclo == null){Swal.fire("Selecciona el ciclo");return 0;}
		if(tipo_inscripcion == '' || tipo_inscripcion == null){Swal.fire("Selecciona el tipo de inscripcion");return 0;}
		if(numero_cuotas == ''|| numero_cuotas == null){Swal.fire("Selecciona el numero_cuotas");return 0;}
		if(valor_matricula == '' || valor_matricula == null){Swal.fire("Digite el valor de la matricula");return 0;}
		if(valor_idiomas == '' || valor_idiomas == null){Swal.fire("Digite el valor de los idiomas");return 0;}
		if(valor_servicio == '' || valor_servicio == null){Swal.fire("Digite el valor del servicio");return 0;}
		if(porc_matricula == '' || porc_matricula == null){Swal.fire("Digite el valor del porcentaje de la matricula");return 0;}
		if(porc_idiomas == '' || porc_idiomas == null){Swal.fire("Digite el valor del procentaje de los idiomas");return 0;}


		datos = {'id_promocion':id_promocion,'estado':estado,'fecha_registro':fecha_registro,'tipo_promocion':tipo_promocion,'periodo':periodo,
		'periodo_idiomas':periodo_idiomas,'programa':programa,'ciclo':ciclo,'tipo_inscripcion':tipo_inscripcion,'numero_cuotas':numero_cuotas,
		'valor_matricula':valor_matricula,'valor_idiomas':valor_idiomas,'valor_servicio':valor_servicio,'porc_matricula':porc_matricula,'porc_idiomas':porc_idiomas,
		'es_cun_vive':es_cun_vive,'es_2x1':es_2x1,'tipoPromocionedit_antes':tipoPromocionedit_antes,'periodoedit_antes':periodoedit_antes,'periodoIdiomasedit_antes':periodoIdiomasedit_antes,
		'programaedit_antes':programaedit_antes,'cicloedit_antes':cicloedit_antes,'tipoInscripcionedit_antes':tipoInscripcionedit_antes};

		$.ajax({
		url: 'php/UpdatePromocion.php',
		data: datos,
		type: 'POST',
			success:function(R){
				if(R == 1){
					Swal.fire("Datos actualizados correctamente", "", "success");
					ConsultarPromociones();
					$("#modal-EditarPromociones").modal('hide');
				}else if(R == 2){
					Swal.fire("El registro ya existe", "", "warning");
					return 0;
				}else{
					Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
				}
			},error:function( jqXHR, textStatus, errorThrown ){
				Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
			}
		});
	}


		function cuota(){
			//console.log("entra");
			cuotas = $("#cuotas").val();

			if(cuotas < 1 || cuotas > 4){
				$("#alertcuotas").show();
				$("#cuotas").addClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", true);
			}else{
				$("#alertcuotas").hide();
				$("#cuotas").removeClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", false);
			}
	} 

		function cuotaedit(){
			//console.log("entra");
			cuotasedit = $("#cuotasedit").val();

			if(cuotasedit < 1 || cuotasedit > 4){
				$("#alertcuotasedit").show();
				$("#cuotasedit").addClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", true);
			}else{
				$("#alertcuotasedit").hide();
				$("#cuotasedit").removeClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", false);
			}
	} 

		function matricula(){
			//console.log("entra");
			matriculas = $("#valorMatricula").val();

			if(matriculas < 0){
				//alert('ya no es menor a 4');
				$("#alertmatricula").show();
				$("#valorMatricula").addClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", true);
			}else{
				$("#alertmatricula").hide();
				$("#valorMatricula").removeClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", false);
			}
		} 

		function matriculaedit(){
			//console.log("entra");
			matriculasedit = $("#valorMatriculaedit").val();

			if(matriculasedit < 0){
				//alert('ya no es menor a 4');
				$("#alertmatriculaedit").show();
				$("#valorMatriculaedit").addClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", true);
			}else{
				$("#alertmatriculaedit").hide();
				$("#valorMatriculaedit").removeClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", false);
			}
		} 

		function idioma(){
			//console.log("entra");
			idiomas = $("#valorIdiomas").val();

			if(idiomas < 0){
				//alert('ya no es menor a 4');
				$("#alertidioma").show();
				$("#valorIdiomas").addClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", true);
			}else{
				$("#alertidioma").hide();
				$("#valorIdiomas").removeClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", false);
			}
		}

		function idiomaedit(){
			//console.log("entra");
			idiomasedit = $("#valorIdiomasedit").val();

			if(idiomasedit < 0){
				//alert('ya no es menor a 4');
				$("#alertidiomaedit").show();
				$("#valorIdiomasedit").addClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", true);
			}else{
				$("#alertidiomaedit").hide();
				$("#valorIdiomasedit").removeClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", false);
			}
		} 

		function servicio(){
			//console.log("entra");
			servicios = $("#valorServicio").val();

			if(servicios < 0){
				//alert('ya no es menor a 4');
				$("#alertservicio").show();
				$("#valorServicio").addClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", true);
			}else{
				$("#alertservicio").hide();
				$("#valorServicio").removeClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", false);
			}
		} 

		function servicioedit(){
			//console.log("entra");
			serviciosedit = $("#valorServicioedit").val();

			if(serviciosedit < 0){
				//alert('ya no es menor a 4');
				$("#alertservicioedit").show();
				$("#valorServicioedit").addClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", true);
			}else{
				$("#alertservicioedit").hide();
				$("#valorServicioedit").removeClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", false);
			}
		} 

		function porcmatricula(){
			//console.log("entra");
			pormatriculas = $("#porcMatricula").val();

			if(pormatriculas < 0|| pormatriculas > 100){
				$("#alertporcmatricula").show();
				$("#porcMatricula").addClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", true);
			}else{
				$("#alertporcmatricula").hide();
				$("#porcMatricula").removeClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", false);
			}
		} 

		function porcmatriculaedit(){
			//console.log("entra");
			porcmatriculasedit = $("#porcMatriculaedit").val();

			if(porcmatriculasedit < 0|| porcmatriculasedit > 100){
				$("#alertporcmatriculaedit").show();
				$("#porcMatriculaedit").addClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", true);
			}else{
				$("#alertporcmatriculaedit").hide();
				$("#porcMatriculaedit").removeClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", false);
			}
		} 

		function porcidioma(){
			//console.log("entra");
			porcidiomas = $("#porcIdiomas").val();

			if(porcidiomas < 0|| porcidiomas > 100){
				$("#alertporcidioma").show();
				$("#porcIdiomas").addClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", true);
			}else{
				$("#alertporcidioma").hide();
				$("#porcIdiomas").removeClass('errorva');
				$("#btn_guardarpromociones").prop("disabled", false);
			}
		} 

		function porcidiomaedit(){
			//console.log("entra");
			porcidiomasedit = $("#porcIdiomasedit").val();

			if(porcidiomasedit < 0|| porcidiomasedit > 100){
				$("#alertporcidiomaedit").show();
				$("#porcIdiomasedit").addClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", true);
			}else{
				$("#alertporcidiomaedit").hide();
				$("#porcIdiomasedit").removeClass('errorva');
				$("#btn_actualizarpromociones").prop("disabled", false);
			}
		} 



/* Javascript guia del formulario - ANDRES  - CAMBIOS*/
	
	$(document).ready(function(){
		$("#estado").addClass('sig');
		$("#estado").focus();
	});

	$('#estado').on('change', function(){
	  	//Remarcar fecha registro
	  	$("#estado").removeClass('sig');
	  	$("#fechaRegistro").addClass('sig');
	  	$("#fechaRegistro").focus();
	});

	$("#fechaRegistro").change(function(){
		$("#estado").removeClass('sig');
		$("#fechaRegistro").removeClass('sig');
		$("#tipoPromocion").addClass('sig');
        $("#tipoPromocion").focus();
    })

	$("#tipoPromocion").blur(function(){
		$("#tipoPromocion").removeClass('sig');
		$("#periodo").addClass('sig');
		$("#periodo").focus();
	});

	$('#periodo').on('change', function(){
	  	$("#periodo").removeClass('sig');
	  	$("#periodoIdiomas").addClass('sig');
	  	$("#periodoIdiomas").focus();
	});

	$('#periodoIdiomas').on('change', function(){
	  	$("#periodoIdiomas").removeClass('sig');
	  	$("#programa").addClass('sig');
	  	$("#programa").focus();
	});

	$('#programa').on('change', function(){
	  	$("#programa").removeClass('sig');
	  	$("#ciclo").addClass('sig');
	  	$("#ciclo").focus();
	});

	$('#ciclo').on('change', function(){
	  	$("#ciclo").removeClass('sig');
	  	$("#tipoInscripcion").addClass('sig');
	  	$("#tipoInscripcion").focus();
	});

	$('#tipoInscripcion').on('change', function(){
	  	$("#tipoInscripcion").removeClass('sig');
	  	$("#valorMatricula").addClass('sig');
	  	$("#valorMatricula").focus();
	});


	$("#valorMatricula").blur(function(){
		$("#valorMatricula").removeClass('sig');
		$("#valorIdiomas").addClass('sig');
		$("#valorIdiomas").focus();
	});

	$("#valorIdiomas").blur(function(){
		$("#valorIdiomas").removeClass('sig');
		$("#valorServicio").addClass('sig');
		$("#valorServicio").focus();
	});	

	$("#valorServicio").blur(function(){
		$("#valorServicio").removeClass('sig');
		$("#cuotas").addClass('sig');
		$("#cuotas").focus();
	});	

	$("#cuotas").blur(function(){
		$("#cuotas").removeClass('sig');
		$("#porcMatricula").addClass('sig');
		$("#porcMatricula").focus();
	});	

	$("#porcMatricula").blur(function(){
		$("#porcMatricula").removeClass('sig');
		$("#porcIdiomas").addClass('sig');
		$("#porcIdiomas").focus();
	});	

	$("#porcIdiomas").blur(function(){
		$("#porcIdiomas").removeClass('sig');
		$("#financiacion").focus();
	});	


	function OpcionEs(str){
		op = str;
		if(op == 1){
			$("#div_masivo").hide();
			$("#div_manual").show();
		}else{
			$("#div_manual").hide();
			$("#div_masivo").show();		
		}
	}

	function doSearch(str){
         
		if(str == 1){
			var tableReg = document.getElementById('TablaFinanciaciones');
	    	var searchText = document.getElementById('searchTerm').value.toLowerCase();
		}else if(str == 2){
			var tableReg = document.getElementById('TablaResultFnMs');
	    	var searchText = document.getElementById('searchTerm2').value.toLowerCase();
		}else{
			var tableReg = document.getElementById('TablaRefFP');
	    	var searchText = document.getElementById('searchTerm3').value.toLowerCase();
		}	
	    
	    var cellsOfRow="";
	    var found=false;
	    var compareWith="";

	    for (var i = 1; i < tableReg.rows.length; i++)
	    {
	      cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
	      found = false;
	      for (var j = 0; j < cellsOfRow.length && !found; j++)
	      {
	        compareWith = cellsOfRow[j].innerHTML.toLowerCase();
	        if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
	        {
	          found = true;
	        }
	      }
	      if(found)
	      {
	        tableReg.rows[i].style.display = '';
	      } else {
	        tableReg.rows[i].style.display = 'none';
	      }
	    }
	}

	function verPeriodoMs(){
		
		periodo = $("#periodomasivo").val();

		if(periodo == '' || periodo == null){
			Swal.fire("Debes seleccionar un periodo");
			return 0;
		}

		$("#Modal_Masivo_F").modal('show');

		datos = {'periodo':periodo};

		$.ajax({
		url: 'php/ConsRegistrosPeriodo.php',
		data: datos,
		type: 'POST',
			success:function(Table){
				$("#div_table_periodos").html(Table);
			}
		});
	}

	function ChechkMs(){

		if( $('#check_masivo').prop('checked') ) {
		    //Marcar todos los checks
		    $(".check_ms_migrar").prop("checked", true);
		}else{
			//Desmarcar todos los checks
			$(".check_ms_migrar").prop("checked", false);
		}

	}

	function MigrarDatos(){

		var arr = $('[name="check_periodo[]"]:checked').map(function(){
        return this.value;
	    }).get();
	  
	    var str = arr.join(',');
	  
	    registros = str;
	    
	    if(registros == ''){
	        Swal.fire("Debes seleccionar minimo un registro");
	        return 0;

	    }

	    $("#registros_mg").val(registros);
	    $("#Modal_Masivo_Destino").modal('show');

	}

	function MigrarDatosPNew(){

		periodo_new = $("#periodomasivodest").val();
		periodo_ant = $("#periodomasivo").val();

		if(periodo_new == '' || periodo_new == null){
			Swal.fire("Debes seleccionar el nuevo periodo");
			return 0;
		}

		//Validar si esta seguro de hacer la migracion

		Swal.fire({
		  title: '¿Realizar la migracion de los datos al periodo: '+periodo_new+'?',
		  text: "Esta acción no se podra revertir!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Migrar datos',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
		  if (result.isConfirmed) {
		    
		    jsShowWindowLoad('Espera un momento, estamos procesando la informacion');

			    tipo_masivo_gest = $("#tipo_masivo_gest").val();

			    if(tipo_masivo_gest == 1){

			    	//Capturar la tabla con las modificaciones

			        var registros = "";

					$(".registro_table_ms").parent("tr").find("td").each(function(){
		            	registros += $(this).text() + '+';
			        });
			        
			        registros_selec = $("#registros_mg").val();

			        datos = {'registros':registros,'periodo_new':periodo_new,'periodo_ant':periodo_ant,'registros_selec':registros_selec};

					$.ajax({
					url: 'php/InsertFinanciacionMsEdit.php',
					data: datos,
					type: 'POST',
						success:function(table_result){
							$("#Modal_Masivo_Destino").modal('hide');
							$("#Modal_Masivo_F").modal('hide');
							jsRemoveWindowLoad();
							Swal.fire("Gestion realizada correctamente", "", "success");
							$("#Modal_result_ms").modal('show');
							$("#table_result_ms").html(table_result);
						},error:function( jqXHR, textStatus, errorThrown ){
							jsRemoveWindowLoad();
			            	Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", 
			            		"warning");
			        	}
					});
			        
			     	
			    }else{

			    	registros = $("#registros_mg").val();

			    	datos = {'registros':registros,'periodo_new':periodo_new,'periodo_ant':periodo_ant};

					$.ajax({
					url: 'php/InsertFinanciacionMs.php',
					data: datos,
					type: 'POST',
						success:function(table_result){
							$("#Modal_Masivo_Destino").modal('hide');
							$("#Modal_Masivo_F").modal('hide');
							jsRemoveWindowLoad();
							Swal.fire("Gestion realizada correctamente", "", "success");
							$("#Modal_result_ms").modal('show');
							$("#table_result_ms").html(table_result);
						},error:function( jqXHR, textStatus, errorThrown ){
							jsRemoveWindowLoad();
			            	Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", 
			            		"warning");
			        	}
					});

			    }
		  }
		});
	}

	//Editar cualquier dato uno a uno
	function EditUnoxUno(tipo,id_span){
		//Abrir modal

		serverLocation = '190.184.202.251:8090';
		
		$("#id_span_edit").val(id_span);
		$("#tipo_edit_unoxuno").val(tipo);

		$("#div_tipofinanciacion_unoxuno").hide();
		$("#div_periodoidiomas_unoxuno").hide();
		$("#div_programacademico_unoxuno").hide();
		$("#div_ciclo_unoxuno").hide();
		$("#div_tipoinscripcion_unoxuno").hide();	
		$("#div_valormatricula_unoxuno").hide();
		$("#div_valoridiomas_unoxuno").hide();
		$("#div_valorservicio_unoxuno").hide();
		$("#div_cuotas_unoxuno").hide();

		periodo = $("#periodomasivo").val();
		programa = null;
		ciclo = null;

		if(tipo == 1){
			//Editar tipo de financiacion
			$("#"+id_span).addClass('pintarTd');
			$("#div_tipofinanciacion_unoxuno").show();

		}else if(tipo == 2){
			//Editar periodo idiomas
			$("#"+id_span).addClass('pintarTd');


			//select periodo Idiomas
			$.ajax({
				url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Periodo_idiomas.php',
				type: 'POST',
				data: 'periodo='+periodo,
				success: function(r){
					var obj = JSON.parse(JSON.stringify(r));
					var objHtml = '';
					
					for(var i=0; i< obj.length; i++){
						objHtml += '<option value ="'+obj[i].periodo_idiomas+'">'+obj[i].periodo_idiomas+'</option>';
					}
					
					$('#periodoIdiomas_edit_unoxuno').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
				}
			});

			$("#div_periodoidiomas_unoxuno").show();

		}else if(tipo == 3){
			//Editar programa
			$("#"+id_span).addClass('pintarTd');

			//select Programa Academico
			$.ajax({
				url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Programa.php',
				type: 'POST',
				data: 'periodo='+periodo,
				success: function(r){
					var obj = JSON.parse(JSON.stringify(r));
					var objHtml = '';
					
					for(var i=0; i< obj.length; i++){
						objHtml += '<option value ="'+obj[i].nombre+'">'+obj[i].nombre+'</option>';
					}
					
					$('#programa_edit_unoxuno').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
				}
			});

			$("#div_programacademico_unoxuno").show();


		}else if(tipo == 4){
			//Editar ciclo
			$("#"+id_span).addClass('pintarTd');

			//select Ciclo propedeutico
			$.ajax({
				url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Ciclo.php',
				type: 'POST',
				data: 'programa='+programa+'&periodo='+periodo,
				success: function(r){
					var obj = JSON.parse(JSON.stringify(r));
					var objHtml = '';
					
					for(var i=0; i< obj.length; i++){
						objHtml += '<option value ="'+obj[i].ciclo+'">'+obj[i].ciclo+'</option>';
					}
					
					$('#ciclo_edit_unoxuno').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
				}
			});

			$("#div_ciclo_unoxuno").show();

		}else if(tipo == 5){
			//Editar tipo inscripcion
			$("#"+id_span).addClass('pintarTd');

			//select Tipo Inscripcion:
			$.ajax({
				url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Inscripcion.php',
				type: 'POST',
				data: 'programa='+programa+'&periodo='+periodo+'&ciclo='+ciclo,
				success: function(r){
					var obj = JSON.parse(JSON.stringify(r));
					var objHtml = '';
					
					for(var i=0; i< obj.length; i++){
						objHtml += '<option value ="'+obj[i].descripcion+'">'+obj[i].descripcion+'</option>';
					}
					
					$('#tipoinscripcion_edit_unoxuno').html('<option disabled selected>Selecciona una opción</option>'+objHtml);
				}
			});

			$("#div_tipoinscripcion_unoxuno").show();	

		}else if(tipo == 6){
			//Editar valor matricula
			$("#"+id_span).addClass('pintarTd');
			$("#div_valormatricula_unoxuno").show();

		}else if(tipo == 7){
			//Editar valor idiomas
			$("#"+id_span).addClass('pintarTd');
			$("#div_valoridiomas_unoxuno").show();

		}else if(tipo == 8){
			//Editar valor servicio
			$("#"+id_span).addClass('pintarTd');
			$("#div_valorservicio_unoxuno").show();			
		}else if(tipo == 9){
			//Editar numero cuotas
			$("#"+id_span).addClass('pintarTd');
			$("#div_cuotas_unoxuno").show();	
		}

		$("#Modal_edit_td_unoxuno").modal('show');

	}


	function ActualizarTableTemporalUnoxUno(){

		id_span_edit = $("#id_span_edit").val();
		tipo = $("#tipo_edit_unoxuno").val();

		if(tipo == 1){

			//Capturar el tipo de financiacion

			tipo_financiacion = $("#tipofinanciacion_edit_unoxuno").val();

			if(tipo_financiacion == '' || tipo_financiacion == null){
				Swal.fire("Debes escoger un tipo de financiacion");
				return 0;
			}

			$("#"+id_span_edit).html(tipo_financiacion);


		}else if(tipo == 2){

			//Capturar el periodo idiomas

			periodo_idiomas = $("#periodoIdiomas_edit_unoxuno").val();

			if(periodo_idiomas == '' || periodo_idiomas == null){
				Swal.fire("Debes escoger un periodo_idiomas");
				return 0;
			}

			$("#"+id_span_edit).html(periodo_idiomas);

		}else if(tipo == 3){

			//Capturar programa

			programa = $("#programa_edit_unoxuno").val();

			if(programa == '' || programa == null){
				Swal.fire("Debes escoger un programa");
				return 0;
			}

			$("#"+id_span_edit).html(programa);

		}else if(tipo == 4){

			//Capturar ciclo

			ciclo = $("#ciclo_edit_unoxuno").val();

			if(ciclo == '' || ciclo == null){
				Swal.fire("Debes escoger un ciclo");
				return 0;
			}

			$("#"+id_span_edit).html(ciclo);

		}else if(tipo == 5){

			//Capturar tipo inscripcion

			tipo_inscripcion = $("#tipoinscripcion_edit_unoxuno").val();

			if(tipo_inscripcion == '' || tipo_inscripcion == null){
				Swal.fire("Debes escoger un tipo de inscripcion");
				return 0;
			}

			$("#"+id_span_edit).html(tipo_inscripcion);

		}else if(tipo == 6){

			//Capturar valor matricula

			valor_matricula = $("#valormatricula_edit_unoxuno").val();

			if(valor_matricula == '' || valor_matricula == null){
				Swal.fire("El valor de la matricula no puede estar vacio");
				return 0;
			}

			if(valor_matricula <= 0){
				Swal.fire("El valor de matricula no es valido", "Debe ser mayor a 1", "warning");
				return 0;
			}


			$("#"+id_span_edit).html(valor_matricula);			

		}else if(tipo == 7){

			//Capturar valor idiomas

			valor_idiomas = $("#valoridiomas_edit_unoxno").val();

			if(valor_idiomas == '' || valor_idiomas == null){
				Swal.fire("El valor de idiomas no puede estar vacio");
				return 0;
			}

			if(valor_idiomas <= 0){
				Swal.fire("El valor de idiomas no es valido", "Debe ser mayor a 1", "warning");
				return 0;
			}

			$("#"+id_span_edit).html(valor_idiomas);	

		}else if(tipo == 8){

			//Capturar valor servicio

			valor_servicio = $("#valorservicio_edit_unoxuno").val();

			if(valor_servicio == '' || valor_servicio == null){
				Swal.fire("El valor del servicio no puede estar vacio");
				return 0;
			}

			if(valor_servicio <= 0){
				Swal.fire("El valor de servicio no es valido", "Debe ser mayor a 1", "warning");
				return 0;
			}

			$("#"+id_span_edit).html(valor_servicio);	
		
		}else if(tipo == 9){

			//Capturar numero de cuotas

			cuotas = $("#cuotas_edit_unoxuno").val();

			if(cuotas == '' || cuotas == null){
				Swal.fire("El numero de cuotas no puede estar vacio");
				return 0;
			}

			if(cuotas < 1 || cuotas > 4){
				Swal.fire("El numero de cuotas no es valido" ,"Debe ser entre 1 y 4", "warning");
				return 0;
			}

			$("#"+id_span_edit).html(cuotas);	

		}

		Swal.fire("Dato actualizado correctamente", "", "success");
		$("#Modal_edit_td_unoxuno").modal('hide');
		$("#tipo_masivo_gest").val(1);

	}


  
function jsRemoveWindowLoad() {
    // eliminamos el div que bloquea pantalla
    $("#WindowLoad").remove();
 
}
 
function jsShowWindowLoad(mensaje) {
    //eliminamos si existe un div ya bloqueando
    jsRemoveWindowLoad();
 
    //si no enviamos mensaje se pondra este por defecto
    if (mensaje === undefined) mensaje = "Procesando la información&amp;lt;br&amp;gt;Espere por favor";
 
    //centrar imagen gif
    height = 20;//El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;
 
    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;
 
    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto/2 - parseInt(height)/2;//Se utiliza en el margen superior, para centrar
 
   //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold;'>" + mensaje + "</div><img  src='img/loading.gif' style='width:150px;'></div>";
 
        //creamos el div que bloquea grande------------------------------------------
        div = document.createElement("div");
        div.id = "WindowLoad"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("body").append(div);
 
        //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
        input = document.createElement("input");
        input.id = "focusInput";
        input.type = "text"
 
        //asignamos el div que bloquea
        $("#WindowLoad").append(input);
 
        //asignamos el foco y ocultamos el input text
        $("#focusInput").focus();
        $("#focusInput").hide();
 
        //centramos el div del texto
        $("#WindowLoad").html(imgCentro);
 
}

function EditMs(str){

	$("#tipo_entrada_edit").val(str);
	$("#div_tipofinanciacion").hide();
	$("#div_periodoidiomas").hide();
	$("#div_programacademico").hide();
	$("#div_ciclo").hide();
	$("#div_tipoinscripcion").hide();
	$("#div_valormatricula").hide();
	$("#div_valoridiomas").hide();
	$("#div_valorservicio").hide();
	$("#div_cuotas").hide();

	serverLocation = '190.184.202.251:8090';
	periodo = $("#periodomasivo").val();
	programa = null;
	ciclo = null;

	switch (str) {
	  case 1:
	    //Editar tipo financiacion masivo
	    $(".tipo_financiacion_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Tipo financiacion');
	    $("#div_tipofinanciacion").show();
	    $("#tipofinanciacion_edit_ms").val('');
	    $("#Modal_edit_td_masivo").modal('show');

	    break;
	  case 2:
	    //Editar Periodo idiomas masivo
	    $(".periodo_idiomas_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Periodo Idiomas');

	    //Cargar Periodos idioma

		//select periodo Idiomas
		$.ajax({
			url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Periodo_idiomas.php',
			type: 'POST',
			data: 'periodo='+periodo,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
				var objHtml = '';
				
				for(var i=0; i< obj.length; i++){
					objHtml += '<option value ="'+obj[i].periodo_idiomas+'">'+obj[i].periodo_idiomas+'</option>';
				}
				
				$('#periodoIdiomas_edit_ms').html('<option disabled selected>Selecciona una opción</option>'+objHtml);

				$("#div_periodoidiomas").show();
			    $("#periodoIdiomas_edit_ms").val('');
			    $("#Modal_edit_td_masivo").modal('show');
			}
		});

	    break;
	  case 3:
	    //Editar Programa masivo
	    $(".programa_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Programa');

		//select Programa Academico
		$.ajax({
			url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Programa.php',
			type: 'POST',
			data: 'periodo='+periodo,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
				var objHtml = '';
				
				for(var i=0; i< obj.length; i++){
					objHtml += '<option value ="'+obj[i].nombre+'">'+obj[i].nombre+'</option>';
				}
				
				$('#programa_edit_ms').html('<option disabled selected>Selecciona una opción</option>'+objHtml);

				$("#div_programacademico").show();
	    		$("#Modal_edit_td_masivo").modal('show');

			}
		});

	    break;
	  case 4:
	    //Editar Ciclo masivo
	    $(".ciclo_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Ciclo');

	    //select Ciclo propedeutico
		$.ajax({
			url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Ciclo.php',
			type: 'POST',
			data: 'programa='+programa+'&periodo='+periodo,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
				var objHtml = '';
				
				for(var i=0; i< obj.length; i++){
					objHtml += '<option value ="'+obj[i].ciclo+'">'+obj[i].ciclo+'</option>';
				}
				
				$('#ciclo_edit_ms').html('<option disabled selected>Selecciona una opción</option>'+objHtml);

				$("#div_ciclo").show();
	    		$("#Modal_edit_td_masivo").modal('show');

			}
		});

	    break;
	  case 5:
	    //Editar tipo inscripcion
	    $(".tipo_inscripcion_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Tipo inscripcion');

	    //select Tipo Inscripcion:
		$.ajax({
			url: 'http://'+serverLocation+'/formularioback/Admin/Promociones/Inscripcion.php',
			type: 'POST',
			data: 'programa='+programa+'&periodo='+periodo+'&ciclo='+ciclo,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
				var objHtml = '';
				
				for(var i=0; i< obj.length; i++){
					objHtml += '<option value ="'+obj[i].descripcion+'">'+obj[i].descripcion+'</option>';
				}
				
				$('#tipoinscripcion_edit_ms').html('<option disabled selected>Selecciona una opción</option>'+objHtml);

				$("#div_tipoinscripcion").show();
	    		$("#Modal_edit_td_masivo").modal('show');

			}
		});


	    break;
	  case 6:
	    //Editar valor matricula
		$(".valor_matricula_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Valor matricula');	    
	    $("#div_valormatricula").show();
	   	$("#Modal_edit_td_masivo").modal('show');

	    break;
	  case 7:
	    //Editar valor idiomas
		$(".valor_idiomas_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Valor Idiomas');	    
	    $("#div_valoridiomas").show();
	   	$("#Modal_edit_td_masivo").modal('show');
	    break;
	  case 8:
	    //Editar valor servicios
	    $(".valor_servicio_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Valor Servicio');	    
	    $("#div_valorservicio").show();
	   	$("#Modal_edit_td_masivo").modal('show');
	    break;
	  case 9:
	    //Editar cuotas
	    $(".numero_cuotas_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Cuotas');	    
	    $("#div_cuotas").show();
	   	$("#Modal_edit_td_masivo").modal('show');

	    break;
	  default:
	    Swal.fire("Tenemos un error interno", "", "warning");
	    return 0;
	}

}


function ActualizarTableTemporal(){

	str = $("#tipo_entrada_edit").val();

	if(str == 1){

		tipo_financiacion = $("#tipofinanciacion_edit_ms").val();

	  	if(tipo_financiacion == '' || tipo_financiacion == null){
	  		Swal.fire("Debes escoger un tipo de Financiación"); 
	  		return 0;
	  	}

	  	$(".txt_td_tipo_financiacion").html(tipo_financiacion);

	}else if(str == 2){

		periodo_idiomas = $("#periodoIdiomas_edit_ms").val();

		if(periodo_idiomas == '' || periodo_idiomas == null){
			Swal.fire("Debes escoger un periodo de idiomas");
			return 0;
		}

		$(".txt_td_periodo_idiomas").html(periodo_idiomas);		

	}else if(str == 3){

		programa = $("#programa_edit_ms").val();

		if(programa == '' || programa == null){
			Swal.fire("Debes escoger un programa academico");
			return 0;
		}

		$(".txt_td_programa").html(programa);				

	}else if(str == 4){

		ciclo = $("#ciclo_edit_ms").val();

		if(ciclo == '' || ciclo == null){
			Swal.fire("Debes escoger un ciclo");
			return 0;
		}

		$(".txt_td_ciclo").html(ciclo);	

	}else if(str == 5){

		tipo_inscripcion = $("#tipoinscripcion_edit_ms").val();

		if(tipo_inscripcion == '' || tipo_inscripcion == null){
			Swal.fire("Debes escoger un tipo de inscripcion");
			return 0;
		}

		$(".txt_td_tipo_inscripcion").html(tipo_inscripcion);

	}else if(str == 6){

		valor_matricula = $("#valormatricula_edit_ms").val();

		if(valor_matricula == '' || valor_matricula == null){
			Swal.fire("El valor de la matricula no puede estar vacio");
			return 0;
		}

		if(valor_matricula <= 0){
			Swal.fire("El valor de matricula no es valido", "Debe ser mayor a 1", "warning");
			return 0;
		}

		$(".txt_td_valor_matricula").html(valor_matricula);		

	}else if(str == 7){

		valor_idiomas = $("#valoridiomas_edit_ms").val();

		if(valor_idiomas == '' || valor_idiomas == null){
			Swal.fire("El valor idiomas no puede estar vacio");
			return 0;
		}

		if(valor_idiomas <= 0){
			Swal.fire("El valor de idiomas no es valido", "Debe ser mayor a 1", "warning");
			return 0;
		}

		$(".txt_td_valor_idiomas").html(valor_idiomas);

	}else if(str == 8){

		valor_servicio = $("#valorservicio_edit_ms").val();

		if(valor_servicio == '' || valor_servicio == null){
			Swal.fire("El valor de servicio no puede estar vacio");
			return 0;
		}

		if(valor_servicio <= 0){
			Swal.fire("El valor de servicio no es valido", "Debe ser mayor a 1", "warning");
			return 0;
		}

		$(".txt_td_valor_servicio").html(valor_servicio);

	}else if(str == 9){

		cuotas = $("#cuotas_edit_ms").val();

		if(cuotas == '' || cuotas == null){
			Swal.fire("Las cuotas no pueden estar vacias");
			return 0;
		}

		if(cuotas < 1 || cuotas > 4){
			Swal.fire("El numero de cuotas no es valido" ,"Debe ser entre 1 y 4", "warning");
			return 0;
		}

		$(".txt_td_cuotas").html(cuotas);

	}
	
	$("#Modal_edit_td_masivo").modal('hide');
	Swal.fire("Datos actualizados correctamente", "", "success");
	$("#tipo_masivo_gest").val(1);


}

/* Fin guia del formulario */
	
