$("#form_uploadfile").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("form_uploadfile"));

    $("#loadingData").show();
    $("#btnload").prop("disabled", true);

    $.ajax({
    url: "php/credyty/upload_credyty.php",
    type: "post",
    dataType: "JSON",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
        success:function(res){
            console.log(res);
            $("#btnload").prop("disabled", false);
            $("#loadingData").hide();

            status = res['status'];
            consecutivo = res['consecutivo'];
            
            if(status == 1){
                CargarLoads();
                Swal.fire("Archivo cargado correctamente", "", "success");
                $("#result_file_load").show();
                $("#form_uploadfile")[0].reset();

                link = 'php/credyty/downloadfile.php?cons='+consecutivo;
                $('#link_download_excel').attr('href', link);

            }else if(status == 3){
                Swal.fire("Archivo no permitido", "Debes cargar un archivo con extension .xlsx", "warning");
            }else{
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }
        },error:function( jqXHR, textStatus, errorThrown ){
            $("#btnload").prop("disabled", false);
            $("#loadingData").hide();
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });
});

window.onload = CargarLoads;
function CargarLoads(){

    $.ajax({
    url: "php/credyty/Cons_Archivos_Cargados.php",
    type: "post",
        success:function(table){
            $("#table_loads").html(table);
        }
    });

}

function VerDetallleCredyty(str){

    consecutivo = str;

    datos = {'consecutivo':consecutivo};

    $("#Modal-detalle_credyty").modal('show');

    $.ajax({
    url: 'php/credyty/ConsDetalleCredyty.php',
    data: datos,
    type: 'POST',
        success:function(table){
            $("#table_detalle_credyty").html(table);
            link = 'php/credyty/downloadfile.php?cons='+consecutivo;
            $('#href_btn_modal_credyty').attr('href', link);

        },error:function( jqXHR, textStatus, errorThrown ){
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}