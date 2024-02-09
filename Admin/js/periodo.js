$(document).ready(function() {

    //serverLocation = 'localhost/CUN';
    serverLocation = '190.184.202.251:8090';

    //select periodo
    $.ajax({
        url: 'http://' + serverLocation + '/formularioback/Admin/Promociones/Periodo.php',
        type: 'POST',
        success: function(r) {
            var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';

            for (var i = 0; i < obj.length; i++) {
                objHtml += '<option value ="' + obj[i].periodo + '">' + obj[i].periodo + " " + obj[i].nombre + '</option>';
            }

            $('#periodo').html('<option disabled selected>Selecciona una opción</option>' + objHtml);

            //Periodo edit
            var objHtmledit = '';

            for (var i = 0; i < obj.length; i++) {
                objHtmledit += '<option value ="' + obj[i].periodo + '">' + obj[i].periodo + " " + obj[i].nombre + '</option>';
            }

            $('#periodoedit').html('<option disabled selected>Selecciona una opción</option>' + objHtmledit);
        }
    });

    //select financiacion:
    $.ajax({
        url: 'http://' + serverLocation + '/formularioback/Admin/Promociones/Financiacion.php',
        type: 'POST',
        success: function(r) {
            var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';

            for (var i = 0; i < obj.length; i++) {
                objHtml += '<option value ="' + obj[i].descripcion + '">' + obj[i].descripcion + '</option>';
            }

            $('#tipofinanciacion').html('<option disabled selected>Selecciona una opción</option>' + objHtml);

            //Tipo financiacion edit
            var objHtmledit = '';

            for (var i = 0; i < obj.length; i++) {
                objHtmledit += '<option value ="' + obj[i].descripcion + '">' + obj[i].descripcion + '</option>';
            }

            $('#tipofinanciacionedit').html('<option disabled selected>Selecciona una opción</option>' + objHtmledit);

        }
    });

    //select periodo Idiomas
    $.ajax({
        url: 'http://' + serverLocation + '/formularioback/Admin/Promociones/Periodo_idiomas2.php',
        type: 'POST',
        success: function(r) {
            var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';

            for (var i = 0; i < obj.length; i++) {
                objHtml += '<option value ="' + obj[i].periodo_idiomas + '">' + obj[i].periodo_idiomas + '</option>';
            }

            $('#periodoIdiomas').html('<option disabled selected>Selecciona una opción</option>' + objHtml);

            //Periodo idiomas edit
            var objHtmledit = '';

            for (var i = 0; i < obj.length; i++) {
                objHtmledit += '<option value ="' + obj[i].periodo_idiomas + '">' + obj[i].periodo_idiomas + '</option>';
            }

            $('#periodoIdiomasedit').html('<option disabled selected>Selecciona una opción</option>' + objHtmledit);

        }
    });


});

