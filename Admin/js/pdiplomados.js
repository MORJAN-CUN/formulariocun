$(document).ready(function() {

    serverLocation = '190.184.202.251:8090/';
    //serverLocation = 'localhost/CUN/';

    //realizamos cargue de los periodos
    $.ajax({
        url: 'http://' + serverLocation + 'formularioback/Admin/pdiplomados/PeriodosActivos.php',
        method: 'POST',
        success: function(r) {
            var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';

            for (var i = 0; i < obj.length; i++) {
                objHtml += '<option value ="' + obj[i].COD_PERIODO + '">' + obj[i].COD_PERIODO + '</option>';
            }

            $('#periodo').html('<option selected value="">Seleccionar</option>' + objHtml);
            $('#periodo_edit').html('<option selected value="">Seleccionar</option>' + objHtml);
        }
    });

    //realizamos cargue de las regionales
    $('#periodo').on('change', function() {
        periodo = $(this).val();

        //select periodo Idiomas
        $.ajax({
            url: 'http://' + serverLocation + 'formularioback/Admin/pdiplomados/Regionales.php',
            type: 'POST',
            data: 'periodo=' + periodo,
            success: function(r) {
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';

                for (var i = 0; i < obj.length; i++) {
                    objHtml += '<option value ="' + obj[i].COD_REGIONAL + '">' + obj[i].NOM_REGIONAL + '</option>';
                }

                $('#regional').html('<option disabled selected>Selecciona una opción</option>' + objHtml);
            }
        });
    });

    //realizamos cargue de los programas
    $('#regional').on('change', function() {
        regional = $(this).val();
        periodo = $("#periodo").val();

        datos = { 'regional': regional, 'periodo': periodo };

        //select periodo Idiomas
        $.ajax({
            url: 'http://' + serverLocation + 'formularioback/Admin/pdiplomados/Programas.php',
            type: 'POST',
            data: datos,
            success: function(r) {
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';

                for (var i = 0; i < obj.length; i++) {
                    objHtml += '<option value ="' + obj[i].COD_UNIDAD + '/' + obj[i].CENTRO_COSTOS + '">' + obj[i].NOM_UNIDAD + '</option>';
                }

                $('#programa').html('<option disabled selected>Selecciona una opción</option>' + objHtml);
                $('#programa_edit').html('<option selected value="">Seleccionar</option>' + objHtml);
            }
        });
    });


    //realizamos cargue de los grupos
    $('#programa').on('change', function() {
        programa_value = $(this).val();
        res = programa_value.split("/");
        programa = (res[0]);
        centro_costos = (res[1]);

        periodo = $("#periodo").val();
        regional = $("#regional").val();

        datos = { 'regional': regional, 'periodo': periodo, 'programa': programa };

        //select periodo Idiomas
        $.ajax({
            url: 'http://' + serverLocation + 'formularioback/Admin/pdiplomados/Grupos.php',
            type: 'POST',
            data: datos,
            success: function(r) {
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';

                for (var i = 0; i < obj.length; i++) {
                    objHtml += '<option value ="' + obj[i].NUM_GRUPO + '">' + obj[i].NUM_GRUPO + '</option>';
                }

                $('#grupo').html('<option disabled selected>Selecciona una opción</option>' + objHtml);
                $('#grupo_edit').html('<option selected value="">Seleccionar</option>' + objHtml);
            }
        });
    });
});

//realizamos cargue del porcentaje (valor_uso)
$('#grupo').on('change', function() {
    console.log('invoco el servicio');
    $.ajax({
        success: function(r) {
            var objHtml = '';

            for (var i = 1; i <= 100; i++) {
                objHtml += '<option value ="' + i + '">' + i + ' %</option>';
            }

            $('#valor_uso').html('<option disabled selected>Selecciona una opción</option>' + objHtml);
            $('#valor_uso_edit').html('<option selected value="">Seleccionar</option>' + objHtml);
        }
    });
});

//realizamos cargue de la linea de credito
$('#valor_uso').on('change', function() {
    $.ajax({
        url: 'http://' + serverLocation + 'formularioback/Admin/pdiplomados/lineaCredito.php',
        type: 'POST',
        data: datos,
        success: function(r) {
            var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';

            for (var i = 0; i < obj.length; i++) {
                objHtml += '<option value ="' + obj[i].LINEA_CREDITO + '">' + obj[i].DESCRIPCION + '</option>';
            }

            $('#linea_credito').html('<option disabled selected>Selecciona una opción</option>' + objHtml);
            $('#linea_credito_edit').html('<option selected value="">Seleccionar</option>' + objHtml);
        }
    });
});

