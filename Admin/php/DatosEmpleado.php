<?php
if(!isset($_SESSION)){
	session_start();
}
$id_empleado = $_SESSION['id_user'];
//Enviar ID por cURL para consultar datos del empleado
$url = 'http://190.184.202.251:8090/formularioback/Admin/DatosEmpleado.php';
//$url = 'http://localhost/CUN/formularioback/Admin/DatosEmpleado.php';

$datos = array(
	'id' => $id_empleado
);

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datos));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


$result = curl_exec($ch);

curl_close($ch);

$data_empleado = json_decode($result,true);
//var_dump($data_empleado);


$NOMBRE = $data_empleado['nombre'];
$NOM_ARR = explode(' ', $NOMBRE);
$nombre_corto = $NOM_ARR[0];

$ACCESOS = $data_empleado['accesos'];
$accesos_arr = explode(",", $ACCESOS);


