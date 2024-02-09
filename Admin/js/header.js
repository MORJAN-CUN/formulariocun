function ActualizarPass(){

	$("#pass_actual").removeClass('valPass');

	pass_actual = $("#pass_actual").val();
	pass_new = $("#pass_new").val();
	pass_new_confirm = $("#pass_new_confirm").val();

	if(pass_actual == ''){Swal.fire("La contraseña actual no puede estar vacia"); return 0;}
	if(pass_new == ''){Swal.fire("La contraseña nueva no puede estar vacia"); return 0;}
	if(pass_new_confirm == ''){Swal.fire("Confirma la contraseña"); return 0;}

	pswd = pass_new;
	$("#pswd_info").show();

	    //validate the length
    if (pswd.length < 8){
    	one = 0;
        $('#length').removeClass('valid').addClass('invalid');
    }else{
    	one = 1;
        $('#length').removeClass('invalid').addClass('valid');
    }

    //validate letter
    if(pswd.match(/[A-z]/)){
    	two = 1;
        $('#letter').removeClass('invalid').addClass('valid');
    }else{
    	two = 0;
        $('#letter').removeClass('valid').addClass('invalid');
    }

    //validate capital letter
    if (pswd.match(/[A-Z]/)){
    	tree = 1;
        $('#capital').removeClass('invalid').addClass('valid');
    }else{
    	tree = 0;
        $('#capital').removeClass('valid').addClass('invalid');
    }

    //validate number
    if (pswd.match(/\d/)){
    	four = 1;
        $('#number').removeClass('invalid').addClass('valid');
    }else{
    	four = 0;
        $('#number').removeClass('valid').addClass('invalid');
    }

    validacion = [one,two,tree,four];
    est = validacion.includes(0);

    if(est == true){
    	return 0;
    }

	if(pass_new != pass_new_confirm){
		Swal.fire("Las contraseñas no coinciden");
		$("#pass_new").addClass('valPass');
		$("#pass_new_confirm").addClass('valPass');
		return 0;
	}else{
		$("#pass_new").removeClass('valPass');
		$("#pass_new_confirm").removeClass('valPass');
	}


	datos = {'pass_actual':pass_actual,'pass_new':pass_new};

	$.ajax({
	url:'php/CambiarPass.php',
	data: datos,
	type: 'POST',
		success:function(R){
			if(R == 1){
				Swal.fire("Contraseña actualizada correctamente", "", "success");
				$("#pass_actual").val('');
				$("#pass_new").val('');
				$("#pass_new_confirm").val('');
				$("#pswd_info").hide();
			}else if(R == 2){
				Swal.fire("La contraseña actual es incorrecta", "", "warning");
				$("#pass_actual").addClass('valPass');
			}else{
				Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
			}
		},error:function( jqXHR, textStatus, errorThrown ){
            Swal.fire("En este momento estamos presentando incoventientes", "Estamos trabajando para resolverlos lo antes posible", "warning");
        }
	});

}