function ConsultarCabeceras() {

    periodo = $("#periodo").val();
    grupo = $("#grupo").val();
    centro_costos = $("#centro_costos").val();
    programa_value = $("#programa").val();
    regional = $("#regional").val();
    valor_uso = $("#valor_uso").val();
    linea_credito = $("#linea_credito").val();

    const sres = programa_value || '';

    res = sres.split("/");
    programa = (res[0]);
    centro_costos = (res[1]);
    if (periodo == "") { Swal.fire("Debes seleccionar un periodo"); return 0; }
    if (regional == null) { Swal.fire("Debes seleccionar una regional"); return 0; }
    if (programa == "") { Swal.fire("Debes seleccionar un programa"); return 0; }
    if (grupo == null) { Swal.fire("Debes seleccionar un grupo"); return 0; }
    if (valor_uso == null) { Swal.fire("Debes seleccionar un porcentaje"); return 0; }
    if (linea_credito == null) { Swal.fire("Debes seleccionar una linea de crédito"); return 0; }
    if (centro_costos == null) { Swal.fire("Debes seleccionar un centro de costos"); return 0; }

    datos = { 'periodo': periodo, 'grupo': grupo, 'centro_costos': centro_costos, 'programa': programa, 'valor_uso': valor_uso, 'linea_credito': linea_credito };

    $("#div_tabla").show();

    $.ajax({
        url: 'php/pdiplomados/ConsEncabezados.php',
        type: 'POST',
        data: datos,
        success: function(table) {
            $("#btncrear").show();
            $("#table_encabezados").html(table);
        }
    });

}

