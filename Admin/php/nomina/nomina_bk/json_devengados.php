<?php 

function DyD_devengados($periodo,$cedula,$nmro_cuenta){

	//Obtener conceptos devengados

	$conceptos = consultarConceptos($periodo,$cedula,$nmro_cuenta);
	$array_principal = $conceptos;

	$DyD_devengados = array(
		'Basico' => array(
			'DiasTrabajados' => DesfragmentarValue(extraerData('Basico','DiasTrabajados',null,$array_principal)),
			'SueldoTrabajado' => DesfragmentarValue(extraerData('Basico','SueldoTrabajado',null,$array_principal))
		),
		'Transporte' => array(
			'AuxilioTransporte' => DesfragmentarValue(extraerData('Transporte','AuxilioTransporte',null,$array_principal)),
			'ViaticoManuAlojS' => DesfragmentarValue(extraerData('Transporte','ViaticoManuAlojS',null,$array_principal)),
			'ViaticoManuAlojNS' => DesfragmentarValue(extraerData('Transporte','ViaticoManuAlojNS',null,$array_principal))
		),
		'HEDs' => array(
			'HED' => array(
				'HoraInicio' => DesfragmentarValue(extraerData('HEDs','HED','HoraInicio',$array_principal)),
				'HoraFin' => DesfragmentarValue(extraerData('HEDs','HED','HoraFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('HEDs','HED','Cantidad',$array_principal)),
				'Porcentaje' => DesfragmentarValue(extraerData('HEDs','HED','Porcentaje',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('HEDs','HED','Pago',$array_principal))
			),
		),
		'HENs' => array(
			'HEN' => array(
				'HoraInicio' => DesfragmentarValue(extraerData('HENs','HEN','HoraInicio',$array_principal)),
				'HoraFin' => DesfragmentarValue(extraerData('HENs','HEN','HoraFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('HENs','HEN','Cantidad',$array_principal)),
				'Porcentaje' => DesfragmentarValue(extraerData('HENs','HEN','Porcentaje',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('HENs','HEN','Pago',$array_principal))
			),
		),
		'HRNs' => array(
			'HRN' => array(
				'HoraInicio' => DesfragmentarValue(extraerData('HRNs','HRN','HoraInicio',$array_principal)),
				'HoraFin' => DesfragmentarValue(extraerData('HRNs','HRN','HoraFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('HRNs','HRN','Cantidad',$array_principal)),
				'Porcentaje' => DesfragmentarValue(extraerData('HRNs','HRN','Porcentaje',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('HRNs','HRN','Pago',$array_principal))
			),
		),
		'HEDDFs' => array(
			'HEDDF' => array(
				'HoraInicio' => DesfragmentarValue(extraerData('HEDDFs','HEDDF','HoraInicio',$array_principal)),
				'HoraFin' => DesfragmentarValue(extraerData('HEDDFs','HEDDF','HoraFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('HEDDFs','HEDDF','Cantidad',$array_principal)),
				'Porcentaje' => DesfragmentarValue(extraerData('HEDDFs','HEDDF','Porcentaje',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('HEDDFs','HEDDF','Pago',$array_principal))
			),
		),
		'HRDDFs' => array(
			'HRDDF' => array(
				'HoraInicio' => DesfragmentarValue(extraerData('HRDDFs','HRDDF','HoraInicio',$array_principal)),
				'HoraFin' => DesfragmentarValue(extraerData('HRDDFs','HRDDF','HoraFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('HRDDFs','HRDDF','Cantidad',$array_principal)),
				'Porcentaje' => DesfragmentarValue(extraerData('HRDDFs','HRDDF','Porcentaje',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('HRDDFs','HRDDF','Pago',$array_principal))
			),
		),
		'HENDFs' => array(
			'HRDDF' => array(
				'HoraInicio' => DesfragmentarValue(extraerData('HENDFs','HRDDF','HoraInicio',$array_principal)),
				'HoraFin' => DesfragmentarValue(extraerData('HENDFs','HRDDF','HoraFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('HENDFs','HRDDF','Cantidad',$array_principal)),
				'Porcentaje' => DesfragmentarValue(extraerData('HENDFs','HRDDF','Porcentaje',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('HENDFs','HRDDF','Pago',$array_principal))
			),
		),
		'HRNDFs' => array(
			'HRNDF' => array(
				'HoraInicio' => DesfragmentarValue(extraerData('HRNDFs','HRNDF','HoraInicio',$array_principal)),
				'HoraFin' => DesfragmentarValue(extraerData('HRNDFs','HRNDF','HoraFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('HRNDFs','HRNDF','Cantidad',$array_principal)),
				'Porcentaje' => DesfragmentarValue(extraerData('HRNDFs','HRNDF','Porcentaje',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('HRNDFs','HRNDF','Pago',$array_principal))
			),
		),
		'Vacaciones' => array(
			'VacacionesComunes' => array(
				'FechaInicio' => DesfragmentarValue(extraerData('Vacaciones','VacacionesComunes','FechaInicio',$array_principal)),
				'FechaFin' => DesfragmentarValue(extraerData('Vacaciones','VacacionesComunes','FechaFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('Vacaciones','VacacionesComunes','Cantidad',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('Vacaciones','VacacionesComunes','Pago',$array_principal))
			),
			'VacacionesCompensadas' => array(
				'Cantidad' => DesfragmentarValue(extraerData('Vacaciones','VacacionesCompensadas','Cantidad',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('Vacaciones','VacacionesCompensadas','Pago',$array_principal))
			),
		),
		'Primas' => array(
			'Cantidad' => DesfragmentarValue(extraerData('Primas','Cantidad',null,$array_principal)),
			'Pago' => DesfragmentarValue(extraerData('Primas','Pago',null,$array_principal)),
			'PagoNS' => DesfragmentarValue(extraerData('Primas','PagoNS',null,$array_principal))
		),
		'Cesantias' => array(
			'Pago' => DesfragmentarValue(extraerData('Cesantias','Pago',null,$array_principal)),
			'Porcentaje' => DesfragmentarValue(extraerData('Cesantias','Porcentaje',null,$array_principal)),
			'PagoIntereses' => DesfragmentarValue(extraerData('Cesantias','PagoIntereses',null,$array_principal))
		),	
		'Incapacidades' => array(
			'Incapacidad' => array(
				'FechaInicio' => DesfragmentarValue(extraerData('Incapacidades','Incapacidad','FechaInicio',$array_principal)),
				'FechaFin' => DesfragmentarValue(extraerData('Incapacidades','Incapacidad','FechaFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('Incapacidades','Incapacidad','Cantidad',$array_principal)),
				'Tipo' => DesfragmentarValue(extraerData('Incapacidades','Incapacidad','Tipo',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('Incapacidades','Incapacidad','Pago',$array_principal))
			),
		),
		'Licencias' => array(
			'LicenciaMP' => array(
				'FechaInicio' => DesfragmentarValue(extraerData('Licencias','LicenciaMP','FechaInicio',$array_principal)),
				'FechaFin' => DesfragmentarValue(extraerData('Licencias','LicenciaMP','FechaFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('Licencias','LicenciaMP','Cantidad',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('Licencias','LicenciaMP','Pago',$array_principal))
			),
			'LicenciaR' => array(
				'FechaInicio' => DesfragmentarValue(extraerData('Licencias','LicenciaR','FechaInicio',$array_principal)),
				'FechaFin' => DesfragmentarValue(extraerData('Licencias','LicenciaR','FechaFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('Licencias','LicenciaR','Cantidad',$array_principal)),
				'Pago' => DesfragmentarValue(extraerData('Licencias','LicenciaR','Pago',$array_principal))
			),
			'LicenciaNR' => array(
				'FechaInicio' => DesfragmentarValue(extraerData('Licencias','LicenciaNR','FechaInicio',$array_principal)),
				'FechaFin' => DesfragmentarValue(extraerData('Licencias','LicenciaNR','FechaFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('Licencias','LicenciaNR','Cantidad',$array_principal))
			),
		),
		'Bonificaciones' => array(
			'Bonificacion' => array(
				'BonificacionS' => DesfragmentarValue(extraerData('Bonificaciones','Bonificacion','BonificacionS',$array_principal)),
				'BonificacionNS' => DesfragmentarValue(extraerData('Bonificaciones','Bonificacion','BonificacionNS',$array_principal))
			),
		),
		'Auxilios' => array(
			'Auxilio' => array(
				'AuxilioS' => DesfragmentarValue(extraerData('Auxilios','Auxilio','AuxilioS',$array_principal)),
				'AuxilioNS' => DesfragmentarValue(extraerData('Auxilios','Auxilio','AuxilioNS',$array_principal))
			),
		),
		'HuelgasLegales' => array(
			'HuelgaLegal' => array(
				'FechaInicio' => DesfragmentarValue(extraerData('HuelgasLegales','HuelgaLegal','FechaInicio',$array_principal)),
				'FechaFin' => DesfragmentarValue(extraerData('HuelgasLegales','HuelgaLegal','FechaFin',$array_principal)),
				'Cantidad' => DesfragmentarValue(extraerData('HuelgasLegales','HuelgaLegal','Cantidad',$array_principal))
			),
		),
		'OtrosConceptos' => array(
			'OtroConcepto' => array(
				'DescripcionConcepto' => DesfragmentarValue(extraerData('OtrosConceptos','OtroConcepto','DescripcionConcepto',$array_principal)),
				'ConceptoS' => DesfragmentarValue(extraerData('OtrosConceptos','OtroConcepto','ConceptoS',$array_principal)),
				'ConceptoNS' => DesfragmentarValue(extraerData('OtrosConceptos','OtroConcepto','ConceptoNS',$array_principal))
			),
		),
		'Compensaciones' => array(
			'Compensacion' => array(
				'CompensacionO' => DesfragmentarValue(extraerData('Compensaciones','Compensacion','CompensacionO',$array_principal)),
				'CompensacionE' => DesfragmentarValue(extraerData('Compensaciones','Compensacion','CompensacionE',$array_principal))
			),
		),
		'BonoEPCTVs' => array(
			'BonoEPCTV' => array(
				'PagoS' => DesfragmentarValue(extraerData('BonoEPCTVs','BonoEPCTV','PagoS',$array_principal)),
				'PagoNS' => DesfragmentarValue(extraerData('BonoEPCTVs','BonoEPCTV','PagoNS',$array_principal)),
				'PagoAlimentacionS' => DesfragmentarValue(extraerData('BonoEPCTVs','BonoEPCTV','PagoAlimentacionS',$array_principal)),
				'PagoAlimentacionNS' => DesfragmentarValue(extraerData('BonoEPCTVs','BonoEPCTV','PagoAlimentacionNS',$array_principal))
			),
		),
		'Comisiones' => array(
			'Comision' => DesfragmentarValue(extraerData('Comisiones','Comision',null,$array_principal))
		),
		'PagosTerceros' => array(
			'PagoTercero' => DesfragmentarValue(extraerData('PagosTerceros','PagoTercero',null,$array_principal))
		),
		'Anticipos' => DesfragmentarValue(extraerData('Anticipos',null,null,$array_principal))
	);

	return $DyD_devengados;

}


function consultarConceptos($periodo,$cedula,$nmro_cuenta){



	$url = 'http://190.184.202.251:8090/formularioback/Admin/nomina/json_devengados.php';
	//$url = 'http://localhost/CUN/formularioback/Admin/nomina/json_devengados.php';

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

function extraerData($nivel1,$nivel2,$nivel3,$array_principal){

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

function DesfragmentarValue($array_result){

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