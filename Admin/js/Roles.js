$(document).ready(function() {


    serverLocation = '190.184.202.251:8090';
    //serverLocation = 'localhost/CUN';

    //realizamos cargue de periodos activos
    $.ajax({
        url: 'http://' + serverLocation + '/formularioback/Admin/PerfilesActivos.php',
        method: 'POST',
        success: function(r) {
            var obj = JSON.parse(JSON.stringify(r));
            var objHtml = '';

            for (var i = 0; i < obj.length; i++) {
                objHtml += '<option value ="' + obj[i].id + '">' + obj[i].nom_perfil + '</option>';
            }

            $('#src_perfil').html('<option selected value="">Perfil...</option>' + objHtml);
        }
    });
});

function AsignarRoles() {

    $("#modal-AsigPerfil").modal('show');

    $.ajax({
        url: 'php/ConsEmpleados.php',
        method: 'POST',
        success: function(Table) {
            $("#table_usuarios").html(Table);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}

function dataPerfil() {
    option = document.getElementById("src_perfil").value;
    datos = { 'option': option };
    $.ajax({
        data: datos,
        url: 'php/ConsPerfilUsuario.php',
        method: 'POST',
        success: function(Table) {
            $("#table_usuarios").html(Table);
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

function CrearRol() {

    nom_rol = $("#nom_rol").val();
    est_rol = $("#est_rol").val();

    if (nom_rol == '') {
        Swal.fire("El nombre no puede estar vacio");
        return 0;
    }

    var arr = $('[name="checks[]"]:checked').map(function() {
        return this.value;
    }).get();

    var str = arr.join(',');

    accesos = str;

    if (accesos == '') {
        Swal.fire("Debes seleccionar minimo un acceso");
        return 0;

    }

    datos = { 'nom_rol': nom_rol, 'est_rol': est_rol, 'accesos': accesos };

    $.ajax({
        url: 'php/InsertPerfil.php',
        data: datos,
        method: 'POST',
        success: function(R) {
            if (R == 1) {
                Swal.fire("Perfil creado correctamente", "", "success");
                RolesCreados();

                $("#nom_rol").val('');
                $("#est_rol").val('');
                $(".acceso_rol").prop("checked", false);

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

window.onload = RolesCreados;

function RolesCreados() {

    $.ajax({
        url: 'php/ConsRolesCreados.php',
        method: 'POST',
        success: function(Table) {
            $("#table_roles").html(Table);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}


function AsigPerfilEmpleado(str) {

    $("#modal-AsigPerfil").modal('hide');
    $("#modal-AsigPerfilEmpleado").modal('show');

    $("#id_user").val(str);

    $.ajax({
        url: 'php/ConsRolesSelect.php',
        method: 'POST',
        success: function(select) {
            $("#select_perfiles").html(select);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}

function QuitPerfilEmpleado(str) {

    id = str;

    Swal.fire({
        title: '¿Esta seguro que desea eliminarle el perfil a este usuario?',
        text: "Esta accion no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Quitar perfil',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            datos = { 'id': id };
            $.ajax({
                url: 'php/QuitarPerfil.php',
                method: 'POST',
                data: datos,
                success: function(R) {
                    if (R == 1) {
                        Swal.fire("Perfil actualizado correctamente", "", "success");
                        dataPerfil();
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

function UpdPerfilEmp() {

    id = $("#id_user").val();
    perfil = $("#select_perfil").val();

    if (perfil == '') {
        Swal.fire("Debes seleccionar un perfil");
        return 0;
    }

    datos = { 'id': id, 'perfil': perfil };

    $.ajax({
        url: 'php/UpdatePerfilEmpleado.php',
        method: 'POST',
        data: datos,
        success: function(R) {
            if (R == 1) {
                Swal.fire("Perfil actualizado correctamente", "", "success");
                $("#modal-AsigPerfilEmpleado").modal('hide');
            } else {
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}


function EditarPerfil(id) {

    $("#id_perfil_upd").val(id);
    $("#modal-EditarPerfil").modal('show');

    datos = { 'id': id };

    $(".acceso_rol_updt").prop("checked", false);

    $.ajax({
        url: 'php/DatosPerfil.php',
        method: 'POST',
        data: datos,
        dataType: 'json',
        async: false,
        success: function(data) {

            datos_r = data[0];

            nom_perfil = datos_r['NOM_PERFIL'];
            accesos = datos_r['ACCESOS'];
            estado = datos_r['ESTADO_P'];

            $("#nom_perfil_updt").val(nom_perfil);
            $("#span_nom_perfil").html(nom_perfil);
            $("#est_rol_updt").val(estado);

            array_accesos = accesos.split(',');

            $.each(array_accesos, function(ind, elem) {
                $("#" + elem + "_updt").prop("checked", true);
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}

function UpdatePerfil() {

    id_perfil = $("#id_perfil_upd").val();
    nom_perfil = $("#nom_perfil_updt").val();
    estado = $("#est_rol_updt").val();

    var arr = $('[name="checks_upd[]"]:checked').map(function() {
        return this.value;
    }).get();

    var str = arr.join(',');

    accesos = str;

    if (accesos == '') {
        Swal.fire("Debes seleccionar minimo un acceso");
        return 0;

    }

    datos = { 'id_perfil': id_perfil, 'nom_perfil': nom_perfil, 'estado': estado, 'accesos': accesos };

    $.ajax({
        url: 'php/UpdatePerfil.php',
        method: 'POST',
        data: datos,
        success: function(R) {
            if (R == 1) {
                Swal.fire("Perfil actualizado correctamente", "", "success");
                RolesCreados();
                $("#modal-EditarPerfil").modal('hide');
            } else {
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });


}


function AsignacionMasiva() {


    var arr = $('[name="check_empleado[]"]:checked').map(function() {
        return this.value;
    }).get();

    var str = arr.join(',');

    empleados = str;

    if (empleados == '') {
        Swal.fire("Debes seleccionar minimo un usuario");
        return 0;

    }

    $("#empleados_ids").val(empleados);

    $("#modal-AsigPerfil").modal('hide');

    $.ajax({
        url: 'php/ConsRolesSelectMs.php',
        method: 'POST',
        success: function(select) {
            $("#select_perfiles_ms").html(select);
            $("#modal-AsigPerfilEmpleadoMasivo").modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}

function AsignacionMasivaPerfil() {

    empleados_ids = $("#empleados_ids").val();
    id_perfil = $("#select_perfilms").val();

    if (id_perfil == '') {
        Swal.fire("Debes seleccionar el perfil");
        return 0;
    }

    datos = { 'empleados_ids': empleados_ids, 'id_perfil': id_perfil };

    $.ajax({
        url: 'php/UpdatePefilEmplMasivo.php',
        method: 'POST',
        data: datos,
        success: function(R) {
            if (R == 1) {
                Swal.fire("Actualizacion hecha correctamente", "", "success");
                $("#modal-AsigPerfilEmpleadoMasivo").modal('hide');
            } else {
                Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}