function GuardarDatos() {

    //serverLocation = 'localhost/CUN';
    serverLocation = '190.184.202.251:8090';

    periodo = $("#periodo").val();
    tipoPromocion = $("#tipofinanciacion").val();
    fechaRegistro = $("#fechaRegistro").val();
    fechaFinal = $("#fechaFinal").val();
    periodoIdiomas = $("#periodoIdiomas").val();
    cuotas = $("#cuotas").val();
    porcpagar = $("#porcpagar").val();

    if (periodo == '' || tipoPromocion == '' || fechaRegistro == '' || fechaFinal == '' || periodoIdiomas == '' || cuotas == '' || porcpagar == '') {
        Swal.fire("Hay datos vacios");
        return 0;
    }

    datos = {
        'periodo': periodo,
        'tipoPromocion': tipoPromocion,
        'fechaRegistro': fechaRegistro,
        'fechaFinal': fechaFinal,
        'periodoIdiomas': periodoIdiomas,
        'cuotas': cuotas,
        'porcpagar': porcpagar
    };


    $.ajax({
        url: 'http://' + serverLocation + '/formularioback/Admin/Promociones/CrearParamPeriodo.php',
        type: 'POST',
        data: datos,
        success: function(R) {
            if (R == 1) {
                Swal.fire("Guardado Correctamente", "", "success");
                $("#form_create")[0].reset();
                ConsultarPeriodos();
                return 0;
            } else if (R == 2) {
                Swal.fire("El registro ya existe", "", "warning");
                return 0;
            } else {
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}


window.onload = ConsultarPeriodos;

function ConsultarPeriodos() {

    $.ajax({
        url: 'php/PeriodosCreados.php',
        type: 'POST',
        success: function(Table) {
            $("#table_periodos").html(Table);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}

function EditarPeriodo(str) {

    id_periodo = str;
    $("#idperiodo_edit").val(id_periodo);

    //Cargar datos en inputs

    datos = { 'id_periodo': id_periodo };

    $.ajax({
        url: 'php/ConsDatosPeriodo.php',
        data: datos,
        type: 'POST',
        dataType: 'JSON',
        success: function(Data) {
            periodo = Data['PERIODO'];
            tipo_promocion = Data['TIPO_PROMOCION'];
            fecha_registro = Data['FECHA_REGISTRO'];
            fecha_final = Data['FECHA_FINAL'];
            periodo_idiomas = Data['PERIODO_IDIOMAS'];
            numero_cuotas = Data['NUMERO_CUOTAS'];
            porc_a_pagar = Data['PORC_A_PAGAR'];

            $("#periodoedit").val(periodo);
            $("#tipofinanciacionedit").val(tipo_promocion);
            $("#fecharegistro_edit").val(fecha_registro);
            $("#fechafinal_edit").val(fecha_final);
            $("#periodoIdiomasedit").val(periodo_idiomas);
            $("#numero_cuotasedit").val(numero_cuotas);
            $("#porc_a_pagaredit").val(porc_a_pagar);

            //Antes
            $("#periodoedit_antes").val(periodo);
            $("#tipofinanciacionedit_antes").val(tipo_promocion);

            $("#modal-EditarPeriodo").modal('show');
        }
    });
}

function ActualizarPeriodo() {

    //Capturar datos de inputs del modal de edit

    id_periodo = $("#idperiodo_edit").val();
    periodo = $("#periodoedit").val();
    tipo_financiacion = $("#tipofinanciacionedit").val();
    fecha_registro = $("#fecharegistro_edit").val();
    fecha_final = $("#fechafinal_edit").val();
    periodo_idiomas = $("#periodoIdiomasedit").val();
    numero_cuotas = $("#numero_cuotasedit").val();
    porc_a_pagar = $("#porc_a_pagaredit").val();

    //Antes
    periodoedit_antes = $("#periodoedit_antes").val();
    tipofinanciacionedit_antes = $("#tipofinanciacionedit_antes").val();

    if (periodo == '') { Swal.fire("Selecciona el periodo"); return 0; }
    if (tipo_financiacion == '' || tipo_financiacion == null) { Swal.fire("Selecciona el tipo de Financiacion"); return 0; }
    if (fecha_registro == '' || fecha_final == '') { Swal.fire("Hay fechas vacias"); return 0; }
    if (periodo_idiomas == '') { Swal.fire("Selecciona el periodo idiomas"); return 0; }
    if (numero_cuotas == '') { Swal.fire("Las cuotas no pueden estar vacias"); return 0; }
    if (porc_a_pagar == '') { Swal.fire("El porcentaje no puede estar vacio"); return 0; }

    datos = {
        'id_periodo': id_periodo,
        'periodo': periodo,
        'tipo_financiacion': tipo_financiacion,
        'fecha_registro': fecha_registro,
        'fecha_final': fecha_final,
        'periodo_idiomas': periodo_idiomas,
        'numero_cuotas': numero_cuotas,
        'porc_a_pagar': porc_a_pagar,
        'periodoedit_antes': periodoedit_antes,
        'tipofinanciacionedit_antes': tipofinanciacionedit_antes
    };

    $.ajax({
        url: 'php/UpdatePeriodo.php',
        data: datos,
        type: 'POST',
        success: function(R) {
            if (R == 1) {
                Swal.fire("Datos actualizados correctamente", "", "success");
                ConsultarPeriodos();
                $("#modal-EditarPeriodo").modal('hide');
            } else if (R == 2) {
                Swal.fire("El registro ya existe", "", "warning");
                return 0;
            } else {
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
}

function cuota() {
    //console.log("entra");
    cuotas = $("#cuotas").val();

    if (cuotas < 1 || cuotas > 4) {
        $("#alertcuotas").show();
        $("#cuotas").addClass('errorva');
        $("#btn_guardarperiodo").prop("disabled", true);
    } else {
        $("#alertcuotas").hide();
        $("#cuotas").removeClass('errorva');
        $("#btn_guardarperiodo").prop("disabled", false);
    }
}

function valporcentaje() {
    //console.log("entra");
    porcentaje = $("#porcpagar").val();

    if (porcentaje < 0 || porcentaje > 100) {
        $("#alertporcpagar").show();
        $("#porcpagar").addClass('errorva');
        $("#btn_guardarperiodo").prop("disabled", true);
    } else {
        $("#alertporcpagar").hide();
        $("#porcpagar").removeClass('errorva');
        $("#btn_guardarperiodo").prop("disabled", false);
    }
}