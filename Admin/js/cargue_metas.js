$(document).ready(function(){

	//serverLocation = 'localhost/CUN/';
	serverLocation = '190.184.202.251:8090/';

	//realizamos cargue de las unidades de negocio
	$.ajax({
		url: 'http://'+serverLocation+'formularioback/Admin/metas/UnidadesNegocio.php',
		method: 'POST',
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].id+'">'+obj[i].nombre_meta+'</option>';
                }

			$('#unidad_negocio').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#unidad_negocio_ms').html('<option selected value="">Seleccionar</option>'+objHtml);
		}
	});

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
			$('#periodo_reporte').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#periodo_inicio_ms').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#periodo_destino_ms').html('<option selected value="">Seleccionar</option>'+objHtml);
	
		}
	});

	//realizamos cargue de los grupos de analisis
	$.ajax({
		url: 'php/metas/CargarGrupoAnalisis.php',
		method: 'POST',
		success: function(data){
			$("#grupo_analisis").html(data);
			$("#grupo_analisis_inicio_ms").html(data);
			$("#grupo_analisis_destino_ms").html(data);
		}
	});

	//realizamos cargue de las regionales
	$.ajax({
		url: 'http://'+serverLocation+'formularioback/Admin/metas/regionales.php',
		method: 'POST',
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].COD_SECC+'">'+obj[i].SECCIONAL+'</option>';
                }

			$('#regional').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#regional_edit').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#regional_edit_ms').html('<option selected value="">Seleccionar</option>'+objHtml);
			
		}
	});

	//realizamos el cargue de las sedes
	$('#regional').on('change',function(){
		regional = $(this).val();
		//select periodo Idiomas
		$.ajax({
			url: 'http://'+serverLocation+'formularioback/Admin/metas/sedes.php',
			type: 'POST',
			data: 'regional='+regional,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
				var objHtml = '';
				
				for(var i=0; i< obj.length; i++){
					objHtml += '<option value ="'+obj[i].COD_SEDE+'">'+obj[i].SEDE+'</option>';
				}
				
				$('#sede').html('<option selected value="">Selecciona una opción</option>'+objHtml);
			}
		});
	});


	//realizamos el cargue de las sedes edit
	$('#regional_edit').on('change',function(){
		regional = $(this).val();
		//select periodo Idiomas
		$.ajax({
			url: 'http://'+serverLocation+'formularioback/Admin/metas/sedes.php',
			type: 'POST',
			data: 'regional='+regional,
			success: function(r){
				var obj = JSON.parse(JSON.stringify(r));
				var objHtml = '';
				
				for(var i=0; i< obj.length; i++){
					objHtml += '<option value ="'+obj[i].COD_SEDE+'">'+obj[i].SEDE+'</option>';
				}
				
				$('#sede_edit').html('<option selected value="">Selecciona una opción</option>'+objHtml);
			}
		});
	});


	//realizamos cargue de los tipos de alumno
	$.ajax({
		url: 'http://'+serverLocation+'formularioback/Admin/metas/tipos_alumno.php',
		method: 'POST',
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].ID+'">'+obj[i].DESCRIPCION+'</option>';
                }

			$('#tipo_alumno').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#tipo_alumno_edit').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#tipo_alumno_edit_ms').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#tipo_alumno_edit_unoxuno').html('<option selected value="">Seleccionar</option>'+objHtml);
		
		}	
	});

	//realizamos cargue de los programas
	$.ajax({
		url: 'http://'+serverLocation+'formularioback/Admin/metas/programas.php',
		method: 'POST',
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].COD_PROGRAMA+'">'+obj[i].NOM_PROGRAMA+'</option>';
                }

			$('#programa').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#programa_edit').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#programa_edit_ms').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#programa_edit_unoxuno').html('<option selected value="">Seleccionar</option>'+objHtml);
			
		}
	});

	//realizamos cargue de las modalidades
	$.ajax({
		url: 'http://'+serverLocation+'formularioback/Admin/metas/modalidad.php',
		method: 'POST',
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].COD_MODA+'">'+obj[i].MODALIDAD+'</option>';
                }

			$('#modalidad').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#modalidad_edit').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#modalidad_edit_ms').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#modalidad_edit_unoxuno').html('<option selected value="">Seleccionar</option>'+objHtml);	
		}
	});

	//realizamos cargue de los ciclos
	$.ajax({
		url: 'http://'+serverLocation+'formularioback/Admin/metas/ciclos.php',
		method: 'POST',
		success: function(r){
			var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';
                
                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].COD_CICLO+'">'+obj[i].CICLO+'</option>';
                }

			$('#ciclo').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#ciclo_edit').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#cilo_edit_ms').html('<option selected value="">Seleccionar</option>'+objHtml);
			$('#ciclo_edit_unoxuno').html('<option selected value="">Seleccionar</option>'+objHtml);
			
		}
	});

	//realizamos cargue de los grupos de analisis
	$.ajax({
		url: 'php/metas/CargarGrupoAnalisis.php',
		method: 'POST',
		success: function(data){
			$("#grupo_analisis_insert").html(data);
			$("#grupo_analisis_reporte").html(data);
		}
	});

	OpcionEs();

});

function OpcionEs(str){
	op = 1;
	//op = str;
	if(op == 1){
		$(".masivo_reg").hide();
		$(".manual_reg").show();
	}else{
		$(".manual_reg").hide();
		$("#crear_new_meta").hide();
		$(".masivo_reg").show();		
	}
}


