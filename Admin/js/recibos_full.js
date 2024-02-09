$(document).ready(function() {

    serverLocation = '190.184.202.251:8090';
    //serverLocation = 'localhost/CUN';

    //realizamos cargue de periodos activos
    $.ajax({
        url: 'http://' + serverLocation + '/formularioback/Admin/PeriodosActivos.php',
        method: 'POST',
        success: function(r) {
            var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';

            for (var i = 0; i < obj.length; i++) {
                objHtml += '<option value ="' + obj[i].periodo + '">' + obj[i].periodo + '</option>';
            }

            $('#periodo').html('<option selected value="">Periodo</option>' + objHtml);
        }
    });

    //realizamos cargue de los programas
    $.ajax({
        url: 'http://' + serverLocation + '/formularioback/Admin/recibos_full/programas.php',
        method: 'POST',
        success: function(r) {
            var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';

            for (var i = 0; i < obj.length; i++) {
                objHtml += '<option value ="' + obj[i].COD_PROGRAMA + '">' + obj[i].NOM_PROGRAMA + '</option>';
            }

            $('#programa').html('<option selected value="">Seleccionar</option>' + objHtml);
        }
    });

    //realizamos cargue de los ciclos
    $.ajax({
        url: 'http://' + serverLocation + '/formularioback/Admin/metas/ciclos.php',
        method: 'POST',
        success: function(r) {
            var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';

            for (var i = 0; i < obj.length; i++) {
                objHtml += '<option value ="' + obj[i].COD_CICLO + '">' + obj[i].CICLO + '</option>';
            }

            $('#ciclo').html('<option selected value="">Seleccionar</option>' + objHtml);
        }
    });


});

function ConsultarOrdenes() {

    periodo = $("#periodo").val();
    cedula = $("#cedula").val();
    programa = $("#programa").val();
    ciclo = $("#ciclo").val();

    if (periodo == '' || periodo == undefined || periodo == null) {
        Swal.fire("El Periodo no puede estar vacio");
        return 0;
    }

    if (programa == '' || programa == undefined || programa == null) {
        Swal.fire("El Programa no puede estar vacio");
        return 0;
    }

    if (ciclo == '' || ciclo == undefined || ciclo == null) {
        Swal.fire("El Ciclo no puede estar vacio");
        return 0;
    }

    if (cedula == '' || cedula == undefined || cedula == null) {
        cedula = null;
    }

    datos = { 'periodo': periodo, 'cedula': cedula, 'programa': programa, 'ciclo': ciclo };

    $("#btnload").prop("disabled", true);
    $("#loadingData").show();

    $.ajax({
        data: datos,
        type: 'POST',
        url: 'php/recibos_full/ConsOrdenes.php',
        success: function(table) {
            $("#btn_asig_masivo").show();
            $("#btnload").prop("disabled", false);
            $("#loadingData").hide();

            $("#table_result").html(table);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#btnload").prop("disabled", false);
            $("#loadingData").hide();
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    })

}


function ConsultaCedula() {

    cedula = $("#cedula").val();

    if (cedula == '' || cedula == undefined || cedula == null) {
        Swal.fire("La cédula no puede estar vacia");
        return 0;
    }

    datos = { 'cedula': cedula };

    $("#btnload1").prop("disabled", true);
    $("#loadingData").show();

    $.ajax({
        data: datos,
        type: 'POST',
        url: 'php/recibos_full/ConsOrdenesCedula.php',
        success: function(table) {
            /* $("#btn_asig_masivo").show(); */
            $("#btnload1").prop("disabled", false);
            $("#loadingData").hide();

            $("#table_result").html(table);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#btnload").prop("disabled", false);
            $("#loadingData").hide();
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    })

}

$(document).on('click', '.Update_Orden', function() {

    var descr = $(this).attr('data-descr');
    res = descr.split("}");

    orden = (res[0]);
    valor_nuevo = (res[1]);
    valor_antiguo = (res[2]);
    documento = (res[3]);
    cedula_cli = (res[4]);
    valor_orden_act = (res[5]);
    valor_convenio = (res[6]);

    $("#numero_orden_txt").html(orden);

    $("#valor_orden_select").html(
        '<option value="">Seleccionar</option>' +
        '<option value=' + valor_nuevo + '>Nuevo: ' + valor_nuevo + '</option>' +
        '<option value=' + valor_antiguo + '>Continuo: ' + valor_antiguo + '</option>' +
        '<option value=' + valor_convenio + '>Convenio: ' + valor_convenio + '</option>'
    )


    $("#id_orden").val(orden.replace(/ /g, ""));
    $("#id_documento").val(documento);
    $("#valor_orden_act").val(valor_orden_act);

    $("#Modal_Actualizar_Orden").modal('show');
    $(".modG").modal('hide');


});

function Actualizar_Valor() {

    orden = $("#id_orden").val();
    documento = $("#id_documento").val();
    valor_orden = $("#valor_orden_select").val();
    valor_orden_act = $("#valor_orden_act").val();

    if (valor_orden == '') {
        Swal.fire("Debes escoger un valor para la orden");
        return 0;
    }

    Swal.fire({
        title: '¿Actualizar valor de la orden?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            datos = { 'orden': orden, 'documento': documento, 'valor_orden': valor_orden, 'valor_orden_act': valor_orden_act };

            $.ajax({
                url: 'php/recibos_full/Update_Orden.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Orden actualizada correctamente", "", "success");
                        ConsultarOrdenes();
                        $("#Modal_Actualizar_Orden").modal('hide');
                    } else {
                        Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                }
            });

        }
    })

}

