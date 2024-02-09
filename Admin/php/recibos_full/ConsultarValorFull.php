<?php

function ValorFull($periodo,$cod_modalidad,$cod_programa,$cod_ciclo){

	$url = 'http://190.184.202.251:8090/formularioback/Admin/recibos_full/ConsValorFull.php';
	//$url = 'http://localhost/CUN/formularioback/Admin/recibos_full/ConsValorFull.php';

	$datos = array(
	    'periodo' => $periodo,
	    'cod_modalidad' => $cod_modalidad,
	    'cod_programa' => $cod_programa,
	    'cod_ciclo' => $cod_ciclo
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

	$data = json_decode($result,true);

	if (array_key_exists(0, $data)) {
	  	
		$data_key = $data[0];

		$valor_nuevo = $data_key['NUEVO'];
		$valor_antiguo = $data_key['ANTIGUO'];
		$valor_convenio = $data_key['CONVENIO'];

	}else{
		
		$valor_nuevo = 0;
		$valor_antiguo = 0;
		$valor_convenio = 0;

	}

	

	return array(
		'nuevo' => $valor_nuevo,
		'antiguo' => $valor_antiguo,
		'convenio' => $valor_convenio
	);

}

?>