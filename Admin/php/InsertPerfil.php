<?php

$nom_rol = $_POST['nom_rol'];
$est_rol = $_POST['est_rol'];
$accesos = $_POST['accesos'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/InsertPerfil.php';

$datos = array(
	'nom_rol' => $nom_rol,
	'est_rol' => $est_rol,
	'accesos' => $accesos
);

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

$data = json_decode($result,true);

echo $data;