function CrearEncabezado() {

    //Capturar datos

    periodo = $("#periodo").val();
    grupo = $("#grupo").val();
    centro_costos = $("#centro_costos").val();
    programa_value = $("#programa").val();
    valor_uso = $("#valor_uso").val();
    linea_credito = $("#linea_credito").val();

    res = programa_value.split("/");
    programa = (res[0]);
    centro_costos = (res[1]);

    if (periodo == '') { Swal.fire("Debes seleccionar un periodo"); return 0; }
    if (grupo == '') { Swal.fire("Debes seleccionar un grupo"); return 0; }
    if (centro_costos == '') { Swal.fire("Debes seleccionar un centro de costos"); return 0; }
    if (programa == '') { Swal.fire("Debes seleccionar un programa"); return 0; }

    datos = { 'periodo': periodo, 'grupo': grupo, 'centro_costos': centro_costos, 'programa': programa, 'valor_uso': valor_uso, 'linea_credito': linea_credito };

    Swal.fire({
        title: '¿Crear encabezado?',
        text: "Esta acción no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Crear',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'php/pdiplomados/CrearEncabezado.php',
                type: 'POST',
                data: datos,
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Creado correctamente", "", "success");
                        ConsultarCabeceras();
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

function ConsDetalleEncabezado() {

    secuencia = $("#id_secuencia_modal").val();

    datos = { 'secuencia': secuencia };

    $.ajax({
        url: 'php/pdiplomados/ConsDetalleEncabezado.php',
        data: datos,
        type: 'POST',
        success: function(table_det) {
            $("#table_detalle").html(table_det);
            $("#ModalDatosEnc").modal('show');
        }
    });
}


function AgregarFecha(str) {

    secuencia = str;
    $("#id_secuencia_modal").val(secuencia);

    //Consultar los detalles de ese encabezado

    datos = { 'secuencia': secuencia };

    $.ajax({
        url: 'php/pdiplomados/ConsDetalleEncabezado.php',
        data: datos,
        type: 'POST',
        success: function(table_det) {
            $("#table_detalle").html(table_det);
            $("#ModalDatosEnc").modal('show');
        }
    });
}

function GuardarFecha() {

    secuencia = $("#id_secuencia_modal").val();
    fecha_vencimiento = $("#fecha_insert").val();

    if (fecha_vencimiento == '') {
        Swal.fire("La fecha no puede estar vacia");
        return 0;
    }

    datos = { 'secuencia': secuencia, 'fecha_vencimiento': fecha_vencimiento };

    $.ajax({
        url: 'php/pdiplomados/GuardarFecha.php',
        data: datos,
        type: 'POST',
        success: function(R) {
            if (R == 1) {
                $("#fecha_insert").val('');
                Swal.fire("Creado correctamente", "", "success");
                ConsDetalleEncabezado();
                ConsultarCabeceras();
            } else {
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
}

function EliminarDetalle(str) {

    secuencia_cab = $("#id_secuencia_modal").val();
    id_detalle = str;

    Swal.fire({
        title: '¿Eliminar Fecha?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            datos = { 'id_detalle': id_detalle, 'secuencia_cab': secuencia_cab };

            $.ajax({
                url: 'php/pdiplomados/EliminarFecha.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Eliminado correctamente", "", "success");
                        ConsDetalleEncabezado();
                        ConsultarCabeceras();
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

$(document).on('click', '.EditarFecha', function() {

    var descr = $(this).attr('data-descr');
    res = descr.split("}");

    id_detalle = (res[0]);
    fecha_vencimiento = (res[1]);

    $("#id_detalle_edit").val(id_detalle);
    $("#fecha_vencimiento_edit_audit").val(fecha_vencimiento);
    $("#Modal_EditarFecha").modal('show');
});


function UpdateDetalle() {

    id_detalle = $("#id_detalle_edit").val();
    fecha_vencimiento = $("#fecha_vencimiento_edit").val();
    fecha_vencimiento_audi = $("#fecha_vencimiento_edit_audit").val();

    if (fecha_vencimiento == '') {
        Swal.fire("La fecha no puede estar vacia");
        return 0;
    }

    datos = { 'id_detalle': id_detalle, 'fecha_vencimiento': fecha_vencimiento, 'fecha_vencimiento_audi': fecha_vencimiento_audi };

    $.ajax({
        url: 'php/pdiplomados/EditarDetalle.php',
        data: datos,
        type: 'POST',
        success: function(R) {
            if (R == 1) {
                Swal.fire("Actualizado correctamente", "", "success");
                ConsDetalleEncabezado();
                ConsultarCabeceras();
                $("#Modal_EditarFecha").modal('hide');
            } else {
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
}

$(document).on('click', '.EditarEncabezado', function() {

    var descr = $(this).attr('data-descr');
    res = descr.split("}");

    secuencia = (res[0]);
    periodo = (res[1]);
    grupo = (res[2]);
    centro_costos = (res[3]);
    programa = (res[4]);

    value_programa = programa + '/' + centro_costos;

    $("#id_encabezado_edit").val(secuencia);
    $("#periodo_edit").val(periodo);
    $("#grupo_edit").val(grupo);
    $("#programa_edit").val(value_programa);

    $("#periodo_edit_audi").val(periodo);
    $("#grupo_edit_audi").val(grupo);
    $("#programa_edit_audi").val(programa);
    $("#centro_costos_edit_audi").val(centro_costos);

    $("#Modal_EditarEncabezado").modal('show');
});

function UpdateEncabezado() {

    //Capturar datos
    secuencia = $("#id_encabezado_edit").val();
    periodo = $("#periodo_edit").val();
    grupo = $("#grupo_edit").val();
    programa_value = $("#programa_edit").val();

    res = programa_value.split("/");
    programa = (res[0]);
    centro_costos = (res[1]);

    if (periodo == '') { Swal.fire("Debes seleccionar un periodo"); return 0; }
    if (grupo == '') { Swal.fire("Debes seleccionar un grupo"); return 0; }
    if (centro_costos == '') { Swal.fire("Debes seleccionar un centro de costos"); return 0; }
    if (programa == '') { Swal.fire("Debes seleccionar un programa"); return 0; }

    periodo_edit_audi = $("#periodo_edit_audi").val();
    grupo_edit_audi = $("#grupo_edit_audi").val();
    programa_edit_audi = $("#programa_edit_audi").val();
    centro_costos_edit_audi = $("#centro_costos_edit_audi").val();


    datos = {
        'secuencia': secuencia,
        'periodo': periodo,
        'grupo': grupo,
        'centro_costos': centro_costos,
        'programa': programa,
        'periodo_edit_audi': periodo_edit_audi,
        'grupo_edit_audi': grupo_edit_audi,
        'programa_edit_audi': programa_edit_audi,
        'centro_costos_edit_audi': centro_costos_edit_audi
    };

    Swal.fire({
        title: '¿Actualizar encabezado?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: 'php/pdiplomados/EditarEncabezado.php',
                type: 'POST',
                data: datos,
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Actualizado correctamente", "", "success");
                        ConsultarCabeceras();
                        $("#Modal_EditarEncabezado").modal('hide');
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