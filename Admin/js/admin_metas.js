window.onload = ConsultarTiposMetas;
function ConsultarTiposMetas(){

    $.ajax({
    url: "php/metas/ConsTiposMetas.php",
    type: "post",
        success:function(table){
            $("#table_tipos_metas").html(table);
        }
    });

}

function CrearMeta(){

	nombre_meta = $("#nombre_meta").val();

	if(nombre_meta == ''){
		Swal.fire("El nombre no puede estar vacio");
		return 0;
	}

	if($('#clase_ingreso').prop('checked')){clase_ingreso = 1;}else{clase_ingreso = 0;}
	if($('#tipo_ingreso').prop('checked')){tipo_ingreso = 1;}else{tipo_ingreso = 0;}
	if($('#regional').prop('checked')){regional = 1;}else{regional = 0;}
	if($('#sede').prop('checked')){sede = 1;}else{sede = 0;}
	if($('#modalidad').prop('checked')){modalidad = 1;}else{modalidad = 0;}
	if($('#programa').prop('checked')){programa = 1;}else{programa = 0;}
	if($('#nivel').prop('checked')){nivel = 1;}else{nivel = 0;}
	if($('#ciclo').prop('checked')){ciclo = 1;}else{ciclo = 0;}
	if($('#tipo_alumno').prop('checked')){tipo_alumno = 1;}else{tipo_alumno = 0;}
	if($('#grupo').prop('checked')){grupo = 1;}else{grupo = 0;}
	if($('#valor_meta').prop('checked')){valor_meta = 1;}else{valor_meta = 0;}
	if($('#cantidad_meta').prop('checked')){cantidad_meta = 1;}else{cantidad_meta = 0;}

	datos = {'nombre_meta':nombre_meta,'clase_ingreso':clase_ingreso,'tipo_ingreso':tipo_ingreso,'regional':regional,'sede':sede,'modalidad':modalidad,'programa':programa
	,'nivel':nivel,'ciclo':ciclo,'tipo_alumno':tipo_alumno,'grupo':grupo,'valor_meta':valor_meta,'cantidad_meta':cantidad_meta};

	$.ajax({
	data: datos,
	type: 'POST',
	url: 'php/metas/CrearTipoMeta.php',
		success:function(R){
			if(R == 1){
				$("#FormInsert")[0].reset();
				Swal.fire("Tipo de meta creada correctamente", "", "success");
				ConsultarTiposMetas();
			}else{
				Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
			}
		},error:function( jqXHR, textStatus, errorThrown ){
			Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
		}
	});

}

function EditarTipoMeta(str){

	id = str;

	datos = {'id':id};

	$.ajax({
	data: datos,
	type: 'POST',
	url: 'php/metas/ConsDatosMeta.php',
	dataType: 'JSON',
		success:function(Data){
			
			$("#id_unidad_negocio").val(id);

			datos_meta = Data[0];

			nombre_meta = datos_meta['NOMBRE_META'];
			$("#nom_meta_edit").val(nombre_meta);

			modalidad = datos_meta['CON_MODA'];
			programa = datos_meta['CON_PROGRAMA'];
			nivel = datos_meta['CON_NFORMA'];
			ciclo = datos_meta['CON_CICLO'];
			tipo_alumno = datos_meta['CON_TALUMNO'];
			valor_ingresos = datos_meta['CON_VMETA'];
			cantidad_estudiantes = datos_meta['CON_CMETA'];

			if(modalidad == 1){
				$("#modalidad_edit").prop("checked", true);
			}else{
				$("#modalidad_edit").prop("checked", false);
			}

			if(programa == 1){
				$("#programa_edit").prop("checked", true);
			}else{
				$("#programa_edit").prop("checked", false);
			}

			if(nivel == 1){
				$("#nivel_edit").prop("checked", true);
			}else{
				$("#nivel_edit").prop("checked", false);
			}
			
			if(ciclo == 1){
				$("#ciclo_edit").prop("checked", true);
			}else{
				$("#ciclo_edit").prop("checked", false);
			}
			
			if(tipo_alumno == 1){
				$("#tipo_alumno_edit").prop("checked", true);
			}else{
				$("#tipo_alumno_edit").prop("checked", false);
			}
			
			if(valor_ingresos == 1){
				$("#valor_meta_edit").prop("checked", true);
			}else{
				$("#valor_meta_edit").prop("checked", false);
			}
			
			if(cantidad_estudiantes == 1){
				$("#cantidad_meta_edit").prop("checked", true);
			}else{
				$("#cantidad_meta_edit").prop("checked", false);
			}
			
			$("#Modal_EditarTipoMeta").modal('show');
		}
	});

}

function ActualizarUnidadNegocio(){

	id = $("#id_unidad_negocio").val();
	nombre_meta = $("#nom_meta_edit").val();

	if(nombre_meta == ''){Swal.fire("El nombre no puede estar vacio"); return 0;}

	if($('#modalidad_edit').prop('checked')){modalidad = 1;}else{modalidad = 0;}
	if($('#programa_edit').prop('checked')){programa = 1;}else{programa = 0;}
	if($('#nivel_edit').prop('checked')){nivel = 1;}else{nivel = 0;}
	if($('#ciclo_edit').prop('checked')){ciclo = 1;}else{ciclo = 0;}
	if($('#tipo_alumno_edit').prop('checked')){tipo_alumno = 1;}else{tipo_alumno = 0;}
	if($('#valor_meta_edit').prop('checked')){valor_ingresos = 1;}else{valor_ingresos = 0;}
	if($('#cantidad_meta_edit').prop('checked')){cantidad_estudiantes = 1;}else{cantidad_estudiantes = 0;}

	datos = {'id':id,'nombre_meta':nombre_meta,'modalidad':modalidad,'programa':programa
	,'nivel':nivel,'ciclo':ciclo,'tipo_alumno':tipo_alumno,'valor_ingresos':valor_ingresos,'cantidad_estudiantes':cantidad_estudiantes};

	$.ajax({
	url : 'php/metas/UpdateUnidadNegocio.php',
	data: datos,
	type: 'POST',
		success:function(R){
			if(R == 1){
				Swal.fire("Unidad de negocio actualizada correctamente", "", "success");
				ConsultarTiposMetas();
				$("#Modal_EditarTipoMeta").modal('hide');
			}else{
				Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
			}
			
		},error:function( jqXHR, textStatus, errorThrown ){
			Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
		}
	});

}	