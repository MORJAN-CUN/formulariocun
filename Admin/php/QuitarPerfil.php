<?php

$id = $_POST['id'];

$datos = array(
	'id' => $id,
);

$url = 'http://190.184.202.251:8090/formularioback/Admin/QuitarPerfil.php';
//$url = 'http://localhost/CUN/formularioback/Admin/QuitarPerfil.php';

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

$data = json_decode($result,true);

echo $data;
