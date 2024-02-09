<?php

function getDatos($factura){

	$url = 'http://190.184.202.251:8090/formularioback/Admin/facturacione/DatosFactura.php';
	//$url = 'http://localhost/CUN/formularioback/Admin/facturacione/DatosFactura.php';

	$datos = array(
	    'factura' => $factura
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

	return $data;

}

?>