function ChechkMs() {

    if ($('#check_masivo').prop('checked')) {
        //Marcar todos los checks
        $(".check_ms_migrar").prop("checked", true);
    } else {
        //Desmarcar todos los checks
        $(".check_ms_migrar").prop("checked", false);
    }

}

function AsignarValorMasivo() {

    var arr = $('[name="check_orden[]"]:checked').map(function() {
        return this.value;
    }).get();

    var str = arr.join(',');

    registros = str;

    if (registros == '') {
        Swal.fire("Debes seleccionar minimo un registro");
        return 0;

    }

    $("#registros_mg").val(registros);
    $("#Modal_Actualizar_Orden_MS").modal('show');

}

function ActualizarOrdenesMs() {

    registros = $("#registros_mg").val();
    tipo_valor = $("#valor_orden_ms").val();

    if (tipo_valor == '') {
        Swal.fire("Debes seleccionar un tipo de valor para las ordenes");
        return 0;
    }

    Swal.fire({
        title: '¿Actualizar valor de las ordenes seleccioandas?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            jsShowWindowLoad('Estamos procesando la informacion, espera un momento');

            datos = { 'registros': registros, 'tipo_valor': tipo_valor };

            $.ajax({
                url: 'php/recibos_full/Update_Orden_MS.php',
                data: datos,
                type: 'POST',
                success: function(table) {
                    $("#Modal_Actualizar_Orden_MS").modal('hide');
                    $(".check_ms_migrar").prop("checked", false);
                    $('#check_masivo').prop('checked', false);
                    jsRemoveWindowLoad();
                    Swal.fire("Registros procesados correctamente", "", "success");
                    $("#table_result_ordenes_ms").html(table);
                    $("#Modal_Result_Ordenes_Ms").modal('show');
                }
            });

        }
    })

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
    height = 20; //El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;

    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;

    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto / 2 - parseInt(height) / 2; //Se utiliza en el margen superior, para centrar

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