function ConsultarGruposA(){

	unidad_negocio = $("#unidad_negocio").val();
	periodo = $("#periodo").val();

	if(unidad_negocio == ''){Swal.fire("Debes escoger una unidad de negocio");return 0;}
	//if(periodo == ''){Swal.fire("Debes escoger un periodo");return 0;}

	$("#table_grupos_analisis").html('<center><img src="img/Gif_Loading.gif" width="250"></center>');
	$("#valor_temporal").val('');

	datos = {'unidad_negocio':unidad_negocio,'periodo':periodo};

	$.ajax({
	url: 'php/metas/ConsGruposAnalisis.php',
	data: datos,
	type: 'POST',
		success:function(table_grupos){
			$("#table_grupos_analisis").html(table_grupos);
			$("#crear_new_meta").show();


			datos = {'id':unidad_negocio};

			$.ajax({
			url: 'php/metas/ConsDatosMeta.php',
			data: datos,
			type: 'POST',
			dataType: 'JSON',
				success:function(Data){
					datos_meta = Data[0];

					programa = datos_meta['CON_PROGRAMA'];

					if(programa == 1){
						$("#div_programa").show();
					}else{
						$("#div_programa").hide();
					}

					modalidad = datos_meta['CON_MODA'];

					if(modalidad == 1){
						$("#div_modalidad").show();
					}else{
						$("#div_modalidad").hide();
					}

					ciclo = datos_meta['CON_CICLO'];

					if(ciclo == 1){
						$("#div_ciclo").show();
					}else{
						$("#div_ciclo").hide();
					}

					tipo_alumno = datos_meta['CON_TALUMNO'];

					if(tipo_alumno == 1){
						$("#div_tipo_alumno").show();
					}else{
						$("#div_tipo_alumno").hide();
					}

					meta_estudiantes = datos_meta['CON_CMETA'];

					if(meta_estudiantes == 1){
						$("#div_meta_estudiantes").show();
					}else{
						$("#div_meta_estudiantes").hide();
					}

					valor_ingresos = datos_meta['CON_VMETA'];

					if(valor_ingresos == 1){
						$("#div_meta_valor_ingresos").show();
					}else{
						$("#div_meta_valor_ingresos").hide();
					}
					

					//Consultar los totales de estudiantes y dinero

					datos_totales = {'id':unidad_negocio,'periodo':periodo};

					$.ajax({
					url: 'php/metas/ConsDatosTot.php',
					data: datos_totales,
					type: 'POST',
					dataType: 'JSON',
						success:function(data_tot){
							
							cantidad = data_tot['cantidad'];
							valor = data_tot['valor'];

							if(cantidad == '' || cantidad == null){cantidad = 0;}
							if(valor == '' || valor == null){valor = 0;}

							$("#txt_tot_estudiantes").html(cantidad);
							$("#txt_valor_dinero").html('$ ' + valor);
							
						}
					});


					$("#div_uno_data").show();
					$("#div_dos_data").show();
					$("#div_tres_data").show();
					$("#div_cuatro_data").show();


					$("#crear_new_meta").show();

					grupo_analisis = null;
					if(grupo_analisis == '' || grupo_analisis == undefined || grupo_analisis == null){
						grupo_analisis = null;
					}

					ConsultarMetasCreadas(unidad_negocio,periodo,grupo_analisis);
				}
			});

		},error:function( jqXHR, textStatus, errorThrown ){
			Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
		}
	});

}


function ConsultarMetas(str){

	unidad_negocio = $("#unidad_negocio").val();
	periodo = str['PERIODO'];
	grupo_analisis = str['GRUPO'];

	if(unidad_negocio == ''){Swal.fire("Debes escoger una unidad de negocio");return 0;}
	if(periodo == ''){Swal.fire("Debes escoger un periodo");return 0;}
	if(grupo_analisis == ''){Swal.fire("Debes escoger un grupo de analisis");return 0;}

	$("#grupo_analisis_id").val(grupo_analisis);

	ConsultarMetasCreadas(unidad_negocio,periodo,grupo_analisis);	
}

function ConsultarMetasCreadas(unidad_negocio,periodo,grupo_analisis){

	datos = {'unidad_negocio':unidad_negocio,'periodo':periodo,'grupo_analisis':grupo_analisis};

	$.ajax({
	url: 'php/metas/ConsMetasCreadas.php',
	data: datos,
	type: 'POST',
		success:function(table){
			$("#table_metas_creadas").html(table);
			$("#Tabla").tablesorter();
		}
	});

}


