<?php

$empleados_ids = $_POST['empleados_ids'];
$id_perfil = $_POST['id_perfil'];

//$url = 'http://190.184.202.251:8090/formularioback/Admin/ConsPerfiles.php';
$url = 'http://localhost/CUN/formularioback/Admin/UpdatePerfilEmpleadoMS.php';

$datos = array(
	'empleados_ids' => $empleados_ids,
	'id_perfil' => $id_perfil
);

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);
/*
$data = json_decode($result,true);

print_r($data);
*/
echo $result;