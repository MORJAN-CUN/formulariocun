<?php

$id = $_POST['id'];
$perfil = $_POST['perfil'];

$datos = array(
	'id' => $id,
	'perfil' => $perfil
);

$url = 'http://190.184.202.251:8090/formularioback/Admin/UpdatePerfilEmpleado.php';

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

$data = json_decode($result,true);

echo $data;
