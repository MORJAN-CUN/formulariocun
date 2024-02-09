$("#form_uploadfile").on("submit", function(e){
e.preventDefault();
var f = $(this);
var formData = new FormData(document.getElementById("form_uploadfile"));

$("#loadingD[ata").show();
    $("#btnload").prop("disabled", true);
    $(".result_file_load").hide();

    $.ajax({
    url: "php/fechas_cartera/upload_fechas_cartera.php",
    type: "post",
    //dataType: "JSON",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
        success:function(table){
            $("#file").val('');
            $("#btnload").prop("disabled", false);
            $("#loadingData").hide();
            $(".result_file_load").show();
            $("#table_result_excel").html(table);
        },error:function( jqXHR, textStatus, errorThrown ){
            $("#btnload").prop("disabled", false);
            $("#loadingData").hide();
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
});

function Consultar(){

    cedula = $("#cedula_estudiante").val();

    if(cedula == ''){
        Swal.fire("La cedula no puede estar vacia");
        return 0;
    }

    datos = {'cedula':cedula};

    $.ajax({
    data: datos,
    type: 'POST',
    url: 'php/fechas_cartera/ConsultarEstudiante.php',
        success:function(table){
            $("#table_result").html(table);
        }
    });
}

function EditarFecha(str){

    datos_empleado = str;

    cedula = str['CLIENTE'];
    periodo = str['PERIODO'];
    nota_debito = str['NOTA_DEBITO'];

    $("#cedula_estudiante_edit").val(cedula);
    $("#periodo_estudiante_edit").val(periodo);
    $("#nota_debito_estudiante_edit").val(nota_debito);

    $("#Modal_EditarFecha").modal('show');

}

function ActualizarFecha(){

    cedula = $("#cedula_estudiante_edit").val();
    periodo = $("#periodo_estudiante_edit").val();
    nota_debito = $("#nota_debito_estudiante_edit").val();

    fecha_vencimiento = $("#fecha_vencimiento_edit").val();

    if(fecha_vencimiento == ''){
        Swal.fire("La fecha no puede estar vacia");
        return 0;
    }

    datos = {'cedula':cedula,'periodo':periodo,'nota_debito':nota_debito,'fecha_vencimiento':fecha_vencimiento};

    $.ajax({
    url: 'php/fechas_cartera/UpdateFecha.php',
    data: datos,
    type: 'POST',
        success:function(R){
            if(R == 1){
                Swal.fire("Fecha actualizada correctamente", "", "success");
                Consultar();
                $("#Modal_EditarFecha").modal('hide');
            }else{
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }
        },error:function( jqXHR, textStatus, errorThrown ){
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}