function EditarMeta(str){

	serverLocation = '190.184.202.251:8090/';

	id = str;

	$("#id_meta").val(id);

	unidad_negocio = $("#unidad_negocio").val();

	datos_meta = {'id':unidad_negocio};

	$.ajax({
	url: 'php/metas/ConsDatosMeta.php',
	data: datos_meta,
	type: 'POST',
	dataType: 'JSON',
		success:function(data){
			
			datos_meta = data[0];

			programa = datos_meta['CON_PROGRAMA'];

			if(programa == 1){
				$("#div_programa_edit").show();
			}else{
				$("#div_programa_edit").hide();
			}

			modalidad = datos_meta['CON_MODA'];

			if(modalidad == 1){
				$("#div_modalidad_edit").show();
			}else{
				$("#div_modalidad_edit").hide();
			}

			ciclo = datos_meta['CON_CICLO'];

			if(ciclo == 1){
				$("#div_ciclo_edit").show();
			}else{
				$("#div_ciclo_edit").hide();
			}

			tipo_alumno = datos_meta['CON_TALUMNO'];

			if(tipo_alumno == 1){
				$("#div_tipo_alumno_edit").show();
			}else{
				$("#div_tipo_alumno_edit").hide();
			}

			meta_estudiantes = datos_meta['CON_CMETA'];

			if(meta_estudiantes == 1){
				$("#div_meta_estudiantes_edit").show();
			}else{
				$("#div_meta_estudiantes_edit").hide();
			}

			valor_ingresos = datos_meta['CON_VMETA'];

			if(valor_ingresos == 1){
				$("#div_meta_valor_ingresos_edit").show();
			}else{
				$("#div_meta_valor_ingresos_edit").hide();
			}

			//Consultar los datos del registro

			datos_reg = {'id':id};

			$.ajax({
			url: 'php/metas/ConsDatosMetaReg.php',
			data: datos_reg,
			type: 'POST',
			dataType: 'JSON',
				success:function(R){
					
					data_reg = R[0];

					regional_value = data_reg['COD_SECC'];

					//Cargar sedes y meter el value por default

					$.ajax({
						url: 'http://'+serverLocation+'formularioback/Admin/metas/sedes.php',
						type: 'POST',
						data: 'regional='+regional_value,
						async: false,
						success: function(r){
							var obj = JSON.parse(JSON.stringify(r));
							var objHtml = '';
							
							for(var i=0; i< obj.length; i++){
								objHtml += '<option value ="'+obj[i].COD_SEDE+'">'+obj[i].SEDE+'</option>';
							}
							
							$('#sede_edit').html('<option selected value="">Selecciona una opción</option>'+objHtml);
						}
					});

					sede_value = data_reg['COD_SEDE'];
					tipo_alumno_value = data_reg['TIPO_ALUMNO'];
					programa_value = data_reg['COD_PROGRAMA'];
					modalidad_value = data_reg['COD_MODA'];
					ciclo_value = data_reg['COD_CICLO'];
					meta_estudiantes_value = data_reg['C_META_'];
					meta_valor_ingresos_value = data_reg['V_META'];

					$("#regional_edit").val(regional_value);
					$("#sede_edit").val(sede_value);
					$("#tipo_alumno_edit").val(tipo_alumno_value);
					$("#programa_edit").val(programa_value);
					$("#modalidad_edit").val(modalidad_value);
					$("#ciclo_edit").val(ciclo_value);
					$("#meta_estudiantes_edit").val(meta_estudiantes_value);
					$("#valor_ingresos_edit").val(meta_valor_ingresos_value);

					$("#regional_edit_audi").val(regional_value);
					$("#sede_edit_audi").val(sede_value);
					$("#tipo_alumno_edit_audi").val(tipo_alumno_value);
					$("#programa_edit_audi").val(programa_value);
					$("#modalidad_edit_audi").val(modalidad_value);
					$("#ciclo_edit_audi").val(ciclo_value);
					$("#meta_estudiantes_edit_audi").val(meta_estudiantes_value);
					$("#valor_ingresos_edit_audi").val(meta_valor_ingresos_value);
					
					$("#Modal_EditarMeta").modal('show');
				}
			});
		}
	});
}	

