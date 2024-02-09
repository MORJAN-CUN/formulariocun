$(document).ready(function() {

    /* $.ajax({
        url: 'php/aplicacion_pagos/Pagos.php',
        method: 'POST',
        success: function(table) {
            $('#table_pagos').html(table);
        }
    }); */

});

function ConsultarFechas() {

    fecha_desde = $("#fecha_desde").val();
    /* fecha_hasta = $("#fecha_hasta").val(); */
    datos = { 'fecha_desde': fecha_desde, /* 'fecha_hasta': fecha_hasta */ };
    $("#loadingData").show();

    $.ajax({
        data: datos,
        type: 'POST',
        url: 'php/aplicacion_pagos/PagosFechas.php',
        success: function(table) {
            $('#table_pagos').html(table);
            $("#loadingData").hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
}

function ConsultarFechasDiferencia() {

    fecha_desde = $("#fecha_desde").val();
    /* fecha_hasta = $("#fecha_hasta").val(); */
    datos = { 'fecha_desde': fecha_desde, /* 'fecha_hasta': fecha_hasta */ };
    $("#loadingData").show();

    $.ajax({
        data: datos,
        type: 'POST',
        url: 'php/aplicacion_pagos/PagosFechasDiferencia.php',
        success: function(table) {
            $('#table_pagos').html(table);
            $("#loadingData").hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
}

function ConsultarState() {
    fecha_desde = $("#fecha_desde").val();
    /* fecha_hasta = $("#fecha_hasta").val(); */
    datos = { 'fecha_desde': fecha_desde, /* 'fecha_hasta': fecha_hasta */ };
    $("#loadingData").show();
    $("#loadingData").show();

    $.ajax({
        data: datos,
        type: 'POST',
        url: 'php/aplicacion_pagos/PagosState.php',
        success: function(table) {
            $('#table_pagos').html(table);
            $("#loadingData").hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
}

function ConsultaEsp() {

    especifica = $("#especifica").val();

    datos = { 'especifica': especifica };
    $("#loadingData").show();

    $.ajax({
        data: datos,
        type: 'POST',
        url: 'php/aplicacion_pagos/PagosEsp.php',
        success: function(table) {
            $('#table_pagos').html(table);
            $("#loadingData").hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
}

function ConsultaID() {

    especifica = $("#especifica").val();

    datos = { 'especifica': especifica };
    $("#loadingData").show();

    $.ajax({
        data: datos,
        type: 'POST',
        url: 'php/aplicacion_pagos/PagosID.php',
        success: function(table) {
            $('#table_pagos').html(table);
            $("#loadingData").hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
}

function ConsultaVP() {

    especifica = $("#especifica").val();

    datos = { 'especifica': especifica };
    $("#loadingData").show();

    $.ajax({
        data: datos,
        type: 'POST',
        url: 'php/aplicacion_pagos/PagosVP.php',
        success: function(table) {
            $('#table_pagos').html(table);
            $("#loadingData").hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
}

function StatePending(str) {
    referencia = str;
    Swal.fire({
        title: '¿Cambiar estado a PENDING?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Cambiar estado',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            datos = { 'referencia': referencia };
            $.ajax({
                url: 'php/aplicacion_pagos/StatePending.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Estado cambiado a pending correctamente", "", "success");
                    } else {
                        Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                        console.log(R);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                }
            });

        }
    });
}

function ProcessResponse(str) {
    referencia = str;
    Swal.fire({
        title: '¿Procesar respuesta?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Procesar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            datos = { 'referencia': referencia };
            $.ajax({
                url: 'php/aplicacion_pagos/ProcessResponse.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Respuesta procesada correctamente", "", "success");
                    } else {
                        Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                        console.log(R);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
                }
            });

        }
    });
}

function DeleteDetResponse(str) {
    referencia = str;
    Swal.fire({
        title: '¿Está seguro que desea borrar el detalle de respuesta?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Borrar Detalle',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            datos = { 'referencia': referencia };
            $.ajax({
                url: 'php/aplicacion_pagos/DeleteDetResponse.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Detalle de respuesta borrado correctamente", "", "success");
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

function UpdateValorOrden(str) {
    referencia = str;
    Swal.fire({
        title: '¿Está seguro que desea actualizar el valor de la orden?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            datos = { 'referencia': referencia };
            $.ajax({
                url: 'php/aplicacion_pagos/UpdateValorOrden.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Valor de la orden actualizado correctamente", "", "success");
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

function DeleteResponse(str) {
    referencia = str;
    Swal.fire({
        title: '¿Está seguro que desea borrar la respuesta?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Borrar Respuesta',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            datos = { 'referencia': referencia };
            $.ajax({
                url: 'php/aplicacion_pagos/DeleteResponse.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Respuesta borrada correctamente", "", "success");
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

function UpdateValorCredito(ref, val) {
    referencia = ref;
    valor = val;
    Swal.fire({
        title: '¿Está seguro que desea actualizar el valor del credito?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            datos = { 'referencia': referencia, 'valor': valor };
            $.ajax({
                url: 'php/aplicacion_pagos/UpdateValorCredito.php',
                data: datos,
                type: 'POST',
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Valor de la orden actualizado correctamente", "", "success");
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

function ChechkMs() {

    if ($('#check_masivo').prop('checked')) {
        //Marcar todos los checks
        $(".check_ms_migrar").prop("checked", true);
    } else {
        //Desmarcar todos los checks
        $(".check_ms_migrar").prop("checked", false);
    }

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