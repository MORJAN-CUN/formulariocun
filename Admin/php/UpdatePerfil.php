<?php

$id_perfil = $_POST['id_perfil'];
$nom_perfil = $_POST['nom_perfil'];
$estado = $_POST['estado'];
$accesos = $_POST['accesos'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/UpdatePerfil.php';

$datos = array(
	'id' => $id_perfil,
	'nombre' => $nom_perfil,
	'estado' => $estado,
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

echo json_encode($data);