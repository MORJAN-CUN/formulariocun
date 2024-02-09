window.onload = getComerciales;

function getComerciales() {

    $.ajax({
        type: 'POST',
        url: 'php/gestor_comercial/CargarGestores.php',
        success: function(table) {
            $("#table_comerciales").html(table);
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



function ActivarGestor() {

    cedula = $("#cedula").val();

    datos = {
        /* 'nombre': nombre, */
        'cedula': cedula,
    };


    Swal.fire({
        title: '¿Activar Gestor Comercial?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Activar gestor comercial',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'php/gestor_comercial/ActivarGestor.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 11) {
                        Swal.fire("Gestor activado correctamente", "", "success");
                        setTimeout(function() { location.reload() }, 2000);
                        service = window.open('http://190.184.202.251:8090/zoho_CRM/createGestores.php');
                        setTimeout(function() { service.close() }, 100);
                    } else {
                        Swal.fire("¡Atención!", "El número de documento " + cedula + " puede que no exista o ya se encuentre registrado dentro de los gestores", "info");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                }
            });

        }
    });


}

function dataName() {
    cedula = $("#cedula").val();
    if (cedula.length >= 10) {
        datos = {
            /* 'nombre': nombre, */
            'cedula': cedula,
        };

        $.ajax({
            type: 'POST',
            url: 'php/gestor_comercial/dataName.php',
            data: datos,
            success: function(name) {
                $("#name").html(name);
            }
        });
    }

}

/* function GenerarReporte() {

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

} */