function UpdateMetaReg(){

	//Capturar datos

	unidad_negocio = $("#unidad_negocio").val();

	datos = {'id':unidad_negocio};

	$.ajax({
	url: 'php/metas/ConsDatosMeta.php',
	data: datos,
	type: 'POST',
	dataType: 'JSON',
		success:function(Data){
			datos_meta = Data[0];

			programa = datos_meta['CON_PROGRAMA'];
			modalidad = datos_meta['CON_MODA'];
			ciclo = datos_meta['CON_CICLO'];
			tipo_alumno = datos_meta['CON_TALUMNO'];
			meta_estudiantes = datos_meta['CON_CMETA'];
			valor_ingresos = datos_meta['CON_VMETA'];

			//capturar datos

			regional_input = $("#regional_edit").val();
			sede_input = $("#sede_edit").val();
			tipo_alumno_input = $("#tipo_alumno_edit").val();
			programa_input = $("#programa_edit").val();
			modalidad_input = $("#modalidad_edit").val();
			ciclo_input = $("#ciclo_edit").val();
			meta_estudiantes_input = $("#meta_estudiantes_edit").val();
			valor_ingresos_input = $("#valor_ingresos_edit").val()

			if(regional_input == ''){Swal.fire("Debes seleccionar una regional"); return 0;}
			if(sede_input == ''){Swal.fire("Debes seleccionar una sede"); return 0;}

			if(tipo_alumno == 1){
				if(tipo_alumno_input == ''){Swal.fire("Debes seleccionar un tipo de alumno");return 0;}
			}

			if(programa == 1){
				if(programa_input == ''){Swal.fire("Debes seleccionar un programa");return 0;}
			}

			if(modalidad == 1){
				if(modalidad_input == ''){Swal.fire("Debes seleccionar una modalidad");return 0;}
			}

			if(ciclo == 1){
				if(ciclo_input == ''){Swal.fire("Debes seleccionar un ciclo");return 0;}
			}

			if(meta_estudiantes == 1){
				if(meta_estudiantes_input == ''){Swal.fire("La meta de estudiantes no puede estar vacia");return 0;}
				if(meta_estudiantes_input == ''){Swal.fire("El valor no puede ser cero");return 0;}
			}

			if(valor_ingresos == 1){
				if(valor_ingresos_input == ''){Swal.fire("El valor de los ingresos no puede estar vacio");return 0;}
				if(valor_ingresos_input == ''){Swal.fire("El valor no puede ser cero");return 0;}
			}

			id_meta = $("#id_meta").val();

			//Capturar datos antes auditoria

			regional_edit_audi = $("#regional_edit_audi").val();
			sede_edit_audi = $("#sede_edit_audi").val();
			tipo_alumno_edit_audi = $("#tipo_alumno_edit_audi").val();
			programa_edit_audi = $("#programa_edit_audi").val();
			modalidad_edit_audi = $("#modalidad_edit_audi").val();
			ciclo_edit_audi = $("#ciclo_edit_audi").val();
			meta_estudiantes_edit_audi = $("#meta_estudiantes_edit_audi").val();
			valor_ingresos_edit_audi = $("#valor_ingresos_edit_audi").val();

			datos = {'id_meta':id_meta,
			'regional_input':regional_input,'sede_input':sede_input,'programa_input':programa_input,'modalidad_input':modalidad_input,
			'ciclo_input':ciclo_input,'tipo_alumno_input':tipo_alumno_input,
			'valor_ingresos_input':valor_ingresos_input,'meta_estudiantes_input':meta_estudiantes_input,
				'regional_edit_audi':regional_edit_audi,
				'sede_edit_audi':sede_edit_audi,
				'tipo_alumno_edit_audi':tipo_alumno_edit_audi,
				'programa_edit_audi':programa_edit_audi,
				'modalidad_edit_audi':modalidad_edit_audi,
				'ciclo_edit_audi':ciclo_edit_audi,
				'meta_estudiantes_edit_audi':meta_estudiantes_edit_audi,
				'valor_ingresos_edit_audi':valor_ingresos_edit_audi
			};

			$.ajax({
			url: 'php/metas/UpdateMetaReg.php',
			data: datos,
			type: 'POST',
				success:function(R){
					if(R == 1){
						Swal.fire("Datos actualizados correctamente", "", "success");
						unidad_negocio = $("#unidad_negocio").val();
						periodo = $("#periodo").val();
						grupo_analisis = null;
						$("#Modal_EditarMeta").modal('hide');
						ConsultarMetasCreadas(unidad_negocio,periodo,grupo_analisis);
					}else{
						Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
					}
				},error:function( jqXHR, textStatus, errorThrown ){
					Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
				}
			});
		}
	});	
}


function AgregarMeta(){

	unidad_negocio = $("#unidad_negocio").val();
	periodo = $("#periodo").val();
	grupo_analisis = $("#grupo_analisis_insert").val();

	if(grupo_analisis == ''){
		Swal.fire("Debes seleccionar un grupo de analisis");
		return 0;
	}

	datos = {'id':unidad_negocio};

	$.ajax({
	url: 'php/metas/ConsDatosMeta.php',
	data: datos,
	type: 'POST',
	dataType: 'JSON',
		success:function(Data){
			datos_meta = Data[0];

			programa = datos_meta['CON_PROGRAMA'];
			modalidad = datos_meta['CON_MODA'];
			ciclo = datos_meta['CON_CICLO'];
			tipo_alumno = datos_meta['CON_TALUMNO'];
			meta_estudiantes = datos_meta['CON_CMETA'];
			valor_ingresos = datos_meta['CON_VMETA'];

			//capturar datos

			regional_input = $("#regional").val();
			sede_input = $("#sede").val();
			tipo_alumno_input = $("#tipo_alumno").val();
			programa_input = $("#programa").val();
			modalidad_input = $("#modalidad").val();
			ciclo_input = $("#ciclo").val();
			meta_estudiantes_input = $("#meta_estudiantes").val();
			valor_ingresos_input = $("#valor_ingresos").val();

			//validar cuales deben ser obligatorios	

			if(regional_input == ''){Swal.fire("Debes seleccionar una regional"); return 0;}
			if(sede_input == ''){Swal.fire("Debes seleccionar una sede"); return 0;}

			if(tipo_alumno == 1){
				if(tipo_alumno_input == ''){Swal.fire("Debes seleccionar un tipo de alumno");return 0;}
			}

			if(programa == 1){
				if(programa_input == ''){Swal.fire("Debes seleccionar un programa");return 0;}
			}

			if(modalidad == 1){
				if(modalidad_input == ''){Swal.fire("Debes seleccionar una modalidad");return 0;}
			}

			if(ciclo == 1){
				if(ciclo_input == ''){Swal.fire("Debes seleccionar un ciclo");return 0;}
			}

				if(meta_estudiantes == 1){
				if(meta_estudiantes_input == ''){Swal.fire("La meta de estudiantes no puede estar vacia");return 0;}
				if(meta_estudiantes_input == 0){Swal.fire("El valor no puede ser cero"); return 0;}
			}

			if(valor_ingresos == 1){
				if(valor_ingresos_input == ''){Swal.fire("El valor de los ingresos no puede estar vacio");return 0;}
				if(valor_ingresos_input == 0){Swal.fire("El valor no puede ser cero"); return 0;}
			}

			tipo_ingreso = null;
			clase_ingreso = null;
			nivel_formacion = null;
			grupo = grupo_analisis;

			datos = {'unidad_negocio':unidad_negocio,'periodo':periodo,'tipo_ingreso':tipo_ingreso,'clase_ingreso':clase_ingreso,
			'regional_input':regional_input,'sede_input':sede_input,'programa_input':programa_input,'modalidad_input':modalidad_input,
			'ciclo_input':ciclo_input,'nivel_formacion':nivel_formacion,'tipo_alumno_input':tipo_alumno_input,'grupo':grupo,
			'valor_ingresos_input':valor_ingresos_input,'meta_estudiantes_input':meta_estudiantes_input};

			$.ajax({
			url: 'php/metas/CrearMeta.php',
			data: datos,
			type: 'POST',
				success:function(R){
					if(R == 1){
						Swal.fire("Meta creada correctamente", "", "success");
						$("#form_insert")[0].reset();
						//ConsultarMetasCreadas(unidad_negocio,periodo,grupo_analisis);
						ConsultarMetasCreadas(unidad_negocio,periodo,grupo_analisis);
						ConsultarGruposA();
						$("#ModalCrearMeta").modal('hide');
					}else if(R == 2){
						Swal.fire("El registro ya existe", "", "warning");
					}else{
						Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
					}
				},error:function( jqXHR, textStatus, errorThrown ){
					Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
				}
			});

		}
	});
}

