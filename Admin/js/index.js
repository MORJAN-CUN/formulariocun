function AccederN(){

    email = $("#email").val();
    password = $("#password").val();

    if(email == ''){
        Swal.fire("El email no puede estar vacio");
        return 0;
    }

    if(password == ''){
        Swal.fire("La contraseña no puede estar vacia");
        return 0;
    }

    datos = {'email':email,'pass':password};

    $.ajax({
    url: 'php/ValidarLogin.php',
    data: datos,
    method: 'POST',
    dataType: 'JSON',
        success:function(Result){  

        R = Result['status'];
        perfil = Result['perfil'];

            if(R == 1){

                if(perfil != 0){
                    //location.href ="dashboard.php";
                    window.location="dashboard.php";
                }else{
                    Swal.fire("Tu usuario se encuentra inactivo", "", "warning");
                    return 0;
                }
               
            }else{
                Swal.fire("Datos incorrectos", "Intentalo nuevamente", "warning");
                return 0;
            }

        },error:function( jqXHR, textStatus, errorThrown ){
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });


}   

 function Login(e) {
          
    if (e.keyCode === 13 && !e.shiftKey) {
        AccederN();
    }
}

function SolicitarNewPass(){

    email = $("#email_recovery").val();
    cedula = $("#cedula_recovery").val();

    if(email == ''){
        Swal.fire("El email no puede estar vacio");
        return 0;
    }

    if(cedula == ''){
        Swal.fire("La cedula no puede estar vacia");
        return 0;
    }

    datos = {'email':email,'cedula':cedula};

    $.ajax({
    url: 'php/SolicitarNewPass.php',
    data: datos,
    method: 'POST',
        success:function(R){   
        console.log(R);        
            if(R == 1){

                Swal.fire("Solicitud hecha correctamente", "Te hemos enviado un correo con las instrucciones para restablecer tu contraseña", "success");
                $("#email_recovery").val('');
                $("#cedula_recovery").val('');

                $("#Modal-CambiarPass").modal('hide');

            }else if(R == 0){
                Swal.fire("No hemos podido validar los datos", "Intenta nuevamente", "warning");
                return 0;
            }

        },error:function( jqXHR, textStatus, errorThrown ){
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
    });

}