$(document).on('click', '.EditarValores', function() {

    var descr = $(this).attr('data-descr');
    res = descr.split("}");

    orden = (res[0]);
    valor_orden = (res[1]);
    valor_orden_db = (res[1]);
    valor_seguro = (res[2]);
    valor_ingles = (res[3]);
    console.log(valor_ingles);
    if (valor_ingles === '' || valor_ingles === undefined || valor_ingles === null) { valor_ingles = 0; }
    valor_matricula = (res[4]);
    cedula = (res[5]);
    documento = (res[6]);
    valor_descuento = (res[7]);
    porcentaje_descuento = (res[8]);

    $("#id_orden_edit").val(orden);
    $("#documento_orden_edit").val(documento);
    $("#cedula_orden_edit").val(cedula);

    $("#valor_orden_edit2").val(valor_orden);
    $("#valor_orden_db").val(valor_orden_db);
    $("#valor_servicio_medico2").val(valor_seguro);
    $("#valor_idiomas_edit2").val(valor_ingles);

    /* $("#porc_descuento_edit").val(porcentaje_descuento); */


    $("#valor_orden_edit").val(valor_orden_db);
    $("#valor_servicio_medico").val(valor_seguro);
    $("#valor_servicio_medico").prop("disabled", true);
    $("#valor_idiomas_edit").val(valor_ingles);
    valor_matricula = (parseFloat(valor_orden_db) + parseFloat(valor_seguro) + parseFloat(valor_ingles) - parseFloat(valor_descuento));
    $("#span_total_valores").html('$ ' + addCommas(Math.round(valor_matricula)));
    $("#valor_descuento").val(Math.round(valor_descuento));
    $("#porcentaje_descuento").val(porcentaje_descuento);

    $("#Modal_Actualizar_Valores").modal('show');
    $(".modG").modal('hide');

});

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

function sumTot() {
    porc_descuento_edit = $("#porc_descuento_edit").val();

    valor_orden_db = $("#valor_orden_db").val();
    valor_orden = $("#valor_orden_edit").val();

    valor_servicio = $("#valor_servicio_medico").val();
    valor_idiomas = $("#valor_idiomas_edit").val();

    valor_descuento = $("#valor_descuento").val();
    porc_desc = $("#porcentaje_descuento").val();

    if (valor_orden === '' || valor_orden === undefined) { valor_orden = 0; }
    if (valor_servicio === '' || valor_servicio === undefined) { valor_servicio = 0; }
    if (valor_idiomas === '' || valor_idiomas === undefined || valor_idiomas === null) { valor_idiomas = 0; }
    if (valor_descuento === '' || valor_descuento === undefined) { valor_descuento = 0; }
    if (porc_desc === '' || porc_desc === undefined) { porc_desc = 0; }





    if ($("#porc_descuento_edit").val() == '') {
        new_descuento = 0;
        t = (parseFloat(valor_orden) * parseFloat(porc_desc)) / 100;
        total = (parseFloat(valor_orden) + parseFloat(valor_servicio) + parseFloat(valor_idiomas) - parseFloat(t));
        $("#valor_descuento").val(Math.round(t));
        $("#span_total_valores").html('$ ' + addCommas(Math.round(total)));
    } else {
        new_descuento = (parseFloat(valor_orden_db) * parseFloat(porc_descuento_edit)) / 100;
        new_valor = valor_orden_db - new_descuento;
        $("#valor_orden_edit").val(Math.round(new_valor));
        t = (parseFloat(new_valor) * parseFloat(porc_desc)) / 100;
        total = (parseFloat(new_valor) + parseFloat(valor_servicio) + parseFloat(valor_idiomas) - parseFloat(t));
        $("#valor_descuento").val(Math.round(t));
        $("#span_total_valores").html('$ ' + addCommas(Math.round(total)));
    }



}

