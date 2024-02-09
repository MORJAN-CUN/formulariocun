$(document).ready(function(){

	//realizamos cargue de los centros de costos
	$.ajax({
	url: 'php/ingreso_laboral/CentroCostosKactus.php',
	method: 'POST',
		success: function(r){
			$('#centro_costo').html(r);
		}
	});

});

function Consultar(){

	centro_costo = $("#centro_costo").val();
	estado = $("#estado").val();
	existe_ingreso = $("#existe_ingreso").val();
	palabra_clave = $("#palabra_clave").val();

	datos = {'centro_costo':centro_costo,'estado':estado,'existe_ingreso':existe_ingreso,'palabra_clave':palabra_clave};

	$("#btncons").prop("disabled", true);
	$("#table_empleados").html('<center><img src="img/Gif_Loading.gif" width="250"></center>');

	$.ajax({
	url: 'php/ingreso_laboral/EmpleadosCreados.php',
	data: datos,
	type: 'POST',
		success:function(table){
			$("#btncons").prop("disabled", false);
			$("#table_empleados").html(table);
		}
	});

}


function doSearch(){
                                            
    var tableReg = document.getElementById('Tabla');
    var searchText = document.getElementById('searchTerm').value.toLowerCase();
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

function CrearIngreso(str){

	Swal.fire({
	  title: '¿Crear en ingreso laboral?',
	  text: "Esta accion no se podra revertir!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Crear',
	  cancelButtonText: 'Cancelar'
	}).then((result) => {
	  if (result.isConfirmed){

	  	datos = str;

	  	$.ajax({
	  	url: 'php/ingreso_laboral/CrearIngreso.php',
	  	data: datos,
	  	type: 'POST',
	  		success:function(R){
	  			if(R == 1){
	  					Swal.fire("Creado correctamente en Ingreso Laboral", "", "success");
	  					Consultar();
	  			}else if(R == 0){
	  					Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
	  			}else if(R == 2){
	  					Swal.fire("El usuario ya existe en Ingreso Laboral", "", "warning");
	  					return 0;
	  			}
	  		},error:function( jqXHR, textStatus, errorThrown ){
						Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
				}
	  	});

	  }
	})

}

function EditarEmpleado(str){

	cedula = str['COD_EMPL'];
	nombres = str['NOM_EMPL'];
	apellidos = str['APE_EMPL'];
	correo  = str['CORREO_KACTUS'];

	$("#txt_nom_empleado").html(nombres);
	$("#cedula_empleado").val(cedula);
	$("#nombres_empleado").val(nombres);
	$("#apellidos_empleado").val(apellidos);
	$("#correo_empleado").val(correo);
	
	$("#Modal_EditarEmpleado").modal('show');

}

function ActualizarDatoIngreso(){

		Swal.fire({
	  title: 'Actualizar datos en ingreso laboral?',
	  text: "Esta accion no se podra revertir!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Actualizar',
	  cancelButtonText: 'Cancelar'
	}).then((result) => {
	  if (result.isConfirmed){

				cedula_empleado = $("#cedula_empleado").val();
				nombres_empleado = $("#nombres_empleado").val();
				apellidos_empleado = $("#apellidos_empleado").val();
				correo_empleado = $("#correo_empleado").val();

				if(nombres_empleado == '' || apellidos_empleado == '' || correo_empleado == ''){
					Swal.fire("No pueden haber datos vacios");
					return 0;
				}

				datos = {'cedula_empleado':cedula_empleado,'nombres_empleado':nombres_empleado,
				'apellidos_empleado':apellidos_empleado,'correo_empleado':correo_empleado};

				$.ajax({
				url: 'php/ingreso_laboral/ActualizarEmpleado.php',
				data: datos,
				type: 'POST',
					success:function(R){
							if(R == 1){
								Swal.fire("Datos actualizados correctamente", "", "success");
								$("#Modal_EditarEmpleado").modal('hide');
								return 0;
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