function ExportarExcel(){

	unidad_negocio = $("#unidad_negocio").val();
	periodo = $("#periodo_reporte").val();
	grupo_analisis = $("#grupo_analisis_reporte").val();

	if(unidad_negocio == ''){Swal.fire("Debes escoger una unidad de negocio");return 0;}

	Swal.fire({
	  title: '¿Generar reporte?',
	  text: "",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Generar',
	  cancelButtonText: 'Cancelar'
	}).then((result) => {
	  if (result.isConfirmed) {
	    	
	  	$("#btn_reporte").prop("disabled", true);
		$("#result_file_load").html('Generando Excel, espera un momento...');

		datos = {'unidad_negocio':unidad_negocio,'periodo':periodo,'grupo_analisis':grupo_analisis};

		$.ajax({
		url: 'php/metas/ExportarExcel.php',
		data: datos,
		type: 'POST',
		dataType: 'JSON',
			success:function(R){
				$("#btn_reporte").prop("disabled", false);

				status = R['status'];
				link = R['link'];

				if(status == 1){
					Swal.fire("Archivo generado correctamente", "", "success");
					$("#result_file_load").html('<div class="alert" role="alert">Tu archivo se ha generado correctamente, puedes descargar el resultado</div><a href="'+link+'" class="btn btn-dark form-control" id="link_download_excel">Descargar Excel</a>');
				}else{
					Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
				}
			},error:function( jqXHR, textStatus, errorThrown ){
				Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
			}
		});

	  }
	})
}



function doSearch(){
                                            
    var tableReg = document.getElementById('TablaMetas');
    var searchText = document.getElementById('searchTerm').value.toLowerCase();
    var cellsOfRow="";
    var found=false;
    var compareWith="";

    for (var i = 1; i < tableReg.rows.length; i++){

	      cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
	      found = false;

	      for (var j = 0; j < cellsOfRow.length && !found; j++){

	        compareWith = cellsOfRow[j].innerHTML.toLowerCase();

	        if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)){
	          found = true;
	        }

	      }

	      if(found){
	        tableReg.rows[i].style.display = '';
	      }else{
	        tableReg.rows[i].style.display = 'none';
	      }
    }
}


function SumarPorcentaje(){

	valor = $("#valor_temporal").val();

	if(valor == ''){
		Swal.fire("El valor no puede estar vacio");
		return 0;
	}

	//Capturar los ids y su valor

	var registros = "";

	$(".registro_table_ms").each(function(){
    	registros += $(this).html().trim() + '+';
    });

	//Convertir string en array

	const registro_arr = registros.split('+');

	//Recorrer array

	registro_arr.forEach(function(valor_arr, index){

		if(valor_arr == '' || valor_arr == null || valor_arr == undefined){
			//console.log(index + ' : ' + valor_arr);
		}else{

			//Convertir valor HTML en array para acceder al ID del span

			const valores_arr_html = valor_arr.split('"');

			id_span = valores_arr_html[5];

			//Capturar valor del span

			valor_span = $("#"+id_span).text();

			//Eliminar caracter pesos y comas

			valor_span_pesos = valor_span.replace('$', ''); 
			valor_span_full = valor_span_pesos.replace(',', ''); 

			//Ahora sacar el porcentaje del valor y sumarlo

			valor_a_sumar = parseFloat(valor) * parseFloat(valor_span_full) / 100;

			valor_span_nuevo = parseFloat(valor_span_full) + parseFloat(valor_a_sumar);

			valor_span_nuevo = addCommas(valor_span_nuevo);

			$("#"+id_span).html('$'+valor_span_nuevo);

		}	    
	});
}

