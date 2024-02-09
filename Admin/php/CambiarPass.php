<?php
session_start();
$id_user = $_SESSION['id_user'];
$pass_actual = $_POST['pass_actual'];
$pass_new = $_POST['pass_new'];

//Enviar ID por cURL para consultar datos del empleado

$url = 'http://190.184.202.251:8090/formularioback/Admin/CambiarPass.php';
//$url = 'http://localhost/CUN/formularioback/Admin/CambiarPass.php';

$datos = array(
	'id_user' => $id_user,
	'pass_actual' => $pass_actual,
	'pass_new' => $pass_new
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

echo $result;
