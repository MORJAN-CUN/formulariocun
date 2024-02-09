<?php

function getFechaMax($secuencia){

	$url = 'http://190.184.202.251:8090/formularioback/Admin/pdiplomados/FechaMaxEncabezado.php';
	//$url = 'http://localhost/CUN/formularioback/Admin/pdiplomados/FechaMaxEncabezado.php';

	$datos = array(
    'secuencia' => $secuencia
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

	return $result;

}

?>