function RestarPorcentaje(){

	valor = $("#valor_temporal").val();

	if(valor == ''){
		Swal.fire("El valor no puede estar vacio");
		return 0;
	}

	//Capturar los ids y su valor

	var registros = "";

	$(".registro_table_ms").each(function(){
    	registros += $(this).html().trim() + '+';
    });

	//Convertir string en array

	const registro_arr = registros.split('+');

	//Recorrer array

	registro_arr.forEach(function(valor_arr, index){

		if(valor_arr == '' || valor_arr == null || valor_arr == undefined){
			//console.log(index + ' : ' + valor_arr);
		}else{

			//Convertir valor HTML en array para acceder al ID del span

			const valores_arr_html = valor_arr.split('"');

			id_span = valores_arr_html[5];

			//Capturar valor del span

			valor_span = $("#"+id_span).text();

			//Eliminar caracter pesos y comas

			valor_span_pesos = valor_span.replace('$', ''); 
			valor_span_full = valor_span_pesos.replace(',', ''); 

			//Ahora sacar el porcentaje del valor y sumarlo

			valor_a_sumar = parseFloat(valor) * parseFloat(valor_span_full) / 100;

			valor_span_nuevo = parseFloat(valor_span_full) - parseFloat(valor_a_sumar);

			valor_span_nuevo = addCommas(valor_span_nuevo);

			$("#"+id_span).html('$'+valor_span_nuevo);

		}	    
	});
}


function addCommas(nStr){
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


//Editar cualquier dato uno a uno
function EditUnoxUno(tipo,id_span){
	//Abrir modal

	$("#id_span_edit").val(id_span);
	$("#tipo_edit_unoxuno").val(tipo);
	$("#div_tipo_alumno_unoxuno").hide();
	$("#div_programa_unoxuno").hide();
	$("#div_modalidad_unoxuno").hide();
	$("#div_ciclo_unoxuno").hide();
	$("#div_meta_estudiantes_unoxuno").hide();
	$("#div_valor_meta_estudiantes_unoxuno").hide();

	if(tipo == 1){
		//Editar tipo de alumno
		$("#"+id_span).addClass('pintarTd');
		$("#div_tipo_alumno_unoxuno").show();

	}else if(tipo == 2){
		//Editar programa
		$("#"+id_span).addClass('pintarTd');
		$("#div_programa_unoxuno").show();

	}else if(tipo == 3){
		//Editar modalidad
		$("#"+id_span).addClass('pintarTd');
		$("#div_modalidad_unoxuno").show();

	}else if(tipo == 4){
		//Editar ciclo
		$("#"+id_span).addClass('pintarTd');
		$("#div_ciclo_unoxuno").show();

	}else if(tipo == 5){
		//Editar meta estudiantes
		$("#"+id_span).addClass('pintarTd');
		$("#div_meta_estudiantes_unoxuno").show();

	}else if(tipo == 6){
		//Editar valor meta estudiantes
		$("#"+id_span).addClass('pintarTd');
		$("#div_valor_meta_estudiantes_unoxuno").show();
	}

	$("#Modal_edit_td_unoxuno").modal('show');

}


function ActualizarTableTemporalUnoxUno(){

	id_span_edit = $("#id_span_edit").val();
	tipo = $("#tipo_edit_unoxuno").val();

	if(tipo == 1){

		//tipo_alumno = $("#tipo_alumno_edit_unoxuno").val();
		tipo_alumno = $('select[id="tipo_alumno_edit_unoxuno"] option:selected').text();

		if(tipo_alumno == '' || tipo_alumno == null){
			Swal.fire("Debes escoger un tipo de alumno");
			return 0;
		}
		$("#"+id_span_edit).html(tipo_alumno);

	}else if(tipo == 2){

		//programa = $("#programa_edit_unoxuno").val();
		programa = $('select[id="programa_edit_unoxuno"] option:selected').text();

		if(programa == '' || programa == null){
			Swal.fire("Debes escoger un programa");
			return 0;
		}
		$("#"+id_span_edit).html(programa);

	}else if(tipo == 3){

		//modalidad = $("#modalidad_edit_unoxuno").val();
		modalidad = $('select[id="modalidad_edit_unoxuno"] option:selected').text();

		if(modalidad == '' || modalidad == null){
			Swal.fire("Debes escoger una modalidad");
			return 0;
		}
		$("#"+id_span_edit).html(modalidad);

	}else if(tipo == 4){

		//ciclo = $("#ciclo_edit_unoxuno").val();
		ciclo = $('select[id="ciclo_edit_unoxuno"] option:selected').text();

		if(ciclo == '' || ciclo == null){
			Swal.fire("Debes escoger un ciclo");
			return 0;
		}
		$("#"+id_span_edit).html(ciclo);

	}else if(tipo == 5){

		meta_estudiantes = $("#meta_estudiantes_edit_unoxuno").val();
		if(meta_estudiantes == '' || meta_estudiantes == null){
			Swal.fire("La meta no puede estar vacia");
			return 0;
		}

		if(meta_estudiantes == 0){
			Swal.fire("El valor no puede ser cero");
			return 0;
		}

		$("#"+id_span_edit).html(meta_estudiantes);

	}else if(tipo == 6){

		valor_meta = $("#valor_meta_estudiantes_edit_unoxuno").val();
		if(valor_meta == '' || valor_meta == null){
			Swal.fire("El valor de la meta no puede estar vacia");
			return 0;
		}

		if(valor_meta == 0){
			Swal.fire("El valor no puede ser cero");
			return 0;
		}
		
		$("#"+id_span_edit).html(valor_meta);

	}

	Swal.fire("Dato actualizado correctamente", "", "success");
	$("#Modal_edit_td_unoxuno").modal('hide');
	$("#tipo_masivo_gest").val(1);

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

	var arr = $('[name="check_meta[]"]:checked').map(function(){
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

	unidad_negocio = $("#unidad_negocio").val();
	periodo_destino = $("#periodo_destino_ms").val();
	grupo_analisis = $("#grupo_analisis_destino_ms").val();

	if(periodo_destino == '' || periodo_destino == null){
		Swal.fire("Debes seleccionar el nuevo periodo");
		return 0;
	}

	if(grupo_analisis == '' || grupo_analisis == null){
		Swal.fire("Debes seleccionar el nuevo grupo de analisis");
		return 0;
	}

	//Validar si esta seguro de hacer la migracion

	Swal.fire({
	  title: '¿Realizar la migracion de los datos al periodo: '+periodo_destino+' y al grupo de analisis: '+grupo_analisis+'?',
	  text: "Esta acción no se podra revertir!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Migrar datos',
	  cancelButtonText: 'Cancelar'
	}).then((result) => {
	  if (result.isConfirmed) {
	    
	    //jsShowWindowLoad('Espera un momento, estamos procesando la informacion');
	  
	    	//Capturar la tabla con las modificaciones

	        var registros = "";

			$(".registro_table_ms").parent("tr").find("td").each(function(){
            	registros += $(this).text().trim() + '+';
	        });

	        registros_selec = $("#registros_mg").val();

	        datos = {'registros':registros,'unidad_negocio':unidad_negocio,'periodo_destino':periodo_destino,
	        'grupo_analisis':grupo_analisis,'registros_selec':registros_selec};

			$.ajax({
			url: 'php/metas/CrearMetaMs.php',
			data: datos,
			type: 'POST',
				success:function(table_result){
					$("#Modal_Masivo_Destino").modal('hide');
					jsRemoveWindowLoad();
					Swal.fire("Gestion realizada correctamente", "", "success");
					$("#Modal_result_ms").modal('show');
					$("#table_result_ms").html(table_result);
					ConsultarGruposA();
				},error:function( jqXHR, textStatus, errorThrown ){
					jsRemoveWindowLoad();
	            	Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", 
	            		"warning");
	        	}
			});
	
	  }
	});
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

function EliminarMeta(str){

	var id_meta = str;

	Swal.fire({
	  title: '¿Eliminar meta?',
	  text: "Esta accion no se podrá revertir!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Eliminar',
	  cancelButtonText: 'Cancelar'
	}).then((result) => {
	  if (result.isConfirmed) {
	    	
	  	datos = {'id_meta':id_meta};

	  	$.ajax({
	  	url: 'php/metas/EliminarMeta.php',
	  	data: datos,
	  	type: 'POST',
	  		success:function(R){
	  			if(R == 1){
	  				Swal.fire("Meta eliminada correctamente", "", "success");
	  				ConsultarGruposA();
	  			}else{
	  				Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", 
            		"warning");
	  			}
	  		},error:function( jqXHR, textStatus, errorThrown ){
            	Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", 
            		"warning");
        	}
	  	});

	  }
	});
}

function EliminarGrupoA(str){

	var unidad_negocio = $("#unidad_negocio").val();
	var grupo_analisis = str['GRUPO'];
	var periodo = str['PERIODO'];

	if(unidad_negocio == ''){
		Swal.fire("La unidad de negocio no puede estar vacia");
		return 0;
	}

	Swal.fire({
	  title: '¿Eliminar metas del grupo de analisis?',
	  text: "Esta accion no se podrá revertir!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Eliminar',
	  cancelButtonText: 'Cancelar'
	}).then((result) => {
	  if (result.isConfirmed) {
	    	
	  	datos = {'unidad_negocio':unidad_negocio,'grupo_analisis':grupo_analisis,'periodo':periodo};

	  	$.ajax({
	  	url: 'php/metas/EliminarMetasGrupo.php',
	  	data: datos,
	  	type: 'POST',
	  		success:function(R){
	  			if(R == 1){
	  				Swal.fire("Metas eliminadas correctamente del grupo "+grupo_analisis, "", "success");
	  				ConsultarGruposA();
	  			}else{
	  				Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", 
            		"warning");
	  			}
	  		},error:function( jqXHR, textStatus, errorThrown ){
            	Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", 
            		"warning");
        	}
	  	});

	  }
	});

}