function ActualizarValores() {

    //Capturar datos

    id_orden = $("#id_orden_edit").val();
    documento = $("#documento_orden_edit").val();
    cedula = $("#cedula_orden_edit").val();
    valor_orden = $("#valor_orden_edit").val();
    valor_idiomas = $("#valor_idiomas_edit").val();

    valor_orden_act = $("#valor_orden_edit2").val();
    valor_idiomas_act = $("#valor_idiomas_edit2").val();

    if (valor_orden == '') {
        Swal.fire("El valor de la orden no puede estar vacia");
        return 0;
    }
    /*
    	if(valor_idiomas == ''){
    		Swal.fire("El valor de idiomas no puede estar vacio");
    		return 0;
    	}
    */

    datos = {
        'id_orden': id_orden,
        'documento': documento,
        'cedula': cedula,
        'valor_orden': valor_orden,
        'valor_idiomas': valor_idiomas,
        'valor_orden_act': valor_orden_act,
        'valor_idiomas_act': valor_idiomas_act,
    };

    $.ajax({
        url: 'php/recibos_full/UpdateValoresOrden.php',
        data: datos,
        type: 'POST',
        success: function(R) {
            if (R == 1) {
                Swal.fire("Orden actualizada correctamente", "", "success");
                ConsultaCedula();
                $("#Modal_Actualizar_Valores").modal('hide');
            } else {
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

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

function ReporteOrdenesMod() {

    fecha_desde = $("#fecha_desde").val();
    fecha_hasta = $("#fecha_hasta").val();

    if (fecha_desde == '' || fecha_hasta == '') {
        Swal.fire("No pueden haber fechas vacias");
        return 0;
    }

    datos = { 'fecha_desde': fecha_desde, 'fecha_hasta': fecha_hasta };

    $("#loadingDataReporte").show();
    $("#result_file_load").hide();
    $("#btnreporteordenesmod").prop("disabled", true);

    $.ajax({
        url: 'php/recibos_full/ReporteOrdenesMod.php',
        data: datos,
        type: 'POST',
        dataType: 'JSON',
        success: function(R) {

            $("#btnreporteordenesmod").prop("disabled", false);
            status = R['status'];
            link_descarga = R['link'];
            $("#loadingDataReporte").hide();

            if (status == 1) {
                Swal.fire("Reporte generado correctamente", "", "success");
                $("#result_file_load").show();
                $("#fecha_desde").val('');
                $("#fecha_hasta").val('');
                $('#link_download_excel').attr('href', link_descarga);
            } else {
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#btnreporteordenesmod").prop("disabled", false);
            $("#loadingDataReporte").hide();
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
}

function MarcaPago(str) {

    periodo = str['PERIODO'];
    cedula = str['CLIENTE_SOLICITADO'];
    orden = str['ORDEN'];

    Swal.fire({
        title: '¿Activar marco de pago?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Activar marca de pago',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            datos = { 'periodo': periodo, 'cedula': cedula, 'orden': orden };
            $.ajax({
                url: 'php/recibos_full/ActivarMarcaPago.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Marca de pago activada correctamente", "", "success");
                    } else {
                        Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                }
            });

        }
    });


}

function QuitarMarcaPago(str) {

    periodo = str['PERIODO'];
    cedula = str['CLIENTE_SOLICITADO'];
    orden = str['ORDEN'];

    Swal.fire({
        title: '¿Quitar marca de pago?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Quitar marca de pago',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            datos = { 'periodo': periodo, 'cedula': cedula, 'orden': orden };
            $.ajax({
                url: 'php/recibos_full/QuitarMarcaPago.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Marca de pago quitada correctamente", "", "success");
                    } else {
                        Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                }
            });

        }
    });


}

function CunVive(str) {

    periodo = str['PERIODO'];
    cedula = str['CLIENTE_SOLICITADO'];
    nombre = str['NOMBRE_NEGOCIO'];

    Swal.fire({
        title: '¿Activar Cun Vive?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Activar cun vive',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            service = window.open('http://190.184.202.251:8090/zoho_cunvive/InsertCunvive.php?cedula=' + cedula + '&periodo=' + periodo + '&user=' + nombre + '&programa=' + programa);
            Swal.fire("Cun vive activado correctamente", "", "success");
            /* datos = { 'periodo': periodo, 'cedula': cedula }; */
            /* $.ajax({
                url: 'php/recibos_full/ActivarCunVive.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        setTimeout(function() { service.close() }, 100000);
                    } else {
                        Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                }
            }); */

        }
    });


}

$("#form_uploadfile").on("submit", function(e) {
    $(".modal").modal('hide');
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("form_uploadfile"));

    $("#loadingData").show();
    $("#btnload").prop("disabled", true);
    $(".result_file_load").hide();

    $.ajax({
        url: "php/recibos_full/upload_cedulas.php",
        type: "post",
        //dataType: "JSON",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(table) {
            $("#file").val('');
            $("#btnload").prop("disabled", false);
            $("#loadingData").hide();
            $(".result_file_load").show();
            $("#table_result").html(table);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#btnload").prop("disabled", false);
            $("#loadingData").hide();
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
});
