<?php
function DyD_deducciones($periodo,$cedula,$nmro_cuenta){ 	
	
	//Obtener conceptos devengados

	$conceptos = consultarConceptos_dedu($periodo,$cedula,$nmro_cuenta);
	$array_principal = $conceptos;

	$DyD_deducciones = array(
		'Salud' => array(
			'Porcentaje' => DesfragmentarValue_dedu(extraerData_dedu('Salud','Porcentaje',null,$array_principal)),
			'Deduccion' => DesfragmentarValue_dedu(extraerData_dedu('Salud','Deduccion',null,$array_principal))
		),
		'FondoPension' => array(
			'Porcentaje' => DesfragmentarValue_dedu(extraerData_dedu('FondoPension','Porcentaje',null,$array_principal)),
			'Deduccion' => DesfragmentarValue_dedu(extraerData_dedu('FondoPension','Deduccion',null,$array_principal))
		),
		'FondoSP' => array(
			'Porcentaje' => DesfragmentarValue_dedu(extraerData_dedu('FondoSP','Porcentaje',null,$array_principal)),
			'DeduccionSP' => DesfragmentarValue_dedu(extraerData_dedu('FondoSP','DeduccionSP',null,$array_principal)),
			'PorcentajeSub' => DesfragmentarValue_dedu(extraerData_dedu('FondoSP','PorcentajeSub',null,$array_principal)),
			'DeduccionSub' => DesfragmentarValue_dedu(extraerData_dedu('FondoSP','DeduccionSub',null,$array_principal))
		),
		'Sindicatos' => array(	
			'Sindicato' => array(
				'Porcentaje' => DesfragmentarValue_dedu(extraerData_dedu('Sindicatos','Sindicato','Porcentaje',$array_principal)),
				'Deduccion' => DesfragmentarValue_dedu(extraerData_dedu('Sindicatos','Sindicato','Deduccion',$array_principal))
			),
		),
		'Sanciones' => array(
			'Sancion' => array(
				'SancionPublic' => DesfragmentarValue_dedu(extraerData_dedu('Sanciones','Sancion','SancionPublic',$array_principal)),
				'SancionPriv' => DesfragmentarValue_dedu(extraerData_dedu('Sanciones','Sancion','SancionPriv',$array_principal))
			),
		),
		'Libranzas' => array(
			'Libranza' => array(
				'Descripcion' => DesfragmentarValue_dedu(extraerData_dedu('Libranzas','Libranza','Descripcion',$array_principal)),
				'Deduccion' => DesfragmentarValue_dedu(extraerData_dedu('Libranzas','Libranza','Deduccion',$array_principal)),
			),
		),
		'PagosTerceros' => array(
			'PagoTercero' => DesfragmentarValue_dedu(extraerData_dedu('PagosTerceros','PagoTercero',null,$array_principal))
		),
		'Anticipos' => array(
			'Anticipo' => DesfragmentarValue_dedu(extraerData_dedu('Anticipos','Anticipo',null,$array_principal))
		),
		'OtrasDeducciones' => array(
			'OtraDeduccion' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','OtraDeduccion',null,$array_principal)),
			'PensionVoluntaria' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','PensionVoluntaria',null,$array_principal)),
			'RetencionFuente' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','RetencionFuente',null,$array_principal)),
			'AFC' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','AFC',null,$array_principal)),
			'Cooperativa' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','Cooperativa',null,$array_principal)),
			'EmbargoFiscal' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','EmbargoFiscal',null,$array_principal)),
			'PlanComplementarios' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','PlanComplementarios',null,$array_principal)),
			'Educacion' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','Educacion',null,$array_principal)),
			'Reintegro' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','Reintegro',null,$array_principal)),
			'Deuda' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','Deuda',null,$array_principal)),
			'Redondeo' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','Redondeo',null,$array_principal)),
			'DevengadosTotal' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','DevengadosTotal',null,$array_principal)),
			'DeduccionesTotal' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','DeduccionesTotal',null,$array_principal)),
			'ComprobanteTotal' => DesfragmentarValue_dedu(extraerData_dedu('OtrasDeducciones','ComprobanteTotal',null,$array_principal))
		)
		
	);


	return $DyD_deducciones;

}

function consultarConceptos_dedu($periodo,$cedula,$nmro_cuenta){

	$url = 'http://190.184.202.251:8090/formularioback/Admin/nomina/json_deducidos.php';
	//$url = 'http://localhost/CUN/formularioback/Admin/nomina/json_deducidos.php';

	$datos = array(
	    'periodo' => $periodo,
	    'cedula' => $cedula,
	    'nmro_cuenta' => $nmro_cuenta
	);

	//Iniciar cURL

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);

	//curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


	$result = curl_exec($ch);

	curl_close($ch);

	return $data_empleados = json_decode($result,true);


}



function extraerData_dedu($nivel1,$nivel2,$nivel3,$array_principal){

	$result = array();

	foreach($array_principal as $key){

		if (in_array($nivel1, $key)){

			//Validar si nivel 2 trae datos

			if($nivel2 != null){

				if(in_array($nivel2, $key)){
					//Validar si nivel 3 trae datos

					if($nivel3 != null){

						if(in_array($nivel3, $key)){

							//devolver nivel 3
							array_push($result, $key['VALOR3']);

						}else{
							
							//devolver valor nivel 2
							array_push($result, $key['VALOR2']);

						}

					}else{
						//devolver valor nivel 2
						array_push($result, $key['VALOR2']);
					}

				}else{

					//devolver valor 1
					array_push($result, $key['VALOR1']);

				}

			}else{
				//devolver valor 1
				array_push($result, $key['VALOR1']);
			}

		}else{
			//No existe en los conceptos
			array_push($result, 0);
		}

	}

	return $result;

}

function DesfragmentarValue_dedu($array_result){

	$array_new_r = array();

	foreach ($array_result as $key){
		
		if($key == 0 || $key == null || empty($key)){

		}else{
			array_push($array_new_r, $key);
		}

	}

	$valor = $array_new_r[0];

	if($valor == '' || $valor == null || empty($valor)){
		$valor = 0;
	}

	return $valor;

}

?>