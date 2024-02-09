function CargarMovMes() {

    factura = $("#num_factura").val();

    if (factura == '') {
        Swal.fire("El numero de factura no puede estar vacio");
        return 0;
    }

    $("#btnload").prop("disabled", true);
    $("#num_factura").prop("disabled", true);

    datos = { 'factura': factura };

    $("#div_ejecu_procesos").show();
    $("#gif_loading").show();
    $("#result_process").hide();

    $.ajax({
        url: 'php/facturacione/CargarMovMes.php',
        data: datos,
        type: 'POST',
        dataType: 'JSON',
        success: function(R) {

            status = R['status'];
            message = R['message'];

            $("#result_uno").html(message);
            $("#label_uno").show();

            CargarCabecera();

        }
    });

}


function CargarCabecera() {

    factura = $("#num_factura").val();

    datos = { 'factura': factura };

    $.ajax({
        url: 'php/facturacione/CargarCabecera.php',
        data: datos,
        type: 'POST',
        dataType: 'JSON',
        success: function(R) {
            message = R['output'];
            $("#result_dos").html(message);
            $("#label_dos").show();
            Renumericacion();
        }
    });

}

function Renumericacion() {

    $.ajax({
        url: 'php/facturacione/CargarRemuneracion.php',
        data: datos,
        type: 'POST',
        dataType: 'JSON',
        success: function(R) {
            message = R['message'];
            $("#result_tres").html(message);
            $("#label_tres").show();
            EnvioEbill();
        }
    });

}

function EnvioEbill() {

    $.ajax({
        url: 'php/facturacione/EnvioEbill.php',
        data: datos,
        type: 'POST',
        dataType: 'JSON',
        success: function(R) {
            message = R['message'];
            $("#result_cuatro").html(message);
            $("#label_cuatro").show();
            JobEbill();
        }
    });

}

function JobEbill() {

    factura = $("#num_factura").val();

    datos = { 'factura': factura };

    $.ajax({
        url: 'php/facturacione/JobEbill.php',
        data: datos,
        type: 'POST',
        dataType: 'JSON',
        success: function(R) {
            message = R['message'];
            $("#result_cinco").html(message);
            $("#label_cinco").show();

            $("#btnload").prop("disabled", false);
            $("#num_factura").val('');
            $("#num_factura").prop("disabled", false);
            $("#gif_loading").hide();
            $("#result_process").show();
            FacturasCargadas();
        }
    });

}

window.onload = FacturasCargadas;

function FacturasCargadas() {

    $.ajax({
        url: 'php/facturacione/FacturasCargadas.php',
        type: 'POST',
        success: function(table) {
            $("#table_result").html(table);
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

function dataInfo() {
    num_factura = $("#num_factura").val();
    if (num_factura.length >= 4) {
        datos = {
            'num_factura': num_factura,
        };
        $.ajax({
            type: 'POST',
            url: 'php/facturacione/dataInfo.php',
            data: datos,
            success: function(info) {
                $("#info").html(info);
            }
        });
    }
}