/*

function ConsultarMetasMS(){

	unidad_negocio = $("#unidad_negocio_ms").val();
	periodo = $("#periodo_ms").val();
	grupo_analisis = $("#grupo_analisis_ms").val();

	if(unidad_negocio == ''){Swal.fire("Selecciona una unidad de negocio"); return 0;}
	if(periodo == ''){Swal.fire("Selecciona un periodo"); return 0;}
	if(grupo_analisis == ''){Swal.fire("Selecciona un grupo de analisis"); return 0;}

	datos = {'unidad_negocio':unidad_negocio,'periodo':periodo,'grupo_analisis':grupo_analisis};

	$.ajax({
	url: 'php/metas/ConsMetasCreadasMS.php',
	data: datos,
	type: 'POST',
		success:function(table){
			$("#table_metas_creadas_ms").html(table);
			$("#Tabla").tablesorter();
			$("#div_result_ms").show();
			$("#btn_migrar_ms").show();

						//Consultar los totales de estudiantes y dinero

			datos_totales = {'id':unidad_negocio,'periodo':periodo,'grupo_analisis':grupo_analisis};

			$.ajax({
			url: 'php/metas/ConsDatosTot.php',
			data: datos_totales,
			type: 'POST',
			dataType: 'JSON',
				success:function(data_tot){
					
					cantidad = data_tot['cantidad'];
					valor = data_tot['valor'];

					if(cantidad == '' || cantidad == null){cantidad = 0;}
					if(valor == '' || valor == null){valor = 0;}

					$("#txt_tot_estudiantes_ms").html(cantidad);
					$("#txt_valor_dinero_ms").html('$ ' + valor);
					
				}
			});


			$("#div_uno_data_ms").show();
			$("#div_dos_data_ms").show();
			$("#div_tres_data_ms").show();
			$("#div_cuatro_data_ms").show();

		}
	});

}

function EditMs(str){

	$("#tipo_entrada_edit").val(str);
	$("#div_regional_ms").hide();
	$("#div_tipo_alumno_ms").hide();
	$("#div_programa_ms").hide();
	$("#div_ciclo_ms").hide();
 	$("#div_meta_estudiantes_ms").hide();
 	$("#div_meta_valor_ingresos_ms").hide();
 	$("#div_modalidad_ms").hide();

	//serverLocation = '190.184.202.251:8090';
	serverLocation = 'localhost/CUN';

	switch (str) {
	  case 1:
	    //Editar regional
	    $(".regional_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Regional');
	    $("#div_regional_ms").show();
	    $("#regional_edit_ms").val('');
	    $("#Modal_edit_td_masivo").modal('show');

	    break;
	  case 2:
	    
	    break;
	  case 3:
	    //Editar tipo alumno
	    $(".tipo_alumno_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Tipo alumno');
	    $("#div_tipo_alumno_ms").show();
	    $("#tipo_alumno_edit_ms").val('');
	    $("#Modal_edit_td_masivo").modal('show');

	    break;
	  case 4:
	  	//Editar programa
	  	$(".programa_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Programa');
	    $("#div_programa_ms").show();
	    $("#programa_edit_ms").val('');
	    $("#Modal_edit_td_masivo").modal('show');


	    break;
	  case 5:
	  	//Editar modalidad
	  	$(".modalidad_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Modalidad');
	    $("#div_modalidad_ms").show();
	    $("#modalidad_edit_ms").val('');
	    $("#Modal_edit_td_masivo").modal('show');

	    break;
	  case 6:
	  	//Editar ciclo
	  	$(".ciclo_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Ciclo');
	    $("#div_ciclo_ms").show();
	    $("#cilo_edit_ms").val('');
	    $("#Modal_edit_td_masivo").modal('show');

	    break;
	  case 7:
	  	//Editar cantidad estudiantes
	  	$(".meta_estudiantes_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Meta estudiantes');
	    $("#div_meta_estudiantes_ms").show();
	    $("#meta_estudiantes_edit_ms").val('');
	    $("#Modal_edit_td_masivo").modal('show');

	    break;
	  case 8:
	  	//Editar meta valor ingresos
	  	$(".meta_valor_ingresos_td").addClass('pintarTd');
	    $("#nom_colum_edit").html('Meta valor ingresos');
	    $("#div_meta_valor_ingresos_ms").show();
	    $("#meta_valor_ingresos_edit_ms").val('');
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

		regional = $("#regional_edit_ms").val();

	  	if(regional == '' || regional == null){
	  		Swal.fire("Debes seleccionar una regional"); 
	  		return 0;
	  	}

	  	$(".txt_td_regional").html(regional);

	}else if(str == 2){

		

	}else if(str == 3){

		//tipo_alumno = $("#tipo_alumno_edit_ms").val();
		tipo_alumno = $('select[id="tipo_alumno_edit_ms"] option:selected').text();

		if(tipo_alumno == '' || tipo_alumno == null){
			Swal.fire("Debes seleccionar un tipo de alumno");
			return 0;
		}

		$(".txt_td_tipo_alumno").html(tipo_alumno);				

	}else if(str == 4){

		//programa = $("#programa_edit_ms").val();
		programa = $('select[id="programa_edit_ms"] option:selected').text();

		if(programa == '' || programa == null){
			Swal.fire("Debes seleccionar un programa");
			return 0;
		}

		$(".txt_td_programa").html(programa);		
		

	}else if(str == 5){

		//modalidad = $("#modalidad_edit_ms").val();
		modalidad = $('select[id="modalidad_edit_ms"] option:selected').text();

		if(modalidad == '' || modalidad == null){
			Swal.fire("Debes seleccionar una modalidad");
			return 0;
		}

		$(".txt_td_modalidad").html(modalidad);		

	}else if(str == 6){

		//ciclo = $("#cilo_edit_ms").val();
		ciclo = $('select[id="cilo_edit_ms"] option:selected').text();

		if(ciclo == '' || ciclo == null){
			Swal.fire("Debes seleccionar un ciclo");
			return 0;
		}

		$(".txt_td_ciclo").html(ciclo);	
				

	}else if(str == 7){

		meta_estudiantes = $("#meta_estudiantes_edit_ms").val();

		if(meta_estudiantes == '' || meta_estudiantes == null){
			Swal.fire("El valor no puede estar vacio");
			return 0;
		}

		$(".txt_td_meta_estudiantes").html(meta_estudiantes);	
		

	}else if(str == 8){

		valor_ingresos = $("#meta_valor_ingresos_edit_ms").val();

		if(valor_ingresos == '' || valor_ingresos == null){
			Swal.fire("El valor no puede estar vacio");
			return 0;
		}

		$(".txt_td_meta_valor_ingresos").html(valor_ingresos);	

	}

	$("#Modal_edit_td_masivo").modal('hide');
	Swal.fire("Datos actualizados correctamente", "", "success");
	$("#tipo_masivo_gest").val(1);


}



	











*/