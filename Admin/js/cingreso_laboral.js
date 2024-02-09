$(document).ready(function() {

    //realizamos cargue de los centros de costos
    $.ajax({
        url: 'php/ingreso_laboral/CentroCostos.php',
        method: 'POST',
        success: function(r) {
            $('#centro_costo').html(r);
        }
    });

    //realizamos cargue de los dispositivos
    $.ajax({
        url: 'php/ingreso_laboral/Dispositivos.php',
        method: 'POST',
        success: function(r) {
            $('#dispositivos').html(r);
        }
    });

});

function Consultar() {

    fecha_desde = $("#fecha_desde").val();
    fecha_hasta = $("#fecha_hasta").val();
    centro_costo = $("#centro_costo").val();
    dispositivos = $("#dispositivos").val();
    palabra_clave = $("#palabra_clave").val();

    datos = {
        'fecha_desde': fecha_desde,
        'fecha_hasta': fecha_hasta,
        'centro_costo': centro_costo,
        'dispositivos': dispositivos,
        'palabra_clave': palabra_clave
    };

    if (fecha_desde != '' && fecha_hasta == '') {
        Swal.fire("Debes seleccionar ambas fechas de busqueda");
        return 0;
    }

    if (fecha_hasta != '' && fecha_desde == '') {
        Swal.fire("Debes seleccionar ambas fechas de busqueda");
        return 0;
    }

    $("#btncons").prop("disabled", true);
    $("#table_empleados").html('<center><img src="img/Gif_Loading.gif" width="250"></center>');

    $.ajax({
        data: datos,
        type: 'POST',
        url: 'php/ingreso_laboral/ConsultarEmpleados.php',
        success: function(table) {
            console.log(table);
            $("#btncons").prop("disabled", false);
            $("#table_empleados").html(table);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    })

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

function GenerarReporte() {

    Swal.fire({
        title: '¿Generar reporte?',
        text: "Se utilizaran los filtros seleccionados!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Generar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            fecha_desde = $("#fecha_desde").val();
            fecha_hasta = $("#fecha_hasta").val();
            centro_costo = $("#centro_costo").val();
            dispositivos = $("#dispositivos").val();
            palabra_clave = $("#palabra_clave").val();

            datos = {
                'fecha_desde': fecha_desde,
                'fecha_hasta': fecha_hasta,
                'centro_costo': centro_costo,
                'dispositivos': dispositivos,
                'palabra_clave': palabra_clave
            };

            if (fecha_desde != '' && fecha_hasta == '') {
                Swal.fire("Debes seleccionar ambas fechas de busqueda");
                return 0;
            }

            if (fecha_hasta != '' && fecha_desde == '') {
                Swal.fire("Debes seleccionar ambas fechas de busqueda");
                return 0;
            }

            $("#result_file_load").hide();
            $("#loading_reporte").show();
            $("#btn_reporte").prop("disabled", true);

            $.ajax({
                data: datos,
                type: 'POST',
                dataType: 'JSON',
                url: 'php/ingreso_laboral/GenerarReporte.php',
                success: function(R) {
                    $("#loading_reporte").hide();
                    $("#btn_reporte").prop("disabled", false);
                    status = R['status'];
                    link_descarga = R['link'];

                    if (status == 1) {
                        Swal.fire("Reporte generado correctamente", "", "success");
                        $("#result_file_load").show();
                        $('#link_download_excel').attr('href', link_descarga);
                    } else {
                        Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $("#loading_reporte").hide();
                    $("#btn_reporte").prop("disabled", false);
                    Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                }
            })

        }
    })

}