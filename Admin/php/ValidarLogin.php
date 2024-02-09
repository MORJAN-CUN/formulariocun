<?php
$email = $_POST['email'];
$pass = $_POST['pass'];

//Enviar datos por cURL

// $url = 'http://190.184.202.251:8090/formularioback/Admin/ValidarLogin.php';
$url = 'http://localhost/formularioback/Admin/ValidarLogin.php';

$datos = array(
	'user' => $email,
	'pass' => $pass
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

$status = $data['status'];
$id_emple = $data['id_empl'];
$perfil = $data['perfil'];

if($status == 1){

	if($perfil != 0){

		session_start();
		$_SESSION['id_user'] = $id_emple;

	}

}

$r = array(
	'status' => $status,
	'perfil' => $perfil
);

echo json_encode($r);